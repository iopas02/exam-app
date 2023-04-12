@extends('layout.app')

@section('content')
    @include('include.navbar')
    <h1>Update Item Page</h1>
    <br>
    <form action="{{ route('admin.update', $item->id) }}" method="post">
        @csrf
        @method('PUT')
        <input type="text" name="itemName" placeholder="Item Name" value="{{ $item->itemName }}">
        <br>
        @error('itemName')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>
        <input type="number" name="quantity" placeholder="Quantity" min="0" value="{{ $item->quantity }}">
        <br>
        @error('quantity')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>
        <br>
        <button type="submit" class="btn btn-primary">Update</button>
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