@extends('layout.app')

@section('content')
<div class="row justify-content-center pt-5 mt-5">
    <h1 class="col-auto">Welcome to Charles Item Store</h1>
</div>
<div class="row justify-content-center pt-5 mt-5">
    <a href="{{ route('user.login') }}" class="col-1 btn btn-primary">Login</a>
    @if(Session::has('success'))
        <span class="text-success">Logout Successful</span>
    @endif
</div>
    
@endsection