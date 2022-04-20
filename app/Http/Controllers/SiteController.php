<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

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
}
