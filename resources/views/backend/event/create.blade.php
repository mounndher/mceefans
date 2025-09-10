@extends('backend.layouts.master')

@section('context')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create New Event</h3>
                <div class="card-actions">
                    <a href="{{ route('events.index') }}" class="btn btn-primary">
                        <!-- Back icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                             stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-arrow-left">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 12l14 0"/>
                            <path d="M5 12l6 6"/>
                            <path d="M5 12l6 -6"/>
                        </svg>
                        Back
                    </a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" value="{{ old('nom') }}" placeholder="Enter event name">
                        @error('nom') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Subtitle</label>
                        <input type="text" class="form-control" name="subtitle" value="{{ old('subtitle') }}" placeholder="Enter subtitle">
                        @error('subtitle') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="image_post">
                        @error('image_post') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control" name="date" value="{{ old('date') }}">
                        @error('date') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Stade</label>
                        <input type="text" class="form-control" name="stade" value="{{ old('stade') }}" placeholder="Enter stade/location">
                        @error('stade') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="">-- Select Status --</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Create Event</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
