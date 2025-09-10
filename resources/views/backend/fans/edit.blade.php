@extends('backend.layouts.master')

@section('context')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Fan</h3>
                <div class="card-actions">
                    <a href="{{ route('fans.index') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
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
                <form action="{{ route('fans.update', $fan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" value="{{ old('nom', $fan->nom) }}">
                        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text" class="form-control" name="prenom" value="{{ old('prenom', $fan->prenom) }}">
                        <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">NIN</label>
                        <input type="text" class="form-control" name="nin" value="{{ old('nin', $fan->nin) }}">
                        <x-input-error :messages="$errors->get('nin')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Téléphone</label>
                        <input type="text" class="form-control" name="numero_tele" value="{{ old('numero_tele', $fan->numero_tele) }}">
                        <x-input-error :messages="$errors->get('numero_tele')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date de Naissance</label>
                        <input type="date" class="form-control" name="date_de_nai" value="{{ old('date_de_nai', $fan->date_de_nai) }}">
                        <x-input-error :messages="$errors->get('date_de_nai')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">QR_CODE IMAGE</label>

                        <!-- Display the card image -->
                        @if(!empty($fan->qr_img))
                        <div class="mb-2">
                            <img src="{{ asset($fan->qr_img) }}" alt="Fan Card" style="max-width: 300px; border: 1px solid #ccc; border-radius: 8px;">
                        </div>
                        @endif

                        <!-- Optional: hidden input to keep the card path -->
                        <input type="hidden" name="card" value="{{ $fan->card }}">

                        <x-input-error :messages="$errors->get('card')" class="mt-2" />
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Image</label><br>
                        @if ($fan->image)
                        <img src="{{ asset($fan->image) }}" width="100" class="mb-2">
                        @endif
                        <input type="file" class="form-control" name="image">
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image Cart</label><br>
                        @if ($fan->imagecart)
                        <img src="{{ asset('uploads/fans/'.$fan->imagecart) }}" width="100" class="mb-2">
                        @endif
                        <input type="file" class="form-control" name="imagecart">
                        <x-input-error :messages="$errors->get('imagecart')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M14 4l0 4l-6 0l0 -4" />
                            </svg>
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

