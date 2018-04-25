<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use \igaster\TranslateEloquent\TranslationTrait;

use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
    ];
    protected $table='ingredients';

    protected $dates = ['deleted_at'];

    public function ingredients()
    {
        return $this->belongsTo('App\models\Ingredient');
    }
}
