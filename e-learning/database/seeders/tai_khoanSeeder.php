<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\GiaoVien;
use App\Models\SinhVien;
use App\Models\TaiKhoan;
use Illuminate\Database\Seeder;
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
        $dsSinhVien=SinhVien::all();
        foreach($dsSinhVien as $SinhVien)
        {
            $TaiKhoan = new TaiKhoan();
            $TaiKhoan->password = Str::random(10);
            $TaiKhoan->tai_khoan_id = $SinhVien->ten_dang_nhap;
            $TaiKhoan->loai_tai_khoan = 3;
            $TaiKhoan->trang_thai = true;
            $TaiKhoan->save();
        }

        $dsGiaoVien=GiaoVien::all();
        foreach($dsGiaoVien as $GiaoVien)
        {
            $TaiKhoan = new TaiKhoan();
            $TaiKhoan->password = Str::random(10);
            $TaiKhoan->tai_khoan_id = $GiaoVien->ten_dang_nhap;
            $TaiKhoan->loai_tai_khoan = 2;
            $TaiKhoan->trang_thai = true;
            $TaiKhoan->save();
        }

        $dsAdmin=Admin::all();
        foreach($dsAdmin as $Admin)
        {
            $TaiKhoan = new TaiKhoan();
            $TaiKhoan->password = Str::random(10);
            $TaiKhoan->tai_khoan_id = $Admin->ten_dang_nhap;
            $TaiKhoan->loai_tai_khoan = 1;
            $TaiKhoan->trang_thai = true;
            $TaiKhoan->save();
        }
    }
}
