<?php

namespace App\Http\Controllers;

use App\Http\Services\PostService;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth', ['except' => ['index', 'login']]);
    // }
    protected $postService;
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    //load the index page
    public function index(){
        return view('site.index');
    }

    public function login(){
        return view('site.login');
    }

    public function success(){
        return view('site.success');
    }

    public function blog(){
        $posts = Post::where('status', 0)->orderBy('created_at', 'desc')->cursorPaginate(5);
        return view('site.blog')->with('posts', $posts);
    }

    public function viewSingle($id){
        $result = $this->postService->getSinglePost($id);
        return view('site.view')->with('post', $result);
    }
}
