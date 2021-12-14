<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBinhLuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binh_luan', function (Blueprint $table) {
            $table->id();
            $table->string('noi_dung')->require;
            $table->integer('tap_tin_id');
            $table->date('ngay_dang');
            $table->integer('bai_dang_id');
            $table->string('ma_tai_khoan');
            $table->boolean('trang_thai');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('binh_luan');
    }
}
