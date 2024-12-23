@extends('layouts.app')
@section('title', 'posts')

@section('content')
    @can('manageUser', auth()->user())
        <a href="{{ route('users.index') }}" class=" btn btn-info m-20">avaliable users</a>
    @endcan
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger my-2">logout</button>
    </form>
    <a href="{{ route('posts.create') }}" class="btn btn-secondary m-20"> add new post</a>
    <div class="container">
        @forelse ($posts as $post)
            <div class="card mb-2" style="width: 18rem;" id="contents">
                @php
                    $imgsarray = json_decode($post->images);
                @endphp
                @foreach ($imgsarray as $image)
                    <img src="/assets/images/{{ $image }}" class="card-img-top" alt="image icon">
                @endforeach
                <div class="card-body">
                    <h2 class="card-title">{{ $post->title }}</h2>
                    <p class="card-text">{{ $post->description }}</p>
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-secondary mb-2">show more about this post</a>
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary mb-2">edit</a>
                    @can('manageUser', auth()->user())
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endcan
                </div>
            </div>
        @empty
            <p>There is not any posts</p>
        @endforelse
    </div>
@endsection
