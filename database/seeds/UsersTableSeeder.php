<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	[
	            'username' => 'admin',
	            'name' => 'Admin',
	            'email' => 'admin@gmail.com',
	            'password' => bcrypt('secret'),
                'level' => 1,
        	],
        	[
	            'username' => 'user1',
	            'name' => 'User 1',
	            'email' => 'user1@gmail.com',
	            'password' => bcrypt('secret'),
                'level' => 2,
        	],
        ]);
    }
}
