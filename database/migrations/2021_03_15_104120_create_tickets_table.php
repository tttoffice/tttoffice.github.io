<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            $table->unsignedBiginteger('user_id');//employee_id
            $table->unsignedBiginteger('module_id');
            $table->unsignedBiginteger('branch_id');
            $table->unsignedBiginteger('project_id');
            $table->unsignedBiginteger('closedBy_id')->nullable();//supporter_id


            $table->string('title');
            $table->text('description');
            $table->enum('priority',['high','medium','low']);

            $table->string('reference_call')->nullable();

            $table->enum('status',['logged','withSupport','withCustomer','drop','solved']);


            $table->boolean('is_logged')->default('1');//logged
            $table->boolean('is_pending')->default('0');//withSupport or withCustomer
            $table->boolean('is_solved')->default('0');//solved (closed)

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('project_id')->references('id')->on('projects');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
