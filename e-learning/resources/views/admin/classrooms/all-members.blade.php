@extends('.layouts.admin')
@section('all-members')
<div class="dashboard-page-one">
    <div class="dashboard-content-one">
        <div class="container-center">

            <div class="header__center">
                <a href="{{ route('classroom-detail', ['ma_lop' => $dsClassroom->ma_lop]) }}">Home</a>
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
                            <td class="text-left"><img class="img-circle" src={{ asset('img/users/' . $chiTietGV['hinh_anh_gv'] . '') }} alt="student">
                            </td>
                            <td>{{ $chiTietGV['giao_vien'] }}</td>
                            <td class="text-right">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="flaticon-more-button-of-three-dots"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </table>
                </div>
                <br>
                <div class="item-title">
                    <h3>Students</h3>
                    <table class="table display data-table text-nowrap">
                        @foreach ($dsClassroom->chiTietLop as $chiTiet)
                        <?php
                        $chiTietTaiKhoan = $taiKhoan::where('username', $chiTiet->pivot->tai_khoan_id)->first();
                        if ($chiTietTaiKhoan->loai_tai_khoan_id == 3) {
                        ?> <tr>
                                <td class="text-left"><img class="img-circle" src={{ asset('img/users/' . $chiTietTaiKhoan->hinh_anh . '') }} alt="student">
                                </td>
                                <td>{{ $chiTietTaiKhoan->ho_ten }}</td>
                                <td>
                                    @if ($chiTiet->pivot->trang_thai == '0')
                                    Đang chờ...
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="flaticon-more-button-of-three-dots"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        } ?>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <!--Container Page End-->
    </div>

</div>


@endsection