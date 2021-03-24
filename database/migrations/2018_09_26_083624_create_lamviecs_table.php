<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLamviecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lamviecs', function (Blueprint $table) {
            $table->increments('id');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('hocvien_id')->unsigned();
            $table->foreign('hocvien_id')->references('id')->on('hoso_hocviens')->onDelete('cascade')->onUpdate('cascade');
            $table->string('thoigianbd');
            $table->string('thoigiankt');
            $table->string('tencongty');
            $table->string('congviec');
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
        Schema::dropIfExists('lamviecs');
    }
}
