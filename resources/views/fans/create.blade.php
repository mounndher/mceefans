@extends('layout.app')

@section('content')
    <h1>Create New Fan</h1>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('fan.store') }}">
                @csrf
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Save Fan</button>
            </form>
        </div>
    </div>
@endsection
