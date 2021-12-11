<?php

namespace Database\Seeders;

use App\admin as AppAdmin;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($a = 1; $a <= 10; $a++)
        {
            $dsAdmin = new Admin();
            $dsAdmin->ten_dang_nhap = "admin{$a}";
            $dsAdmin->ho_ten = "Administrator{$a}";
            $dsAdmin->sdt = "000000000{$a}";
            $dsAdmin->email = "admin{$a}@gmail.com";
            $dsAdmin->hinh_anh = "{$a}.jpg";
            $dsAdmin->dia_chi = "dia_chi_admin_{$a}";
            $dsAdmin->gioi_tinh = 1;
            $dsAdmin->trang_thai = true;
            $dsAdmin->save();
        }
        
    }
}
