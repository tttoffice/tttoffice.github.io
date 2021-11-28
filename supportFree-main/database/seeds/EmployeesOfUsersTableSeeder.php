<?php

use Illuminate\Database\Seeder;

class EmployeesOfUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees=[['emp1 ','emp1@app.com'],['emp2 ','emp2@app.com'],['emp3 ','emp3@app.com']];



        foreach ($employees as $employee) {
            $user=\App\User::create([
                "firstName"=>$employee[0],
                "lastName"=>"test",
                "email"=>$employee[1],
                "password"=> bcrypt("12345678"),
            ]);
            $user->attachRole('employee');
            $user->syncPermissions(['read_calls']);

        }
    }
}
