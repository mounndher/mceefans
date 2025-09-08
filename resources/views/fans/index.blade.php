@extends('layout.app')

@section('content')
    <h1 class="mb-4">Fans</h1>

    <!-- Success Message -->
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
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        @error('name')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        @error('email')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
        @error('phone')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Card Number</label>
        <input type="text" name="card_number" class="form-control" value="{{ old('card_number') }}" required>
        @error('card_number')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Profile Image</label>
        <input type="file" name="image" class="form-control">
        @error('image')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Create Fan</button>
</form>

        </div>
    </div>

    <!-- Fans Table -->
    <div class="card">
        <div class="card-header">Fans List</div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Card Number</th>
                        <th>Profile Image</th>
                        <th>Virtual Card</th>
                        <th>QR Code</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fans as $fan)
                        <tr>
                            <td>{{ $fan->id }}</td>
                            <td>{{ $fan->name }}</td>
                            <td>{{ $fan->email }}</td>
                            <td>{{ $fan->phone }}</td>
                            <td>{{ $fan->card_number }}</td>

                            <td>
                                @if($fan->image)
                                    <img src="{{ asset($fan->image) }}" width="50" alt="Profile">
                                @endif
                            </td>

                            <td>
                                @if($fan->card_image)
                                    <img src="{{ asset($fan->card_image) }}" width="150" alt="Virtual Card">
                                @endif
                            </td>

                            <td>
                                @if($fan->qr_code)
                                    <img src="{{ asset($fan->qr_code) }}" width="100" alt="QR Code">
                                @endif
                            </td>

                            <td>

                                    <button class="btn btn-danger btn-sm">Delete</button>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No fans found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
