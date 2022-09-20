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
        $comment_report_count = AdminMessage::whereNotNull('comment_id')->count();
        return view('dashboard',compact('categories','users','posts','comment_report_count'));
    }
    public function categories()
    { 
        return view('admin.categories');
    }
    public function posts()
    {
        $posts = Post::with('category')->paginate(10);
        return view('admin.posts',compact('posts'));
    }
    public function comment_reports()
    {
        return view('admin.comment-report');
    }
}
