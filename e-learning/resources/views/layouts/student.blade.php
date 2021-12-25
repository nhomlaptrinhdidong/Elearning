<!doctype html>
<html class="no-js" lang="">


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 17 Oct 2021 13:16:07 GMT -->

@extends('masterlayout.head')

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        <div class="navbar navbar-expand-md header-menu-one bg-light">
            <div class="nav-bar-header-one">
                <div class="header-logo">
                    <a href="index.html">
                        <img src={{ asset('img/logo.png') }} alt="logo">
                    </a>
                </div>
                <div class="toggle-button sidebar-toggle">
                    <button type="button" class="item-link">
                        <span class="btn-icon-wrap">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="d-md-none mobile-nav-bar">
                <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse"
                    data-target="#mobile-navbar" aria-expanded="false">
                    <i class="far fa-arrow-alt-circle-down"></i>
                </button>
                <button type="button" class="navbar-toggler sidebar-toggle-mobile">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
                <ul class="navbar-nav">
                    <li class="navbar-item header-search-bar">
                        <div class="input-group stylish-input-group">
                            <span class="input-group-addon">
                                <button type="submit">
                                    <span class="flaticon-search" aria-hidden="true"></span>
                                </button>
                            </span>
                            <input type="text" class="form-control" placeholder="Find Something . . .">
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="navbar-item dropdown header-admin">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <div class="admin-title">
                                <h5 class="item-title">{{ auth()->user()->ho_ten }}</h5>
                                <span>Student</span>
                            </div>
                            <div class="admin-img">
                                <img class="img-circle"
                                    src={{ asset('img/users/' . auth()->user()->hinh_anh . '') }} alt="student">
                            </div>

                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="item-header">
                                <h6 class="item-title">{{ auth()->user()->ho_ten }}</h6>
                            </div>
                            <div class="item-content">
                                <ul class="settings-list">
                                    <li><a href={{ route('student-detail') }}><i class="flaticon-user"></i>My
                                            Profile</a></li>
                                    <li><a href="#"><i class="flaticon-list"></i>Task</a></li>
                                    <li><a href="#"><i
                                                class="flaticon-chat-comment-oval-speech-bubble-with-text-lines"></i>Message</a>
                                    </li>
                                    <li><a href="{{ route('reset-student-password') }}"><i
                                                class="flaticon-gear-loading"></i>Reset Password</a></li>
                                    <li><a href="{{ route('logout') }}"><i class="flaticon-turn-off"></i>Log Out</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="navbar-item dropdown header-message">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="far fa-envelope"></i>
                            <div class="item-title d-md-none text-16 mg-l-10">Message</div>
                            <span>5</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="item-header">
                                <h6 class="item-title">05 Message</h6>
                            </div>
                            <div class="item-content">
                                <div class="media">
                                    <div class="item-img bg-skyblue author-online">
                                        <img src={{ asset('img/figure/student11.png') }} alt="img">
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="item-title">
                                            <a href="#">
                                                <span class="item-name">Maria Zaman</span>
                                                <span class="item-time">18:30</span>
                                            </a>
                                        </div>
                                        <p>What is the reason of buy this item. Is it usefull for me.....</p>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="item-img bg-yellow author-online">
                                        <img src={{ asset('img/figure/student12.png') }} alt="img">
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="item-title">
                                            <a href="#">
                                                <span class="item-name">Benny Roy</span>
                                                <span class="item-time">10:35</span>
                                            </a>
                                        </div>
                                        <p>What is the reason of buy this item. Is it usefull for me.....</p>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="item-img bg-pink">
                                        <img src="img/figure/student13.png" alt="img">
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="item-title">
                                            <a href="#">
                                                <span class="item-name">Steven</span>
                                                <span class="item-time">02:35</span>
                                            </a>
                                        </div>
                                        <p>What is the reason of buy this item. Is it usefull for me.....</p>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="item-img bg-violet-blue">
                                        <img src="img/figure/student11.png" alt="img">
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="item-title">
                                            <a href="#">
                                                <span class="item-name">Joshep Joe</span>
                                                <span class="item-time">12:35</span>
                                            </a>
                                        </div>
                                        <p>What is the reason of buy this item. Is it usefull for me.....</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="navbar-item dropdown header-notification">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="far fa-bell"></i>
                            <div class="item-title d-md-none text-16 mg-l-10">Notification</div>
                            <span>{{ $notification->count() }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="item-header">
                                <h6 class="item-title">{{ $notification->count() }} Notifiacations</h6>
                            </div>
                            <div class="scrollbar" id="style-2">
                                <div class="force-overflow">
                                    <div class="item-content">
                                        @foreach ($notification as $notidetail)
                                            @php
                                                $chiTietLop = $lop::where('ma_lop', $notidetail->lop_id)->first();
                                            @endphp
                                            <div class="media">
                                                <div class="item-icon bg-violet-blue">
                                                    <i class="fas fa-hourglass-half"></i>
                                                </div>
                                                <div class="media-body space-sm">
                                                    <div class="post-title">You have an invitation to class
                                                        {{ $chiTietLop->ten_lop }} . Do you want to join?</div>
                                                    <div class="container_swap">

                                                        <div class="div_left">
                                                            <a onclick="return confirm('Are you sure?')"
                                                                href="{{ route('accept-join-class', ['ma_lop' => $notidetail->lop_id]) }}">
                                                                <div class="item-icon bg-skyblue">
                                                                    <i class="fas fa-check"></i>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="div_right">
                                                            <a onclick="return confirm('Are you sure?')"
                                                                href="{{ route('delete-join-class', ['ma_lop' => $notidetail->lop_id]) }}">
                                                                <div class="item-icon bg-red">

                                                                    <i class="fas fa-times text-orange-red"></i>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="media">
                                            <div class="item-icon bg-orange">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                            <div class="media-body space-sm">
                                                <div class="post-title">Director Metting</div>
                                                <span>20 Mins ago</span>
                                            </div>
                                        </div>

                                        <div class="media">
                                            <div class="item-icon bg-violet-blue">
                                                <i class="fas fa-cogs"></i>
                                            </div>
                                            <div class="media-body space-sm">
                                                <div class="post-title">Update Password</div>
                                                <span>45 Mins ago</span>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="item-icon bg-violet-blue">
                                                <i class="fas fa-cogs"></i>
                                            </div>
                                            <div class="media-body space-sm">
                                                <div class="post-title">Update Password</div>
                                                <span>45 Mins ago</span>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="item-icon bg-violet-blue">
                                                <i class="fas fa-cogs"></i>
                                            </div>
                                            <div class="media-body space-sm">
                                                <div class="post-title">Update Password</div>
                                                <span>45 Mins ago</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="navbar-item dropdown header-language">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false"><i class="fas fa-globe-americas"></i>EN</a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">English</a>
                            <a class="dropdown-item" href="#">Spanish</a>
                            <a class="dropdown-item" href="#">Franchis</a>
                            <a class="dropdown-item" href="#">Chiness</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
                <div class="mobile-sidebar-header d-md-none">
                    <div class="header-logo">
                        <a href="index.html"><img src="img/logo1.png" alt="logo"></a>
                    </div>
                </div>
                <div class="sidebar-menu-content">
                    <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                        <li class="nav-item sidebar-nav-item">
                            <a href="{{ route('student-index') }}" class="nav-link"><i
                                    class="flaticon-dashboard"></i><span>Dashboard</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="account-settings.html" class="nav-link"><i
                                    class="flaticon-settings"></i><span>Account</span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Sidebar Area End Here -->
            @yield('index-student')
            @yield('search-student')
            @yield('student-detail')
            @yield('edit-profile')
            @yield('reset-password')
            @yield('join-classroom')
            @yield('classroom-detail')
            @yield('all-members')

        </div>
        <!-- Page Area End Here -->
    </div>
    <!-- jquery-->
    @extends('masterlayout.script')
</body>


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 17 Oct 2021 13:16:44 GMT -->

</html>
