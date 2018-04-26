<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = factory(Category::class, 5)->create();
    }
}
