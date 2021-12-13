@extends('.layouts.admin')
@section('edit-profile-student')
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Student</h3>
        <ul>
            <li>
                <a href="{{route('admin-index')}}">Home</a>
            </li>
            <li>Edit Profile</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Admit Form Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>{{$student->ho_ten}}</h3>
                </div>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-expanded="false">...</a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i
                                class="fas fa-times text-orange-red"></i>Close</a>
                        <a class="dropdown-item" href="#"><i
                                class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                        <a class="dropdown-item" href="#"><i
                                class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                    </div>
                </div>
            </div>
            <form class="new-added-form" action="{{route('save-edit-student-profile',['username'=>$student->username])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Full Name *</label>
                        <input type="text" name="ho_ten" placeholder="" class="form-control" value='{{$student->ho_ten}}'>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Gender *</label>
                        <select name="gioi_tinh" class="select2">
                            <option value="">----- Please Select Gender -----</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                        
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Account Type *</label>
                        <select name="loai_tai_khoan_id" class="select2">
                            <option value="">----- Please Select Type -----</option>
                            <option value="2">Teacher</option>
                            <option value="3">Student</option>
                        </select>     
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Status *</label>
                        <select name="trang_thai" class="select2">
                            <option value="">----- Please Select Status -----</option>
                            <option value="1">Active</option>
                            <option value="2">Lock</option>
                        </select>     
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Date Of Birth *</label>
                        <input type="text" placeholder="dd/mm/yyyy" class="form-control air-datepicker"
                            data-position='bottom right' name="ngay_sinh" value='{{date('d-m-Y', strtotime($student->ngay_sinh))}}'>
                        <i class="far fa-calendar-alt"></i>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Address</label>
                        <input type="text" name="dia_chi" placeholder="" class="form-control" value='{{$student->dia_chi}}'>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>E-Mail</label>
                        <input type="email" name="email" placeholder="" class="form-control" value={{$student->email}}>
                    </div>
                    
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Phone</label>
                        <input type="text" name="sdt" placeholder="" class="form-control" value={{$student->sdt}}>
                    </div>
                    <div class="col-lg-6 col-12 form-group mg-t-30">
                        <label class="text-dark-medium">Upload Student Photo (150px X 150px)</label>
                        <input type="file" name="hinh_anh" class="form-control-file" value='{{$student->hinh_anh}}'>
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit"  class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                        <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Admit Form Area End Here -->
</div> 
@endsection