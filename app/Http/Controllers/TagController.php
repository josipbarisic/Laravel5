<?php

namespace App\Http\Controllers;

use App\models\Tag;
use DB;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
      
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'title'=>'required',
            'slug'=>'required',

        ]);

        $tag=new Tag;
        $tag->title=$request->title;
        $tag->slug=str_slug($request->slug, '-');
        $tag->save();

        return $tag;
    }

    public function index()
    {
        
        return Tag::all();
    }

    public function show($id)
    {
        return Tag::find($id);
    }

    public function edit(Request $request)
    {
       $this->validate($request, 
       [
        'id'=>'required',
        'title'=>'required',
        'slug'=>'required',
       ]);
       dd($request->slug);
       /*
        $tag=Tag::find($request->id);
        if($tag==NULL)
        {
            return 'Ne postoji';
        }
        $tag->title=$request->title;
        $string='-tagSlug';
        $tag->slug=str_slug($request->slug, '-').$string;
        $tag->save();

        return Tag::find($request->id);*/
    }
  
}
