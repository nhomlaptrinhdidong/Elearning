<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\BaiDang;
use App\Models\ChiTietLop;
use App\Models\Lop;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class TeacherController extends Controller
{
    public function index()
    {

        $dsLop = TaiKhoan::where('username', auth()->user()->username)->first();

        foreach ($dsLop->dsLop as $chitiet) {

            $chiTietLop = Lop::where('ma_lop', $chitiet->ma_lop)->first();
            $dschitiet[$chiTietLop->ma_lop]['ma_lop'] = $chiTietLop->ma_lop;
            $dschitiet[$chiTietLop->ma_lop]['ten_lop'] = $chiTietLop->ten_lop;
            $dschitiet[$chiTietLop->ma_lop]['banner'] = $chiTietLop->banner;
            $dschitiet[$chiTietLop->ma_lop]['mo_ta'] = $chiTietLop->mo_ta;

            foreach ($chiTietLop->chiTietLop as $taikhoan) {
                if ($taikhoan->username == auth()->user()->username) {
                    $dschitiet[$chiTietLop->ma_lop]['giao_vien'] = $taikhoan->ho_ten;
                    $dschitiet[$chiTietLop->ma_lop]['hinh_anh_gv'] = $taikhoan->hinh_anh;
                }
            }
        }
        return view('teachers/index', compact('dschitiet'));
    }
    public function userDetail()
    {
        return view('teachers/account-detail');
    }
    public function editUserProfile()
    {
        return view('teachers/edit-profile');
    }
    public function saveEditUserProfile(UpdateAccountRequest  $req)
    {
        $user = TaiKhoan::where('username', auth()->user()->username)->first();
        $user->ho_ten = $req->ho_ten;
        $user->gioi_tinh = $req->gioi_tinh;
        $user->ngay_sinh = date('Y/m/d', strtotime($req->ngay_sinh));
        $user->email = $req->email;
        $user->sdt = $req->sdt;
        $user->dia_chi = $req->dia_chi;
        if (!empty($req->hinh_anh)) {
            $uploadFile = $req->hinh_anh;
            $uploadFile->storeAs('img/users', auth()->user()->username . '.' . $uploadFile->extension());
            $user->hinh_anh = auth()->user()->username . '.' . $uploadFile->extension();
        }
        $user->save();
        Auth::setUser($user);
        return view('teachers/account-detail');
    }
    public function classroomDetail($ma_lop)
    {
        $dsClassroom = Lop::where('ma_lop', $ma_lop)->first();
        return view('teachers/classrooms/classroom-detail', compact('dsClassroom'));
    }
    public function studentDetail($username, $ma_lop)
    {

        $user = TaiKhoan::where('username', $username)->first();
        return view('teachers/classrooms/student-detail', compact('user', 'ma_lop'));
    }
    public function allMembers($ma_lop)
    {
        $dsClassroom = Lop::where('ma_lop', $ma_lop)->first();
        $taiKhoan = new TaiKhoan();
        $chiTietGV = [];
        foreach ($dsClassroom->chiTietLop as $chiTiet) {
            $chiTietTaiKhoan = TaiKhoan::where('username', $chiTiet->pivot->tai_khoan_id)->get();
            foreach ($chiTietTaiKhoan as $chiTiet) {
                if ($chiTiet->loai_tai_khoan_id == 2) {
                    $chiTietGV['giao_vien'] = $chiTiet->ho_ten;
                    $chiTietGV['hinh_anh_gv'] = $chiTiet->hinh_anh;
                }
            }
        };
        return view('teachers/classrooms/all-members', compact('taiKhoan', 'chiTietGV', 'dsClassroom'));
    }
    public function deleteStudent($username, $ma_lop)
    {
        ChiTietLop::where('lop_id', $ma_lop)->where('tai_khoan_id', $username)->first()->delete();
        $notification = array(
            'message' => 'Delete student successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function listStudents($ma_lop)
    {
        $dssv = ChiTietLop::select('tai_khoan_id')->where('lop_id', $ma_lop)->get()->toArray();
        $dsSinhVien = TaiKhoan::whereNotIn('username', $dssv)->where('loai_tai_khoan_id', '3')->get();
        return view('teachers/classrooms/list-students', compact('dsSinhVien', 'ma_lop'));
    }
    public function addStudent($ma_lop, Request $req)
    {
        if (!empty($req->username)) {

            foreach ($req->username as $sv) {
                $join = new ChiTietLop();
                $join->tai_khoan_id = $sv;
                $join->lop_id = $ma_lop;
                $join->trang_thai = 0;
                $join->cach_tham_gia = 2;
                $join->save();
            }
        }

        return redirect()->route('classroom-teacher-all-members', ['ma_lop' => $ma_lop]);
    }
    public function sendEmail(Request $req, $ma_lop)
    {
        $listEmail = explode(";", $req->email);
        $arr = [];
        $noexist = '0';
        $success = '0';
        $were = '0';
        $i = 0;
        foreach ($listEmail as $email) {
            $i++;
            $checkUsername = TaiKhoan::where('email', $email)->where('loai_tai_khoan_id', '3')->first();
            if (empty($checkUsername)) {
                $arr['noexist'][$i] = $email;
            } else {
                $checkLop = ChiTietLop::where('lop_id', $ma_lop)->where('tai_khoan_id', $checkUsername->username)->first();
                if (empty($checkLop)) {
                    $join = new ChiTietLop();
                    $join->lop_id = $ma_lop;
                    $join->tai_khoan_id = $checkUsername->username;
                    $join->cach_tham_gia = 3;
                    $join->trang_thai = 0;
                    $join->save();
                    $url = route('join-classroom-by-email', ['username' => $checkUsername->username, 'ma_lop' => $ma_lop]);
                    $data = [
                        'route' => $url
                    ];
                    Mail::send('teachers.classrooms.join-by-email', $data, function ($message) use ($email) {
                        $message->to($email, 'Join Classroom')->subject('Join Classroom');
                    });
                    $arr['success'][$i] = $email;
                } else {
                    $arr['were'][$i] = $email;
                }
            }
        }
        if (empty($arr['were']) && empty($arr['noexist'])) {
            $success = implode(' ', $arr['success']);
            $notification = array(
                'message' => "Email sent successfully: $success",
                'alert-type' => 'success'
            );
        } else {
            if (!empty($arr['were'])) {

                $were = implode(' ', $arr['were']);
            }
            if (!empty($arr['noexist'])) {

                $noexist = implode(' ', $arr['noexist']);
            };
            if (!empty($arr['success'])) {

                $success = implode(' ', $arr['success']);
            };

            $notification = array(
                'message' => "Email sent successfully: $success Email is not in the list of students: $noexist Email already in class: $were",
                'alert-type' => 'warning'
            );
        }
        return redirect()->back()->with($notification);
    }
    public function resetPassword()
    {
        return view('teachers/reset-password');
    }
    public function savePassword(ResetPasswordRequest $req)
    {
        $user = TaiKhoan::where('username', auth()->user()->username)->first();
        $user->password = Hash::make($req->newpassword);
        $user->save();
        $notification = array(
            'message' => 'Change password successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    //Thêm thông báo / Tài liệu
    public function addPost($ma_lop)
    {
        $lop = Lop::where('ma_lop', "$ma_lop")->first();
        return view('teachers/classrooms/add-post', compact('lop'));
    }
    
    public function addPost_POST(Request $req, $ma_lop)
    {
        $lop = Lop::where('ma_lop', "$ma_lop")->first();

        $post = new BaiDang();
        $post->loai_bai_dang_id = 3;
        $post->ma_lop = $ma_lop;
        $post->tieu_de = $req->tieu_de;
        $post->noi_dung = $req->noi_dung;
        $uploadFile = $req->tap_tin_id;
        //$uploadFile->store('images');
        $post->tap_tin_id = $uploadFile;
        $post->ngay_dang = date(now());
        
        //$post->ngay_nop = $req->ngay_nop;
        //$post->trang_thai = $req->trang_thai;
        
        if(empty($req->trang_thai))
        {
            $post->trang_thai = 0;
        }        
        else
        {
            $post->trang_thai = $req->trang_thai;
        }
        //dd($lop);
        $post->save();
        // return view('teachers/classrooms/add-post');
        return redirect()->route('classroom-teacher-news',['ma_lop'=>$lop->ma_lop]);
    }
    //Kết thúc thêm thông báo / tài liệu

    /**Xóa */
    public function deletePost($id, $ma_lop)
    {
        $deletePost = BaiDang::find($id);
        if($deletePost == null)
        {
            return "Không tìm thấy bài đăng";
        }
        $deletePost->delete();
        $lop = Lop::where('ma_lop', "$ma_lop")->first();
        return redirect()->route('classroom-teacher-news', [ 'id'=>$deletePost->id, 'ma_lop'=>$lop->ma_lop]);
    }
    /**Cập nhật thông báo - GET*/
    public function updatePost($id, $ma_lop)
    {
        $updatePost = BaiDang::find($id);
        $lop = Lop::where('ma_lop', "$ma_lop")->first();
        return view('teachers/classrooms/update-post', compact('updatePost', 'lop'));
    }
    /**Cập nhật thông báo - POST*/
    public function updatePost_POST($id, $ma_lop, Request $req)
    {
        $updatePost = BaiDang::find($id);

        $updatePost->loai_bai_dang_id = 3;
        $updatePost->ma_lop = $ma_lop;
        $updatePost->tieu_de = $req->tieu_de;
        $updatePost->noi_dung = $req->noi_dung;
        $uploadFile = $req->tap_tin_id;
        //$uploadFile->store('images');
        $updatePost->tap_tin_id = $uploadFile;
        if(empty($req->trang_thai))
        {
            $updatePost->trang_thai = 0;
        }        
        else
        {
            $updatePost->trang_thai = $req->trang_thai;
        }
        $updatePost->save();
        
        $lop = Lop::where('ma_lop', "$ma_lop")->first();
        return redirect()->route('classroom-teacher-news', [ 'id'=>$updatePost->id, 'ma_lop'=>$lop->ma_lop]);
    }

    //News (Trang Bài Đăng)
    public function news($ma_lop)
    {
        //$listPost = BaiDang::all();
        $date = date(now());

        $listPost = BaiDang::where('ma_lop', $ma_lop)->where('ngay_nop','>=',$date)->orWhere('ngay_nop',null)->get();

        $lop = Lop::where('ma_lop', "$ma_lop")->first();
        return view('teachers/classrooms/news', compact('listPost', 'lop'));
    }
    //End NEWS (Trang Bài Đăng)

    //Thêm bài kiểm tra
    public function addExams($ma_lop)
    {
        $lop = Lop::where('ma_lop', "$ma_lop")->first();
        return view('teachers/classrooms/add-exams', compact('lop'));
    }
    
    public function addExams_POST(Request $req, $ma_lop)
    {
        $lop = Lop::where('ma_lop', "$ma_lop")->first();

        $post = new BaiDang();
        $post->loai_bai_dang_id = 1;
        $post->ma_lop = $ma_lop;
        $post->tieu_de = $req->tieu_de;
        $post->noi_dung = $req->noi_dung;
        $uploadFile = $req->tap_tin_id;
        //$uploadFile->store('images');
        $post->tap_tin_id = $uploadFile;
        $post->ngay_dang = date(now());
        $post->ngay_nop = $req->ngay_nop;
        //$post->trang_thai = $req->trang_thai;
        
        if(empty($req->trang_thai))
        {
            $post->trang_thai = 0;
        }        
        else
        {
            $post->trang_thai = $req->trang_thai;
        }
        //dd($lop);
        $post->save();
        // return view('teachers/classrooms/add-post');
        return redirect()->route('classroom-teacher-news',['ma_lop'=>$lop->ma_lop]);
    }
    //Kết thúc thêm bài kiểm tra

    /**Xóa bài kiểm tra*/
    public function deleteExams($id, $ma_lop)
    {
        $deleteExams = BaiDang::find($id);
        if($deleteExams == null)
        {
            return "Không tìm thấy bài đăng";
        }
        $deleteExams->delete();
        $lop = Lop::where('ma_lop', "$ma_lop")->first();
        return redirect()->route('classroom-teacher-news', [ 'id'=>$deleteExams->id, 'ma_lop'=>$lop->ma_lop]);
    }
    /**Cập nhật bài kiểm tra - GET*/
    public function updateExams($id, $ma_lop)
    {
        $updateExams = BaiDang::find($id);
        $lop = Lop::where('ma_lop', "$ma_lop")->first();
        return view('teachers/classrooms/update-exams', compact('updateExams', 'lop'));
    }
    /**Cập nhật bài kiểm tra - POST*/
    public function updateExams_POST($id, $ma_lop, Request $req)
    {
        $updateExams = BaiDang::find($id);

        $updateExams->loai_bai_dang_id = 1;
        $updateExams->ma_lop = $ma_lop;
        $updateExams->tieu_de = $req->tieu_de;
        $updateExams->noi_dung = $req->noi_dung;
        $uploadFile = $req->tap_tin_id;
        //$uploadFile->store('images');
        $updateExams->tap_tin_id = $uploadFile;
        $updateExams->ngay_nop = $req->ngay_nop;
        if(empty($req->trang_thai))
        {
            $updateExams->trang_thai = 0;
        }        
        else
        {
            $updateExams->trang_thai = $req->trang_thai;
        }
        $updateExams->save();
        
        $lop = Lop::where('ma_lop', "$ma_lop")->first();
        return redirect()->route('classroom-teacher-news', [ 'id'=>$updateExams->id, 'ma_lop'=>$lop->ma_lop]);
    }

    //Thêm bài tập
    public function addWorks($ma_lop)
    {
        $lop = Lop::where('ma_lop', "$ma_lop")->first();
        return view('teachers/classrooms/add-homework', compact('lop'));
    }
    
    public function addWorks_POST(Request $req, $ma_lop)
    {
        $lop = Lop::where('ma_lop', "$ma_lop")->first();

        $post = new BaiDang();
        $post->loai_bai_dang_id = 2;
        $post->ma_lop = $ma_lop;
        $post->tieu_de = $req->tieu_de;
        $post->noi_dung = $req->noi_dung;
        $uploadFile = $req->tap_tin_id;
        //$uploadFile->store('images');
        $post->tap_tin_id = $uploadFile;
        $post->ngay_dang = date(now());
        $post->ngay_nop = $req->ngay_nop;
        //$post->trang_thai = $req->trang_thai;
        
        if(empty($req->trang_thai))
        {
            $post->trang_thai = 0;
        }        
        else
        {
            $post->trang_thai = $req->trang_thai;
        }
        //dd($lop);
        $post->save();
        // return view('teachers/classrooms/add-post');
        return redirect()->route('classroom-teacher-news',['ma_lop'=>$lop->ma_lop]);
    }
    //Kết thúc thêm bài tập

    /**Xóa bài kiểm tập*/
    public function deleteWorks($id, $ma_lop)
    {
        $deleteWorks = BaiDang::find($id);
        if($deleteWorks == null)
        {
            return "Không tìm thấy bài đăng";
        }
        $deleteWorks->delete();
        $lop = Lop::where('ma_lop', "$ma_lop")->first();
        return redirect()->route('classroom-teacher-news', [ 'id'=>$deleteWorks->id, 'ma_lop'=>$lop->ma_lop]);
    }
    /**Cập nhật bài tập - GET*/
    public function updateWorks($id, $ma_lop)
    {
        $updateWorks = BaiDang::find($id);
        $lop = Lop::where('ma_lop', "$ma_lop")->first();
        return view('teachers/classrooms/update-works', compact('updateWorks', 'lop'));
    }
    /**Cập nhật bài tập - POST*/
    public function updateWorks_POST($id, $ma_lop, Request $req)
    {
        $updateWorks = BaiDang::find($id);

        $updateWorks->loai_bai_dang_id = 2;
        $updateWorks->ma_lop = $ma_lop;
        $updateWorks->tieu_de = $req->tieu_de;
        $updateWorks->noi_dung = $req->noi_dung;
        $uploadFile = $req->tap_tin_id;
        //$uploadFile->store('images');
        $updateWorks->tap_tin_id = $uploadFile;
        $updateWorks->ngay_nop = $req->ngay_nop;
        if(empty($req->trang_thai))
        {
            $updateWorks->trang_thai = 0;
        }        
        else
        {
            $updateWorks->trang_thai = $req->trang_thai;
        }
        $updateWorks->save();
        
        $lop = Lop::where('ma_lop', "$ma_lop")->first();
        return redirect()->route('classroom-teacher-news', [ 'id'=>$updateWorks->id, 'ma_lop'=>$lop->ma_lop]);
    }
}
