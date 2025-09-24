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
                <h3 class="card-title">Modifier la section Features</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('features.update',1) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $feature->title ?? '') }}" placeholder="Enter title">
                        @error('title')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Big Title</label>
                        <textarea class="form-control" name="bigtitle" rows="2">{{ old('bigtitle', $feature->bigtitle ?? '') }}</textarea>
                        @error('bigtitle')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="decription" rows="3">{{ old('decription', $feature->decription ?? '') }}</textarea>
                        @error('decription')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Linge and Subtitle Fields --}}
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="mb-3">
                            <label class="form-label">Linge {{ $i }}</label>
                            <input type="text" class="form-control" name="linge{{ $i }}" value="{{ old('linge'.$i, $feature->{'linge'.$i} ?? '') }}">
                            @error('linge'.$i)
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Subtitle {{ $i }}</label>
                            <input type="text" class="form-control" name="subtitle{{ $i }}" value="{{ old('subtitle'.$i, $feature->{'subtitle'.$i} ?? '') }}">
                            @error('subtitle'.$i)
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    @endfor

                    <div class="mb-3 text-center">
                        <button class="btn btn-primary" type="submit">Update Feature</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
@endsection
