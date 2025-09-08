@extends('layout.app')

@section('content')
    <h1 class="mb-4">Fans</h1>

    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <!-- Add Fan Form -->
    <div class="card mb-4">
        <div class="card-header">Add New Fan</div>
        <div class="card-body">
            <form method="POST" action="{{ route('fan.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Card Number</label>
                    <input type="text" name="card_number" class="form-control" required>
                </div>


                <button type="submit" class="btn btn-primary">Create Fan</button>
            </form>
        </div>
    </div>

    <!-- Fans Table -->
    <div class="card">
        <div class="card-header">Fans List</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Card Number</th>

                        <th>QR Code</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fans as $fan)
                        <tr>
                            <td>{{ $fan->id }}</td>
                            <td>{{ $fan->username }}</td>
                            <td>{{ $fan->email }}</td>
                            <td>{{ $fan->phone }}</td>
                            <td>{{ $fan->card_number }}</td>


                            <td>{!! $fan->qr_code !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
