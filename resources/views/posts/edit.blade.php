@extends('layouts.app')
@section('title','edit post')

@section('content')

<h1 class="header">Update post</h1>
<form action="{{ route('posts.update' , $post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    <div class="mb-3">
        <input type="text"  class="form-control" name="title"  placeholder="post title" value="{{ $post->title }}">
    </div>
    <div class="mb-3">
        <textarea class="form-control" name="description" rows="3" placeholder="post description">  {{ $post->description }} </textarea>
    </div>
    <div class="mb-3">
        <input type="file" name="image" style="display: none" id="image">
    <label for="image"> <img src="/assets/images/{{ $post->image }}" alt="img icon"> </label>
    </div>
    <input type="submit" class="btn btn-primary" value="send">
</form>
@endsection