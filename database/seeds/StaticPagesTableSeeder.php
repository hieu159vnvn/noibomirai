<?php

use Illuminate\Database\Seeder;

class StaticPagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('static_pages')->insert([
        	[
	            'name' => 'Home Page',
                'content' => '',
        	],
            [
                'name' => 'About Us',
                'content' => '',
            ],
            [
                'name' => 'Contact Us',
                'content' => '',
            ],
            [
                'name' => 'Sản Phẩm',
                'content' => '',
            ],
            [
                'name' => 'Tuyển Dụng',
                'content' => '',
            ],
        ]);
    }
}
