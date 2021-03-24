<?php

use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->insert([
        	[
        		'source' => 'Trang liên hệ',
	            'full_name' => 'Anh Hưng',
	            'address' => '215 Lý Thường Kiệt, P.13, Q.10, TPHCM',
	            'telephone' => '0932 009 009',
	            'email' => 'hungpro@gmail.com',
	            'subject' => 'Anh thích thì anh liên hệ thôi',
	            'content' => 'Anh thích thì anh liên hệ thôi, có vấn đề gì không?',
	            'created_at' => new Datetime,
	            'updated_at' => new Datetime,
        	],
        	[
        		'source' => 'Trang giới thiệu',
	            'full_name' => 'Chị Phấn',
	            'address' => '215 Lý Thường Kiệt, P.13, Q.10, TPHCM',
	            'telephone' => '0932 999 999',
	            'email' => 'phanpro@gmail.com',
	            'subject' => 'Chị thích thì anh liên hệ thôi',
	            'content' => 'Chị thích thì anh liên hệ thôi, có vấn đề gì không?',
	            'created_at' => new Datetime,
	            'updated_at' => new Datetime,
        	],
        ]);
    }
}
