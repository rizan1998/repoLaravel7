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
        //make seed for user
        \App\User::create([
            'name' => 'Muhamad Rijan Alpalah',
            'username' => 'rizan1998',
            'password' => bcrypt('password'), //bcrypt adalah funciton hash dilaravel
            'email' => 'rizanalfalah@gmail.com'
        ]);
    }
}
