<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GiangVien;
use App\Models\Khoa;
use Illuminate\Support\Str;
class GiangVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dsKhoa = Khoa::all();
        foreach($dsKhoa as $khoa){
            for($i=1;$i<10;$i++){
                $giangvien = new GiangVien();
                $giangvien->ho_ten = Str::random(10);
                $giangvien->ten_dang_nhap = "Giang vien {$i}";
                $giangvien->mat_khau = Str::random(10);
                $giangvien->email = Str::random(6)."@gmail.com";
                $giangvien->idkhoa = $khoa->id;
                $giangvien->save();
            }

        }
    }
}
