<?php

namespace App\Http\Controllers;

use App\models\Category;
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
      //  $this->middleware('auth');
    }
    

    
    
    public function succ()
    {
       /*
        $post = new Post;
        $post->title = $request->input('title');
        $post->title = $request->input('body');
        $post->save();
        */ 

        
    }
    public function create()
    {
        return view('meals.create_category');
    }

    public function save(Request $request)
    {
      //  dd($request->all());
        $this->validate($request, [
            'title'=>'required',
            'slug'=>'required',

        ]);
        $category=new Category;
        $category->title=$request->title;
        $category->slug=$request->slug;
        $category->save();
        
        //$categorys = category::create($request->all());
        //dd("test");
        //route('routeName', ['id' => 1]);
        return redirect()->route('category', ['id' => $category->id])->with('message','Category Created');
    }

    public function show($id)
    {
        $category = Category::find($id);
        return view ('meals.show_category')->with('cat', $category);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
}
