<?php

use Illuminate\Database\Seeder;

class PostTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_tags')->insert([
        	[
	            'tag_name' => 'Tag 1',
	            'tag_slug' => 'tag-1',
	            'tag_seo_title' => 'tag 1',
	            'tag_seo_description' => 'Day la tag 1',
        	],
        	[
	            'tag_name' => 'Tag 2',
	            'tag_slug' => 'tag-2',
	            'tag_seo_title' => 'tag 2',
	            'tag_seo_description' => 'Day la tag 2',
        	],
        ]);
    }
}
