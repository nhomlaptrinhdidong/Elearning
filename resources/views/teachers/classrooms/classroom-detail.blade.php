@extends('.layouts.teacher')
@section('classroom-detail')
<div class="dashboard-page-one">
    <div class="dashboard-content-one">
        <!--Header End-->
        <!--Container Page Start-->
        <div class="container-center">

            <div class="header__center">
                <a href="#" class="active">Home</a>
                <!-- <a href="#">Bài tập trên lớp</a> -->
                <!-- <a href={{ route('classroom-teacher-news', ['ma_lop' => $dsClassroom->ma_lop]) }}>Bài tập trên lớp</a> -->
                <a href={{route('classroom-teacher-all-members', ['ma_lop'=>$dsClassroom->ma_lop])}}>Members</a>
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
        <div class="content-right--post">
            <!-- <a href="{{ route('classroom-teacher-addPost', ['ma_lop' => $dsClassroom -> ma_lop])}}">Thêm mới thông báo / tài liệu</a></br>
            <a href="{{ route('classroom-teacher-addWorks', ['ma_lop' => $dsClassroom -> ma_lop])}}">Thêm mới bài tập</a></br>
            <a href="{{ route('classroom-teacher-addExams', ['ma_lop' => $dsClassroom -> ma_lop])}}">Thêm mới bài kiểm tra</a></br>
            <a href="{{ route('classroom-teacher-detail', ['ma_lop' => $dsClassroom -> ma_lop]) }}">Quay lại lớp</a></br> -->
            @foreach($listPost as $post)
            <div class="content-right--items">
                <div class="content-right--sub">
                    <div class="logo">
                        <i class="far fa-calendar"></i>
                    </div>

                    <div class="description">
                        @if( $post->loai_bai_dang_id == 3)
                        <p class="description-heading">Thông báo / Tài liệu</p>
                        @endif
                        @if( $post->loai_bai_dang_id == 2)
                        <p class="description-heading">Bài tập</p>
                        @endif
                        @if( $post->loai_bai_dang_id == 1)
                        <p class="description-heading">Bài kiểm tra</p>
                        @endif
                        <p class="description-timing">{{$post->ngay_dang}}</p>
                    </div>
                </div>
                <div class="content-right--tab">
                    @if( $post->loai_bai_dang_id == 3)
                    <!-- Xóa -->
                    <p>
                        <a href="{{ route('classroom-teacher-deletePost', ['id' => $post -> id, 'ma_lop' => $dsClassroom -> ma_lop]) }}">Xóa</a></br>
                        <!-- Cập nhật -->
                        <a href="{{ route('classroom-teacher-updatePost', ['id' => $post -> id, 'ma_lop' => $dsClassroom -> ma_lop]) }}">Cập nhật</a></br>
                    </p>
                    @endif
                    @if( $post->loai_bai_dang_id == 2)
                    <!-- Xóa -->
                    <p>
                        <a href="{{ route('classroom-teacher-deleteWorks', ['id' => $post -> id, 'ma_lop' => $dsClassroom -> ma_lop]) }}">Xóa</a></br>
                        <!-- Cập nhật -->
                        <a href="{{ route('classroom-teacher-updateWorks', ['id' => $post -> id, 'ma_lop' => $dsClassroom -> ma_lop]) }}">Cập nhật</a></br>
                    </p>
                    @endif
                    @if( $post->loai_bai_dang_id == 1)
                    <!-- Xóa -->
                    <p>
                        <a href="{{ route('classroom-teacher-deleteExams', ['id' => $post -> id, 'ma_lop' => $dsClassroom -> ma_lop]) }}">Xóa</a></br>
                        <!-- Cập nhật -->
                        <a href="{{ route('classroom-teacher-updateExams', ['id' => $post -> id, 'ma_lop' => $dsClassroom -> ma_lop]) }}">Cập nhật</a></br>
                    </p>
                    @endif
                </div>
            </div>
            <div class="content-description">
                <!-- <td>{{$post->id}}</td> -->
                <p>Mã lớp: {{$post->ma_lop}}</p>
                <p>Tiêu đề: {{$post->tieu_de}}</p>
                <p>Nội dung: {{$post->noi_dung}}</p>
                <p>Tệp đính kèm: {{$post->tep_tin_id}}</p>
                @if( $post->loai_bai_dang_id == 2)
                <p>Ngày nộp bài tập: {{$post->ngay_nop}}</p>
                @endif
                @if( $post->loai_bai_dang_id == 2)
                <p>Ngày nộp bài kiểm tra: {{$post->ngay_nop}}</p>
                @endif

                @if($post->trang_thai == 1)
                <!-- <td>{{$post->trang_thai}}</td> -->
                <p>Trạng thái: Đang hiển thị</p>
                @endif
                @if($post->trang_thai == 0)
                <!-- <td>{{$post->trang_thai}}</td> -->
                <p>Trạng thái: Đang ẩn</p>
                @endif


            </div>
            <form class="content-right--comment" action="{{ route('classroom-teacher-comment_POST',['ma_lop'=>$dsClassroom->ma_lop, 'id_bai_dang'=>$post->id]) }}" method="POST">
                @csrf
                <img src="{{ asset('img/logo.png') }}" height="30px" width="30px" alt="img-User">
                <div>

                    <input type="text" placeholder="Thêm nhận xét trong lớp học.." name="binh_luan">
                    <button type="submit"><i class="far fa-paper-plane"></i></button>
                </div>
            </form>
            @endforeach
        </div>

    </div>


    @endsection