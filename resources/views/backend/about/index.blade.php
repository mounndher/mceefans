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
                <h3 class="card-title">Modifier la section About</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('about.update', 1) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Titre</label>
                        <input type="text" class="form-control" name="title"
                               value="{{ old('title', $about->title ?? '') }}"
                               placeholder="Entrer le titre">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Texte Titre</label>
                        <input type="text" class="form-control" name="title_text"
                               value="{{ old('title_text', $about->title_text ?? '') }}"
                               placeholder="Entrer le texte du titre">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sous-titre</label>
                        <input type="text" class="form-control" name="subtitle"
                               value="{{ old('subtitle', $about->subtitle ?? '') }}"
                               placeholder="Entrer le sous-titre">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4"
                                  placeholder="Entrer la description">{{ old('description', $about->description ?? '') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="image">
                        @if($about->image)
                            <img src="{{ asset($about->image) }}" alt="About" class="img-thumbnail mt-2" width="150">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">phrase 1</label>
                        <input type="text" class="form-control" name="button_text"
                               value="{{ old('button_text', $about->button_text ?? '') }}"
                               placeholder="Texte bouton">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">phrase 2</label>
                        <input type="text" class="form-control" name="button_link"
                               value="{{ old('button_link', $about->button_link ?? '') }}"
                               placeholder="Lien bouton">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">phrase 3</label>
                        <input type="text" class="form-control" name="phase"
                               value="{{ old('phase', $about->phase ?? '') }}"
                               placeholder="Lien bouton">
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
