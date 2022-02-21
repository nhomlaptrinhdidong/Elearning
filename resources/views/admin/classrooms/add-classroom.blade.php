@extends('.layouts.admin')
@section('add-class')
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Classroom</h3>
        <ul>
            <li>
                <a href="{{route('admin-index')}}">Home</a>
            </li>
            <li>Add Classroom</li>
            
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Admit Form Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>New Classroom</h3>
                </div>
            </div>
            <form class="new-added-form" action="{{route('save-add-classroom')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Class Name *</label>
                        <input type="text" name="ten_lop" placeholder="Class Name" class="form-control" >
                        @error('ten_lop')
                        <span class="mess">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Teacher *</label>
                        <select name="tai_khoan_id" class="select2">
                            <option value="">----- Please Select Teachers -----</option>  
                            @foreach ($dsTeacher as $teacher)
                            
                                <option value="{{$teacher->username}}">{{$teacher->ho_ten}}</option>
                            @endforeach
                        </select>  
                        @error('tai_khoan_id')
                        <span class="mess">{{$message}}</span>
                        @enderror   
                    </div>  
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Discription</label>
                        <input type="text" name="mo_ta" placeholder="Discription" class="form-control" >
                        @error('mo_ta')
                        <span class="mess">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label for="favcolor">Select class color:</label>
                        <input type="color" id="favcolor" name="mau_sac" value="#ff0000" class="form-control">
                        @error('mo_ta')
                        <span class="mess">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-12 form-group mg-t-30">
                        <label class="text-dark-medium">Upload Banner Photo (150px X 150px)</label>
                        <input type="file" name="banner" class="form-control-file" >
                        @error('banner')
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