<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use \igaster\TranslateEloquent\TranslationTrait;

use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'slug',
    ];
    protected $table='tags';

    protected $dates='deleted_at';

    public function tags()
    {
        return $this->belongsTo('App\Tag');
    }
}
