<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jelo_Ingredient extends Model
{

    protected $fillable = [
        'jelo_id',
        'ingredient_id',
    ];
    protected $table='jelo_ingredient';


    public function jelo_ing()
    {
        return $this->belongsTo('App\models\Meal');
    }
}
