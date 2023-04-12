@extends('layout.app')

@section('content')
    @include('include.navbar')
    <h1>Register User Page</h1>
    <form action="{{ route('superadmin.registerPost') }}" method="post">
        @csrf
        <input type="text" name="username" placeholder="Username">
        <br>
        @error('username')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>
        <input type="text" name="password" placeholder="Password">
        <br>
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>
        <select name="role">
            <option value="superadmin">Super Admin</option>
            <option value="admin">Admin</option>
            <option value="client">Client</option>
        </select>
        <br>
        <br>
        <button type="submit" class="btn btn-success">Register</button>
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