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
    protected $table = 'ingredients';

    protected $dates = ['deleted_at'];

    public $hidden = ['created_at', 'updated_at', 'deleted_at', 'pivot']; 

    public function ingredients()
    {
        return $this->belongsTo('App\models\Ingredient');
    }

    public function ingredient_translations()
    {
        return $this->hasMany('App\models\IngredientTranslations', 'ingredient_id', 'id' );
    }
}
