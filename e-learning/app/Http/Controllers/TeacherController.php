<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAccountRequest;
use App\Models\Lop;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index(){
       
        $dsLop = TaiKhoan::where('username',auth()->user()->username)->first();

        foreach($dsLop->dsLop as $chitiet){

                $chiTietLop = Lop::where('ma_lop', $chitiet->ma_lop)->first();          
                $dschitiet[$chiTietLop->ma_lop]['ma_lop'] = $chiTietLop->ma_lop;
                $dschitiet[$chiTietLop->ma_lop]['ten_lop'] = $chiTietLop->ten_lop;
                $dschitiet[$chiTietLop->ma_lop]['banner'] = $chiTietLop->banner;
                $dschitiet[$chiTietLop->ma_lop]['mo_ta'] = $chiTietLop->mo_ta;

               foreach($chiTietLop->chiTietLop as $taikhoan){
                   if($taikhoan->username==auth()->user()->username){
                       $dschitiet[$chiTietLop->ma_lop]['giao_vien']= $taikhoan->ho_ten;
                       $dschitiet[$chiTietLop->ma_lop]['hinh_anh_gv']= $taikhoan->hinh_anh;
                   }             
               }
            
        }
        return view('teachers/index', compact('dschitiet')) ;
    }
    public function userDetail() {
        return view('teachers/account-detail');
    }
    public function editUserProfile() {
        return view('teachers/edit-profile');
    }
    public function saveEditUserProfile(UpdateAccountRequest  $req){    
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
        return view('teachers/account-detail');
    }
    public function classroomDetail($ma_lop){
        $dsClassroom = Lop::where('ma_lop',$ma_lop)->first();
        return view('teachers/classrooms/classroom-detail', compact('dsClassroom'));
    }
}
