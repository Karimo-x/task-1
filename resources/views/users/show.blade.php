@extends('layouts.app')

@section('title', 'user')

@section('content')

    <div class="card mx-5 my-5">
        <h2 class="card-header">Name : {{ $user->name }}</h2>
        <div class="card-body">
            <p class="card-text"> Email : {{ $user->email }}</p>
            <p class="card-text">Added at : {{ $user->created_at }}</p>
            <p class="card-text">Updated at : {{ $user->updated_at }}</p>
            <a href="{{ route('users.index') }}" class="btn btn-primary">back to => </a>
        </div>
    </div>

@endsection
