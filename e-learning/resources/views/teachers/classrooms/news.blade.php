@extends('.layouts.teacher')
@section('all-members')
<!-- <h1>Bài đăng</h1> -->
<a href="{{ route('classroom-teacher-addPost', ['ma_lop' => $lop -> ma_lop])}}">Thêm mới</a>

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
</table>
@endsection