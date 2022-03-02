<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Str;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class MailerController extends Controller
{
    public function forgetPassword(){
        return view('forget_password/forget_password');
    }
    public function sendEmail(Request $req){
        
        $email = $req->email;
        $checkUser = TaiKhoan::where('email',$email)->first();
        if($checkUser){
            $random = Str::random(20);
            $code = bcrypt(md5($random)) ;
            $checkUser->token = $code;
            $checkUser->save();
            $url = route('reset-password', ['code' => $code,'email' => $email]);
            $data = [
                'route'=> $url
            ];
            Mail::send('forget_password.email', $data, function($message) use ($email) {
            $message->to($email, 'Reset PassWord')->subject('Reset PassWord');
            
        });
        $notification = array(
            'message' => 'Email sent successfully !',
            'alert-type' => 'success'
        );
        }else{
            $notification = array(
                'message' => 'Check your email again !',
                'alert-type' => 'warning'
            );
        }
        return redirect()->back()->with($notification);
    }
    public function resetPassword(Request $req){
            return view('forget_password/reset_password', compact('req'));
    }
    public function handelResetPassword(Request $req){
        if($req->newpassword!=$req->password){
            $notification = array(
                'message' => 'Kiểm tra lại mật khẩu !',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }else{
            $token = $req->token;
            $email = $req->email;

            $checkUser = TaiKhoan::where(
            [
                'token'=>$token,
                'email'=>$email
            ]
            )->first(); 
            $checkUser->password = Hash::make($req->password);
            $checkUser->token = '';
            $checkUser->save();   
            return view('login');
        }
    }
}
