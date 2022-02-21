@extends('.layouts.student')
@section('join-classroom')
    <div class="dashboard-content-one">
        <div class="login-page-content">

            <div class="login-box">
                <div class="item-logo">
                    <img src="{{ asset('img/logo2.png') }}" alt="logo">
                </div>
                <form action={{ route('save-join-classroom') }} class="login-form" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Class code</label>
                        <input type="text" placeholder="Enter code" name="ma_lop" class="form-control">
                        <i class="fas fa-lock"></i>
                        @error('ma_lop')
                            <span class="mess">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="login-btn">Join</button>
                    </div>
                </form>
            </div>

        </div>
    @endsection
