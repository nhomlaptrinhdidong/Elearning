@extends('.layouts.student')
@section('classroom-detail')
<div class="dashboard-page-one">
    <div class="dashboard-content-one">
        <!--Header End-->
        <!--Container Page Start-->
        <div class="container-center">

            <div class="header__center">
                <a href="#" class="active">Home</a>
                <!-- <a href="#">Bài tập trên lớp</a> -->
                <a href={{ route('classroom-student-all-members', ['ma_lop' => $dsClassroom->ma_lop]) }}>Members</a>
            </div>

        </div>
        <div class="content-right--post">
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
            </div>
            <div class="content-description">
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

                <strong>Danh Sách Bình Luận</strong><br><br>
                @foreach($post->dsBinhLuan as $binhluan)
                    <strong>{{$binhluan->taiKhoan->ho_ten}}:</strong> &emsp;&emsp;
                    {{$binhluan->ngay_dang}}<br>&emsp;
                    {{$binhluan->noi_dung}}<br><br>
                @endforeach

            </div>
            <form class="content-right--comment" action="{{ route('classroom-student-comment_POST',['ma_lop'=>$dsClassroom->ma_lop, 'id_bai_dang'=>$post->id]) }}" method="POST">
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