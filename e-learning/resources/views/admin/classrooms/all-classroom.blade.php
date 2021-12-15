@extends('.layouts.admin')
@section('all-classrooms')

<div class="dashboard-page-one">
    <div class="dashboard-content-one">
        <!-- Breadcubs Area Start Here -->
        <div class="breadcrumbs-area">
            <h3>Classes</h3>
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>All Classes</li>
            </ul>
        </div>
        <!-- Breadcubs Area End Here -->
        <!-- Class Table Area Start Here -->
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>All Classroom</h3>
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
                <form class="mg-b-20">
                    <div class="row gutters-8">
                        <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                            <input type="text" placeholder="Search by ID ..." class="form-control">
                        </div>
                        <div class="col-4-xxxl col-xl-4 col-lg-3 col-12 form-group">
                            <input type="text" placeholder="Search by Name ..." class="form-control">
                        </div>
                        <div class="col-4-xxxl col-xl-3 col-lg-3 col-12 form-group">
                            <input type="text" placeholder="Search by Class ..." class="form-control">
                        </div>
                        <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                            <button type="submit" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table display data-table text-nowrap">
                        <thead>
                            <tr>
                                <th> 
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input checkAll">
                                        <label class="form-check-label">ID</label>
                                    </div>
                                </th>
                                <th>Code</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Discription</th>
                                <th>Date created</th>
                                <th>Status</th>
                                
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>@php
                            $i =1;
                        @endphp
                            @foreach ($dsClassroom as $classroom)                             
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input">
                                            <label class="form-check-label">@php
                                                echo $i++
                                            @endphp</label>
                                        </div>
                                    </td>
                                    <td>{{$classroom->ma_lop}}</td>
                                    <td class="banner" class="text-center"><img src={{asset('img/classrooms/'.$classroom->banner.'')}} alt="student"></td>
    
                                    <td>{{$classroom->ten_lop}}</td>
                                    <td>{{$classroom->mo_ta}}</td>
                                    <td>{{date('d-m-Y', strtotime($classroom->created_at))}}</td>
                                    
                                    <td>{{$classroom->trang_thai}}</td>
                                    
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <span class="flaticon-more-button-of-three-dots"></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                                <a class="dropdown-item" href={{route('classroom-detail', ['ma_lop'=>$classroom->ma_lop])}}><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                                <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                         
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Class Table Area End Here -->
    </div>
</div>
@endsection