<?php

use Illuminate\Database\Seeder;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->insert([
        	[
	            'product_category_name' => 'Product Category 1',
	            'product_category_slug' => 'product-category-1',
	            'product_category_price' => 120000,
                'parent_id' => 0,
	            'product_category_seo_title' => 'Product Category 1',
	            'product_category_seo_description' => 'Day la Product Category 1',
        	],
        	[
	            'product_category_name' => 'Product Category 2',
	            'product_category_slug' => 'product-category-2',
	            'product_category_price' => 130000,
                'parent_id' => 0,
	            'product_category_seo_title' => 'Product Category 2',
	            'product_category_seo_description' => 'Day la Product Category 2',
        	],
        	[
	            'product_category_name' => 'Product Category 3',
	            'product_category_slug' => 'product-category-3',
	            'product_category_price' => 100000,
                'parent_id' => 1,
	            'product_category_seo_title' => 'Product Category 3',
	            'product_category_seo_description' => 'Day la Product Category 3',
        	],
        ]);
    }
}
