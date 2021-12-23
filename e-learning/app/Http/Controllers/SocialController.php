<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Validator, Redirect, Response, File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {

        $getInfo = Socialite::driver($provider)->user();
        $user = $this->createUser($getInfo, $provider);

        auth()->login($user);
        if (auth()->user()->loai_tai_khoan_id == 1) {
            return redirect()->route('admin-index');
        } elseif (auth()->user()->loai_tai_khoan_id == 2) {
            return redirect()->route('teacher-index');
        } else {

            return redirect()->route('student-index');
        }
    }
    function createUser($getInfo, $provider)
    {

        $user = TaiKhoan::where('email', $getInfo->email)->first();

        if (!$user) {
            $user = new TaiKhoan();
            $usernameacc = Str::random(6);
            $usernameCheck = TaiKhoan::where('username', $usernameacc)->first();
            while (!empty($usernameCheck)) {
                $usernameacc = Str::random(6);
                $usernameCheck = TaiKhoan::where('username', $usernameacc)->first();
            }
            Storage::disk('localapi')->put($usernameacc . '.jpeg', file_get_contents($getInfo->avatar));
            $user->ho_ten  = $getInfo->name;
            $user->username = $usernameacc;
            $user->email  = $getInfo->email;
            $user->ho_ten  = $getInfo->name;
            $user->provider_id  = $provider;
            $user->hinh_anh  = $usernameacc . '.jpeg';
            $user->loai_tai_khoan_id  = 3;

            $user->save();
        }
        return $user;
    }
}
