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
                <h3 class="card-title">Modifier la section Contact</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('contact.update',1) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Titre</label>
                        <input type="text" class="form-control" name="title"
                               value="{{ old('title', $contact->title ?? '') }}"
                               placeholder="Entrer le titre">
                        @error('title')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sous-titre</label>
                        <input type="text" class="form-control" name="subtitle"
                               value="{{ old('subtitle', $contact->subtitle ?? '') }}"
                               placeholder="Entrer le sous-titre">
                        @error('subtitle')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="mb-3">
                        <label class="form-label">Téléphone</label>
                        <input type="text" class="form-control" name="phone"
                               value="{{ old('phone', $contact->phone ?? '') }}"
                               placeholder="Numéro de téléphone">
                        @error('phone')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Texte Téléphone</label>
                        <input type="text" class="form-control" name="phone_text"
                               value="{{ old('phone_text', $contact->phone_text ?? '') }}"
                               placeholder="Texte téléphone">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Icône Téléphone (classe CSS)</label>
                        <input type="text" class="form-control" name="phone_icon"
                               value="{{ old('phone_icon', $contact->phone_icon ?? '') }}"
                               placeholder="ex: fa fa-phone">
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" name="email"
                               value="{{ old('email', $contact->email ?? '') }}"
                               placeholder="Adresse email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Texte Email</label>
                        <input type="text" class="form-control" name="email_text"
                               value="{{ old('email_text', $contact->email_text ?? '') }}"
                               placeholder="Texte email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Icône Email (classe CSS)</label>
                        <input type="text" class="form-control" name="email_icon"
                               value="{{ old('email_icon', $contact->email_icon ?? '') }}"
                               placeholder="ex: fa fa-envelope">
                    </div>

                    <!-- Location -->
                    <div class="mb-3">
                        <label class="form-label">Adresse</label>
                        <input type="text" class="form-control" name="location"
                               value="{{ old('location', $contact->location ?? '') }}"
                               placeholder="Adresse">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Texte Adresse</label>
                        <input type="text" class="form-control" name="location_text"
                               value="{{ old('location_text', $contact->location_text ?? '') }}"
                               placeholder="Texte adresse">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Icône Adresse (classe CSS)</label>
                        <input type="text" class="form-control" name="location_icon"
                               value="{{ old('location_icon', $contact->location_icon ?? '') }}"
                               placeholder="ex: fa fa-map-marker">
                    </div>

                    <div class="mb-3 text-center">
                        <button class="btn btn-primary" type="submit">Mettre à jour Contact</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
@endsection
