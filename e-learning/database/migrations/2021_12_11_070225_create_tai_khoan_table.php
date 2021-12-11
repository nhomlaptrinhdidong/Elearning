<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaiKhoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tai_khoan', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('ho_ten');
            $table->string('sdt');
            $table->string('dia_chi');
            $table->string('email');
            $table->string('hinh_anh');
            $table->integer('gioi_tinh');
            $table->string('token');
            $table->string('password');
            $table->string('loai_tai_khoan_id');
            $table->boolean('trang_thai');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tai_khoan');
    }
}
