<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Middleware Auth
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('admin.posts.index')->with('posts', $posts);
    }

    public function myposts()
    {
        if (Auth::user()->isUser) {
            $posts = Auth::user()->posts()->paginate(10);
            return view('posts.user')->with('posts', $posts);
        }

        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('admin.posts.index')->with('posts', $posts);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, array('title' => 'required|max:255',  'body' => 'required'));

        $post = new Post;
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->body = $request->body;
        $post->user_id = Auth::user()->id;

        $post->save();

        Session::flash('success', 'Post created!');
        return redirect()->route('post.show', $post->id);
    }

    /**
     * Show a single resource
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('admin.posts.single')->with('post', $post);
    }

    public function edit($id)
    {
        $post = Post::find($id);

        return view('admin.posts.edit')->with('post', $post);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'title' => 'required|max:255',
            'body' => 'required'
        ));

        // save to database
        $post = Post::find($id);
        $post->title = $request->input('title');
        // $post->slug = $request->input('slug');
        $post->body = $request->input('body');

        $post->save();

        Session::flash('success', 'Post updated successfully');
        return redirect()->route('post.show', $id);
    }

    public function destroy($id)
    {
        $post = Post::find($id)->delete();
        Session::flash('success', 'Post deleted successfully');

        return redirect()->route('admin.posts.index');
    }
}
