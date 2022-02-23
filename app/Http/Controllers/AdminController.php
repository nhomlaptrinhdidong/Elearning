<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Http\Requests\ClassroomRequest;
use App\Http\Requests\EditAccountRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\ChiTietLop;
use App\Models\Lop;
use App\Models\TaiKhoan;
use App\Models\BaiDang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Twilio\Rest\Accounts;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin/index');
    }
    // public function apilist(){
    //     $account = Lop::all();
    //     return json_encode([
    //         'status' => true,
    //         'data' => $account
    //     ]);
    // }
    public function adminDetail()
    {
        return view('admin/account-detail');
    }
    public function editProfile()
    {
        return view('admin/edit-profile');
    }
    public function saveEditProfile(UpdateAccountRequest  $req)
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
        return view('admin/account-detail');
    }
    public function resetPassword()
    {
        return view('admin/reset-password');
    }
    public function savePassword(ResetPasswordRequest $reg)
    {
        $user = TaiKhoan::where('username', auth()->user()->username)->first();
        $user->password = Hash::make($reg->newpassword);
        $user->save();
        $notification = array(
            'message' => 'Change password successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function addAccount()
    {
        return view('admin/add-account');
    }
    public function saveAccount(AccountRequest $req)
    {
        $usernameacc = Str::random(6);
        $usernameCheck = TaiKhoan::where('username', $usernameacc)->first();
        while (!empty($usernameCheck)) {
            $usernameacc = Str::random(6);
            $usernameCheck = TaiKhoan::where('username', $usernameacc)->first();
        }
        $uploadFile = $req->hinh_anh;
        $account = new TaiKhoan();
        $account->username = $usernameacc;
        $account->ho_ten = $req->ho_ten;
        $account->sdt = $req->sdt;
        $account->dia_chi = $req->dia_chi;
        $account->email = $req->email;
        $account->loai_tai_khoan_id = $req->loai_tai_khoan_id;
        $uploadFile->storeAs('img/users', $usernameacc . '.' . $uploadFile->extension());
        $account->hinh_anh = $usernameacc . '.' . $uploadFile->extension();
        $account->gioi_tinh = $req->gioi_tinh;
        $account->ngay_sinh = date('Y/m/d', strtotime($req->ngay_sinh));
        $account->trang_thai = $req->trang_thai;
        $account->save();
        $notification = array(
            'message' => 'Account successfully created!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function allStudent()
    {
        $dsSinhVien = TaiKhoan::where('loai_tai_khoan_id', '3')->get();
        //dd($dsSinhVien);
        return view('admin/students/all-students', compact('dsSinhVien'));
    }
    public function studentDetail($username)
    {
        $student = TaiKhoan::where('username', $username)->first();
        return view('admin/students/student-detail', compact('student'));
    }
    public function editStudentProfile($username)
    {
        $student = TaiKhoan::where('username', $username)->first();
        return view('admin/students/edit-student-profile', compact('student'));
    }
    public function saveEditStudentProfile(EditAccountRequest $req, $usernameacc)
    {
        $student = TaiKhoan::where('username', $usernameacc)->first();
        if (!empty($req->hinh_anh)) {
            $uploadFile = $req->hinh_anh;
            $uploadFile->storeAs('img/users', $usernameacc . '.' . $uploadFile->extension());
            $student->hinh_anh = $usernameacc . '.' . $uploadFile->extension();
        }
        $student->ho_ten = $req->ho_ten;
        $student->sdt = $req->sdt;
        $student->dia_chi = $req->dia_chi;
        $student->email = $req->email;
        $student->gioi_tinh = $req->gioi_tinh;
        $student->ngay_sinh = date('Y/m/d', strtotime($req->ngay_sinh));
        $student->loai_tai_khoan_id = $req->loai_tai_khoan_id;
        $student->trang_thai = $req->trang_thai;
        $student->save();
        return view('admin/students/student-detail', compact('student'));
    }
    public function deleteAccount($username)
    {
        $user = TaiKhoan::where('username', $username)->first();
        ChiTietLop::where('tai_khoan_id', $username)->delete();
        TaiKhoan::where('username', $username)->delete();
        $notification = array(
            'message' => 'Successful delete!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function allTeacher()
    {
        $dsTeacher = TaiKhoan::where('loai_tai_khoan_id', '2')->get();
        return view('admin/teachers/all-teachers', compact('dsTeacher'));
    }
    public function teacherDetail($username)
    {
        $teacher = TaiKhoan::where('username', $username)->first();
        return view('admin/teachers/teacher-detail', compact('teacher'));
    }
    public function editTeacherProfile($username)
    {
        $teacher = TaiKhoan::where('username', $username)->first();
        return view('admin/teachers/edit-teacher-profile', compact('teacher'));
    }
    public function saveEditTeacherProfile(EditAccountRequest $req, $usernameacc)
    {
        $teacher = TaiKhoan::where('username', $usernameacc)->first();
        if (!empty($req->hinh_anh)) {
            $uploadFile = $req->hinh_anh;
            $uploadFile->storeAs('img/users', $usernameacc . '.' . $uploadFile->extension());
            $teacher->hinh_anh = $usernameacc . '.' . $uploadFile->extension();
        }
        $teacher->ho_ten = $req->ho_ten;
        $teacher->sdt = $req->sdt;
        $teacher->dia_chi = $req->dia_chi;
        $teacher->email = $req->email;
        $teacher->gioi_tinh = $req->gioi_tinh;
        $teacher->ngay_sinh = date('Y/m/d', strtotime($req->ngay_sinh));
        $teacher->loai_tai_khoan_id = $req->loai_tai_khoan_id;
        $teacher->trang_thai = $req->trang_thai;
        $teacher->save();
        return view('admin/teachers/teacher-detail', compact('teacher'));
    }
    public function allClassroom()
    {
        $dsClassroom = Lop::all();
        return view('admin/classrooms/all-classroom', compact('dsClassroom'));
    }
    public function classroomDetail($ma_lop)
    {
        // $dsClassroom = Lop::where('ma_lop', $ma_lop)->first();
        // return view('admin/classrooms/classroom-detail', compact('dsClassroom'));

        $dsClassroom = Lop::where('ma_lop', $ma_lop)->first();
        $date = date(now());
        $listPost = BaiDang::where('ma_lop', $ma_lop)->get();
        return view('admin/classrooms/classroom-detail', compact('listPost', 'dsClassroom'));
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
        return view('admin/classrooms/all-members', compact('taiKhoan', 'chiTietGV', 'dsClassroom'));
    }
    public function addClasroom()
    {
        $dsTeacher = TaiKhoan::where('loai_tai_khoan_id', 2)->get();
        return view('admin/classrooms/add-classroom', compact('dsTeacher'));
    }
    public function deleteClasroom($ma_lop)
    {
        Lop::where('ma_lop', $ma_lop)->first()->delete();
        ChiTietLop::where('lop_id', $ma_lop)->delete();
        $notification = array(
            'message' => 'Delete the class successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function saveAddClasroom(ClassroomRequest $req)
    {
        $idClass = Str::random(6);
        $checkId = Lop::where('ma_lop', $idClass)->first();
        while (!empty($checkId)) {
            $idClass = Str::random(6);
            $checkId = Lop::where('ma_lop', $idClass)->first();
        }
        $uploadFile = $req->banner;
        $classroom = new Lop();
        $chiTietLop = new ChiTietLop();
        $classroom->ma_lop = $idClass;
        $classroom->ten_lop = $req->ten_lop;
        $classroom->mo_ta = $req->mo_ta;
        $classroom->mau_sac = $req->mau_sac;
        $uploadFile->storeAs('img/classrooms', $idClass . '.' . $uploadFile->extension());
        $classroom->banner = $idClass . '.' . $uploadFile->extension();
        $classroom->trang_thai = 1;

        $chiTietLop->tai_khoan_id = $req->tai_khoan_id;
        $chiTietLop->lop_id = $idClass;
        $chiTietLop->trang_thai = 1;
        $chiTietLop->cach_tham_gia = 1;

        $classroom->save();
        $chiTietLop->save();

        $notification = array(
            'message' => 'Classroom successfully created!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
//16/2
    //Thêm thông báo / Tài liệu
    public function addPost($ma_lop)
    {
        $lop = Lop::where('ma_lop', "$ma_lop")->first();
        return view('admin/classrooms/add-post', compact('lop'));
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
        $uploadFile->store('images');
        $post->tap_tin_id = $uploadFile;
        $post->ngay_dang = date(now());
        
        if(empty($req->trang_thai))
        {
            $post->trang_thai = 0;
        }        
        else
        {
            $post->trang_thai = $req->trang_thai;
        }

        $post->save();
        return redirect()->route('classroom-detail',['ma_lop'=>$lop->ma_lop]);
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
        return redirect()->route('classroom-detail', [ 'id'=>$deletePost->id, 'ma_lop'=>$lop->ma_lop]);
    }
    /**Cập nhật thông báo - GET*/
    public function updatePost($id, $ma_lop)
    {
        $updatePost = BaiDang::find($id);
        $lop = Lop::where('ma_lop', "$ma_lop")->first();
        return view('admin/classrooms/update-post', compact('updatePost', 'lop'));
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
        return redirect()->route('classroom-detail', [ 'id'=>$updatePost->id, 'ma_lop'=>$lop->ma_lop]);
    }

    //News (Trang Bài Đăng)
    public function news($ma_lop)
    {
        //$listPost = BaiDang::all();
        $date = date(now());

        $listPost = BaiDang::where('ma_lop', $ma_lop)->get();

        $lop = Lop::where('ma_lop', "$ma_lop")->first();
        return view('admin/classrooms/news', compact('listPost', 'lop'));
    }
    //End NEWS (Trang Bài Đăng)

    //Thêm bài kiểm tra
    public function addExams($ma_lop)
    {
        $lop = Lop::where('ma_lop', "$ma_lop")->first();
        return view('admin/classrooms/add-exams', compact('lop'));
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
        $post->tap_tin_id = $uploadFile;
        $post->ngay_dang = date(now());
        $post->ngay_nop = $req->ngay_nop;
        
        if(empty($req->trang_thai))
        {
            $post->trang_thai = 0;
        }        
        else
        {
            $post->trang_thai = $req->trang_thai;
        }
        $post->save();
        return redirect()->route('classroom-detail',['ma_lop'=>$lop->ma_lop]);
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
        return redirect()->route('classroom-detail', [ 'id'=>$deleteExams->id, 'ma_lop'=>$lop->ma_lop]);
    }
    /**Cập nhật bài kiểm tra - GET*/
    public function updateExams($id, $ma_lop)
    {
        $updateExams = BaiDang::find($id);
        $lop = Lop::where('ma_lop', "$ma_lop")->first();
        return view('admin/classrooms/update-exams', compact('updateExams', 'lop'));
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
        return redirect()->route('classroom-detail', [ 'id'=>$updateExams->id, 'ma_lop'=>$lop->ma_lop]);
    }

    //Thêm bài tập
    public function addWorks($ma_lop)
    {
        $lop = Lop::where('ma_lop', "$ma_lop")->first();
        return view('admin/classrooms/add-homework', compact('lop'));
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
        $post->tap_tin_id = $uploadFile;
        $post->ngay_dang = date(now());
        $post->ngay_nop = $req->ngay_nop;
        
        if(empty($req->trang_thai))
        {
            $post->trang_thai = 0;
        }        
        else
        {
            $post->trang_thai = $req->trang_thai;
        }
        $post->save();
        return redirect()->route('classroom-detail',['ma_lop'=>$lop->ma_lop]);
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
        return redirect()->route('classroom-detail', [ 'id'=>$deleteWorks->id, 'ma_lop'=>$lop->ma_lop]);
    }
    /**Cập nhật bài tập - GET*/
    public function updateWorks($id, $ma_lop)
    {
        $updateWorks = BaiDang::find($id);
        $lop = Lop::where('ma_lop', "$ma_lop")->first();
        return view('admin/classrooms/update-works', compact('updateWorks', 'lop'));
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
        return redirect()->route('classroom-detail', [ 'id'=>$updateWorks->id, 'ma_lop'=>$lop->ma_lop]);
    }
    //End 16/2
}
