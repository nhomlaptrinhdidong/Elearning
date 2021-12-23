@extends('.layouts.admin')
@section('add-account')
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Account</h3>
        <ul>
            <li>
                <a href="{{route('admin-index')}}">Home</a>
            </li>
            <li>Add Account</li>
            
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Admit Form Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>New Account</h3>
                </div>
            </div>
            <form class="new-added-form" action="{{route('save-account')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Full Name *</label>
                        <input type="text" name="ho_ten" placeholder="Full Name" class="form-control" >
                        @error('ho_ten')
                        <span class="mess">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Gender *</label>
                        <select name="gioi_tinh" >
                            <option value="">----- Please Select Gender -----</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                        @error('gioi_tinh')
                        <span class="mess">{{$message}}</span>
                        @enderror
                        
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Account Type *</label>
                        <select name="loai_tai_khoan_id" class="select2">
                            <option value="">----- Please Select Type -----</option>    
                            <option value="2">Teacher</option>
                            <option value="3">Student</option>
                        </select>  
                        @error('loai_tai_khoan_id')
                        <span class="mess">{{$message}}</span>
                        @enderror   
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Status *</label>
                        <select name="trang_thai" class="select2" class="form-select" aria-label="Disabled select example" >
                            <option value="">----- Please Select Status -----</option>
                            <option value="1">Active</option>
                            <option value="2">Lock</option>
                        </select>  
                        @error('trang_thai')
                        <span class="mess">{{$message}}</span>
                        @enderror   
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Date Of Birth *</label>
                        <input type="text" placeholder="d-m-yyyy" class="form-control air-datepicker"
                            data-position='bottom right' name="ngay_sinh" >
                        <i class="far fa-calendar-alt"></i>
                        @error('ngay_sinh')
                        <span class="mess">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Address</label>
                        <input type="text" name="dia_chi" placeholder="Address" class="form-control" >
                        @error('dia_chi')
                        <span class="mess">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>E-Mail</label>
                        <input type="email" name="email" placeholder="Email" class="form-control" >
                        @error('email')
                        <span class="mess">{{$message}}</span>
                        @enderror
                    </div>
                    
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Phone</label>
                        <input type="text" name="sdt" placeholder="Phone" class="form-control" >
                        @error('sdt')
                        <span class="mess">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-12 form-group mg-t-30">
                        <label class="text-dark-medium">Upload Account Photo (150px X 150px)</label>
                        <input type="file" name="hinh_anh" class="form-control-file" >
                        @error('hinh_anh')
                        <span class="mess">{{$message}}</span>
                        @enderror
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