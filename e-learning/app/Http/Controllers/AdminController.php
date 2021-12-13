<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
class AdminController extends Controller
{
    function index(){
        return view('admin/index');
    }
    function allStudent(){
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
        $uploadFile->storeAs('img/students',$usernameacc.'.'.$uploadFile->extension());
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
    function allClassroom(){
        //$dsClassroom = Cl::where('loai_tai_khoan_id','3')->get();
        //dd($dsSinhVien);
        return view('admin/classrooms/all-classroom');
    }
}
