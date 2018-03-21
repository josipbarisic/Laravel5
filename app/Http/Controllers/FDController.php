<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FDController extends Controller
{
    public function __construct()
    {
        
    }

    public function show_tags()
    {
        $tags= Tags::$this->title();
    }
}
