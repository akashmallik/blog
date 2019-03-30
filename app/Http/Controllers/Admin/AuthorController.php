<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AuthorController extends Controller
{
    public function index(){
        return $authors = User::authors()->withCount('posts')->withCount('comments')->withCount('favorite_posts')->get();
    }
}
