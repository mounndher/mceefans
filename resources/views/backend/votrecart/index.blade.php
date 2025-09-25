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
                <h3 class="card-title">Modifier la section Votre Cart</h3>
            </div>

            <div class="card-body">

                <form action="{{ route('votrecart.update', 1) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Titre</label>
                        <input type="text" class="form-control" name="title"
                               value="{{ old('title', $cart->title) }}" placeholder="Entrer le titre">
                        @error('title')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sous-titre</label>
                        <input type="text" class="form-control" name="subtitle"
                               value="{{ old('subtitle', $cart->subtitle) }}" placeholder="Entrer le sous-titre">
                        @error('subtitle')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4"
                                  placeholder="Entrer la description">{{ old('description', $cart->description) }}</textarea>
                        @error('description')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="image">
                        @if(!empty($cart->image))
                        <div class="mt-2">
                            <img src="{{ asset($cart->image) }}" alt="Image" width="150">
                        </div>
                        @endif
                        @error('image')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 text-center">
                        <button class="btn btn-primary" type="submit">Mettre à jour</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
