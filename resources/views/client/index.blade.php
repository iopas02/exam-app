@extends('layout.app')

@section('content')
    @include('include.navbar')
    <h1>Client Page</h1>
    <div class="table-responsive">
        <h3>Items</h3>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Item Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Last Updated</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                <tr>
                    <td>{{ $item->itemName }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td>
                        <a href="{{ route('client.request', ['item' => $item]) }}" class="btn btn-primary">Request</a>                            
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
                                <th scope="col">Item Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Date of Request</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pendings as $pending)
                            <tr>
                                <td>{{ $pending->id }}</td>
                                <td>{{ $pending->itemName }}</td>
                                <td>{{ $pending->quantity }}</td>
                                <td>{{ $pending->created }}</td>
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
                                <th scope="col">Item Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Date of Request</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($approves as $approve)
                            <tr>
                                <td>{{ $approve->id }}</td>
                                <td>{{ $approve->itemName }}</td>
                                <td>{{ $approve->quantity }}</td>
                                <td>{{ $approve->created }}</td>
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
                                <th scope="col">Item Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Date of Request</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rejects as $reject)
                            <tr>
                                <td>{{ $reject->id }}</td>
                                <td>{{ $reject->itemName }}</td>
                                <td>{{ $reject->quantity }}</td>
                                <td>{{ $reject->created }}</td>
                            </tr>
                                
                            @empty
                                <span class="text-muted">No data.</span>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>            
        </div>
@endsection