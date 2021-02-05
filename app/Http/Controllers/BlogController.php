<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(5);

        return view('pages.home', compact($posts));
    }

    public function getApi($link)
    {
    }

    public function single($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('posts.single', compact($post));
    }
}
