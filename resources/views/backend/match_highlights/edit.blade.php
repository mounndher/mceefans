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
                <h3 class="card-title">Edit Match Highlight</h3>
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
                <form action="{{ route('match_highlights.update', $matchHighlight->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title"
                               value="{{ old('title', $matchHighlight->title) }}" placeholder="Enter title" required>
                        @error('title')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Subtitle</label>
                        <input type="text" class="form-control" name="subtitle"
                               value="{{ old('subtitle', $matchHighlight->subtitle) }}" placeholder="Enter subtitle" required>
                        @error('subtitle')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image URL</label>
                        <input type="text" class="form-control" name="image"
                               value="{{ old('image', $matchHighlight->image) }}" placeholder="Enter image path or URL">
                        @error('image')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                        @if($matchHighlight->image)
                            <img src="{{ asset($matchHighlight->image) }}" alt="Highlight Image" width="100" class="mt-2">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Text</label>
                        <textarea class="form-control" name="text" rows="4" placeholder="Enter highlight text" required>{{ old('text', $matchHighlight->text) }}</textarea>
                        @error('text')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Update Highlight</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
