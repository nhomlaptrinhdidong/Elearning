<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LoaiTaiKhoan;

class loai_tai_khoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            // $Admin = new LoaiTaiKhoan();
            // $Admin->ten_loai = "Admin";
            // $Admin->trang_thai = true;
            // $Admin->save();

            // $User = new LoaiTaiKhoan();
            // $User->ten_loai = "User";
            // $User->trang_thai = true;
            // $User->save();
            $User = new LoaiTaiKhoan();
            $User->ten_loai = "Student";
            $User->trang_thai = true;
            $User->save();
    }
}
