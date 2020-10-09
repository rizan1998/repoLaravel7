<?php

namespace App\Http\Controllers;

use App\Post;

use App\Http\Requests\PostRequest;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $post = Post::with('author', 'tags', 'category')->latest()->limit(6)->get();
        return view('myhome', compact('post'));
    }
}
