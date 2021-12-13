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
            $Loaitk = new LoaiTaiKhoan();
            $Loaitk->ten_loai = "Admin";
            $Loaitk->trang_thai = true; 
            
            $Loaitk->save();
    }
}
