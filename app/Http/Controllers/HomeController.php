<?php

namespace App\Http\Controllers;

use App\Post;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        return view('posts.create');
    }

    public function spremi(Request $request)
    {
      //  dd($request->all());
        $this->validate($request, [
            'title'=>'required',
            'slug'=>'required'

        ]);
        $post=new Post;
        $post->title=$request->title;
        $post->slug=$request->slug;
        $post->save();
        
        //$posts = Post::create($request->all());
        //dd("test");
        //route('routeName', ['id' => 1]);
        return redirect()->route('postovi', ['id' => $post->id])->with('message','Post Created');
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view ('posts.show')->with('post', $post);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
}
