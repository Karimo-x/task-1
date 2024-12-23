@extends('layouts.app')
@section('title', 'add user')
@section('content')
    <h1 class="header">add new user</h1>
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="text" class="form-control" name="name" placeholder="user name">
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" rows="3" placeholder="user email">
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="password" rows="3" placeholder="user password">
        </div>
        <input type="submit" class="btn btn-primary" value="send">
    </form>
@endsection
