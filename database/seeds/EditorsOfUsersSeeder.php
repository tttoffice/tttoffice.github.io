<?php

use Illuminate\Database\Seeder;

class EditorsOfUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $editors=[['editor1 ','editor1@app.com'],['editor2 ','editor2@app.com'],['editor3 ','editor3@app.com']];



        foreach ($editors as $editor) {
            $user=\App\User::create([
                "firstName"=>$editor[0],
                "lastName"=>"test",
                "email"=>$editor[1],
                "password"=> bcrypt("12345678"),
            ]);
            $user->attachRole('editor');
            $user->syncPermissions(['read_employees']);

        }
    }
}
