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
        $dsClassroom = Lop::where('ma_lop', $ma_lop)->first();
        return view('admin/classrooms/classroom-detail', compact('dsClassroom'));
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
}
