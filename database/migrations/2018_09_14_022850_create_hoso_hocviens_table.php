<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHosoHocviensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoso_hocviens', function (Blueprint $table) {
            $table->increments('id');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->string('hinhanh');
            $table->string('hoten');
            $table->date('ngaysinh');
            $table->boolean('gioitinh');
            $table->string('honnhan');
            $table->string('benhan');
            $table->string('noisinh');
            $table->string('tuoi');
            $table->string('tongiao');
            $table->string('mien');
            $table->string('dienthoai');
            $table->string('dtnguoithan');
            $table->boolean('congviec');
            $table->boolean('keo');
            $table->boolean('dua');
            $table->boolean('viet');
            $table->string('chieucao');
            $table->string('cannang');
            $table->string('nhommau');
            $table->string('mattrai');
            $table->string('matphai');
            $table->string('diachi');
            $table->boolean('anhngu');
            $table->boolean('nhatngu');
            $table->string('ngoaingukhac');
            $table->boolean('datungtoinhat');
            $table->boolean('conguoithantainhat');
            $table->text('mucdich');
            $table->string('sotientrenthang');
            $table->string('sotientrennam');
            $table->text('muctieu');
            $table->integer('banglai');
            $table->integer('loaixe');
            $table->text('sothich');
            $table->text('diemmanh');
            $table->date('ngaydangky');
            $table->text('nguoiphutrach');
            $table->text('nguoigioithieu');
            $table->timestamps();
        });
        // $from = "hosohocvien";
        // $to = "hoso_hocviens";
        // Schema::rename($from, $to);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hoso_hocviens');
    }
}
