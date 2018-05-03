<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use \igaster\TranslateEloquent\TranslationTrait;
use App\models\CategoryTranslations;

use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title',
        'slug',
    ];
    protected $table = 'category';

    protected $dates = ['deleted_at'];
    
    public $hidden = ['created_at', 'updated_at', 'deleted_at']; 

    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function category_translations()
    {
        return $this->hasMany('App\models\CategoryTranslations', 'category_id', 'id' );
    }
}
