<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JeloidTagidUnique extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jelo_ingredient', function (Blueprint $table) {
            $table->unique([
                'jelo_id',
                'ingredient_id'
            ]);
        });
        Schema::table('jelo_tag', function (Blueprint $table) {
            $table->unique([
                'jelo_id',
                'tag_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
