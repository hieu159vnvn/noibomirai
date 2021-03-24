<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->string('product_title');
            $table->string('product_slug');
            $table->string('masanpham')->nullable()->default("");
            $table->string('nhasanxuat')->nullable()->default("");
            $table->integer('product_old_price')->nullable()->default(0);
            $table->integer('product_new_price')->nullable()->default(0);
            $table->text('product_description')->nullable();
            $table->text('product_content')->nullable();
            $table->string('product_feature_image')->nullable();
            $table->tinyInteger('product_status')->default(1);
            $table->tinyInteger('product_noibat')->default(0);
            $table->tinyInteger('product_banchay')->default(0);
            $table->integer('product_view')->default(0);
            $table->integer('stt')->default(1);
            $table->string('xuatxu')->nullable()->default("");
            $table->string('baohanh')->nullable()->default("");
            $table->string('product_seo_title')->nullable()->default("");
            $table->string('product_seo_description')->nullable()->default("");
            $table->string('h1_tag')->nullable()->default("");
            $table->text('h2_tag')->nullable();
            $table->text('h3_tag')->nullable();
            $table->integer('product_category_id')->unsigned();
            $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('user_id')->unsigned()->default(1);
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
        Schema::dropIfExists('products');
    }
}
