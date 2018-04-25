<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslations extends Model
{
    protected $table='category_translations';

    public function category_translations()
    {
        return $this->belongsTo('');
    }
}
