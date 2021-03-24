<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiadinhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giadinhs', function (Blueprint $table) {
            $table->increments('id');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('hocvien_id')->unsigned();
            $table->foreign('hocvien_id')->references('id')->on('hoso_hocviens')->onDelete('cascade')->onUpdate('cascade');
            $table->string('quanhe');
            $table->string('hoten');
            $table->string('namsinh');
            $table->string('congviec');
            $table->string('noilamviec');
            $table->string('luong');
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
        Schema::dropIfExists('giadinhs');
    }
}
