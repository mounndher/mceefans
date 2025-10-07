@extends('backend.layouts.master')
@section('context')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    Statistics
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">

            <div class="col-12">
                <div class="row row-cards">
                    <div class="row">
                        {{-- Checked In --}}
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-success text-white avatar">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M5 12l5 5l10 -10" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{ $stats->checked_in }} Présents
                                            </div>
                                            <div class="text-secondary">
                                                Participants enregistrés
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Absent --}}
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-danger text-white avatar">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M6 6l12 12m0 -12l-12 12" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{ $stats->absent }} Absents
                                            </div>
                                            <div class="text-secondary">
                                                Participants manquants
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- QR Invalid --}}
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-warning text-white avatar">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 9v2m0 4v.01" />
                                                    <path
                                                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7 -12.25a2 2 0 0 0 -3.68 0l-7 12.25a2 2 0 0 0 1.84 2.75" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{ $stats->qr_invalid }} QR invalide
                                            </div>
                                            <div class="text-secondary">
                                                Code non valide
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Scanned Twice --}}
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-info text-white avatar">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7l10 10m0 -10l-10 10" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{ $stats->scanned_twice }} Doublons
                                            </div>
                                            <div class="text-secondary">
                                                Scanné deux fois
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Expired --}}
                        <div class="col-sm-6 col-lg-3 mt-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-secondary text-white avatar">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 8v4l3 3" />
                                                    <path d="M12 20a8 8 0 1 0 -8 -8a8 8 0 0 0 8 8z" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{ $stats->expired }} Expirés
                                            </div>
                                            <div class="text-secondary">
                                                Billets expirés
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Total Fans --}}
                        <div class="col-sm-6 col-lg-3 mt-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary text-white avatar">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                                    <path d="M16 11h6m-3 -3v6" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{ $fan }} Fans
                                            </div>
                                            <div class="text-secondary">
                                                Nombre total des fans
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> {{-- row --}}
                </div>
            </div>

            {{-- Charts --}}
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">Presence Percentage</h4>
                        <div class="ratio ratio-21x9 d-flex align-items-center justify-content-center">
                            <canvas id="presentChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">Absence Percentage</h4>
                        <div class="ratio ratio-21x9 d-flex align-items-center justify-content-center">
                            <canvas id="absenceChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Chart.js --}}
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const percentagePresent = {{ json_encode($percentagePresent) }};
                const percentageAbsent = {{ json_encode($percentageAbsent) }};

                new Chart(document.getElementById('presentChart'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Present', 'Others'],
                        datasets: [{
                            data: [percentagePresent, 100 - percentagePresent],
                            backgroundColor: ['#4caf50', '#e0e0e0']
                        }]
                    },
                    options: {
                        plugins: {
                            legend: { position: 'bottom' }
                        }
                    }
                });

                new Chart(document.getElementById('absenceChart'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Absent', 'Others'],
                        datasets: [{
                            data: [percentageAbsent, 100 - percentageAbsent],
                            backgroundColor: ['#f44336', '#e0e0e0']
                        }]
                    },
                    options: {
                        plugins: {
                            legend: { position: 'bottom' }
                        }
                    }
                });
            </script>

            {{-- Stats par appareil --}}
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Statistiques par appareil</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Utilisateur</th>
                                    <th>Présent</th>
                                    <th>QR invalide</th>
                                    <th>Scanné deux fois</th>
                                    <th>Expiré</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($perAppareilStats as $index => $stat)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $stat->appareil->nom_utilisateur ?? 'Inconnu' }}</td>
                                    <td>{{ $stat->checked_in }}</td>
                                    <td>{{ $stat->qr_invalid }}</td>
                                    <td>{{ $stat->scanned_twice }}</td>
                                    <td>{{ $stat->expired }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">
                                        Aucune statistique disponible pour les appareils.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Doublons --}}
          <div class="col-12 mt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Liste de présence</h3>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nom</th>
                        <th>prenom</th>
                        <th>téléphone</th>
                        <th>id_qr</th>
                        <th>Événement</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($allAttendances as $index => $attendance)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $attendance->fan->nom ?? 'N/A' }}</td>
                        <td>{{ $attendance->fan->prenom ?? 'N/A' }}</td>
                        <td>{{ $attendance->fan->numero_tele ?? 'N/A' }}</td>
                        <td>{{ $attendance->fan->id_qrcode ?? 'N/A' }}</td>
                        <td>{{ $attendance->event->nom ?? 'N/A' }}</td>
                        <td>
                            @php
                                $status = $attendance->status ?? 'absent';
                            @endphp

                            @if($status === 'checked_in')
                                <span class="badge bg-success">Présent</span>
                            @elseif($status === 'scanned_twice')
                                <span class="badge bg-warning text-dark">Scanné deux fois</span>
                            @elseif($status === 'expired')
                                <span class="badge bg-info">Expiré</span>
                            @elseif($status === 'qr_invalid')
                                <span class="badge bg-danger">QR invalide</span>
                            @elseif($status === 'absent')
                                <span class="badge bg-danger">Absent</span>
                            @else
                                <span class="badge bg-info">{{ ucfirst($status) }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            No attendance records.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


        </div> {{-- row --}}
    </div>
</div>
@endsection
