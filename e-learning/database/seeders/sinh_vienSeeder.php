<?php

namespace Database\Seeders;

use App\Models\SinhVien;
use Illuminate\Database\Seeder;

class sinh_vienSeeder extends Seeder
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
            $dsAdmin = new SinhVien();
            $dsAdmin->ten_dang_nhap = "sinhvien{$a}";
            $dsAdmin->ho_ten = "Student{$a}";
            $dsAdmin->sdt = "000000000{$a}";
            $dsAdmin->email = "student{$a}@gmail.com";
            $dsAdmin->hinh_anh = "{$a}.jpg";
            $dsAdmin->dia_chi = "dia_chi_student_{$a}";
            $dsAdmin->gioi_tinh = 1;
            $dsAdmin->trang_thai = true;
            $dsAdmin->save();
        }
    }
}
