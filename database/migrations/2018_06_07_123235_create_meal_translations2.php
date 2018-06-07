<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealTranslations2 extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->integer('language_id');
            $table->integer('meal_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meal_translations');
    }
}
