@extends('layout.app')

@section('content')
    <h1>Login Page</h1>
    <form action="{{ route('user.loginPost') }}" method="post">
        @csrf
        <input type="text" name="username" placeholder="Username">
        <br>
        @error('username')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>
        <input type="password" name="password" placeholder="Password">
        <br>
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>
        <select name="role">
            <option class="d-none">Role</option>
            <option value="superadmin">Super Admin</option>
            <option value="admin">Admin</option>
            <option value="client">Client</option>
        </select>
        <br>
        @error('role')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>
        <button type="submit">Submit</button>
        <br>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('error') }}
            </div>
        @endif
    </form>
@endsection