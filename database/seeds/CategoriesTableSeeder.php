<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //membuat data bayangan untuk name dan slug
        //$categories = ['Framework', 'Code']; // ini tidak bisa bimasukan ke seeder karena bentuknya adalah sebuah arrat
        //jiak ingin memasukannya kedalam seeder kita harus membuatnya menjadi kolesi
        $categories = collect(['framework', 'code']);
        //masukan de database dengan command  php artisan db:seed --class=CategoriesTableSeeder dan nama class seedernya
        $categories->each(function ($c) { //bisa juga menggunakan foreach tapi disini menggunakan each() function dari laravel
            \App\Category::create([
                'name' => $c,
                'slug' => \Str::slug($c)
            ]);
        });
    }
}
