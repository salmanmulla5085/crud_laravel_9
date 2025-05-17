@extends('layouts.app')
@section('title', 'Register')

@section('content')
<h3>Register</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif
<form method="POST" id="registerForm" action="{{ route('register.submit') }}">
    @csrf
    <div class="mb-3">
        <label>Name</label>
        <input name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input name="email" type="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input name="password" type="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Confirm Password</label>
        <input name="password_confirmation" type="password" class="form-control" required>
    </div>
    <button class="btn btn-primary">Register</button>
</form>
@endsection

@section('scripts')
<script>
$('#registerForm').submit(function(e) {
    const password = $('[name="password"]').val();
    const confirm = $('[name="password_confirmation"]').val();
    if (password !== confirm) {
        e.preventDefault();
        alert('Passwords do not match');
    }
});
</script>
@endsection
