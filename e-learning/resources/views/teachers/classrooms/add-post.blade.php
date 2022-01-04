@extends('.layouts.teacher')
@section('all-members')
<form method="POST" action=" {{ route('classroom-teacher-addPost_POST', ['ma_lop' => $lop -> ma_lop]) }} ">
    @csrf
    <label>
        <tr>
            <!-- <th>Loại bài đăng</th>
            <td><input type="text" name="loai_bai_dang_id" value="3" readonly/></td> -->

            <input list="loaiBaiDang" name="loai_bai_dang_id">
            <datalist id="loaiBaiDang">
                <option value="1" label="Bài Tập">
                <option value="2" label="Kiểm Tra">
                <option value="3" label="Thông Báo, Tài Liệu">
            </datalist>
        </tr>

        <!-- <tr>
            <th>Mã Lớp</th>
            <td><input type="text" placeholder="V8zcV5" name="ma_lop" value="V8zcV5" readonly /></td>
        </tr> -->

        <tr>
            <th>Tiêu đề</th>
            <td><input type="text" name="tieu_de" /></td>
        </tr>

        <tr>
            <th>Nội Dung</th>
            <td><input type="text" name="noi_dung" /></td>
        </tr>

        <tr>
            <th>Tập tin id</th>
            <td><input type="text" name="tap_tin_id" /></td>
        </tr>

        <tr>
            <th>Ngày đăng</th>
            <td><input type="date" name="ngay_dang" /></td>
        </tr>

        <tr>
            <th>Ngày nộp</th>
            <td><input type="date" name="ngay_nop" /></td>
        </tr>

        <tr>
            <th>Trạng thái</th>
            <td><input type="checkbox" name="trang_thai" value="1"/></td>
        </tr>

        <!-- Nút Submit -->
        <tr>
            <th></th>
            <td><button type="submit">Đăng</button></td>
        </tr>
    </label>
    
    <a href="{{ route('classroom-teacher-news', ['ma_lop' => $lop -> ma_lop]) }}">Bài Đăng</a>

    <a href="{{ route('classroom-teacher-detail', ['ma_lop' => $lop -> ma_lop]) }}">Quay lại</a>
</form>
@endsection