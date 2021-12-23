@extends('.layouts.admin')
@section('reset-password')
<div class="dashboard-content-one">
    <div class="login-page-content">
        <div class="login-box">
            <div class="item-logo">
                <img src="{{asset('img/logo2.png')}}" alt="logo">
            </div>
            <form action={{route('save-admin-password')}} class="login-form" method="POST">
                @csrf
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" placeholder="Enter Password" name="password" class="form-control">
                    <i class="fas fa-lock"></i>
                    @error('password')
                        <span class="mess">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <input type="text" placeholder="Enter New Password" name="newpassword" class="form-control">
                    <i class="fas fa-lock"></i>
                    @error('newpassword')
                        <span class="mess">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="text" placeholder="Enter Confirm Password" name="confirm_password" class="form-control">
                    <i class="fas fa-lock"></i>
                    @error('confirm_password')
                        <span class="mess">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="login-btn">Save</button>
                </div>  
            </form>
        </div>
    </div>
</div>
@endsection