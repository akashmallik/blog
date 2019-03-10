<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Toastr;

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
            // 'image' => 'required|mimes:jpeg,bnp,jgp,png'
        ]);
        
        //get form image
        $image = $request->file('image');
        $slug = str_slug($request->name);
        if(isset($image)){
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            // check Category directory is Exists
            if(!Storage::disk('public')->exists('category')){
                Storage::disk('public')->makeDirectory('category');
            }
            Storage::disk('public')->put('category/'.$imageName,$image);
        }
        else{
            $imageName ='default.png';
        }
        $category = new Category();
        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->image =$imageName;
        $category->save();
        // Toastr::success('category Successfully Saved','Success');
        // Toastr::success('Successfully Added', 'Success');
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
            'name' => 'required|unique:categories',
            // 'image' => 'required|mimes:jpeg,bnp,jgp,png'
        ]);
        
        //get form image
        $image = $request->file('image');
        $slug = str_slug($request->name);
        if(isset($image)){
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            // check Category directory is Exists
            if(!Storage::disk('public')->exists('category')){
                Storage::disk('public')->makeDirectory('category');
            }
            Storage::disk('public')->put('category/'.$imageName,$image);
        }
        else{
            $imageName ='default.png';
        }
        $category = new Category();
        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->image =$imageName;
        $category->save();
        // Toastr::success('category Successfully Saved','Success');
        // Toastr::success('Successfully Added', 'Success');
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
        //
    }
}
