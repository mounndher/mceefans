@extends('backend.layouts.master')
@section('context')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Statistics
                    </div>
                    
                </div>
                <!-- Page title actions -->

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
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
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
                            <div class="col-sm-6 col-lg-3 mt-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-primary text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
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
                            {{-- Total Fans --}}


                        </div>

                    </div>
                </div>
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

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    // البيانات من Laravel
                    const percentagePresent = {{ $percentagePresent }};
                    const percentageAbsent = {{ $percentageAbsent }};

                    // Chart الحضور
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
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }
                    });

                    // Chart الغياب
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
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }
                    });
                </script>







                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Doublons </h3>
                        </div>

                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                       
                                        <th>Nom</th>
                                        <th>Événement</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($scannedTwiceFans as $index => $attendance)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                           
                                            <td>{{ $attendance->fan->nom }}</td>
                                            <td>{{ $event->nom ?? 'N/A' }}</td>
                                            <td>
                                                <span class="badge bg-info">Scanné deux fois</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">
                                                No fans scanned twice.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
