<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Middleware Auth
     */

    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('admin.posts.index', compact($posts));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, array('title' => 'required|max:255', 'slug' => 'required|alpha_dash|min:5|max:200|unique:posts,slug', 'body' => 'required'));

        $post = new Post;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;

        $post->save();

        Session::flash('success', 'Post created!');
        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Show a single resource
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('admin.posts.single');
    }

    public function edit($id)
    {
        $post = Post::find($id);

        return view('admin.posts.edit', compact($post));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'title' => 'required|max:255',
            'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug,' . $id,
            'body' => 'required'
        ));

        // save to database
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->body = $request->input('body');

        $post->save();

        Session::flash('success', 'Post updated successfully');
        return redirect()->route('admin.posts.show', $id);
    }

    public function destroy($id)
    {
        $post = Post::find($id)->delete();
        Session::flash('success', 'Post deleted successfully');

        return redirect()->route('admin.posts.index');
    }
}
