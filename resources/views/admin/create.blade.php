@extends('layout.app')

@section('content')
    @include('include.navbar')
    <h1>Register Item Page</h1>
    <br>
    <form action="{{ route('admin.store') }}" method="post">
        @csrf
        <input type="text" name="itemName" placeholder="Item Name">
        <br>
        @error('itemName')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>
        <input type="number" name="quantity" placeholder="Quantity" min="0">
        <br>
        @error('quantity')
            <span class="text-danger">{{ $message }}</span>
        @enderror
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