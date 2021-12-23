<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class DangNhapController extends Controller
{
    public function login(){
        return view('login');
    }
    public function handleLogin(LoginRequest $req){

        if(Auth::attempt(['email'=> $req->email,'password'=>$req->password]))
        {
            $user = Auth::user();
                if($user->loai_tai_khoan_id==1){
                    return redirect()->route('admin-index');
                }elseif($user->loai_tai_khoan_id==2){
                    return redirect()->route('teacher-index');
                }elseif($user->loai_tai_khoan_id==3) {
                    return redirect()->route('student-index');
                }
        }   
        else 
        $notification = array(
            'message' => 'Login failed !',
            'alert-type' => 'warning'
        );
        return redirect()->route('login')->with($notification);
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
