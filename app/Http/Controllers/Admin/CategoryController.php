<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'name' => 'required|unique:categories',
            'image' => 'required|mimes:jpeg,bmp,jgp,png,svg'
        ]);
        //get form image
        $image = $request->file('image');
        $slug = str_slug($request->name);
        if(isset($image)){
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            // check Category directory is Exists
            if(!Storage::disk('public')->exists('category/poster')){
                Storage::disk('public')->makeDirectory('category/poster');
            }
            // resize image for category poster and upload
            $poster = Image::make($image)->resize(1600,480)->save('$imageName');
            Storage::disk('public')->put('category/poster/'.$imageName,$poster);

            // check Category directory is Exists
            if(!Storage::disk('public')->exists('category/slider')){
                Storage::disk('public')->makeDirectory('category/slider');
            }
            // resize image for category slider and upload
            $slider = Image::make($image)->resize(500,350)->save('$imageName');
            Storage::disk('public')->put('category/slider/'.$imageName,$slider);
        }
        else{
            $imageName ='default.png';
        }
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image =$imageName;
        $category->save();
        Toastr::success('Category Successfully Saved','Success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'image' => 'mimes:jpeg,bnp,jgp,png'
        ]);
        //get form image
        $image = $request->file('image');
        $slug = str_slug($request->name);
        $category = Category::find($id);
        if(isset($image)){
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            // check Category directory is Exists
            if(!Storage::disk('public')->exists('category/poster')){
                Storage::disk('public')->makeDirectory('category/poster');
            }
            // delete old image
            if(Storage::disk('public')->exists('category/poster/'.$category->image)){
                Storage::disk('public')->delete('category/poster/'.$category->image);
            }
            // resize image for category poster and upload
            $poster = Image::make($image)->resize(1600,480)->save($imageName);
            Storage::disk('public')->put('category/poster/'.$imageName,$poster);

            // check Category directory is Exists
            if(!Storage::disk('public')->exists('category/slider')){
                Storage::disk('public')->makeDirectory('category/slider');
            }
            if(Storage::disk('public')->exists('category/slider/'.$category->image)){
                Storage::disk('public')->delete('category/slider/'.$category->image);
            }
            // resize image for category slider and upload
            $slider = Image::make($image)->resize(500,350)->save($imageName);
            Storage::disk('public')->put('category/slider/'.$imageName,$slider);
        }
        else{
            $imageName = $category->image;
        }
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image =$imageName;
        $category->save();

        Toastr::success('Category Successfully Updated','Success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::Find($id);
        if(Storage::disk('public')->exists('category/poster/'.$category->image)){
            Storage::disk('public')->delete('category/poster/'.$category->image);
        }
        if(Storage::disk('public')->exists('category/slider/'.$category->image)){
            Storage::disk('public')->delete('category/slider/'.$category->image);
        }
        $category->delete();
        
        Toastr::success('Category Successfully Deleted','Success');
        return redirect()->back();
    }
}
