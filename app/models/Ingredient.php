<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use \igaster\TranslateEloquent\TranslationTrait;

class Ingredient extends Model
{
    protected $fillable = [
        'title',
        'slug',
    ];
    protected $table='ingredients';

    public function ingredients()
    {
        return $this->belongsTo('App\Ingredient');
    }
}
