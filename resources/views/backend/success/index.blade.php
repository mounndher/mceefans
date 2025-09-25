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
                <h3 class="card-title">Modifier la section Succès</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('success.update',1) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="mb-3">
                        <label class="form-label">Titre</label>
                        <input type="text" class="form-control" name="title"
                               value="{{ old('title', $success->title ?? '') }}"
                               placeholder="Titre">
                        @error('title')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Subtitle -->
                    <div class="mb-3">
                        <label class="form-label">Sous-titre</label>
                        <input type="text" class="form-control" name="subtitle"
                               value="{{ old('subtitle', $success->subtitle ?? '') }}"
                               placeholder="Sous-titre">
                        @error('subtitle')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="image">
                        @if(!empty($success->image))
                        <div class="mt-2">
                            <img src="{{ asset($success->image) }}" alt="Image" width="150">
                        </div>
                        @endif
                        @error('image')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="descrition" rows="3"
                                  placeholder="Description">{{ old('descrition', $success->descrition ?? '') }}</textarea>
                        @error('descrition')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phrases -->
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="mb-3">
                            <label class="form-label">Phrase {{ $i }}</label>
                            <input type="text" class="form-control" name="pharse{{ $i }}"
                                   value="{{ old('pharse'.$i, $success->{'pharse'.$i} ?? '') }}"
                                   placeholder="Phrase {{ $i }}">
                            @error('pharse'.$i)
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Texte Phrase {{ $i }}</label>
                            <textarea class="form-control" name="textpharse{{ $i }}" rows="2"
                                      placeholder="Texte phrase {{ $i }}">{{ old('textpharse'.$i, $success->{'textpharse'.$i} ?? '') }}</textarea>
                            @error('textpharse'.$i)
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    @endfor

                    <div class="mb-3 text-center">
                        <button class="btn btn-primary" type="submit">Mettre à jour la section</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
