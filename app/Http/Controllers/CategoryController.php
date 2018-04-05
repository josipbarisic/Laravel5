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
        $category->slug=str_slug($request->slug, '-');
        $category->save();
        
        //$category = category::create($request->all());
        //dd("test");
        //route('routeName', ['id' => 1]);
        return redirect()->route('category', ['id' => $category->id])->with('message','Category Created');
    }
    
    public function index()
    {
        return Category::all();
    }

    public function show($id)
    {
        return Category::find($id); 
    }
    public function edit(Request $request, $id)
    {
       $this->validate($request, 
       [
        'title'=>'required',
        'slug'=>'required',
       ]);

        $category=Category::find($id);
        $category->title=$request->title;
        $string='-categorySlug';
        $category->slug=str_slug($request->slug, '-').$string;
        $category->save();

        return Category::find($id);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
}
