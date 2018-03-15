<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    protected $fillable = [
        'title',
        'slug'
    ];
    protected $table='tags';
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    // public function boot()
    // {
    //     //
    // }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
