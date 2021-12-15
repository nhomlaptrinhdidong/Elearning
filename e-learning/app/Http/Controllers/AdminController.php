<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\ChiTietLop;
use App\Models\Lop;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function index(){
        return view('admin/index');
    }
    public function adminDetail() {
        return view('admin/account-detail');
    }
    public function editProfile(){
        return view('admin/edit-profile');
    }
    public function saveEditProfile(UpdateAccountRequest  $req){    
        $user = TaiKhoan::where('username',auth()->user()->username)->first();
        $user->ho_ten = $req->ho_ten;
        $user->gioi_tinh = $req->gioi_tinh;
        $user->ngay_sinh = date('Y/m/d', strtotime($req->ngay_sinh));
        $user->email = $req->email;
        $user->sdt = $req->sdt;
        $user->dia_chi = $req->dia_chi;
        if(!empty($req->hinh_anh)){
            $uploadFile = $req->hinh_anh;
            $uploadFile->storeAs('img/users',auth()->user()->username.'.'.$uploadFile->extension());
            $user->hinh_anh = auth()->user()->username.'.'.$uploadFile->extension();
        }
        $user->save();
        Auth::setUser($user);
        return view('admin/account-detail');
    }
    public function addAccount(){
        return view('admin/add-account');
    }
    public function saveAccount(AccountRequest $req){
        $usernameacc = Str::random(6);
        $usernameCheck = TaiKhoan::where('usernamr',$usernameacc)->first();
        if($usernameCheck){
            $usernameacc = Str::random(6);
        }
        else
        {

            $uploadFile = $req->hinh_anh;
            $account = new TaiKhoan();
            $account->username = $usernameacc;
            $account->ho_ten = $req->ho_ten;
            $account->sdt = $req->sdt;
            $account->dia_chi = $req->dia_chi;
            $account->email = $req->email;
            $account->loai_tai_khoan_id = $req->loai_tai_khoan_id;
            $uploadFile->storeAs('img/users',$usernameacc.'.'.$uploadFile->extension());
            $account->hinh_anh = $usernameacc.'.'.$uploadFile->extension();
            $account->gioi_tinh = $req->gioi_tinh;
            $account->ngay_sinh = date('Y/m/d', strtotime($req->ngay_sinh));
            $account->trang_thai = $req->trang_thai; 
            $account->save();
        }
        return redirect()->back();
    }
    public function allStudent(){
        $dsSinhVien = TaiKhoan::where('loai_tai_khoan_id','3')->get();
        //dd($dsSinhVien);
        return view('admin/students/all-students', compact('dsSinhVien'));
    }
    public function studentDetail($username) {
        $student = TaiKhoan::where('username',$username)->first();
        return view('admin/students/student-detail', compact('student'));
    }
    public function editStudentProfile($username) {
        $student = TaiKhoan::where('username',$username)->first();
        return view('admin/students/edit-student-profile', compact('student'));
    }
    public function saveEditStudentProfile(Request $req, $usernameacc) {
        $uploadFile = $req->hinh_anh;
        $uploadFile->storeAs('img/users',$usernameacc.'.'.$uploadFile->extension());
        $student = TaiKhoan::where('username',$usernameacc)->first();
        $student->ho_ten = $req->ho_ten;
        $student->sdt = $req->sdt;
        $student->dia_chi = $req->dia_chi;
        $student->email = $req->email;
        $student->hinh_anh = $usernameacc.'.'.$uploadFile->extension();
        $student->gioi_tinh = $req->gioi_tinh;
        $student->ngay_sinh = date('Y/m/d', strtotime($req->ngay_sinh));
        $student->loai_tai_khoan_id = $req->loai_tai_khoan_id;
        $student->trang_thai = $req->trang_thai; 
        $student->save();
        return view('admin/students/student-detail', compact('student'));
    }
    public function deleteStudent($username){
        //$student = TaiKhoan::where('username',$username)->delete();
        $notification = array(
            'alert-type' => 'success',
            'message' => '
            Successful delete!',
        );
        // return redirect()->back()->with($notification);
        
        return redirect()->back()->with('success','Item created successfully!');

    }
    public function allTeacher(){
        $dsTeacher = TaiKhoan::where('loai_tai_khoan_id','2')->get();
        return view('admin/teachers/all-teachers', compact('dsTeacher'));
    }
    public function teacherDetail($username) {
        $teacher = TaiKhoan::where('username',$username)->first();
        return view('admin/teachers/teacher-detail', compact('teacher'));
    }
    public function editTeacherProfile($username) {
        $teacher = TaiKhoan::where('username',$username)->first();
        return view('admin/teachers/edit-teacher-profile', compact('teacher'));
    }
    public function saveEditTeacherProfile(Request $req, $usernameacc) {
        $uploadFile = $req->hinh_anh;
        $uploadFile->storeAs('img/users',$usernameacc.'.'.$uploadFile->extension());
        $teacher = TaiKhoan::where('username',$usernameacc)->first();
        $teacher->ho_ten = $req->ho_ten;
        $teacher->sdt = $req->sdt;
        $teacher->dia_chi = $req->dia_chi;
        $teacher->email = $req->email;
        $teacher->hinh_anh = $usernameacc.'.'.$uploadFile->extension();
        $teacher->gioi_tinh = $req->gioi_tinh;
        $teacher->ngay_sinh = date('Y/m/d', strtotime($req->ngay_sinh));
        $teacher->loai_tai_khoan_id = $req->loai_tai_khoan_id;
        $teacher->trang_thai = $req->trang_thai;
        $teacher->save(); 
        return view('admin/teachers/teacher-detail', compact('teacher'));
    }


    public function allClassroom(){
        $dsClassroom = Lop::all();
        return view('admin/classrooms/all-classroom',compact('dsClassroom'));
    }
    public function classroomDetail($ma_lop){
        $dsClassroom = Lop::where('ma_lop',$ma_lop)->first();
        return view('admin/classrooms/classroom-detail', compact('dsClassroom'));
    }
    public function allMembers($ma_lop){
        $dsClassroom = Lop::where('ma_lop',$ma_lop)->first();
        $taiKhoan = new TaiKhoan();
        foreach ($dsClassroom->chiTietLop as $chiTiet)
        {
           $chiTietTaiKhoan = TaiKhoan::where('username',$chiTiet->pivot->tai_khoan_id)->get();
           foreach($chiTietTaiKhoan as $chiTiet)
           {
               if($chiTiet->loai_tai_khoan_id==2){
                   $chiTietGV['giao_vien'] = $chiTiet->ho_ten;
                   $chiTietGV['hinh_anh_gv'] = $chiTiet->hinh_anh;
                   
                } 
            }
        };
        return view('admin/classrooms/all-members', compact('taiKhoan', 'chiTietGV','dsClassroom'));
    }

}
