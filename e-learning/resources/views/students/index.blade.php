@extends('.layouts.student')
@section('index')
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Student Dashboard</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Student</li>
        </ul>
    </div>
    <!--Header End-->
    <!--Grid Container Start-->
    <div class="container container-body">
        <div class="grid-container">
            @foreach ($dschitiet as $chiTietLop)
                <div class="grid__items">
                    <img class="img-header-box"  src={{asset('img/classrooms/'.$chiTietLop['banner'].'')}} height="120px" width="100%" alt="">
                    <div class="grid__items--title">
                        <a href="detail_page.html">
                            <p class="name-class"> @php
                                if(strlen($chiTietLop['ten_lop'])>26)
                                {
                                    $s =Str::substr($chiTietLop['ten_lop'], 0, 22).'...';
                                    echo $s;
                                }
                                    else {
                                       echo $chiTietLop['ten_lop'];
                                    }
                            @endphp</p>
                            <p class="name-subject">
                                @php
                                    if(strlen($chiTietLop['mo_ta'])>41)
                                {
                                    $s =Str::substr($chiTietLop['mo_ta'], 0, 37).'...';
                                    echo $s;
                                }
                                    else {
                                       echo $chiTietLop['mo_ta'];
                                    }
                                @endphp</p>
                            <a href="#" class="grid__items--poss">
                                {{$chiTietLop['giao_vien']}}
                            </a>
                        </a>
                        <i style="padding-left: 50px" class="fas fa-ellipsis-v"></i>
                    </div>
                    <a href="#"><img class="img-body-logo" src={{asset('img/users/'.$chiTietLop['hinh_anh_gv'].' ')}} height="40px" width="40px"
                            alt=""></a>
                    <div class="grid__items--content">
                        <div></div>
                        <span>
                            <a href="#"><i class="far fa-id-badge"></i></a>
                            <a href="#"><i class="far fa-folder"></i></a>
                        </span>
                    </div>
                </div>      
                
            @endforeach
        </div>
    </div>

</div>
@endsection