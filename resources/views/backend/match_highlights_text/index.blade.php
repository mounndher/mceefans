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
                <h3 class="card-title">Modifier le texte de la section Match Highlights</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('match_highlights_text.update') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Titre</label>
                        <input type="text" class="form-control" name="title"
                               value="{{ old('title', $highlightText->title ?? '') }}"
                               placeholder="Entrez le titre">
                        @error('title')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sous-titre</label>
                        <textarea class="form-control" name="subtitle" rows="3"
                                  placeholder="Entrez le sous-titre">{{ old('subtitle', $highlightText->subtitle ?? '') }}</textarea>
                        @error('subtitle')
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
