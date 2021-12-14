<?php

namespace Database\Seeders;

use App\Models\Lop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class lopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Lop_php = new Lop();
        $Lop_php->ma_lop = Str::random(5);
        $Lop_php->ten_lop = 'PHP Nâng Cao';
        $Lop_php->mau_sac = '10ffcb';
        $Lop_php->banner = '';
        $Lop_php->mo_ta = 'Php nâng cao TH + TL';
        $Lop_php->trang_thai = true;
        $Lop_php->save();

        $Lop_ltdd = new Lop();
        $Lop_ltdd->ma_lop = Str::random(5);
        $Lop_ltdd->ten_lop = 'Lập Trình Di Động';
        $Lop_ltdd->mau_sac = 'b6dcfe';
        $Lop_ltdd->banner = '';
        $Lop_ltdd->mo_ta = 'Quên lối về';
        $Lop_ltdd->trang_thai = true;
        $Lop_ltdd->save();

        $Lop_ktpm = new Lop();
        $Lop_ktpm->ma_lop = Str::random(5);
        $Lop_ktpm->ten_lop = 'Kiểm Thử Phần Mềm';
        $Lop_ktpm->mau_sac = '02f0b8';
        $Lop_ktpm->banner = '';
        $Lop_ktpm->mo_ta = 'Tìm hiểu về test case, test tool';
        $Lop_ktpm->trang_thai = true;
        $Lop_ktpm->save();

        $Lop_asp = new Lop();
        $Lop_asp->ma_lop = Str::random(5);
        $Lop_asp->ten_lop = 'Lập trình thiết kế Web với ASP.NET Core';
        $Lop_asp->mau_sac = 'ff00c0';
        $Lop_asp->banner = '';
        $Lop_asp->mo_ta = 'LinQ';
        $Lop_asp->trang_thai = true;
        $Lop_asp->save();

        $Lop_cckt = new Lop();
        $Lop_cckt->ma_lop = Str::random(5);
        $Lop_cckt->ten_lop = 'Công cụ kiểm thử';
        $Lop_cckt->mau_sac = 'd81159';
        $Lop_cckt->banner = '';
        $Lop_cckt->mo_ta = 'Tìm hiểu thêm về test tool';
        $Lop_cckt->trang_thai = true;
        $Lop_cckt->save();
    }
}
