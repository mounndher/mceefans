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
                <h3 class="card-title">Modifier la section What We Do</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('whatwedos.update',1) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-3">
                        <label class="form-label">Titre</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $whatwedo->title ?? '') }}">
                        @error('title') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <!-- Subtitle -->
                    <div class="mb-3">
                        <label class="form-label">Sous-titre</label>
                        <input type="text" class="form-control" name="subtitle" value="{{ old('subtitle', $whatwedo->subtitle ?? '') }}">
                        @error('subtitle') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <!-- Image1 -->
                    <div class="mb-3">
                        <label class="form-label">Image 1</label>
                        <input type="file" class="form-control" name="image1">
                        @if(!empty($whatwedo->image1))
                        <div class="mt-2">
                            <img src="{{ asset($whatwedo->image1) }}" width="150" alt="Image 1">
                        </div>
                        @endif
                        @error('image1') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <!-- Phrase 1 -->
                    <div class="mb-3">
                        <label class="form-label">Phrase 1</label>
                        <textarea class="form-control" name="pharse1" rows="2">{{ old('pharse1', $whatwedo->pharse1 ?? '') }}</textarea>
                        @error('pharse1') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <!-- Image2 -->
                    <div class="mb-3">
                        <label class="form-label">Image 2</label>
                        <input type="file" class="form-control" name="image2">
                        @if(!empty($whatwedo->image2))
                        <div class="mt-2">
                            <img src="{{ asset($whatwedo->image2) }}" width="150" alt="Image 2">
                        </div>
                        @endif
                        @error('image2') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <!-- Phrase 2 -->
                    <div class="mb-3">
                        <label class="form-label">Phrase 2</label>
                        <textarea class="form-control" name="pharse2" rows="2">{{ old('pharse2', $whatwedo->pharse2 ?? '') }}</textarea>
                        @error('pharse2') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <!-- Image3 -->
                    <div class="mb-3">
                        <label class="form-label">Image 3</label>
                        <input type="file" class="form-control" name="image3">
                        @if(!empty($whatwedo->image3))
                        <div class="mt-2">
                            <img src="{{ asset($whatwedo->image3) }}" width="150" alt="Image 3">
                        </div>
                        @endif
                        @error('image3') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <!-- Phrase 3 -->
                    <div class="mb-3">
                        <label class="form-label">Phrase 3</label>
                        <textarea class="form-control" name="pharse3" rows="2">{{ old('pharse3', $whatwedo->pharse3 ?? '') }}</textarea>
                        @error('pharse3') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <!-- Submit -->
                    <div class="mb-3 text-center">
                        <button class="btn btn-primary" type="submit">Mettre à jour</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
@endsection
