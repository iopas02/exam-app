@extends('layout.app')

@section('content')
    @include('include.navbar')
    <h1>Request Item Page</h1>
    <br>
    <form action="{{ route('client.requestPost', ['item'=>$item]) }}" method="post">
        @csrf
        @method('post')
        <span for="">Item Name: <span class="fw-bold fs-3">{{ $item->itemName }}</span></span> 
        <br>
        <span for="">Current Quantity: <span class="fw-bold fs-3">{{ $item->quantity }}</span></span> 
        <br><br>
        <input type="number" name="quantity" placeholder="Request quantity" min="0">
        <br>
        @error('quantity')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
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