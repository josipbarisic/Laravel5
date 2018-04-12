<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use \igaster\TranslateEloquent\TranslationTrait;

use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title',
        'slug',
    ];
    protected $table='category';

    protected $dates = ['deleted_at'];
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
