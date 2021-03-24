<?php

use Illuminate\Database\Seeder;

class ProductTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_tags')->insert([
        	[
	            'tag_name' => 'Product Tag 1',
	            'tag_slug' => 'product-tag-1',
	            'tag_seo_title' => 'Product tag 1',
	            'tag_seo_description' => 'Day la Product tag 1',
        	],
        	[
	            'tag_name' => 'Product Tag 2',
	            'tag_slug' => 'product-tag-2',
	            'tag_seo_title' => 'Product tag 2',
	            'tag_seo_description' => 'Day la Product tag 2',
        	],
        ]);
    }
}
