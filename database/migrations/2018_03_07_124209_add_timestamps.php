<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class AddTimestamps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Tags', function (Blueprint $table) {
             
            
        });

        Schema::table('Category', function (Blueprint $table) {
            $table->timestamps();
           
       });

       Schema::table('Ingredients', function (Blueprint $table) {
       
   });
 

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Category');
    }
}
