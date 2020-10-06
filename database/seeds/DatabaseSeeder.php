<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        //contoh jika call atau require seed yg lain
        //$this->call(CategoriesTableSeed::class);
        //$this->call(TagTaleSeeder:class);
        $this->call(UsersTableSeeder::class);
    }
}
