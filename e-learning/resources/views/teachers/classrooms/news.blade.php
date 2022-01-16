@extends('.layouts.teacher')
@section('index-teacher')
<!-- <h1>Bài đăng</h1>

<a href="{{ route('classroom-teacher-detail', ['ma_lop' => $lop -> ma_lop]) }}">Quay lại lớp</a>

<table border="1" align="center">
    <tr align="center">
        <th>ID</th>
        <th>Loại bài đăng</th>
        <th>Lớp</th>
        <th>Tiêu đề</th>
        <th>Nội dung</th>
        <th>Link đính kièm</th>
        <th>Ngày đăng</th>
        <th>Ngày nộp</th>
        <th>Trạng thái</th>
    </tr>
    @forelse($listPost as $post)
    <tr>
        <td>{{$post->id}}</td>
        <td>{{$post->loai_bai_dang_id}}</td>
        <td>{{$post->ma_lop}}</td>
        <td>{{$post->tieu_de}}</td>
        <td>{{$post->noi_dung}}</td>
        <td>{{$post->tep_tin_id}}</td>
        <td>{{$post->ngay_dang}}</td>
        <td>{{$post->ngay_nop}}</td>
        <td>{{$post->trang_thai}}</td>
    </tr>
    @empty
    <tr>
        <td colspan="5">Không có dữ liệu</td>
    </tr>
    @endforelse
</table> -->

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <h2>Danh sách bài tập</h2>
        <a href="{{ route('classroom-teacher-addPost', ['ma_lop' => $lop -> ma_lop])}}">Thêm mới thông báo / tài liệu</a></br>
        <a href="{{ route('classroom-teacher-addWorks', ['ma_lop' => $lop -> ma_lop])}}">Thêm mới bài tập</a></br>
        <a href="{{ route('classroom-teacher-addExams', ['ma_lop' => $lop -> ma_lop])}}">Thêm mới bài kiểm tra</a></br>
        <a href="{{ route('classroom-teacher-detail', ['ma_lop' => $lop -> ma_lop]) }}">Quay lại lớp</a></br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <!-- <th>ID</th> -->
                    <th>Loại bài đăng</th>
                    <th>Lớp</th>
                    <th>Tiêu đề</th>
                    <th>Nội dung</th>
                    <th>Link đính kièm</th>
                    <th>Ngày đăng</th>
                    <th>Ngày nộp</th>
                    <th>Trạng thái</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            @forelse($listPost as $post)
            <tbody>
                <tr>
    <!-- Thông báo -->
                @if( $post->loai_bai_dang_id == 3)
                    <!-- <td>{{$post->id}}</td> -->
                    <td>Thông báo / Tài liệu</td>
                    <td>{{$post->ma_lop}}</td>
                    <td>{{$post->tieu_de}}</td>
                    <td>{{$post->noi_dung}}</td>
                    <td>{{$post->tep_tin_id}}</td>
                    <td>{{$post->ngay_dang}}</td>
                    <td>{{$post->ngay_nop}}</td>
                    @if($post->trang_thai == 1)
                    <!-- <td>{{$post->trang_thai}}</td> -->
                    <td>Đang hiển thị</td>
                    @endif
                    @if($post->trang_thai == 0)
                    <!-- <td>{{$post->trang_thai}}</td> -->
                    <td>Đang ẩn</td>
                    @endif
                    <!-- Xóa -->
                    <td>
                    <a href="{{ route('classroom-teacher-deletePost', ['id' => $post -> id, 'ma_lop' => $lop -> ma_lop]) }}">Xóa</a></br>
                    <!-- Cập nhật -->
                    <a href="{{ route('classroom-teacher-updatePost', ['id' => $post -> id, 'ma_lop' => $lop -> ma_lop]) }}">Cập nhật</a></br>
                    </td>
                @endif
    <!-- Kiểm tra -->
                @if($post->loai_bai_dang_id == 1)
                    <!-- <td>{{$post->id}}</td> -->
                    <td>Bài kiểm tra</td>
                    <td>{{$post->ma_lop}}</td>
                    <td>{{$post->tieu_de}}</td>
                    <td>{{$post->noi_dung}}</td>
                    <td>{{$post->tep_tin_id}}</td>
                    <td>{{$post->ngay_dang}}</td>
                    <td>{{$post->ngay_nop}}</td>
                    @if($post->trang_thai == 1)
                    <!-- <td>{{$post->trang_thai}}</td> -->
                    <td>Đang hiển thị</td>
                    @endif
                    @if($post->trang_thai == 0)
                    <!-- <td>{{$post->trang_thai}}</td> -->
                    <td>Đang ẩn</td>
                    @endif
                    <!-- Xóa -->
                    <td>
                    <a href="{{ route('classroom-teacher-deleteExams', ['id' => $post -> id, 'ma_lop' => $lop -> ma_lop]) }}">Xóa</a></br>
                    <!-- Cập nhật -->
                    <a href="{{ route('classroom-teacher-updateExams', ['id' => $post -> id, 'ma_lop' => $lop -> ma_lop]) }}">Cập nhật</a></br>
                    </td>
                @endif
    <!-- Bài Tập -->
                @if($post->loai_bai_dang_id == 2)
                    <!-- <td>{{$post->id}}</td> -->
                    <td>Bài tập</td>
                    <td>{{$post->ma_lop}}</td>
                    <td>{{$post->tieu_de}}</td>
                    <td>{{$post->noi_dung}}</td>
                    <td>{{$post->tep_tin_id}}</td>
                    <td>{{$post->ngay_dang}}</td>
                    <td>{{$post->ngay_nop}}</td>
                    @if($post->trang_thai == 1)
                    <!-- <td>{{$post->trang_thai}}</td> -->
                    <td>Đang hiển thị</td>
                    @endif
                    @if($post->trang_thai == 0)
                    <!-- <td>{{$post->trang_thai}}</td> -->
                    <td>Đang ẩn</td>
                    @endif
                    <!-- Xóa -->
                    <td>
                    <a href="{{ route('classroom-teacher-deleteWorks', ['id' => $post -> id, 'ma_lop' => $lop -> ma_lop]) }}">Xóa</a></br>
                    <!-- Cập nhật -->
                    <a href="{{ route('classroom-teacher-updateWorks', ['id' => $post -> id, 'ma_lop' => $lop -> ma_lop]) }}">Cập nhật</a></br>
                    </td>
                @endif
                </tr>
                @empty
                <tr>
                    <td>Không có dữ liệu</td>
                </tr>
            </tbody>
            @endforelse
        </table>
    </div>
</body>
</html>
@endsection