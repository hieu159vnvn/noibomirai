<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->engine = 'InnoDB';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->string('post_title');
            $table->string('post_slug');
            $table->text('post_description')->nullable();
            $table->text('post_content')->nullable();
            $table->string('post_image')->nullable();
            $table->tinyInteger('post_status')->default(1);
            $table->string('post_seo_title')->nullable()->default("");
            $table->string('post_seo_description')->nullable()->default("");
            $table->string('h1_tag')->nullable()->default("");
            $table->text('h2_tag')->nullable();
            $table->text('h3_tag')->nullable();
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('post_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('posts');
    }
}
