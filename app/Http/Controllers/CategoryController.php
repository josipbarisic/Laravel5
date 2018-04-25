<?php

namespace App\Http\Controllers;

use App\models\Category;
use App\models\CategoryTranslations;
use DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      
    }
    
    

    public function save(Request $request)
    {
    
            $this->validate($request, [
            'title'=>'required',
            'slug'=>'required',

        ]);

        $category=new Category;
        $category->title=$request->title;
        $category->slug=str_slug($request->slug, '-');
        $category->save();

        return $category;
    }
    
    public function index()
    {
        return Category::all();
    }

    public function show($id)
    {
        //return Category::where('id', 4)->with('category_translations')->first();
        $var = Category::where('id', 4)->first();  
        return $var->category_translations;

    }
    public function edit(Request $request)
    {
       $this->validate($request, 
       [
        'id'=>'required',
        'title'=>'required',
        'slug'=>'required',
       ]);

        $category=Category::find($request->id);
        if($category==NULL)
        {
            return 'Ne postoji';
        }
        $category->title=$request->title;
        $string='-categorySlug';
        $category->slug=str_slug($request->slug, '-').$string;
        $category->save();

        return Category::find($request->id);
    }
    public function delete(Request $request)
    {
        $this->validate($request, 
       [
        'id'=>'required'
       ]);
        $category=Category::find($request->id);
        $category->delete();

        return 'Deleted'.$category;
    }
}
