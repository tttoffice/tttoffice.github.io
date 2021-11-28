<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBiginteger('module_id');
            $table->string('title');
            $table->text('content');

            $table->string('locale')->index();

            $table->unique(['module_id','locale']);

            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_translations');
    }
}
