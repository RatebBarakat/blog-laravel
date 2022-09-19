<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latest_posts = Post::orderBy('created_at','DESC')->with('category')->paginate(5);
        return view('home',compact('latest_posts'));
    }
}