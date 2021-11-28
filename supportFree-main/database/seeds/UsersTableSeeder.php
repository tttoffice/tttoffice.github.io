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
        $user=\App\User::create([
            "firstName"=>"Khaled",
            "lastName"=>"Ghonaim",
            "email"=> "khaled.ghonaim@app.com",
            "password"=> bcrypt("12345678"),
        ]);

        $user->attachRole('super_admin');


    }
}
