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

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                <h3 class="card-title mb-0">Liste des fans</h3>
        <form method="GET" action="{{ route('fans.index') }}" class="d-flex ms-4">
            <input type="text" name="search" class="form-control me-2"
                placeholder="Rechercher par nom, email, téléphone..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

                    

                    <div class="card-actions">
                        <a href="{{ route('fans.create') }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Ajouter de nouveaux fans
                        </a>
                        <!-- Télécharger Tous -->
                        <a href="{{ route('fans.bulkPdf') }}" target="_blank" class="btn btn-success ms-2">
                            Télécharger Tous
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Bulk PDF Form -->
                    <form id="bulk-pdf-form" action="{{ route('fans.bulkPdf') }}" method="GET" target="_blank">
                        <div class="mb-2">
                            <button type="submit" class="btn btn-danger">
                                Télécharger PDF Sélectionnés
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="select-all">
                                        </th>
                                        <th>ID QR</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>NIN</th>
                                        <th>Téléphone</th>
                                        <th>Date Naissance</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($fans as $fan)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="ids[]" value="{{ $fan->id }}"
                                                    class="fan-checkbox">
                                            </td>
                                            <td>{{ $fan->id_qrcode }}</td>
                                            <td>{{ $fan->nom }}</td>
                                            <td>{{ $fan->prenom }}</td>
                                            <td>{{ $fan->nin }}</td>
                                            <td>{{ $fan->numero_tele }}</td>
                                            <td>{{ $fan->date_de_nai }}</td>
                                            <td>
                                                <!-- Show -->
                                                <a href="{{ route('fans.show', $fan->id) }}" class="text-info"
                                                    title="Show">
                                                    👁
                                                </a>

                                                <!-- Edit -->
                                                <a href="{{ route('fans.edit', $fan->id) }}" class="text-primary ms-2"
                                                    title="Edit">✏️</a>

                                                <!-- PDF -->
                                                <a href="{{ route('fans.cardPdf', $fan->id) }}" target="_blank"
                                                    class="btn btn-sm btn-danger ms-2">PDF</a>

                                                <!-- Delete -->
                                                <form action="{{ route('fans.destroy', $fan->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link p-0 ms-2 text-danger"
                                                        onclick="return confirm('Are you sure?')" title="Delete">🗑</button>
                                                </form>
                                                <a href="javascript:void(0);" class="renouveler-btn ms-2 text-warning"
                                                    data-fan-id="{{ $fan->id }}"
                                                    data-fan-name="{{ $fan->nom }} {{ $fan->prenom }}"
                                                    title="Renouveler Abonnement">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-refresh" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No fans found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $fans->appends(request()->query())->links() }}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

      <div class="modal fade" id="modal-renouveler" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="form-renouveler" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Renouveler Abonnement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Choisir un Abonnement</label>
                            <select name="id_abonment" class="form-select" required>
                                <option value="">-- Sélectionner --</option>
                                @foreach($abonments as $abonment)
                                    <option value="{{ $abonment->id }}" {{ old('id_abonment') == $abonment->id ? 'selected' : '' }}>
                                        {{ $abonment->nom }} - {{ $abonment->prix }} DA - {{ $abonment->nbrmatch }} matchs
                                    </option>
                                @endforeach
                            </select>
                            @error('id_abonment')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary ms-auto">Renouveler</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = new bootstrap.Modal(document.getElementById('modal-renouveler'));
            const form = document.getElementById('form-renouveler');
            const buttons = document.querySelectorAll('.renouveler-btn');

            buttons.forEach(btn => {
                btn.addEventListener('click', () => {
                    const fanId = btn.getAttribute('data-fan-id');
                    const fanName = btn.getAttribute('data-fan-name');

                    document.querySelector('#modal-renouveler .modal-title').textContent =
                        'Renouveler Abonnement - ' + fanName;

                    form.action = '{{ url("fans") }}/' + fanId + '/renouveler';
                    modal.show();
                });
            });
        });

    </script>

    <!-- JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('select-all').addEventListener('change', function() {
                let checked = this.checked;
                document.querySelectorAll('.fan-checkbox').forEach(cb => cb.checked = checked);
            });
        });
    </script>
@endsection
