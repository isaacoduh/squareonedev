@extends('layouts.master')

@section('title','| Modify Blog Post' )

@section('header_scripts')

@include('partials._jquery_parsley')

@endsection

@section('content')
    <article>
        <form id="edit-post-form" method="POST" data-parsley-validate action="{{route('post.update',$post->id)}}">
            @csrf
            <label for="title">Title: </label>
            <textarea name="title" type="text" data-parsley-required data-parsley-trigger="change" data-parsley-maxlength="255" id="title" class="form-control input-lg" rows="1" style="resize: none;">{{$post->title}}</textarea>
            <label name="body">Body:</label>
            <textarea type="text" class="form-control input-lg" data-parsley-required id="body" name="body" rows="10">{{ $post->body }}</textarea>
            <div id="form-buttons-row" class="row">
                <div class="col-sm-2">
                    <a href="{{route('post.show',$post->id)}}" class="btn btn-danger btn-block">Cancel</a>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-success btn-block">Update</button>
                </div>
            </div>
            <input type="hidden" name="_token" value="{{Session::token()}}">
            @method('PUT')
        </form>
    </article>
@endsection
