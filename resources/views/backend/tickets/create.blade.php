@extends('backend.layouts.master')

@section('context')
<div class="page-body">
    <div class="container-xl">

        <!-- Event Info -->
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">🎟️ Create Tickets for Event: <strong>{{ $event->nom }}</strong></h3>
            </div>
            <div class="card-body">
                <form id="ticketForm"  action="{{ route('tickets.store') }}" method="POST" target="_blank">
                    @csrf
                    <input type="hidden" name="id_event" value="{{ $event->id }}">

                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Number of Tickets</label>
                            <input type="number" name="count" class="form-control" min="1" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Ticket Price</label>
                            <input type="number" name="price" step="0.01" class="form-control" required>
                        </div>

                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 5v14m-7 -7h14" />
                                </svg>
                                Generate Tickets PDF
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tickets Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">🎫 All Tickets for this Event</h3>
            </div>

            <div class="card-body">
                @if($tickets->isEmpty())
                    <p class="text-center text-muted">No tickets generated yet for this event.</p>
                @else
                <div class="table-responsive">
                    <table class="table table-vcenter">
                        <thead>
                            <tr>
                                <th>ID</th>
                            
                                <th>Price</th>
                                <th>QR Code</th>
                                <th>Status</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->id }}</td>
                               
                                <td>{{ $ticket->price }} DA</td>
                                <td>
                                @if($ticket->qr_svg)
    <div style="width: 100px; height: 100px;">
        {!! base64_decode(str_replace('data:image/svg+xml;base64,', '', $ticket->qr_svg)) !!}
    </div>
@else
    <span class="text-muted">No QR available</span>
@endif


                                </td>
                                <td>
                                    <span class="badge bg-{{ $ticket->status == 'used' ? 'danger' : 'success' }}">
                                        {{ ucfirst($ticket->status ?? 'active') }}
                                    </span>
                                </td>
                                <td>{{ $ticket->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>

    </div>
</div>
<script>
document.getElementById('ticketForm').addEventListener('submit', function() {
    // Wait a moment to allow PDF to open, then reload the page
    setTimeout(() => {
        window.location.reload();
    }, 1000);
});
</script>
@endsection
