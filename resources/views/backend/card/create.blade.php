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
                <form action="{{ route('fan.cardstore') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">id</label>
                        <input type="text" class="form-control" name="id_qrcode" value="{{ old('id_qrcode') }}" placeholder="Enter id_qrcode">
                        @error('id_qrcode')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                     <div class="mb-3">
                        <label class="form-label">Abonment</label>
                        <select name="id_abonment" class="form-control" required>
                            <option value="">-- Select Abonment --</option>
                            @foreach($abonments as $abonment)
                            <option value="{{ $abonment->id }}">
                                {{ $abonment->nom }} - {{ $abonment->prix }} DA ({{ $abonment->nbrmatch }} matchs)
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <button id="submitBtn" class="btn btn-primary" type="submit">
                            <span id="btnText">Créer un fan</span>
                            <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2" role="status" aria-hidden="true"></span>
                        </button>
                    </div>
                       
                  
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
