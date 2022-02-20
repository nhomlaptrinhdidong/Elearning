<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\BinhLuan;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    function postComment (Request $req){
        $comment = new BinhLuan;
        // dd($req);
        $comment->noi_dung = $req->binh_luan;
        $comment->tap_tin_id = 0;
        $comment->ngay_dang = date(now());
        $comment->bai_dang_id = 0;
        $comment->ma_tai_khoan = Auth::id();
        $comment->trang_thai = 1;
        
        $comment->save();

        return redirect()->route('classroom-teacher-detail',['ma_lop'=>$req->ma_lop]);
    }
}
