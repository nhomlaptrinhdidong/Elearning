<?php

namespace Database\Seeders;

use App\Models\LoaiTaiKhoan;
use App\Models\TaiKhoan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class tai_khoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $TaiKhoan_1 = new TaiKhoan();
            $TaiKhoan_1->username = 'admin';
            $TaiKhoan_1->ho_ten = 'Nguyễn Văn Admin';
            $TaiKhoan_1->sdt = '0389654877';
            $TaiKhoan_1->dia_chi = 'Cầu Giấy, Hà Nội';
            $TaiKhoan_1->email = 'admin@gmail.com';
            $TaiKhoan_1->hinh_anh = 'admin.jpg';
            $TaiKhoan_1->ngay_sinh = '1991-01-01';
            $TaiKhoan_1->gioi_tinh = 1;
            $TaiKhoan_1->token = '';
            $TaiKhoan_1->password = 'admin'; //Str::random(10);
            $TaiKhoan_1->loai_tai_khoan_id = 1;
            $TaiKhoan_1->trang_thai = true;
            $TaiKhoan_1->save();

            $TaiKhoan_2 = new TaiKhoan();
            $TaiKhoan_2->username = 'vanhai';
            $TaiKhoan_2->ho_ten = 'Lê Văn Hải';
            $TaiKhoan_2->sdt = '0359654453';
            $TaiKhoan_2->dia_chi = 'Quận 1, HCM';
            $TaiKhoan_2->email = 'vanhai@gmail.com';
            $TaiKhoan_2->hinh_anh = 'levanhai.jpg';
            $TaiKhoan_2->ngay_sinh = '2002-02-02';
            $TaiKhoan_2->gioi_tinh = 1;
            $TaiKhoan_2->token = '';
            $TaiKhoan_2->password = 'levanhai'; //Str::random(10);
            $TaiKhoan_2->loai_tai_khoan_id = 2;
            $TaiKhoan_2->trang_thai = true;
            $TaiKhoan_2->save();

            $TaiKhoan_3 = new TaiKhoan();
            $TaiKhoan_3->username = 'vannam';
            $TaiKhoan_3->ho_ten = 'Đặng Văn Nam';
            $TaiKhoan_3->sdt = '0359699953';
            $TaiKhoan_3->dia_chi = 'Quận 10, HCM';
            $TaiKhoan_3->email = 'vannam@gmail.com';
            $TaiKhoan_3->hinh_anh = 'dangvannam.jpg';
            $TaiKhoan_3->ngay_sinh = '2001-10-10';
            $TaiKhoan_3->gioi_tinh = 1;
            $TaiKhoan_3->token = '';
            $TaiKhoan_3->password = 'dangvannam'; //Str::random(10);
            $TaiKhoan_3->loai_tai_khoan_id = 2;
            $TaiKhoan_3->trang_thai = true;
            $TaiKhoan_3->save();

            $TaiKhoan_4 = new TaiKhoan();
            $TaiKhoan_4->username = 'thanhtu';
            $TaiKhoan_4->ho_ten = 'Trần Thanh Tú';
            $TaiKhoan_4->sdt = '0359699953';
            $TaiKhoan_4->dia_chi = 'Quan 6, HCM';
            $TaiKhoan_4->email = 'thanhtu@gmail.com';
            $TaiKhoan_4->hinh_anh = 'tranthanhtu.jpg';
            $TaiKhoan_4->ngay_sinh = '2001-08-03';
            $TaiKhoan_4->gioi_tinh = 1;
            $TaiKhoan_4->token = '';
            $TaiKhoan_4->password = 'tranthanhtu'; //Str::random(10);
            $TaiKhoan_4->loai_tai_khoan_id = 2;
            $TaiKhoan_4->trang_thai = true;
            $TaiKhoan_4->save();

            $TaiKhoan_5 = new TaiKhoan();
            $TaiKhoan_5->username = 'yenlinh';
            $TaiKhoan_5->ho_ten = 'Nguyễn Yến Linh';
            $TaiKhoan_5->sdt = '0359699999';
            $TaiKhoan_5->dia_chi = 'Quan 10, HCM';
            $TaiKhoan_5->email = 'yenlinh@gmail.com';
            $TaiKhoan_5->hinh_anh = 'nguyenyenlinh.jpg';
            $TaiKhoan_5->ngay_sinh = '2001-12-10';
            $TaiKhoan_5->gioi_tinh = 2;
            $TaiKhoan_5->token = '';
            $TaiKhoan_5->password = 'nguyenyenlinh'; //Str::random(10);
            $TaiKhoan_5->loai_tai_khoan_id = 2;
            $TaiKhoan_5->trang_thai = true;
            $TaiKhoan_5->save();
    }
}
