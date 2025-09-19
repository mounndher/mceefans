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
                <h3 class="card-title">créer un nouveau fan</h3>
               
            </div>

            <div class="card-body">
                <form action="{{ route('fans.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf



                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" value="{{ old('nom') }}" placeholder="Entrez le nom de famille">
                        @error('nom') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text" class="form-control" name="prenom" value="{{ old('prenom') }}" placeholder="Entrez le prénom">
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
                        <label class="form-label">Image DE CCART NATIONAL</label>
                        <input type="file" class="form-control" name="imagecart">
                        @error('imagecart') <div class="text-danger small">{{ $message }}</div> @enderror
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
                        <button class="btn btn-primary" type="submit">créer un fan</button>
                    </div>
                </form>



            </div>

        </div>
    </div>
</div>
@endsection
