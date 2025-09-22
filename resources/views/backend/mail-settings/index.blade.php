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
                <h3 class="card-title">Modifier les paramètres Mail</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('mail-settings.update',1) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">MAIL_MAILER</label>
                        <input type="text" class="form-control" name="MAIL_MAILER" value="{{ old('MAIL_MAILER', $mailSettings->MAIL_MAILER ?? '') }}">
                        @error('MAIL_MAILER')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">MAIL_HOST</label>
                        <input type="text" class="form-control" name="MAIL_HOST" value="{{ old('MAIL_HOST', $mailSettings->MAIL_HOST ?? '') }}">
                        @error('MAIL_HOST')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">MAIL_PORT</label>
                        <input type="text" class="form-control" name="MAIL_PORT" value="{{ old('MAIL_PORT', $mailSettings->MAIL_PORT ?? '') }}">
                        @error('MAIL_PORT')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">MAIL_USERNAME</label>
                        <input type="text" class="form-control" name="MAIL_USERNAME" value="{{ old('MAIL_USERNAME', $mailSettings->MAIL_USERNAME ?? '') }}">
                        @error('MAIL_USERNAME')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">MAIL_PASSWORD</label>
                        <input type="text" class="form-control" name="MAIL_PASSWORD" value="{{ old('MAIL_PASSWORD', $mailSettings->MAIL_PASSWORD ?? '') }}">
                        @error('MAIL_PASSWORD')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">MAIL_ENCRYPTION</label>
                        <input type="text" class="form-control" name="MAIL_ENCRYPTION" value="{{ old('MAIL_ENCRYPTION', $mailSettings->MAIL_ENCRYPTION ?? '') }}">
                        @error('MAIL_ENCRYPTION')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">MAIL_FROM_ADDRESS</label>
                        <input type="email" class="form-control" name="MAIL_FROM_ADDRESS" value="{{ old('MAIL_FROM_ADDRESS', $mailSettings->MAIL_FROM_ADDRESS ?? '') }}">
                        @error('MAIL_FROM_ADDRESS')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">MAIL_FROM_NAME</label>
                        <input type="text" class="form-control" name="MAIL_FROM_NAME" value="{{ old('MAIL_FROM_NAME', $mailSettings->MAIL_FROM_NAME ?? '') }}">
                        @error('MAIL_FROM_NAME')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 text-center">
                        <button class="btn btn-primary" type="submit">Mettre à jour les paramètres Mail</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
@endsection
