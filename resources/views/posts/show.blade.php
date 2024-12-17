@extends('layouts.app')

@section('title', 'post')

@section('content')

    <div class="card mx-5 my-5">
        <h2 class="card-header">Title : {{ $post->title }}</h2>
        <div class="card-body">
            <p class="card-text"> description : {{ $post->description }}</p>
            <img src="/assets/images/{{ $post->image }}" alt="img icon">
            <p class="card-text">added at : {{ $post->created_at }}</p>
            <a href="{{ route('posts.index') }}" class="btn btn-primary">back to => </a>
        </div>
    </div>

@endsection
