<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lop extends Model
{
    use HasFactory;

    protected $table = 'lop';

    public function chiTietLop()
    {
        return $this->belongsToMany('App\Models\TaiKhoan', 'chi_tiet_lop', 'lop_id', 'tai_khoan_id', 'ma_lop', 'username')->withPivot('lop_id', 'tai_khoan_id', 'cach_tham_gia', 'trang_thai');
    }
}
