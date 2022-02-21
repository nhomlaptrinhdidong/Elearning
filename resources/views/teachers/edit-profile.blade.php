@extends('.layouts.teacher')
@section('edit-profile')
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Teacher</h3>
        <ul>
            <li>
                <a href="{{route('teacher-index')}}">Home</a>
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
                    <h3>{{auth()->user()->ho_ten}}</h3>
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
            <form class="new-added-form" method="POST" action={{route('save-edit-accteacher-profile')}} enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Full Name *</label>
                        <input type="text" name="ho_ten" placeholder="" class="form-control" value='{{auth()->user()->ho_ten}}'>
                        @error('ho_ten')
                        <span class="mess">{{$message}}</span>
                        @enderror
                    </div>
                    

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Gender *</label>
                        <select name="gioi_tinh" class="select2">
                            <option value="">----- Please Select Gender -----</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                        @error('gioi_tinh')
                        <span class="mess">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Date Of Birth *</label>
                        <input name="ngay_sinh" type="text" placeholder="dd/mm/yyyy" class="form-control air-datepicker"
                            data-position='bottom right' value="{{date('d-m-Y', strtotime(auth()->user()->ngay_sinh))}}">
                        <i class="far fa-calendar-alt"></i>
                        @error('ngay_sinh')
                        <span class="mess">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Address *</label>
                        <input name="dia_chi" type="text" placeholder="" class="form-control" value='{{auth()->user()->dia_chi}}'>
                        @error('dia_chi')
                        <span class="mess">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>E-Mail *</label>
                        <input name="email" type="email" placeholder="" class="form-control" value={{auth()->user()->email}}>
                        @error('email')
                        <span class="mess">{{$message}}</span>
                        @enderror
                    </div>
                    
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Phone *</label>
                        <input name="sdt" type="text" placeholder="" class="form-control" value={{auth()->user()->sdt}}>
                        @error('sdt')
                        <span class="mess">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-12 form-group mg-t-30">
                        <label class="text-dark-medium">Upload Teacher Photo (150px X 150px)</label>
                        <input name="hinh_anh" type="file" class="form-control-file" value="{{auth()->user()->hinh_anh}}">
                        @error('hinh_anh')
                        <span class="mess">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                        <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Admit Form Area End Here -->

@endsection