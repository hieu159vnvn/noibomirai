<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        	UsersTableSeeder::class,
        	PostTagsTableSeeder::class,
            PostCategoriesTableSeeder::class,
            MenusTableSeeder::class,
            ProductCategoriesTableSeeder::class,
            ProductTagsTableSeeder::class,
            ContactsTableSeeder::class,
            ConfigsTableSeeder::class,
            StaticPagesTableSeeder::class,
        ]);
    }
}
