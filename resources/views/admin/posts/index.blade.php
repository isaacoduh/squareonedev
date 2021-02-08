@extends('layouts.master')

@section('title','| Posts Index' )

@section('ActiveHome','active')

@section('content')
    <ul>
        <div class="col-sm-2">
            <a href="{{route('post.create')}}" class="btn btn-primary btn-block">Add a Post</a>
        </div>
        @if (!empty($posts))
            <table style="width: 100%">
                <th>Title</th>
                <th>Date</th>
                <th></th>
                <th></th>
        @endif
        @forelse ($posts as $post)
            <tr style="margin-bottom: 4px;">
                <td style="width: 50%"><a href="{{route('post.show',$post->id)}}" title="{{$post->title}}">{{$post->title}}</a></td>
                <td><time class="pos-date" datetime="{{$post->created_at}}">{{$post->created_at->format('M j,Y')}}</time></td>
                <td><a href="{{route('post.edit',$post->id)}}" class="btn btn-primary btn-sm">Edit</a></td>
            </tr>
        @empty
            <li><h1>No posts!</h1></li>
        @endforelse
        @if (!empty($posts))
        </table>
        @endif
    </ul>
    <div class="text-center">
        {!!$posts->links()!!}
    </div>
@endsection
