<?php

use Illuminate\Database\Seeder;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert([
        	[
	            'name' => 'Header',
                'content' => '{"favicon":"","logo":"","quangcao":"","hotline1":"","hotline2":"","facebook":"","skype":"","youtube":"","linkedin":""}',
                'content1' => '{"pic1":"","pic2":"","pic3":"","pic4":"","pic5":"","pic6":"","pic7":"","pic8":""}',
        	],
            [
                'name' => 'Footer',
                'content' => '',
                'content2' => '{"video1":"","video2":"","video3":"","video4":"","video5":""}',
            ],
            [
                'name' => 'Code',
                'content' => '',
                'content1' => '',
            ],
        ]);
    }
}
