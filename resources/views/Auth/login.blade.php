@extends('layouts.app')
@section('title', 'sign in')

@section('content')
<h4 class="header my-3">Please Enter your information :</h4>
<form action="{{ route('login') }}" method="POST" class="my-5">
    @csrf
    <div class="mb-3">
        <input type="email" class="form-control" placeholder="Enter your email" name="email">
    </div>
    <div class="mb-3">
        <input type="password" class="form-control" placeholder="Enter your password" name="password">
    </div>
    <button type="submit" class="btn btn-primary">send</button>
    @if ($errors->any())
        {{ implode('', $errors->all(':message')) }}
    @endif
</form>

@endsection
