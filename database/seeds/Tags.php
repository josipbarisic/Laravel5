<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class Tags extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create('App\Tags');
        $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));
        for($i=1;$i<=20;$i++)
        {
            DB::table('tags')->insert([
                'title'=>$faker->unique()->foodName(),
                'slug'=>$faker->unique()->slug,
                'updated_at'=> \Carbon\Carbon::now(),
                'created_at'=> \Carbon\Carbon::now(),
            ]);
        }
        
    }
}
