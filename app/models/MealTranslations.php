<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class MealTranslations extends Model
{
    protected $table = 'meal_translations';

    protected $hidden = ['language_id', 'meal_id', 'category_id'];
  
    public function category()
    {
        return $this->hasOne('App\models\Category', 'id', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\models\Tag','jelo_tag','jelo_id','tag_id');
    }
    public function jelo_tag()
    {
        return $this->hasMany('App\models\JeloTag', 'jelo_id', 'meal_id');
    }

    public function ingredients()
    {
        return $this->belongsToMany('App\models\Ingredient','jelo_ingredient','jelo_id','ingredient_id');
    }
    public function jelo_ingredient()
    {
        return $this->hasMany('App\models\JeloIngredient', 'jelo_id', 'meal_id' );
    }
}
