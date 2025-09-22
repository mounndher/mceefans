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

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modifier la section Héros</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('hero.update', $hero->id ?? 1) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title"
                               value="{{ old('title', $hero->title ?? '') }}"
                               placeholder="Enter title">
                        @error('title')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Subtitle</label>
                        <input type="text" class="form-control" name="subtitle"
                               value="{{ old('subtitle', $hero->subtitle ?? '') }}"
                               placeholder="Enter subtitle">
                        @error('subtitle')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" class="form-control" name="button_text"
                               value="{{ old('button_text', $hero->button_text ?? '') }}"
                               placeholder="Enter button text">
                        @error('button_text')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hero Image</label>
                        <input type="file" class="form-control" name="image">
                        @if(!empty($hero->image))
                            <div class="mt-2">
                                <img src="{{ asset($hero->image) }}" alt="Hero Image" width="150">
                            </div>
                        @endif
                        @error('image')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Update Hero</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
