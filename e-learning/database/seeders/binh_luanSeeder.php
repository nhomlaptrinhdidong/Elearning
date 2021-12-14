<?php

namespace Database\Seeders;

use App\Models\BinhLuan;
use Illuminate\Database\Seeder;

class binh_luanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $BinhLuan_1 = new BinhLuan();
        $BinhLuan_1->noi_dung = 'Cho thêm thời gian đi Thầy, còn nhiều môn lắm ạ';
        $BinhLuan_1->tap_tin_id = 1;
        $BinhLuan_1->ngay_dang = '2021-12-13';
        $BinhLuan_1->bai_dang_id = 1;
        $BinhLuan_1->ma_tai_khoan = 2;
        $BinhLuan_1->trang_thai = true;
        $BinhLuan_1->save();

        $BinhLuan_2 = new BinhLuan();
        $BinhLuan_2->noi_dung = 'Em xin nộp muộn, em vừa bị Co-Visk ạ';
        $BinhLuan_2->tap_tin_id = 1;
        $BinhLuan_2->ngay_dang = '2021-12-13';
        $BinhLuan_2->bai_dang_id = 1;
        $BinhLuan_2->ma_tai_khoan = 3;
        $BinhLuan_2->trang_thai = true;
        $BinhLuan_2->save();

        $BinhLuan_3 = new BinhLuan();
        $BinhLuan_3->noi_dung = 'U là chời';
        $BinhLuan_3->tap_tin_id = 1;
        $BinhLuan_3->ngay_dang = '2021-12-15';
        $BinhLuan_3->bai_dang_id = 2;
        $BinhLuan_3->ma_tai_khoan = 4;
        $BinhLuan_3->trang_thai = true;
        $BinhLuan_3->save();

        $BinhLuan_4 = new BinhLuan();
        $BinhLuan_4->noi_dung = 'Ối dồi ôi';
        $BinhLuan_4->tap_tin_id = 1;
        $BinhLuan_4->ngay_dang = '2021-12-15';
        $BinhLuan_4->bai_dang_id = 2;
        $BinhLuan_4->ma_tai_khoan = 5;
        $BinhLuan_4->trang_thai = true;
        $BinhLuan_4->save();
    }
}
