@extends('backend.layouts.master')

@section('context')
<div class="page-body">
    <div class="container-xl">

        <!-- Event Info -->
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">
                    🎟️ Create Tickets for Event: <strong>{{ $event->nom }}</strong>
                </h3>
            </div>
            <div class="card-body">
                <form id="ticketForm" action="{{ route('tickets.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_event" value="{{ $event->id }}">

                    <div class="row">
                        <!-- 🟢 Ticket Count -->
                        <div class="col-md-4">
                            <label class="form-label">Number of Tickets</label>
                            <input type="number" name="count" class="form-control" min="1" required
                                value="{{ old('count', session('last_ticket_count', 1)) }}">
                        </div>

                        <!-- 🟢 Ticket Price -->
                        <div class="col-md-4">
                            <label class="form-label">Ticket Price (DZD)</label>
                            <input type="number" name="price" class="form-control" step="0.01" required
                                value="{{ old('price', session('last_ticket_price', 0)) }}">
                        </div>

                        <div class="col-md-4 align-self-end">
                            <button type="submit" class="btn btn-primary w-100">
                                Generate Tickets
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
                @if ($tickets->isEmpty())
                    <p class="text-center text-muted">No tickets generated yet for this event.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-vcenter">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Price</th>
                                    <th>QR Code</th>
                                    <th></th>
                                    <th>Status</th>
                                    <th>Présent</th> {{-- ✅ New column --}}
                                    <th>User</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td>{{ $ticket->ticket_number }}</td>

                                        <td>{{ $ticket->price }} DA</td>

                                        <td>
                                            @if ($ticket->qr_svg)
                                                <div style="width: 100px; height: 100px;">
                                                    {!! base64_decode(str_replace('data:image/svg+xml;base64,', '', $ticket->qr_svg)) !!}
                                                </div>
                                            @else
                                                <span class="text-muted">No QR available</span>
                                            @endif
                                        </td>
                                        <td>
    <a href="{{ route('tickets.print', $ticket->id) }}"
       target="_blank"
       class="btn btn-sm btn-secondary">
        🖨️ Print
    </a>
</td>


                                        <td>
                                            <button
                                                class="btn btn-sm toggle-status {{ $ticket->status === 'active' ? 'btn-success' : 'btn-danger' }}"
                                                data-id="{{ $ticket->id }}">
                                                {{ ucfirst($ticket->status) }}
                                            </button>
                                        </td>

                                        <td>
                                            @if ($ticket->attendanceTickets->where('status', 'checked_in')->isNotEmpty())
                                                <span class="badge bg-info">Présent</span>
                                            @else
                                                <span class="badge bg-warning text-darky">Non utilisé</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($ticket->user)
                                                <div>
                                                    <strong>{{ $ticket->user->name }}</strong><br>
                                                    <small class="text-muted">{{ $ticket->user->email }}</small>
                                                </div>
                                            @else
                                                <span class="text-muted">No user assigned</span>
                                            @endif
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

{{-- ✅ Auto refresh after generating tickets --}}
<script>
    document.getElementById('ticketForm').addEventListener('submit', function() {
        setTimeout(() => {
            window.location.reload();
        }, 1000);
    });
</script>

{{-- ✅ Toggle ticket status --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.toggle-status');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const ticketId = this.dataset.id;
                const btn = this;

                fetch(`/tickets/${ticketId}/toggle-status`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            if (data.new_status === 'active') {
                                btn.classList.remove('btn-danger');
                                btn.classList.add('btn-success');
                                btn.textContent = 'Active';
                            } else {
                                btn.classList.remove('btn-success');
                                btn.classList.add('btn-danger');
                                btn.textContent = 'Annuler';
                            }
                            alert(data.message);
                        }
                    })
                    .catch(err => console.error('Error:', err));
            });
        });
    });
</script>
@endsection
