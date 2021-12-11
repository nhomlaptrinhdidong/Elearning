<?php

namespace Database\Seeders;

use App\Models\GiaoVien;
use Illuminate\Database\Seeder;

class giao_vienSeeder extends Seeder
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
            $dsAdmin = new GiaoVien();
            $dsAdmin->ten_dang_nhap = "giaovien{$a}";
            $dsAdmin->ho_ten = "Teacher{$a}";
            $dsAdmin->sdt = "000000000{$a}";
            $dsAdmin->email = "giaovien{$a}@gmail.com";
            $dsAdmin->hinh_anh = "{$a}.jpg";
            $dsAdmin->dia_chi = "dia_chi_giaovien_{$a}";
            $dsAdmin->gioi_tinh = 1;
            $dsAdmin->trang_thai = true;
            $dsAdmin->save();
        }
    }
}
