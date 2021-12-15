<?php

namespace App\Http\Controllers;

use App\Models\ChiTietLop;
use App\Models\TaiKhoan;
use App\Models\Lop;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
       
        $dsLop = TaiKhoan::where(auth()->user()->usrename)->first();

        foreach($dsLop->dsLop as $chitiet){

                $aa = Lop::where('ma_lop', $chitiet->ma_lop)->first();
                
                $dschitiet[$aa->ma_lop]['ma_lop'] = $aa->ma_lop;
                $dschitiet[$aa->ma_lop]['ten_lop'] = $aa->ten_lop;
                $dschitiet[$aa->ma_lop]['banner'] = $aa->banner;
                $dschitiet[$aa->ma_lop]['mo_ta'] = $aa->mo_ta;

               foreach($aa->chiTietLop as $taikhoan){
                   if($taikhoan->loai_tai_khoan_id==2){
                       $dschitiet[$aa->ma_lop]['giao_vien']= $taikhoan->ho_ten;
                       $dschitiet[$aa->ma_lop]['hinh_anh_gv']= $taikhoan->hinh_anh;
                   }             
               }
            
        }
        return view('students/index', compact('dschitiet')) ;
    }
}
