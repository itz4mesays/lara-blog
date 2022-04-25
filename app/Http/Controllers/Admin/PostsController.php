<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(){
        $posts = Post::where('status', 0)->orderBy('created_at', 'desc')->cursorPaginate(20);
        return view('admin.posts.allposts')->with('posts', $posts);
    }
}
