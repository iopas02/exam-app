@extends('layout.app')

@section('content')
    @include('include.navbar')
    <h1>Super Admin Page</h1>
    <div>
        <a href="{{ route('superadmin.register') }}" class="btn btn-primary">Register User</a>
        <div class="table-responsive">
            <h3>Super Admins</h3>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Username</th>
                        <th scope="col">Date Added</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($superadmins as $superadmin)
                    <tr>
                        <td>{{ $superadmin->id }}</td>
                        <td>{{ $superadmin->username }}</td>
                        <td>{{ $superadmin->created_at }}</td>
                        <td>
                            <a href="" class="btn btn-success">Edit</a>
                            <br>
                            <a href="" class="btn btn-danger">Delete</a></td>
                    </tr>
                        
                    @empty
                        <span class="text-muted">No data.</span>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="table-responsive">
            <h3>Admins</h3>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Username</th>
                        <th scope="col">Date Added</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $admin)
                    <tr>
                        <td>{{ $admin->id }}</td>
                        <td>{{ $admin->username }}</td>
                        <td>{{ $admin->created_at }}</td>
                        <td>
                            <a href="" class="btn btn-success">Edit</a>
                            <br>
                            <a href="" class="btn btn-danger">Delete</a></td>
                    </tr>
                        
                    @empty
                        <span class="text-muted">No data.</span>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="table-responsive">
            <h3>Clients</h3>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Username</th>
                        <th scope="col">Date Added</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clients as $client)
                    <tr>
                        <td>{{ $client->id }}</td>
                        <td>{{ $client->username }}</td>
                        <td>{{ $client->created_at }}</td>
                        <td>
                            <a href="" class="btn btn-success">Edit</a>
                            <br>
                            <a href="" class="btn btn-danger">Delete</a></td>
                    </tr>
                       
                    @empty
                        <span class="text-muted">No data.</span>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection