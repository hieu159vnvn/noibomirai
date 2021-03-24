<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->string('name')->nullable()->default('');
            $table->string('title')->nullable()->default('');
            $table->text('content')->nullable();
            $table->text('content_1')->nullable();
            $table->text('content_2')->nullable();
            $table->text('content_3')->nullable();
            $table->text('content_4')->nullable();
            $table->text('content_5')->nullable();
            $table->string('h1_tag')->nullable()->default("");
            $table->text('h2_tag')->nullable();
            $table->text('h3_tag')->nullable();
            $table->string('seo_title')->nullable()->default("");
            $table->string('seo_description')->nullable()->default("");
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
        Schema::dropIfExists('static_pages');
    }
}
