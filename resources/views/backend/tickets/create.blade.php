@extends('backend.layouts.master')

@section('context')
    <div class="page-body">
        <div class="container-xl">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Event Info -->
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">🎟️ Create Tickets for Event: <strong>{{ $event->nom }}</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('tickets.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_event" value="{{ $event->id }}">

                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Number of Tickets</label>
                                <input type="number" name="count" class="form-control" min="1" max="100" value="1" required>
                                <small class="text-muted">Max 100 tickets per print</small>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Ticket Price (DZD)</label>
                                <input type="number" name="price" step="0.01" class="form-control" required>
                            </div>

                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100" id="printBtn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                        <rect x="7" y="13" width="10" height="8" rx="2" />
                                    </svg>
                                    Create & Print Tickets
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
                    <div class="card-subtitle">Total: {{ $tickets->count() }} tickets</div>
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
                                        <th>Status</th>
                                        <th>User</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->id }}</td>
                                            <td>{{ number_format($ticket->price, 2) }} DZD</td>
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
                                                <button 
                                                    class="btn btn-sm toggle-status 
                                                        {{ $ticket->status === 'active' ? 'btn-success' : 'btn-danger' }}" 
                                                    data-id="{{ $ticket->id }}">
                                                    {{ ucfirst($ticket->status) }}
                                                </button>
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

    <script>
        document.getElementById('ticketForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('printBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Creating & Printing...';
        });

        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.toggle-status');

            buttons.forEach(button => {
                button.addEventListener('click', function () {
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
                                btn.textContent = 'Cancelled';
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