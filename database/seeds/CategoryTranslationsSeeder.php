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
        $string='-TagTran'; 
            DB::table('tag_translations')->insert([
                'title' => 'TagTran1',
                'slug' => str_slug(str_random(5), '').$string,
                'language_id' => 1,
                'tag_id' => rand(1, 5),
            ]);

            DB::table('tag_translations')->insert([
                'title' => 'TagTran2',
                'slug' => str_slug(str_random(5), '').$string,
                'language_id' => 1,
                'tag_id' => rand(1, 5),
            ]);
    }
}
