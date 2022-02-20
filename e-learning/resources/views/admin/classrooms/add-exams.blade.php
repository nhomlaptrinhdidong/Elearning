@extends('.layouts.admin')
@section('add-class')
<form method="POST" action=" {{ route('classroom-Admin-addExams_POST', ['ma_lop' => $lop -> ma_lop]) }} ">
    @csrf
    <label>
        <tr>
            <div class="form-group">
                <label>Tiêu đề:</label>
                <input type="text" class="form-control" name="tieu_de" required>
            </div>
        </tr>
        <tr>
            <div class="form-group">
                <label for="usr">Nội dung:</label>
                <input type="text" class="form-control" id="usr" name="noi_dung" required>
            </div>
        </tr>
        <tr>
            <div class="form-group">
                <label for="usr">Tập tin:</label>
                <input type="file" class="form-control" id="usr" name="tap_tin_id">
            </div>
        </tr>
        <tr>
            <div class="form-group">
                <label for="usr">Ngày nộp:</label>
                <input type="date" class="form-control" id="usr" name="ngay_nop" required>
            </div>
        </tr>
        <tr>
            <div class="form-group">
                <th>Trạng thái</th>
                <td><input type="checkbox" name="trang_thai" value="1" /></td>
            </div>
        </tr>

        <!-- Nút Submit -->
        <tr>
            <th></th>
            <td><button type="submit">Đăng</button></td>
        </tr>
    </label>
    
    <a href="{{ route('classroom-Admin-news', ['ma_lop' => $lop -> ma_lop]) }}">DS Bài Đăng</a>
    <a href="{{ route('classroom-detail', ['ma_lop' => $lop -> ma_lop]) }}">Quay lại</a>
</form>

<p>Thêm bài kiểm tra</p>
@endsection
