@extends('.layouts.teacher')
@section('classroom-detail')
<div class="dashboard-page-one">
    <div class="dashboard-content-one">
        <!--Header End-->
        <!--Container Page Start-->
        <div class="container-center">

            <div class="header__center">
                <a href="#" class="active">Home</a>
                <a href={{ route('classroom-teacher-news', ['ma_lop' => $dsClassroom->ma_lop]) }}>Bài tập trên lớp</a>
                <a href={{ route('classroom-teacher-all-members', ['ma_lop' => $dsClassroom->ma_lop]) }}>Members</a>
                <!--Add Post-->
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <p>Thêm thông báo/Bài Tập/Bài Kiểm Tra</p>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href={{ route('classroom-teacher-addPost', ['ma_lop' => $dsClassroom->ma_lop] ) }}><i class="far fa-bell"></i> Thông Báo</a>
                        <a class="dropdown-item" href={{ route('classroom-teacher-addWorks', ['ma_lop' => $dsClassroom->ma_lop] ) }}><i class="fas fa-home"></i> Bài Tập</a>
                        <a class="dropdown-item" href={{ route('classroom-teacher-addExams', ['ma_lop' => $dsClassroom->ma_lop] ) }}><i class="fas fa-check-double"></i> Bài Kiểm Tra</a>
                    </div>
                </div>
                <!--End Add Post-->
            </div>

        </div>
        <div class="container container-body">

            <div class="container-center">
                <div class="background-heading">
                    <img class="background-heading" src="{{ asset('img/classrooms/' . $dsClassroom->banner . '') }}" alt="">
                    <div>
                        <h4>{{ $dsClassroom->ten_lop }}</h4>
                        <p>{{ $dsClassroom->mo_ta }}</p>
                    </div>
                </div>
                <div class="content">
                    <div class="content-left">
                        <p>Sắp đến hạn</p>
                        <p>Tuyệt vời, không có bài tập nào sắp đến hạn!</p>
                        <a href="#">Xem tất cả</a>
                    </div>
                    <div class="content-right">
                        <div href="#" class="content-right--add">
                            <img src="{{ asset('img/logo.png') }}" height="30px" width="30px" alt="img-User">
                            <p>Thông báo nội dung nào đó cho lớp học của bạn</p>
                        </div>
                        <div class="content-right--post">
                            <div class="content-right--items">
                                <div class="content-right--sub">
                                    <div class="logo">
                                        <i class="far fa-calendar"></i>
                                    </div>

                                    <div class="description">
                                        <p class="description-heading">Dương Hữu Phước</p>
                                        <p class="description-timing">Hôm qua</p>
                                    </div>
                                </div>
                                <div class="content-right--tab"><i class="fas fa-ellipsis-v"></i></div>
                            </div>
                            <div class="content-description">
                                <p>Chào các bạn,</p>
                                <p>Hiện tại công việc gia đình thầy vẫn chưa giải quyết xong, do đó buổi học TH chiều
                                    nay
                                    chúng ta sẽ nghỉ nhé.</p>

                                <p>Cả 2 buổi LT và TH thầy sẽ dạy bù vào tuần sau (tuần ôn tập), dự kiến:</p>
                                <p>- LT: Học bù vào thứ Năm (16/12) từ 6h30 - 8h55</p>
                                <p>- TH: Học bù vào thứ Năm (16/12) từ 9h05 - 11h30</p>
                            </div>
            <!--form thêm comment-->
                            <form class="content-right--comment" action="{{ route('classroom-teacher-comment_POST',['ma_lop'=>$dsClassroom->ma_lop]) }}" method="POST">
                                @csrf
                                <img src="{{ asset('img/logo.png') }}" height="30px" width="30px" alt="img-User">
                                <div>
                                    <input type="text" placeholder="Thêm nhận xét trong lớp học.." name="binh_luan">
                                    <button type="submit"><i class="far fa-paper-plane"></i></button>
                                </div>
                            </form>

                        </div>
                        <a href="exercises.html" class="content-right--items">
                            <div class="content-right--sub">
                                <div class="logo">
                                    <i class="far fa-calendar"></i>
                                </div>

                                <div class="description">
                                    <p class="description-heading">Dương H. Phước đã đăng một bài tập mới: Kiểm tra LT
                                        giữa
                                    </p>
                                    <p class="description-timing">10 th 12</p>
                                </div>
                            </div>
                            <div class="content-right--tab"><i class="fas fa-ellipsis-v"></i></div>
                        </a>
                        <a href="exercises.html" class="content-right--items">
                            <div class="content-right--sub">
                                <div class="logo">
                                    <i class="far fa-calendar"></i>
                                </div>
                                <div class="description">
                                    <p class="description-heading">Dương H. Phước đã đăng một bài tập mới: Kiểm tra LT
                                        lần 3
                                    </p>
                                    <p class="description-timing">7 th 12</p>
                                </div>
                            </div>
                            <div class="content-right--tab"><i class="fas fa-ellipsis-v"></i></div>
                        </a>
                        <a href="exercises.html" class="content-right--items">
                            <div class="content-right--sub">
                                <div class="logo">
                                    <i class="far fa-calendar"></i>
                                </div>

                                <div class="description">
                                    <p class="description-heading">Dương H. Phước đã đăng một bài tập mới: Kiểm tra LT
                                        lần 2

                                    </p>
                                    <p class="description-timing">11 th 11</p>
                                </div>
                            </div>
                            <div class="content-right--tab"><i class="fas fa-ellipsis-v"></i></div>
                        </a>
                        <a href="exercises.html" class="content-right--items">
                            <div class="content-right--sub">
                                <div class="logo">
                                    <i class="far fa-calendar"></i>
                                </div>

                                <div class="description">
                                    <p class="description-heading">Dương H. Phước đã đăng một bài tập mới: Kiểm tra LT
                                        lần 1
                                    </p>
                                    <p class="description-timing">23 th 10</p>
                                </div>
                            </div>
                            <div class="content-right--tab"><i class="fas fa-ellipsis-v"></i></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--Container Page End-->
    </div>

</div>


@endsection