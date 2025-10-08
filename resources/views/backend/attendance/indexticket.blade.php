@extends('backend.layouts.master')

@section('context')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Liste de présence des Tickets</h3>

                <!-- 🔎 Search Form -->
                <form method="GET" action="{{ route('attendanceTickets.index') }}" class="d-flex">
                    <input type="text" name="search" class="form-control me-2"
                           placeholder="Chercher..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Chercher</button>
                </form>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>QR Code</th>
                                <th>Numéro Ticket</th>
                                <th>Événement</th>
                                <th>Appareil</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->id }}</td>
                                    <td>{{ $attendance->ticket->id_qrcode ?? 'N/A' }}</td>
                                    <td>{{ $attendance->ticket->ticket_number ?? 'N/A' }}</td>
                                    <td>{{ $attendance->event->nom ?? 'N/A' }}</td>
                                    <td>{{ $attendance->appareil->nom_utilisateur ?? 'N/A' }}</td>
                                    <td>{{ $attendance->status }}</td>
                                    <td>{{ optional($attendance->created_at)->format('Y-m-d H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Aucun enregistrement trouvé</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $attendances->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
