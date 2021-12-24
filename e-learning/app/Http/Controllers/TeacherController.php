<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdateAccountRequest;
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
}
