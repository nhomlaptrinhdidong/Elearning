<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\BinhLuan;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    function postComment (Request $req,$ma_lop,$id_bai_dang){
        $comment = new BinhLuan;
        // dd($req);
        $comment->noi_dung = $req->binh_luan;
        $comment->tap_tin_id = 0;
        $comment->ngay_dang = date(now());
        $comment->bai_dang_id = $id_bai_dang;
        $comment->ma_tai_khoan = Auth::id();
        $comment->trang_thai = 1;
        
        $comment->save();

        $nguoidung=Auth::user();
        if($nguoidung->loai_tai_khoan_id==2)
            {
                return redirect()->route('classroom-teacher-detail',['ma_lop'=>$ma_lop]);
            }
        if($nguoidung->loai_tai_khoan_id==3)
            {
                return redirect()->route('classroom-student-detail',['ma_lop'=>$ma_lop]);
            }
       
        
    }
}
