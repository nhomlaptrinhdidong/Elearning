<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DangNhapController extends Controller
{
    public function login(){
        return view('login');
    }
    public function handleLogin(LoginRequest $req){

        $taikhoan = TaiKhoan::where('email', $req->email)->first();
        if(Auth::attempt(['email'=> $req->email,'password'=>$req->password]))
        {
            $user = Auth::user();
                if($user->loai_tai_khoan_id==1){
                    return redirect()->route('admin-index');
                }else if($user->loai_tai_khoan_id==2){
                    return redirect()->route('admin-index');
                }else{
                    return redirect()->route('student-index');
                }
        }   
        else 
        $notification = array(
            'message' => 'Đăng nhập không thành công!',
            'alert-type' => 'warning'
        );
        return redirect()->route('login')->with($notification);
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
