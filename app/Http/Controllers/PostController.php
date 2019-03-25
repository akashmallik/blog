<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Session;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->approve()->publish()->paginate(6);
        return view('posts',compact('posts'));
    }
    public function details($slug){
        $post = Post::where('slug',$slug)->first();
        $blogKey = 'blog_'.$post->id;
        if(!Session::has($blogKey)){
            $post->increment('view_count');
            Session::put($blogKey,1);
        }
        $randomposts = Post::approve()->publish()->take(3)->get();
        return view('post',compact('post','randomposts'));
    }
    public function postByCategory($slug){
        $category = Category::where('slug',$slug)->first();
        $posts = $category->posts()->paginate(6);
        return view('categories',compact('posts','category'));
    }
    public function postByTag($slug){
        $tag = Tag::where('slug',$slug)->first();
        $posts = $tag->posts()->paginate(6);
        return view('tags',compact('posts','tag'));
    }
    public function search(Request $request){
        $query = $request->input('query');
        $posts = Post::where('title','LIKE',"%$query%")->approve()->publish()->paginate(6);
        return view('search',compact('posts','query'));
    }
}
