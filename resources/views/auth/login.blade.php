@extends('layouts.app')
@section('title', 'Login')

@section('content')
<h3>Login</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<form method="POST" id="loginForm" action="{{ route('login.submit') }}">
    @csrf
    <div class="mb-3">
        <label>Email</label>
        <input name="email" type="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input name="password" type="password" class="form-control" required>
    </div>
    <button class="btn btn-primary">Login</button>
</form>
@endsection
