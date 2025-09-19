@extends('backend.layouts.master')

@section('context')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Créer un nouvel abonnement</h3>
                <div class="card-actions">
                   
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('abonments.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" value="{{ old('nom') }}" placeholder="Enter abonment name">
                        @error('nom')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Prix</label>
                        <input type="text" class="form-control" name="prix" value="{{ old('prix') }}" placeholder="Enter price">
                        @error('prix')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre de Match</label>
                        <input type="text" class="form-control" name="nbrmatch" value="{{ old('nbrmatch') }}" placeholder="Enter number of matches">
                        @error('nbrmatch')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">desgin_card</label>
                        <input type="file" class="form-control" name="desgin_card">
                        @error('desgin_card')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">desgin_card 1</label>
                        <input type="file" class="form-control" name="image">
                        @error('image')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    

                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">
                            <!-- Save icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="icon icon-tabler icon-tabler-device-floppy">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M14 4v4h-6v-4" />
                            </svg>
                            Create Abonment
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
