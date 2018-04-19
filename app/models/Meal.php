<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model
{
    use softDeletes;

    protected $table='jela';

    #relationships 
    
    protected $dates = ['deleted_at'];
    
    public $timestamps=false;
    
    public function category()
    {
        return $this->hasOne('App\models\Category','meal_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\models\Tag','jelo_tag','jelo_id','tag_id');
    }

    public function ingredients()
    {
        return $this->belongsToMany('App\models\Ingredient','jelo_ingredient','jelo_id','ingredient_id');
    }
}
