<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AdminMessage;

class AdminController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $posts = Post::all();
        $users = User::all();
        return view('dashboard',compact('categories','users','posts'));
    }
    public function categories()
    { 
        return view('admin.categories');
    }
    public function posts()
    {
        return view('admin.posts');
    }
    public function comment_reports()
    {
        return view('admin.comment-report');
    }
}
