<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use \igaster\TranslateEloquent\TranslationTrait;

class Category extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'meal_id'
    ];
    protected $table='category';

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
