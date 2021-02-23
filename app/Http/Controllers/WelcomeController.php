<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
       /*$search = request()->query('search');
       if($search){
         $posts = Post::where('title','LIKE', "%{$search}%")->simplePaginate(2);
       }
       else {
         $posts=Post::simplePaginate(2);
       }*/
       return view('welcome')
       ->with('categories',Category::all())
       ->with('tags',Tag::all())
       ->with('posts', Post::searched()->simplePaginate(2));
       //using scope
    }
}
