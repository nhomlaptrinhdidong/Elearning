<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TaiKhoan extends Authenticatable
{
    use HasFactory;

    protected $table = 'tai_khoan';
    protected $fillable = [
        'name', 'email', 'password', 'provider', 'provider_id'
    ];

    public function dsLop()
    {
        return $this->belongsToMany('App\Models\Lop', 'chi_tiet_lop', 'tai_khoan_id', 'lop_id', 'username', 'ma_lop');
    }
}
