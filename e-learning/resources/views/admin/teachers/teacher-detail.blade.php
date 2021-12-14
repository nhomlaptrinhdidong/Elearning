@extends('.layouts.admin')
@section('teacher-detail')
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>teachers</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Teacher Details</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- teacher Details Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>About Me</h3>
                </div>
               <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" 
                    data-toggle="dropdown" aria-expanded="false">...</a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                    </div>
                </div>
            </div>
            <div class="single-info-details">
                <div class="item-img">
                    <img src={{asset('img/users/'.$teacher->hinh_anh.'')}} alt="teacher">
                </div>
                <div class="item-content">
                    <div class="header-inline item-header">
                        <h3 class="text-dark-medium font-medium">{{$teacher->username}}</h3>
                        <div class="header-elements">
                            <ul>
                                <li><a href={{route('edit-teacher-profile', ['username'=>$teacher->username])}}><i class="far fa-edit"></i></a></li>
                                <li><a href="#"><i class="fas fa-print"></i></a></li>
                                <li><a href="#"><i class="fas fa-download"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="info-table table-responsive">
                        <table class="table text-nowrap">
                            <tbody>
                                <tr>
                                    <td>Name:</td>
                                    <td class="font-medium text-dark-medium">{{$teacher->ho_ten}}</td>
                                </tr>
                                <tr>
                                    <td>Gender:</td>
                                    <td class="font-medium text-dark-medium">@php
                                        if($teacher->username==1){
                                            echo 'Male';
                                        }else
                                            echo 'Female'
                                    @endphp</td>
                                </tr>
                                <tr>
                                    <td>Date Of Birth:</td>
                                    <td class="font-medium text-dark-medium">{{date('d-m-Y', strtotime($teacher->ngay_sinh))}}</td>
                                </tr>
                                <tr>
                                    <td>E-mail:</td>
                                    <td class="font-medium text-dark-medium">{{$teacher->email}}</td>
                                </tr>                                                            
                                
                                <tr>
                                    <td>Address:</td>
                                    <td class="font-medium text-dark-medium">{{$teacher->dia_chi}}</td>
                                </tr>
                                <tr>
                                    <td>Phone:</td>
                                    <td class="font-medium text-dark-medium">{{$teacher->sdt}}</td>
                                </tr>
                                <tr>
                                    <td>Status:</td>
                                    <td class="font-medium text-dark-medium">@php
                                        if($teacher->trang_thai==1){
                                            echo 'Active';
                                        }else
                                            echo 'Ban';
                                    @endphp</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- teacher Details Area End Here -->

</div> 
@endsection