<?php

use Illuminate\Database\Seeder;

class PostCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_categories')->insert([
        	[
	            'category_name' => 'Chuyên Mục 1',
	            'category_slug' => 'chuyen-muc-1',
                'parent_id' => 0,
	            'category_seo_title' => 'Chuyên Mục 1',
	            'category_seo_description' => 'Day la Chuyên Mục 1',
        	],
        	[
	            'category_name' => 'Chuyên Mục 2',
	            'category_slug' => 'chuyen-muc-2',
                'parent_id' => 0,
	            'category_seo_title' => 'Chuyên Mục 2',
	            'category_seo_description' => 'Day la Chuyên Mục 2',
        	],
        ]);
    }
}
