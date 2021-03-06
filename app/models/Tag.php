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
    protected $table = 'tags';

    protected $dates = ['deleted_at'];

    public $hidden = ['created_at', 'updated_at', 'deleted_at', 'pivot']; 

    #relationships

    public function tags()
    {
        return $this->belongsTo('App\models\Tag');
    }

    public function tag_translations()
    {
        return $this->hasMany('App\models\TagTranslations', 'tag_id', 'id' );
    }
}
