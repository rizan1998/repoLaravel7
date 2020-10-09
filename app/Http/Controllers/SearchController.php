<?php

namespace App\Http\Controllers;

use App\Post;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function post()
    {
        $query =  request('query');
        $post = Post::where("title", "like", "%$query%")->latest()->paginate(4);
        return view('posts.index', compact('post'));
    }
}
