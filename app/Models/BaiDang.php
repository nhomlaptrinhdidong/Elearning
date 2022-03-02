<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiDang extends Model
{
    use HasFactory;

    protected $table = 'bai_dang';

    public function dsBinhLuan(){
        return $this->hasMany('App\Models\BinhLuan');
    }
}
