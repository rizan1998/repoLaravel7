<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RefreshDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this is cutom command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->line('the command has been run!');

        $this->call('migrate:refresh');
        ///migrate refresh ini adalah command bawaan laravel
        //dengan menulisnya disini itu berarti jika kita menjalankan php artisan refresh:database
        //maka migrate:refresh ini akan langsung jalan


        //sintak seed bisa di tempel disini
        //dibawah adalah sintak untuk menambah data ke dalam table category
        $categories = collect(['framework', 'code']);
        $categories->each(function ($c) {
            \App\Category::create([
                'name' => $c,
                'slug' => \Str::slug($c)
            ]);
        });

        //dibawah adalah sintak untuk menambah data ke dalam table tag
        $tag = collect(['Laravel', 'Fondation', 'Slim', 'Bug', 'Help']);
        $tag->each(function ($c) {
            \App\Tag::create([  //ini terhubung ke model tag
                'name' => $c,
                'slug' => \Str::slug($c)
            ]);
        });

        $this->call('db:seed');
        $this->info('lets rock n roll');

        //jika tidak suka cara seperti ini bisa juga panggil seednya dimana di database seed sudah dibuatkan
        //atau sudah di require dari seed yang lain jadi cukup dipanggil disini 1x saja tapi di database seednya dikumupulkan
        //semuanya
        //$this->call('db:seed');
    }
}
