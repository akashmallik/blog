<?php

namespace App\Http\Controllers\Author;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Tag;
use App\Category;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
use App\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewAuthorPost;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::user()->posts()->latest()->get();
        return view('author.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('author.post.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,bmp,svg',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);
        //get form image
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if(isset($image)){
            //get current datetime
            $currentDate = Carbon::now()->toDateString();
            //make unique name for image
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            //check post directory is exists
            if (!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }
            //resize image
            $post = Image::make($image)->resize(1600,1080)->save($imageName);
            //save image on the directory
            Storage::disk('public')->put('post/'.$imageName,$post);
        }else{
            $imageName = 'default.png';
        }
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image =$imageName;
        $post->body =$request->body;
        if(isset($request->status)){
            $post->status = true;
        }else{
            $post->status = false;
        }
        $post->is_approved = false;
        $post->save();
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
        $users = User::where('role_id',1)->get();
        Notification::send($users,new NewAuthorPost($post));
        Toastr::success('Post Successfully Saved','Success');
        return redirect()->route('author.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if($post->user_id != Auth::id()){
            Toastr::error('You are not authorized this post','Error');
            return redirect()->back();
        }
        return view('author.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post->user_id != Auth::id()){
            Toastr::error('You are not authorized this post','Error');
            return redirect()->back();
        }
        $categories = Category::all();
        $tags = Tag::all();
        return view('author.post.edit',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if($post->user_id != Auth::id()){
            Toastr::error('You are not authorized this post','Error');
            return redirect()->back();
        }
        $this->validate($request,[
            'title' => 'required',
            'image' => 'image',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);
        //get form image
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if(isset($image)){
            //get current datetime
            $currentDate = Carbon::now()->toDateString();
            //make unique name for image
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            //check post directory is exists
            if (!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }
            // delete old image
            if (Storage::disk('public')->exists('post/'.$post->image)) {
                Storage::disk('public')->delete('post/'.$post->image);
            }
            //resize image
            $postUpdate = Image::make($image)->resize(1600,1080)->save($imageName);
            //save image on the directory
            Storage::disk('public')->put('post/'.$imageName,$postUpdate);
        }else{
            $imageName = $post->image;
        }
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image =$imageName;
        $post->body =$request->body;
        if(isset($request->status)){
            $post->status = true;
        }else{
            $post->status = false;
        }
        $post->is_approved = false;
        $post->save();
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);
        Toastr::success('Post Successfully Updated','Success');
        return redirect()->route('author.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->user_id != Auth::id()){
            Toastr::error('You are not authorized this post','Error');
            return redirect()->back();
        }
        if (Storage::disk('public')->exists('post/'.$post->image)) {
            Storage::disk('public')->delete('post/'.$post->image);
        }
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
        Toastr::success('Post Successfully Deleted','Success');
        return redirect()->back();
    }
}
