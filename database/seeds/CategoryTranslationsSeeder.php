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
        for ($i=1; $i<=15; $i++)
        {
            $randtime[$i] = rand(1525962167, 1526962167);
            $time = Carbon::createFromTimestamp($randtime[i])->format('Y-m-d');
            
            DB::table('meal_translations')->where('id', $i)->insert([
                'created_at' => $time,

            ]);
        }
    }
}
