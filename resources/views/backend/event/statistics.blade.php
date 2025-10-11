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

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                        <li class="nav-item">
                            <a href="#tabs-fan" class="nav-link active" data-bs-toggle="tab">Fan</a>
                        </li>
                        <li class="nav-item">
                            <a href="#tabs-ticket" class="nav-link" data-bs-toggle="tab">Ticket</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <!-- ONGLET FAN -->
                        <div class="tab-pane active show" id="tabs-fan">
                            <h4>Fan Tab</h4>
                            <div class="page-body">
                                <div class="container-xl">
                                    <div class="row row-deck row-cards">
                                        <!-- Stats cards pour Fan -->
                                        <div class="col-12">
    <div class="row row-cards">

        {{-- ✅ Checked In --}}
        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm shadow-sm">
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
                            <div class="fw-bold">{{ $stats->checked_in }} Présents</div>
                            <div class="text-secondary">Fans enregistrés</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ❌ Absent --}}
        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm shadow-sm">
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
                            <div class="fw-bold">{{ $stats->absent }} Absents</div>
                            <div class="text-secondary">Fans manquants</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ⚠️ QR Invalid --}}
        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm shadow-sm">
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
                            <div class="fw-bold">{{ $stats->qr_invalid }} QR invalide</div>
                            <div class="text-secondary">Code non valide</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 🔁 Scanned Twice --}}
        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm shadow-sm">
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
                            <div class="fw-bold">{{ $stats->scanned_twice }} Doublons</div>
                            <div class="text-secondary">Scanné deux fois</div>
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

        {{-- 👥 Total Fans --}}
        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm shadow-sm">
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
                            <div class="fw-bold">{{ $fan }} Fans</div>
                            <div class="text-secondary">Nombre total des fans</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


                                        <!-- GRAPHIQUES FAN - BAR CHARTS -->
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title text-center">Fan - Statistiques Présence</h4>
                                                    <div
                                                        class="ratio ratio-21x9 d-flex align-items-center justify-content-center">
                                                        <canvas id="fanPresentChart"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title text-center">Fan - Répartition des Statuts</h4>
                                                    <div
                                                        class="ratio ratio-21x9 d-flex align-items-center justify-content-center">
                                                        <canvas id="fanAbsenceChart"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Statistiques par appareil Fan -->
                                        <div class="col-12 mt-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Statistiques par appareil - Fan</h3>
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
                                                                    <td>{{ $stat->appareil->nom_utilisateur ?? 'Inconnu' }}
                                                                    </td>
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

                                        <!-- Liste de présence Fan -->
                                        <div class="col-12 mt-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Liste de présence - Fan</h3>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table card-table table-vcenter text-nowrap datatable">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Nom</th>
                                                                <th>Prénom</th>
                                                                <th>Téléphone</th>
                                                                <th>ID QR</th>
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
                                                                    <td>
                                                                        @php
                                                                            $status = $attendance->status ?? 'absent';
                                                                        @endphp
                                                                        @if ($status === 'checked_in')
                                                                            <span class="badge bg-success">Présent</span>
                                                                        @elseif($status === 'scanned_twice')
                                                                            <span class="badge bg-warning text-dark">Scanné
                                                                                deux fois</span>
                                                                        @elseif($status === 'expired')
                                                                            <span class="badge bg-info">Expiré</span>
                                                                        @elseif($status === 'qr_invalid')
                                                                            <span class="badge bg-danger">QR
                                                                                invalide</span>
                                                                        @elseif($status === 'absent')
                                                                            <span class="badge bg-danger">Absent</span>
                                                                        @else
                                                                            <span
                                                                                class="badge bg-info">{{ ucfirst($status) }}</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="6" class="text-center text-muted">
                                                                        Aucune donnée de présence.
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
                        </div>

                        <!-- ONGLET TICKET -->
                        <div class="tab-pane" id="tabs-ticket">
                            <h4>Ticket Tab</h4>
                            <div class="page-body">
                                <div class="container-xl">
                                    <div class="row row-deck row-cards">
                                        <!-- Stats cards pour Ticket -->
                                        <div class="col-12">
    <div class="row row-cards">
        <div class="row">

            {{-- ✅ Checked In Tickets --}}
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
                                    {{ $statss->checked_in }} Tickets Valides
                                </div>
                                <div class="text-secondary">
                                    Billets validés
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ❌ Absent Tickets --}}
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
                                    {{ $statss->absent }} Tickets Non-utilisés
                                </div>
                                <div class="text-secondary">
                                    Billets non validés
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ⚠️ QR Invalid --}}
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
                                    {{ $statss->qr_invalid }} QR Invalide
                                </div>
                                <div class="text-secondary">
                                    Code ticket non valide
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 🧾 Total Tickets --}}
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-primary text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M3 7v4a1 1 0 0 0 1 1h16a1 1 0 0 0 1 -1v-4a1 1 0 0 0 -1 -1h-16a1 1 0 0 0 -1 1z" />
                                        <path d="M8 7v-2a2 2 0 1 1 4 0v2" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ $totalTickets }} Tickets
                                </div>
                                <div class="text-secondary">
                                    Nombre total de tickets
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 💰 Total Prix des Tickets Actifs --}}
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-success text-white avatar">
                                    💰
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ number_format($totalActivePrice, 2) }} DA
                                </div>
                                <div class="text-secondary">
                                    Total prix des tickets actifs
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 🟢 Tickets Actifs --}}
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-success text-white avatar">🟢</span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ $totalActiveTickets }} Tickets Actifs
                                </div>
                                <div class="text-secondary">
                                    Statut actif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 🔴 Tickets Annulés --}}
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-danger text-white avatar">🔴</span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ $totalAnnulledTickets }} Tickets Annulés
                                </div>
                                <div class="text-secondary">
                                    Statut annulé
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


                                        <!-- GRAPHIQUES TICKET - DOUGHNUT CHARTS -->
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title text-center">Ticket - Distribution des Statuts
                                                    </h4>
                                                    <div
                                                        class="ratio ratio-21x9 d-flex align-items-center justify-content-center">
                                                        <canvas id="ticketPresentChart"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title text-center">Ticket - Répartition de Validité
                                                    </h4>
                                                    <div
                                                        class="ratio ratio-21x9 d-flex align-items-center justify-content-center">
                                                        <canvas id="ticketAbsenceChart"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Statistiques par appareil Ticket -->
                                        <div class="col-12 mt-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Statistiques par appareil - Ticket</h3>
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
                                                            @forelse($perAppareilStatsTickets as $index => $stat)
                                                                <tr>
                                                                    <td>{{ $index + 1 }}</td>
                                                                    <td>{{ $stat->appareil->nom_utilisateur ?? 'Inconnu' }}
                                                                    </td>
                                                                    <td>{{ $stat->checked_in }}</td>
                                                                    <td>{{ $stat->qr_invalid }}</td>
                                                                    <td>{{ $stat->scanned_twice }}</td>
                                                                    <td>{{ $stat->expired }}</td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="6" class="text-center text-muted">
                                                                        Aucune statistique disponible pour les tickets.
                                                                    </td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Liste des tickets -->
                                        <div class="col-12 mt-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Liste des Tickets</h3>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table card-table table-vcenter text-nowrap datatable">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Utilisateur</th>
                                                                <th>Code Ticket</th>
                                                                <th>Événement</th>
                                                                <th>Statut</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse($allAttendancesTickets as $index => $attendance)
                                                                <tr>
                                                                    <td>{{ $index + 1 }}</td>
                                                                    <td>{{ $attendance->ticket->user->name ?? 'N/A' }}</td>
                                                                    <td>{{ $attendance->ticket->ticket_code ?? 'N/A' }}
                                                                    </td>
                                                                    <td>{{ $attendance->event->nom ?? 'N/A' }}</td>
                                                                    <td>
                                                                        @php
                                                                            $status = $attendance->status ?? 'absent';
                                                                        @endphp
                                                                        @if ($status === 'checked_in')
                                                                            <span class="badge bg-success">Validé</span>
                                                                        @elseif($status === 'scanned_twice')
                                                                            <span class="badge bg-warning text-dark">Scanné
                                                                                deux fois</span>
                                                                        @elseif($status === 'expired')
                                                                            <span class="badge bg-info">Expiré</span>
                                                                        @elseif($status === 'qr_invalid')
                                                                            <span class="badge bg-danger">QR
                                                                                invalide</span>
                                                                        @elseif($status === 'absent')
                                                                            <span class="badge bg-danger">Non-utilisé</span>
                                                                        @else
                                                                            <span
                                                                                class="badge bg-info">{{ ucfirst($status) }}</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="5" class="text-center text-muted">
                                                                        Aucune donnée de tickets.
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script avec données dynamiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Variables de données Fan
        const percentagePresent = {{ json_encode($percentagePresent) }};
        const percentageAbsent = {{ json_encode($percentageAbsent) }};
        const fanStats = {
            checked_in: {{ $stats->checked_in }},
            absent: {{ $stats->absent }},
            qr_invalid: {{ $stats->qr_invalid }},
            scanned_twice: {{ $stats->scanned_twice }},
            expired: {{ $stats->expired }},
            total: {{ $fan }}
            };

        // Variables de données Ticket
        const percentagePresentTickets = {{ json_encode($percentagePresentTickets) }};
        const percentageAbsentTickets = {{ json_encode($percentageAbsentTickets) }};
        const ticketStats = {
            checked_in: {{ $statss->checked_in }},
            absent: {{ $statss->absent }},
            qr_invalid: {{ $statss->qr_invalid }},
            scanned_twice: {{ $statss->scanned_twice }},
            expired: {{ $statss->expired }},
            total: {{ $totalTickets }}
            };

        // Variables pour stocker les instances des graphiques
        let fanPresentChart, fanAbsenceChart, ticketPresentChart, ticketAbsenceChart;

        // Fonction pour initialiser les graphiques Fan (BAR CHARTS)
        function initFanCharts() {
            const fanPresentCtx = document.getElementById('fanPresentChart');
            const fanAbsenceCtx = document.getElementById('fanAbsenceChart');

            if (fanPresentCtx && !fanPresentChart) {
                fanPresentChart = new Chart(fanPresentCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Présents', 'Absents', 'Total'],
                        datasets: [{
                            label: 'Nombre de Fans',
                            data: [
                                fanStats.checked_in,
                                fanStats.absent,
                                fanStats.total
                            ],
                            backgroundColor: [
                                '#28a745',
                                '#dc3545',
                                '#007bff'
                            ],
                            borderColor: [
                                '#1e7e34',
                                '#c82333',
                                '#0056b3'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            if (fanAbsenceCtx && !fanAbsenceChart) {
                fanAbsenceChart = new Chart(fanAbsenceCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['QR Invalide', 'Scanné 2x', 'Expirés', 'Autres'],
                        datasets: [{
                            data: [
                                fanStats.qr_invalid,
                                fanStats.scanned_twice,
                                fanStats.expired,
                                fanStats.total - (fanStats.qr_invalid + fanStats.scanned_twice +
                                    fanStats.expired)
                            ],
                            backgroundColor: [
                                '#ffc107',
                                '#17a2b8',
                                '#6c757d',
                                '#28a745'
                            ],
                            borderColor: [
                                '#e0a800',
                                '#138496',
                                '#5a6268',
                                '#1e7e34'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            }
        }

        // Fonction pour initialiser les graphiques Ticket (DOUGHNUT CHARTS)
        function initTicketCharts() {
            const ticketPresentCtx = document.getElementById('ticketPresentChart');
            const ticketAbsenceCtx = document.getElementById('ticketAbsenceChart');

            if (ticketPresentCtx && !ticketPresentChart) {
                ticketPresentChart = new Chart(ticketPresentCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Tickets Validés', 'Tickets Non-utilisés'],
                        datasets: [{
                            data: [ticketStats.checked_in, ticketStats.absent],
                            backgroundColor: [
                                '#28a745',
                                '#ffc107'
                            ],
                            borderColor: [
                                '#1e7e34',
                                '#e0a800'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            }

            if (ticketAbsenceCtx && !ticketAbsenceChart) {
                ticketAbsenceChart = new Chart(ticketAbsenceCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['QR Invalide', 'Scanné 2x', 'Expirés', 'Valides'],
                        datasets: [{
                            data: [
                                ticketStats.qr_invalid,
                                ticketStats.scanned_twice,
                                ticketStats.expired,
                                ticketStats.checked_in
                            ],
                            backgroundColor: [
                                '#dc3545',
                                '#17a2b8',
                                '#6c757d',
                                '#28a745'
                            ],
                            borderColor: [
                                '#c82333',
                                '#138496',
                                '#5a6268',
                                '#1e7e34'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            }
        }

        // Initialiser les graphiques au chargement de la page
        document.addEventListener('DOMContentLoaded', function () {
            // Initialiser les graphiques Fan (onglet actif par défaut)
            initFanCharts();

            // Écouter les changements d'onglets
            const tabLinks = document.querySelectorAll('[data-bs-toggle="tab"]');
            tabLinks.forEach(function (tabLink) {
                tabLink.addEventListener('shown.bs.tab', function (event) {
                    const target = event.target.getAttribute('href');

                    if (target === '#tabs-fan') {
                        initFanCharts();
                    } else if (target === '#tabs-ticket') {
                        initTicketCharts();
                    }
                });
            });
        });
    </script>
@endsection