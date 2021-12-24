@extends('.layouts.teacher')
@section('all-members')
    <div class="dashboard-page-one">
        <div class="dashboard-content-one">
            <div class="container-center">

                <div class="header__center">
                    <a href="{{ route('classroom-teacher-detail', ['ma_lop' => $dsClassroom->ma_lop]) }}">Home</a>
                    <a href="#">Bài tập trên lớp</a>
                    <a href="#" class="active">Members</a>
                </div>
            </div>
            <!--Header End-->

            <!--Container Page Start-->
            <div class="container container-body">
                <div class="container-center">
                    <div class="item-title">
                        <h3>Teacher</h3>

                        <table class="table display data-table text-nowrap">
                            @if ($chiTietGV != null)
                                <tr>
                                    <td class="text-left"><img class="img-circle"
                                            src={{ asset('img/users/' . $chiTietGV['hinh_anh_gv'] . '') }} alt="student">
                                    </td>
                                    <td>{{ $chiTietGV['giao_vien'] }}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    <br>
                    <div class="item-title">
                        <table class="table display data-table text-nowrap">
                            <tr>
                                <td class="text-left">
                                    <h3>Students</h3>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="flaticon-more-button-of-three-dots"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item"
                                                href="{{ route('list-students', ['ma_lop' => $dsClassroom->ma_lop]) }}"><i
                                                    class="fas fa-plus text-orange-red  "></i>List Students</a>
                                            <a href="#sendemail" class="dropdown-item"><i
                                                    class="far fa-paper-plane text-dark-pastel-green"></i>Send
                                                Email</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <div id="sendemail" class="overlay">
                            <div class="popup">
                                <h2>Sent Email</h2>
                                <a class="close" href="#">&times;</a>
                                <form action="{{ route('send-email-class', ['ma_lop' => $dsClassroom->ma_lop]) }}"
                                    method="post">
                                    @csrf
                                    <table>
                                        <tr>
                                            <td class="text-left">

                                                <div class="form-group">
                                                    <label>Email:</label>
                                                    <textarea placeholder="Enter email" rows="4" cols="50" type="text"
                                                        name="email"> </textarea>
                                                </div>
                                            </td>
                                            <td>

                                            <td style="padding-left: 6px" class="text-right">
                                                <button type="submit">

                                                    <i class="far fa-paper-plane text-dark-pastel-green"></i>
                                                </button>
                                            </td>
                                            </td>
                                        </tr>
                                    </table>
                                    <h6>(Note: Each student is separated by ' ; ')</h6>
                                </form>
                            </div>
                        </div>
                        <table class="table display data-table text-nowrap">
                            @foreach ($dsClassroom->chiTietLop as $chiTiet)
                                <?php
                            $chiTietTaiKhoan = $taiKhoan::where('username',$chiTiet->pivot->tai_khoan_id)->first();
                                if($chiTietTaiKhoan->loai_tai_khoan_id==3){
                              ?> <tr>
                                    <td class="text-left"><img class="img-circle"
                                            src={{ asset('img/users/' . $chiTietTaiKhoan->hinh_anh . '') }} alt="student">
                                    </td>
                                    <td>{{ $chiTietTaiKhoan->ho_ten }}</td>
                                    <td>
                                        @if ($chiTiet->pivot->trang_thai == '0')
                                            Đang chờ...
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false">
                                                <span class="flaticon-more-button-of-three-dots"></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" onclick="return confirm('Are you sure?')"
                                                    href={{ route('delete-student-class', ['username' => $chiTiet->pivot->tai_khoan_id, 'ma_lop' => $dsClassroom->ma_lop]) }}>
                                                    <i class="fas fa-times text-orange-red"></i> Delete</a>

                                                <a class="dropdown-item"
                                                    href={{ route('student-detail-class', ['username' => $chiTiet->pivot->tai_khoan_id, 'ma_lop' => $dsClassroom->ma_lop]) }}><i
                                                        class="fas fa-cogs text-dark-pastel-green"></i>Detail</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                }?>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <!--Container Page End-->
        </div>

    </div>


@endsection
