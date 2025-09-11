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
                <h3 class="card-title">Card and QR Code</h3>
                <div class="card-actions">
                    <a href="{{ route('fans.index') }}" class="btn btn-primary">
                        Back
                    </a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('generate.card.preview') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nin</label>
                        <input type="text" class="form-control" name="nin" value="{{ old('nin') }}" placeholder="Enter nin">
                        @error('nin') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Telephone</label>
                        <input type="text" class="form-control" name="numero_tele" value="{{ old('numero_tele') }}" placeholder="Enter phone">
                        @error('numero_tele') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Check</button>
                    </div>
                </form>

                {{-- ✅ عرض الكارت و QR لو موجود --}}
                @isset($card_url)
                    <div class="mt-4">
                        <h4>Generated Card</h4>
                        <img src="{{ $card_url }}" alt="Fan Card" class="img-fluid rounded shadow">
                    </div>
                @endisset

                @isset($qr_code_url)
                    <div class="mt-4">
                        <h4>QR Code</h4>
                        <img src="{{ $qr_code_url }}" alt="QR Code" class="img-fluid rounded shadow" width="200">
                    </div>
                @endisset

            </div>
        </div>
    </div>
</div>
@endsection
