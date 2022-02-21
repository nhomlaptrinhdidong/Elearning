@extends('.layouts.student')
@section('all-members')
    <div class="dashboard-page-one">
        <div class="dashboard-content-one">
            <div class="container-center">

                <div class="header__center">
                    <a href="{{ route('classroom-student-detail', ['ma_lop' => $dsClassroom->ma_lop]) }}">Home</a>
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
                            @foreach ($dsClassroom->chiTietLop as $chiTiet)
                                @php
                                    
                                    $chiTietTaiKhoan = $taiKhoan::where('username', $chiTiet->pivot->tai_khoan_id)->first();
                                @endphp
                                @if ($chiTietTaiKhoan->loai_tai_khoan_id == 2)
                                    <tr>
                                        <td class="text-left"><img class="img-circle"
                                                src={{ asset('img/users/' . $chiTietTaiKhoan->hinh_anh . '') }}
                                                alt="student">
                                        </td>
                                        <td>{{ $chiTietTaiKhoan->ho_ten }}</td>

                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                    <br>
                    <div class="item-title">
                        <h3>Students</h3>
                        <table class="table display data-table text-nowrap">
                            @foreach ($dsClassroom->chiTietLop as $chiTiet)
                                @if ($chiTiet->pivot->trang_thai == 1)

                                    @php
                                        $chiTietTaiKhoan = $taiKhoan::where('username', $chiTiet->pivot->tai_khoan_id)->first();
                                    @endphp

                                    @if ($chiTietTaiKhoan->loai_tai_khoan_id == 3)
                                        <tr>
                                            <td class="text-left"><img class="img-circle"
                                                    src={{ asset('img/users/' . $chiTietTaiKhoan->hinh_anh . '') }}
                                                    alt="student">
                                            </td>
                                            <td>{{ $chiTietTaiKhoan->ho_ten }}</td>

                                            </td>
                                        </tr>
                                    @endif
                                @endif

                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <!--Container Page End-->
        </div>

    </div>


@endsection
