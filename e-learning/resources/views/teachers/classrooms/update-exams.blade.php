@extends('.layouts.teacher')
@section('index-teacher')
<form method="POST" action=" {{ route('classroom-teacher-updateExams_POST', ['id'=>$updateExams->id, 'ma_lop' => $lop -> ma_lop]) }} ">
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
                <input type="text" class="form-control" id="usr" name="tap_tin_id" required>
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
                <td><input type="checkbox" name="trang_thai" value="1"/></td>
            </div>
        </tr>

        </br>

        <!-- Nút Submit -->
        <tr>
            <th></th>
            <td><button class="btn btn-info" type="submit">Cập nhật</button></td>
        </tr>
    </label></br>

    <a href="{{ route('classroom-teacher-news', ['ma_lop' => $lop -> ma_lop]) }}">DS Bài Đăng</a></br>
    <a href="{{ route('classroom-teacher-detail', ['ma_lop' => $lop -> ma_lop]) }}">Quay lại</a></br>
</form>

@endsection