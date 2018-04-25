<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Languages extends Model
{
    protected $table='languages';

    public function category_translations()
    {
        return $this->belongsToMany('App\models\CategoryTranslations', 'category_translations', 'language_id', 'category_id');
    }

    public function ingredient_translations()
    {
        return $this->belongsToMany('App\models\IngredientTranslations','ingredient_translations', 'language_id', 'category_id');
    }

    public function tag_translations()
    {
        return $this->belongsToMany('App\models\TagTranslations', 'tag_translations', 'language_id', 'category_id');
    }

    public function meal_translations()
    {
        return $this->belongsToMany('App\models\MealTranslations', 'meal_translations', 'language_id', 'category_id');
    }

}
