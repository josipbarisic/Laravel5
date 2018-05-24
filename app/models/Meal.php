<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model
{
    use softDeletes;

    protected $table = 'jela';
    protected $dates = ['deleted_at'];
    
    public $timestamps = true;

    public $hidden = ['category_id', 'deleted_at']; 

    #relationships 
    
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
        return $this->hasMany('App\models\JeloTag', 'jelo_id', 'id');
    }

    public function ingredients()
    {
        return $this->belongsToMany('App\models\Ingredient','jelo_ingredient','jelo_id','ingredient_id');
    }
    public function jelo_ingredient()
    {
        return $this->hasMany('App\models\JeloIngredient', 'jelo_id', 'id' );
    }

    public function meal_translations()
    {
        return $this->hasMany('App\models\MealTranslations', 'meal_id', 'id' );
    }
}
