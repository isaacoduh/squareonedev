@extends('layouts.master')

@section('title','| Blog Post' )

@section('content')
    <article>
        <h1>{{$post->title}}</h1>
        <aside>
            <ul>
                <li>
                    <time class="post-date" datetime="{{$post->created_at}}">{{$post->created_at->format('M j,Y')}}</time>
                </li>

                <li>by {{$post->user->isAdmin ? 'Admin' : $post->user->name}}</li>
            </ul>
        </aside>
        <p>{{$post->body}}</p>

    </article>
@endsection
