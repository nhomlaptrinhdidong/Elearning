<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    use HasFactory;

    protected $table = 'binh_luan';

    public function baiDang(){
        return $this->belongsTo('App\Models\BaiDang');
    }
    public function taiKhoan(){
        return $this->belongsTo('App\Models\TaiKhoan','ma_tai_khoan');
    }
}
