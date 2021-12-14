<?php

namespace Database\Seeders;

use App\Models\LoaiBaiDang;
use Illuminate\Database\Seeder;

class loai_bai_dangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $LoaiBaiDang_1_BaiTap = new LoaiBaiDang();
        $LoaiBaiDang_1_BaiTap->ten = 'Bài Tập';
        $LoaiBaiDang_1_BaiTap->trang_thai = true;
        $LoaiBaiDang_1_BaiTap->save();

        $LoaiBaiDang_1_KiemTra = new LoaiBaiDang();
        $LoaiBaiDang_1_KiemTra->ten = 'Kiểm Tra';
        $LoaiBaiDang_1_KiemTra->trang_thai = true;
        $LoaiBaiDang_1_KiemTra->save();

        $LoaiBaiDang_1_TaiLieu = new LoaiBaiDang();
        $LoaiBaiDang_1_TaiLieu->ten = 'Tài Liệu';
        $LoaiBaiDang_1_TaiLieu->trang_thai = true;
        $LoaiBaiDang_1_TaiLieu->save();
    }
}
