<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;

class CommentController extends Controller
{
    public function index(){
        $comments = Comment::latest()->get();
        return view('admin/post/comments',compact('comments'));
    }
    public function destroy($id)
    {
        Comment::find($id)->delete();
        Toastr::success('Successfully Deleted', 'Success');
        return redirect()->back();
    }
}
