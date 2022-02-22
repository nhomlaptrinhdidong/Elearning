@extends('.layouts.admin')
@section('add-class')
<form method="POST" action=" {{ route('classroom-Admin-addWorks_POST', ['ma_lop' => $lop -> ma_lop]) }} ">
    @csrf
    <label>
        <!-- <tr>
            <th>Loại bài đăng</th>
            <td><input type="text" name="loai_bai_dang_id" value="3" readonly/></td>

            <input list="loaiBaiDang" name="loai_bai_dang_id">
            <datalist id="loaiBaiDang">
                <option value="1" label="Bài Tập">
                <option value="2" label="Kiểm Tra">
                <option value="3" label="Thông Báo, Tài Liệu">
            </datalist>
        </tr> -->

        <!-- <tr>
            <th>Mã Lớp</th>
            <td><input type="text" placeholder="V8zcV5" name="ma_lop" value="V8zcV5" readonly /></td>
        </tr> -->

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

        <!-- <tr>
            <th>Ngày đăng</th>
            <td><input type="date" name="ngay_dang" value="data.now"/></td>
        </tr> -->

        <!-- <tr>
            <th>Ngày nộp</th>
            <td><input type="date" name="ngay_nop"/></td>
        </tr> -->

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

<p>Thêm bài tập</p>
@endsection