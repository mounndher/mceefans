@extends('backend.layouts.master')

@section('context')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create New Fan</h3>
                <div class="card-actions">
                    <a href="{{ route('fans.index') }}" class="btn btn-primary">
                        <!-- Back icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-arrow-left">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l14 0" />
                            <path d="M5 12l6 6" />
                            <path d="M5 12l6 -6" />
                        </svg>
                        Back
                    </a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('fans.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                   

                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" value="{{ old('nom') }}" placeholder="Enter last name">
                        @error('nom') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text" class="form-control" name="prenom" value="{{ old('prenom') }}" placeholder="Enter first name">
                        @error('prenom') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">NIN</label>
                        <input type="text" class="form-control" name="nin" value="{{ old('nin') }}" placeholder="Enter NIN">
                        @error('nin') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Numéro Téléphone</label>
                        <input type="text" class="form-control" name="numero_tele" value="{{ old('numero_tele') }}" placeholder="Enter phone number">
                        @error('numero_tele') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date de Naissance</label>
                        <input type="date" class="form-control" name="date_de_nai" value="{{ old('date_de_nai') }}">
                        @error('date_de_nai') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="image">
                        @error('image') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Abonment</label>
                        <select name="id_abonment" class="form-control" required>
                            <option value="">-- Select Abonment --</option>
                            @foreach($abonments as $abonment)
                            <option value="{{ $abonment->id }}" {{ old('id_abonment') == $abonment->id ? 'selected' : '' }}>
                                {{ $abonment->nom }} - {{ $abonment->prix }} DA ({{ $abonment->nbrmatch }} matchs)
                            </option>
                            @endforeach
                        </select>
                        @error('id_abonment') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Create Fan</button>
                    </div>
                </form>



            </div>

        </div>
    </div>
</div>
@endsection
