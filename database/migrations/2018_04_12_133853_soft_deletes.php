<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SoftDeletes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('ingredients', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::dropIfExists('ingredients', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::dropIfExists('tags', function (Blueprint $table) {
            $table->softDeletes();
        });
    }
}
