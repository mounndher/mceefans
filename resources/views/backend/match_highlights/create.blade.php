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
                <h3 class="card-title">Create New Match Highlight</h3>
                <div class="card-actions">
                    <a href="{{ route('match_highlights.index') }}" class="btn btn-primary">
                        <!-- Back icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round"
                             class="icon icon-tabler icon-tabler-arrow-left">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12h14" />
                            <path d="M5 12l6 6" />
                            <path d="M5 12l6 -6" />
                        </svg>
                        Back
                    </a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('match_highlights.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf



                    <div class="mb-3">
                        <label class="form-label">Image URL</label>
                        <input type="file" class="form-control" name="image"
                               value="{{ old('image') }}" placeholder="Enter image path or URL">
                        @error('image')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Text</label>
                        <textarea class="form-control" name="text" rows="4"
                                  placeholder="Enter highlight text" required>{{ old('text') }}</textarea>
                        @error('text')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Create Highlight</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
