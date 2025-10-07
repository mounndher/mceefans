@extends('backend.layouts.master')

@section('context')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tester QR Codes</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('tickets.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Nombre de tickets</label>
                        <input type="number" name="count" class="form-control" min="1"  value="{{ request('count',1) }}">
                    </div>
                    <div class="mb-3">
                        <label>Prix</label>
                        <input type="number" name="price" class="form-control" min="0" value="{{ request('price',1) }}">
                    </div>
                    <div class="mb-3">
                        <label>Événement</label>
                        <select name="id_event" class="form-control">
                            <option value="">-- Sélectionnez un événement --</option>
                            @foreach($events as $event)
                                <option value="{{ $event->id }}" {{ request('id_event')==$event->id?'selected':'' }}>{{ $event->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">Tester</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
