<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNhanviensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhanviens', function (Blueprint $table) {
            $table->increments('id');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->text('hinhanh')->nullable();            
            $table->text('hoten')->nullable();
            $table->boolean('gioitinh')->define(1);
            $table->date('namsinh')->nullable();
            $table->integer('chucvu')->nullable();
            $table->text('diachi')->nullable();
            $table->integer('tinhthanh');
            $table->string('sodienthoai',10);
            $table->text('trinhdo')->nullable();
            $table->text('chuyenmon')->nullable();
            $table->text('ngoaingu')->nullable();
            $table->text('kinhnghiem')->nullable();
            $table->text('ghichu')->nullable();
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
        Schema::dropIfExists('nhanviens');
    }
}
