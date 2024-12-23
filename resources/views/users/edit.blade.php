@extends('layouts.app')
@section('title', 'add user')
@section('content')
    <h1 class="header">Update user</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf 
        @method('PUT')
        <div class="mb-3">
            <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="user name">
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" rows="3" value="{{ $user->email }}" placeholder="user email">
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="password" value="{{ $user->password }}" rows="3" placeholder="user password">
        </div>
        <input type="submit" class="btn btn-primary" value="send">
    </form>
@endsection
