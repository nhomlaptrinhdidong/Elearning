<?php

namespace Database\Seeders;

use App\Models\BaiDang;
use Illuminate\Database\Seeder;

class bai_dangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $BaiDang_1 = new BaiDang();
            $BaiDang_1->loai_bai_dang_id = 1;
            $BaiDang_1->ma_lop = 1;
            $BaiDang_1->tieu_de = 'Bài Tập PHP';
            $BaiDang_1->noi_dung = 'thực hành migration';
            $BaiDang_1->tap_tin_id = 2;
            $BaiDang_1->ngay_dang = '2021-12-13';
            $BaiDang_1->ngay_nop = '2021-12-14';
            $BaiDang_1->trang_thai = 1;
            $BaiDang_1->save();

            $BaiDang_2 = new BaiDang();
            $BaiDang_2->loai_bai_dang_id = 2;
            $BaiDang_2->ma_lop = 2;
            $BaiDang_2->tieu_de = 'Kiểm Tra LTDĐ';
            $BaiDang_2->noi_dung = 'Firebase';
            $BaiDang_2->tap_tin_id = 1;
            $BaiDang_2->ngay_dang = '2021-12-15';
            $BaiDang_2->ngay_nop = '2021-12-16';
            $BaiDang_2->trang_thai = 1;
            $BaiDang_2->save();
    }
}
