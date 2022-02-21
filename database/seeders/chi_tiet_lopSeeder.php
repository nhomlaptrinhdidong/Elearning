<?php

namespace Database\Seeders;

use App\Models\ChiTietLop;
use App\Models\TaiKhoan;
use Illuminate\Database\Seeder;

class chi_tiet_lopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $taikhoan = TaiKhoan::all();
        // foreach($taikhoan as $tk){
        //     $ChiTietLop_php = new ChiTietLop();
        //     $ChiTietLop_php->lop_id = 'fdyVC';
        //     $ChiTietLop_php->tai_khoan_id = $tk->username;
        //     $ChiTietLop_php->cach_tham_gia = 1;
        //     $ChiTietLop_php->trang_thai = true;
        //     $ChiTietLop_php->save();
        // }
        foreach($taikhoan as $tk){
            $ChiTietLop_php = new ChiTietLop();
            $ChiTietLop_php->lop_id = 'gNN9V';
            $ChiTietLop_php->tai_khoan_id = $tk->username;
            $ChiTietLop_php->cach_tham_gia = 1;
            $ChiTietLop_php->trang_thai = true;
            $ChiTietLop_php->save();
        }
        
    }
}
