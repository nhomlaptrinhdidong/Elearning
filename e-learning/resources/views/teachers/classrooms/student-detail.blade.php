@extends('.layouts.teacher')
@section('student-detail')
    <div class="dashboard-content-one">
        <!-- Breadcubs Area Start Here -->
        <div class="breadcrumbs-area">
            <h3>Student</h3>
            <ul>
                <li>
                    <a href="{{ route('classroom-teacher-all-members', ['ma_lop' => $ma_lop]) }}">All Members</a>
                </li>
                <li>Student Details</li>
            </ul>
        </div>
        <!-- Breadcubs Area End Here -->
        <!-- Student Details Area Start Here -->
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>About Me</h3>
                    </div>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">...</a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                        </div>
                    </div>
                </div>
                <div class="single-info-details">
                    <div class="admin-img">
                        <img class="img-circle" src={{ asset('img/users/' . $user->hinh_anh . '') }} alt="student">
                    </div>
                    <div class="item-content">
                        <div class="header-inline item-header">
                            <h3 class="text-dark-medium font-medium">{{ $user->username }}</h3>
                        </div>
                        <div class="info-table table-responsive">
                            <table class="table text-nowrap">
                                <tbody>
                                    <tr>
                                        <td>Name:</td>
                                        <td class="font-medium text-dark-medium">{{ $user->ho_ten }}</td>
                                    </tr>
                                    <tr>
                                        <td>Gender:</td>
                                        <td class="font-medium text-dark-medium">@php
                                            if ($user->gioi_tinh == 1) {
                                                echo 'Male';
                                            } elseif ($user->gioi_tinh == 1) {
                                                echo 'Female';
                                            } else {
                                                echo 'Other';
                                            }
                                        @endphp</td>
                                    </tr>
                                    <tr>
                                        <td>Date Of Birth:</td>
                                        <td class="font-medium text-dark-medium">
                                            {{ date('d-m-Y', strtotime($user->ngay_sinh)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>E-mail:</td>
                                        <td class="font-medium text-dark-medium">{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Type:</td>
                                        <td class="font-medium text-dark-medium">Student</td>
                                    </tr>
                                    <tr>
                                        <td>Address:</td>
                                        <td class="font-medium text-dark-medium">{{ $user->dia_chi }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone:</td>
                                        <td class="font-medium text-dark-medium">{{ $user->sdt }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Student Details Area End Here -->

    </div>
@endsection
