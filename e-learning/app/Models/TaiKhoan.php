<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class TaiKhoan extends Authenticatable
{
    use HasFactory;

    protected $table = 'tai_khoan';

    public function chiTietLop(){
        return $this->belongsToMany('App\Models\Lop','chi_tiet_lop','lop_id','tai_khoan_id','ma_lop','username');
    }
}
