@extends('.layouts.admin')
@section('add-class')

<div class="content-right--post">
<a href="{{ route('classroom-Admin-addPost', ['ma_lop' => $lop -> ma_lop])}}">Thêm mới thông báo / tài liệu</a></br>
<a href="{{ route('classroom-Admin-addWorks', ['ma_lop' => $lop -> ma_lop])}}">Thêm mới bài tập</a></br>
<a href="{{ route('classroom-Admin-addExams', ['ma_lop' => $lop -> ma_lop])}}">Thêm mới bài kiểm tra</a></br>
<a href="{{ route('classroom-detail', ['ma_lop' => $lop -> ma_lop]) }}">Quay lại lớp</a></br>
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
            <a href="{{ route('classroom-Admin-deletePost', ['id' => $post -> id, 'ma_lop' => $lop -> ma_lop]) }}">Xóa</a></br>
            <!-- Cập nhật -->
            <a href="{{ route('classroom-Admin-updatePost', ['id' => $post -> id, 'ma_lop' => $lop -> ma_lop]) }}">Cập nhật</a></br>
        </p>
        @endif
        @if( $post->loai_bai_dang_id == 2)
        <!-- Xóa -->
        <p>
            <a href="{{ route('classroom-Admin-deleteWorks', ['id' => $post -> id, 'ma_lop' => $lop -> ma_lop]) }}">Xóa</a></br>
            <!-- Cập nhật -->
            <a href="{{ route('classroom-Admin-updateWorks', ['id' => $post -> id, 'ma_lop' => $lop -> ma_lop]) }}">Cập nhật</a></br>
        </p>
        @endif
        @if( $post->loai_bai_dang_id == 1)
        <!-- Xóa -->
        <p>
            <a href="{{ route('classroom-Admin-deleteExams', ['id' => $post -> id, 'ma_lop' => $lop -> ma_lop]) }}">Xóa</a></br>
            <!-- Cập nhật -->
            <a href="{{ route('classroom-Admin-updateExams', ['id' => $post -> id, 'ma_lop' => $lop -> ma_lop]) }}">Cập nhật</a></br>
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
    <form class="content-right--comment">
        <img src="{{asset('img/logo.png')}}" height="30px" width="30px" alt="img-User">
        <div>
            <input type="text" placeholder="Thêm nhận xét trong lớp học..">
            <button type="submit"><i class="far fa-paper-plane"></i></button>
        </div>
    </form>
    @endforeach
</div>


@endsection