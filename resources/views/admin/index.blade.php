@extends('layout.app')

@section('content')
    @include('include.navbar')
    <h1>Admin Page</h1>
    <div class="row justify-content-center">
        <div class="col-auto">
            <a href="{{ route('admin.create') }}" class="btn btn-primary">Add items</a>
        </div>
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
        <div class="table-responsive">
            <h3>Items</h3>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Last Updated</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->itemName }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td>
                            <a href="{{ route('admin.edit', $item->id) }}" class="btn btn-success">Edit</a>
                            <form action="{{ route('admin.destroy', $item->id) }}" method='post'>
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                            
                        </td>
                    </tr>
                        
                    @empty
                        <span class="text-muted">No data.</span>
                    @endforelse
                </tbody>
            </table>
        </div>
        <hr>
        <h3>Requests</h3>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active text-warning" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="true">Pending</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-primary" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approved" type="button" role="tab" aria-controls="approved" aria-selected="false">Approved</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-danger" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected" type="button" role="tab" aria-controls="rejected" aria-selected="false">Rejected</button>
                    </li>
                </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Client</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Date of Request</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pendings as $pending)
                            <tr>
                                <td>{{ $pending->id }}</td>
                                <td>{{ $pending->clientName }}</td>
                                <td>{{ $pending->itemName }}</td>
                                <td>{{ $pending->quantity }}</td>
                                <td>{{ $pending->created }}</td>
                                <td>
                                    <form action="{{ route('admins.approve') }}" method="post">
                                        @csrf
                                        @method('post')
                                        <input type="hidden" name="id" value="{{ $pending->id }}">
                                        <button type="submit" class="btn btn-primary">Approve</button>
                                    </form>

                                    <form action="{{ route('admins.reject') }}" method="post">
                                        @csrf
                                        @method('post')
                                        <input type="hidden" name="id" value="{{ $pending->id }}">
                                        <button type="submit" class="btn btn-danger">Reject</button>
                                    </form>
                            </tr>
                            @empty
                                <span class="text-muted">No data.</span>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Client</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Date Approved</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($approves as $approve)
                            <tr>
                                <td>{{ $approve->id }}</td>
                                <td>{{ $approve->clientName }}</td>
                                <td>{{ $approve->itemName }}</td>
                                <td>{{ $approve->quantity }}</td>
                                <td>{{ $approve->updated }}</td>
                            </tr>
                                
                            @empty
                                <span class="text-muted">No data.</span>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Client</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Date Rejected</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rejects as $reject)
                            <tr>
                                <td>{{ $reject->id }}</td>
                                <td>{{ $reject->clientName }}</td>
                                <td>{{ $reject->itemName }}</td>
                                <td>{{ $reject->quantity }}</td>
                                <td>{{ $reject->updated }}</td>
                            </tr>
                                
                            @empty
                                <span class="text-muted">No data.</span>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>            
        </div>
    </div>
@endsection