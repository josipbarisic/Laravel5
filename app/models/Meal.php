<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $table='jela';

    #relationships 
    
    /**
     * Get the phone record associated with the category.
     */
    public function category()
    {
        return $this->hasOne('App\models\Category','meal_id');
    }

    /**
     * The roles that belong to the tags.
     */
    public function tags()
    {
        return $this->belongsToMany('App\models\Tag','jelo_tag','jelo_id','tag_id');
    }

    public function ingredients()
    {
        return $this->belongsToMany('App\models\Ingredient','jelo_ingredient','jelo_id','ingredient_id');
    }
}
