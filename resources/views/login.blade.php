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
                    <img src="img/logo2.png" alt="logo">
                </div>
                <form action="{{ route('handle-login') }}" class="login-form" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" placeholder="Enter email" name="email" class="form-control">
                        <i class="far fa-envelope"></i>
                    </div>
                    @error('email')
                        <span>{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" placeholder="Enter password" name="password" class="form-control">
                        <i class="fas fa-lock"></i>
                    </div>
                    @error('password')
                        <span>{{ $message }}</span>
                    @enderror
                    <div class="form-group d-flex align-items-center justify-content-between">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember-me">
                            <label for="remember-me" class="form-check-label">Remember Me</label>
                        </div>
                        <a href={{ route('forget-password') }} class="forgot-btn">Forgot Password?</a>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="login-btn">Login</button>
                    </div>
                </form>
                <div class="login-social">
                    <p>or sign in with</p>
                    <ul>
                        <li><a href="{{ url('/auth/redirect/facebook') }}" class="bg-fb"><i
                                    class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" class="bg-twitter"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="{{ url('/auth/redirect/google') }}" class="bg-gplus"><i
                                    class="fab fa-google-plus-g"></i></a></li>
                        <li><a href="#" class="bg-git"><i class="fab fa-github"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="sign-up">Don't have an account ? <a href="#">Signup now!</a></div>
        </div>
    </div>
    <!-- Login Page End Here -->
    <!-- jquery-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Scroll Up Js -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- Custom Js -->
    <script src="js/main.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if (Session::has('message'))
            var type="{{ Session::get('alert-type', 'info') }}"
        
            switch(type){
            case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
            case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;
            case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;
            case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
            }
        @endif
    </script>

</body>


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 17 Oct 2021 13:17:07 GMT -->

</html>
