<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $string='-IngTran'; 
        for ($i=11; $i<=15; $i++)
        {
            DB::table('ingredient_translations')->insert([
                'id' => $i,
                'title' => 'IngTranFra'.($i-10),
                'slug' => str_slug(str_random(5), '').$string,
                'language_id' => 2,
                'ingredient_id' => rand(1, 5),
            ]);
        }
    }
}
