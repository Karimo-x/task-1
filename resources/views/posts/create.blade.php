@extends('layouts.app')
@section('title', 'add post')

@section('content')
    <h1 class="header">add new post</h1>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="text"  class="form-control" name="title"  placeholder="post title">
        </div>
        <div class="mb-3">
            <textarea class="form-control" name="description" rows="3" placeholder="post description"> </textarea>
        </div>
        <div class="mb-3">
            <input required type="file" name="images[]" multiple>
        </div>
        <input required type="submit" class="btn btn-primary" value="send">
    </form>

@endsection
