<?php

namespace Database\Seeders;

use App\Models\LoaiTaiKhoan;
use App\Models\TaiKhoan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class tai_khoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dsLoaiTaiKhoan=LoaiTaiKhoan::all();
        foreach($dsLoaiTaiKhoan as $LoaiTaiKhoan)
        {
            $TaiKhoan = new TaiKhoan();
            $TaiKhoan->username = "user {$LoaiTaiKhoan->id}";
            $TaiKhoan->ho_ten = 'ten_user1';
            $TaiKhoan->sdt = '0000000001';
            $TaiKhoan->dia_chi = 'dia_chi_user1';
            $TaiKhoan->email = 'user1@gmail.com';
            $TaiKhoan->hinh_anh = '1.jpg';
            $TaiKhoan->gioi_tinh = 1;
            $TaiKhoan->token = 'token_user1';
            $TaiKhoan->password = Hash::make('123456');
            $TaiKhoan->loai_tai_khoan_id =$LoaiTaiKhoan->id;
            $TaiKhoan->trang_thai = true;
            $TaiKhoan->save();
        }
    }
}
