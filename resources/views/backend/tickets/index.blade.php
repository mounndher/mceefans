@extends('backend.layouts.master')

@section('context')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Liste des tickets</h3>
            </div>
            <div class="card-body">
                @if($Ticket->count())
                    <div class="row">
                        @foreach($Ticket as $ticket)
                            <div class="col-md-3 mb-4">
                                <div class="card p-2 text-center">
                                    <img src="{{ asset($ticket->imgticket) }}" alt="Ticket {{ $ticket->id }}" class="img-fluid mb-2">
                                    <p><strong>ID Ticket:</strong> {{ $ticket->id }}</p>
                                    <p><strong>Code:</strong> {{ $ticket->id_qrcode }}</p>
                                    <p><strong>Événement:</strong> {{ $ticket->event->nom ?? 'N/A' }}</p>
                                    <p><strong>QR Code:</strong></p>
                                    <img src="{{ asset($ticket->qr_image) }}" alt="QR Code" style="width:120px;height:120px;">
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>Aucun ticket trouvé.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
