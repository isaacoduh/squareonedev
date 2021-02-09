<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {

        $posts = Cache::remember('posts', 60, function () {
            return Post::orderBy('id', 'desc')->paginate(15);
        });

        return view('pages.home')->with('posts', $posts);
    }

    public function single($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('posts.single')->with('post', $post);
    }

    public function feed()
    {
        $resultsArr = array();

        $client = new Client(['base_uri' => 'https://sq1-api-test.herokuapp.com']);

        $response = $client->request('GET', '/posts');
        $results = $response->getBody();
        $data = json_decode($results, true);
        $postData = $data['data'];
        foreach ($postData as $post) {
            $resultsArr[] = array("title" => $post['title'], 'body' => $post['description'], 'date' => $post['publication_date']);
            Post::updateOrCreate([
                'title' => $post['title'],
                'slug' => Str::slug($post['title']),
                'body' => $post['description'],
                'created_at' => $post['publication_date'],
                'user_id' => 1,
            ]);
        }

        return $resultsArr;
        // $results = json_decode($response->getBody(), true);
        // foreach ($posts as $post) {
        //     Post::updateOrCreate([
        //         'title' => $post->title,
        //         'slug' => Str::slug($post->title),
        //         'body' => $post->body,
        //         'created_at' => $post->publication_date
        //     ]);
        // }

        // return view('pages.feed')->with('post', $posts);

        // try {
        //     $posts = $response['data'];
        //     dd($posts);
        //     // return view('pages.feed')->with('posts', $posts);
        // } catch (Exception $e) {
        // }
    }
}
