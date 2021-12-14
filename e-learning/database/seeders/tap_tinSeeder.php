<?php

namespace Database\Seeders;

use App\Models\TapTin;
use Illuminate\Database\Seeder;

class tap_tinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $TapTin_1 = new TapTin();
        $TapTin_1->duong_dan = 'https://s.memehay.com/files/posts/20210515/toan-bo-loi-ran-day-cua-huan-hoa-hong-huan-rose.jpg';
        $TapTin_1->trang_thai = true;
        $TapTin_1->save();

        $TapTin_2 = new TapTin();
        $TapTin_2->duong_dan = 'https://memehay.com/meme/20211015/ban-qua-hu-ban-se-bi-dam-daddy-phat.jpg';
        $TapTin_2->trang_thai = true;
        $TapTin_2->save();
    }
}
