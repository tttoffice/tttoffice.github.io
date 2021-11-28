<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBiginteger('branch_id')->nullable();
            $table->unsignedBiginteger('project_id')->nullable();

            $table->string('firstName');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->string('image')->default('default.png');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->nullable();
            $table->string('password');

            $table->string('locale', 5)->default('en');

            $table->rememberToken();
            $table->timestamps();


            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('project_id')->references('id')->on('projects');
        });

        DB::table('users')->insert([
            "firstName" => "super",
            "lastName" => "admin",
            "email" => "super_admin@app.com",
            "password" => bcrypt("12345678"),

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
