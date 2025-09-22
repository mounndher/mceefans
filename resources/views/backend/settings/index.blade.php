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
                <h3 class="card-title">Modifier les paramètres du site</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('settings.update', $setting->id ?? 1) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST') <!-- Si tu veux utiliser PUT, change en PUT et ajoute @method('PUT') -->

                    <!-- Nom du site -->
                    <div class="mb-3">
                        <label class="form-label">Nom du site</label>
                        <input type="text" class="form-control" name="site_name"
                               value="{{ old('site_name', $setting->site_name ?? '') }}"
                               placeholder="Nom du site">
                        @error('site_name')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"
                                  placeholder="Description">{{ old('description', $setting->description ?? '') }}</textarea>
                        @error('description')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Logo du site -->
                    <div class="mb-3">
                        <label class="form-label">Logo du site</label>
                        <input type="file" class="form-control" name="site_logo">
                        @if(!empty($setting->site_logo))
                        <div class="mt-2">
                            <img src="{{ asset($setting->site_logo) }}" alt="Logo du site" width="150">
                        </div>
                        @endif
                        @error('site_logo')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Favicon -->
                    <div class="mb-3">
                        <label class="form-label">Favicon</label>
                        <input type="file" class="form-control" name="site_favicon">
                        @if(!empty($setting->site_favicon))
                        <div class="mt-2">
                            <img src="{{ asset($setting->site_favicon) }}" alt="Favicon" width="50">
                        </div>
                        @endif
                        @error('site_favicon')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 text-center">
                        <button class="btn btn-primary" type="submit">Mettre à jour les paramètres</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
