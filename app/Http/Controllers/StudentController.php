<?php

namespace App\Http\Controllers;

use App\Http\Requests\JoinClassroomRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\ChiTietLop;
use App\Models\TaiKhoan;
use App\Models\Lop;
use App\Models\BaiDang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\View\Composers\ProfileComposer;
use Illuminate\Support\Facades\View;

class StudentController extends Controller
{
    public function index()
    {
        $noti = ChiTietLop::where('tai_khoan_id', auth()->user()->username)->where('trang_thai', 0)->get();
        $lop = new Lop();
        View::share('notification', $noti);
        View::share('lop', $lop);
        $dschitiet = [];

        $dsLop = ChiTietLop::where('tai_khoan_id', auth()->user()->username)->where('trang_thai', '1')->get();
        foreach ($dsLop as $chiTiet) {
            $chiTietLop = Lop::where('ma_lop', $chiTiet->lop_id)->first();
            $dschitiet[$chiTietLop->ma_lop]['ma_lop'] = $chiTietLop->ma_lop;
            $dschitiet[$chiTietLop->ma_lop]['ten_lop'] = $chiTietLop->ten_lop;
            $dschitiet[$chiTietLop->ma_lop]['banner'] = $chiTietLop->banner;
            $dschitiet[$chiTietLop->ma_lop]['mo_ta'] = $chiTietLop->mo_ta;

            foreach ($chiTietLop->chiTietLop as $taikhoan) {
                if ($taikhoan->loai_tai_khoan_id == 2) {
                    $dschitiet[$chiTietLop->ma_lop]['giao_vien'] = $taikhoan->ho_ten;
                    $dschitiet[$chiTietLop->ma_lop]['hinh_anh_gv'] = $taikhoan->hinh_anh;
                }
            }
        }
        return view('students/index', compact('dschitiet'));
    }
    public function userDetail()
    {
        return view('students/account-detail');
    }
    public function editUserProfile()
    {
        return view('students/edit-profile');
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
        return view('students/account-detail');
    }
    public function resetPassword()
    {
        return view('students/reset-password');
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

    public function classroomDetail($ma_lop)
    {
        // $dsClassroom = Lop::where('ma_lop', $ma_lop)->first();
        // return view('students/classrooms/classroom-detail', compact('dsClassroom'));

        $dsClassroom = Lop::where('ma_lop', $ma_lop)->first();
        $date = date(now());
        $listPost = BaiDang::where('ma_lop', $ma_lop)->get();
        return view('students/classrooms/classroom-detail', compact('listPost', 'dsClassroom'));
    }
    public function deleteClassroom($ma_lop)
    {
        ChiTietLop::where('lop_id', $ma_lop)->where('tai_khoan_id', auth()->user()->username)->delete();
        $notification = array(
            'message' => 'Delete the class successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
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
        return view('students/classrooms/all-members', compact('taiKhoan', 'chiTietGV', 'dsClassroom'));
    }

    public function joinClassroom()
    {

        return view('students/classrooms/join-classroom');
    }
    public function saveJoinClassroom(JoinClassroomRequest $req)
    {
        $join = ChiTietLop::where('tai_khoan_id', auth()->user()->username)->where('lop_id', $req->ma_lop)->first();
        if (empty($join)) {
            $chiTietLop = new ChiTietLop();
            $chiTietLop->tai_khoan_id =  auth()->user()->username;
            $chiTietLop->lop_id = $req->ma_lop;
            $chiTietLop->cach_tham_gia = 1;
            $chiTietLop->trang_thai = 1;
            $chiTietLop->save();
            $notification = array(
                'message' => 'Successfully join the class',
                'alert-type' => 'success'
            );
            return redirect()->route('student-index')->with($notification);
        } else {
            $notification = array(
                'message' => 'You were in class',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }
    }
    public function joinClassroomByEmail($username, $ma_lop)
    {
        if (auth()->user()->username == $username) {
            $checkLop = ChiTietLop::where('tai_khoan_id', $username)->where('lop_id', $ma_lop)->where('trang_thai', '!=', 0)->first();
            if (empty($checkLop)) {
                $join = ChiTietLop::where('tai_khoan_id', $username)->where('lop_id', $ma_lop)->where('trang_thai', 0)->first();
                if (!empty($join)) {
                    $join->trang_thai = 1;
                    $join->save();
                    $notification = array(
                        'message' => 'Successfully join the class',
                        'alert-type' => 'success'
                    );
                } else {
                    $notification = array(
                        'message' => 'Request has been deleted',
                        'alert-type' => 'error'
                    );
                }
            } else {
                $notification = array(
                    'message' => 'You were in class',
                    'alert-type' => 'warning'
                );
            }

            return redirect()->route('student-index')->with($notification);
        } else {
            return redirect()->route('student-index');
        }
    }
    public function acceptJoinClass($ma_lop)
    {
        $accept = ChiTietLop::where('tai_khoan_id', auth()->user()->username)->where('lop_id', $ma_lop)->first();
        $accept->trang_thai = 1;
        $accept->save();
        $notification = array(
            'message' => 'Successfully join the class',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function deleteJoinClass($ma_lop)
    {
        $accept = ChiTietLop::where('tai_khoan_id', auth()->user()->username)->where('lop_id', $ma_lop)->first()->delete();
        $notification = array(
            'message' => 'Refused to join the class',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
