<!doctype html>
<html class="no-js" lang="">


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 17 Oct 2021 13:17:06 GMT -->

@extends('masterlayout.head')

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <!-- Login Page Start Here -->
    <div class="login-page-wrap">
        <div class="login-page-content">
            <div class="login-box">
                <div class="item-logo">
                    <img src="{{ asset('img/logo2.png') }}" alt="logo">
                </div>
                <form action="{{ route('save-password-api', ['username' => $username]) }}" class="login-form"
                    method="POST">
                    @csrf
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="text" placeholder="Enter New Password" name="newpassword" class="form-control">
                        <i class="fas fa-lock"></i>
                        @error('newpassword')
                            <span class="mess">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="text" placeholder="Enter Confirm Password" name="confirm_password"
                            class="form-control">
                        <i class="fas fa-lock"></i>
                        @error('confirm_password')
                            <span class="mess">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="login-btn">Save</button>
                    </div>
                </form>
            </div>
            <div class="sign-up"> <a href={{ route('login') }}>SignIn Now!</a></div>
        </div>
    </div>
    <!-- Login Page End Here -->
    <!-- jquery-->
    @extends('masterlayout.script')
</body>




</html>
