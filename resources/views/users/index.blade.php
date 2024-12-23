@extends('layouts.app')
@section('title', 'users')
@section('content')
    <a href="{{ route('posts.index') }}" class="btn btn-info mx-5">posts</a>
    <a href="{{ route('users.create') }}" class="btn btn-secondary my-2"> add user</a>
    <table class="table margintable">
        <thead>
            <tr>
                <th >name</th>
                <th >email</th>
                <th >show</th>
                <th >edit</th>
                <th>delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><a href="{{ route('users.show', $user->id) }}" class="btn btn-primary mb-2">show </a></td>
                <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-secondary mb-2">edit</a></td>
                <td><form action="{{ route('users.destroy', $user->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form> </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger my-2">logout</button>
    </form>
@endsection
