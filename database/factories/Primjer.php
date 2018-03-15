<?php

$factory->define(App\Faktori::class, function (Faker\Generator $faker) 
	{
    return 
    	[
       		'title'=> $faker->title,
        	'slug'=> str_random(10),
    	];
	}
);


