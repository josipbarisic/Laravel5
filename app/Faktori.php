<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faktori extends Model
{
    public function cat()
    {
        return $this->belongsTo('App\category_translations');
    }
}
