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
            <div class="card-header">
                <h3 class="card-title">Liste des fans</h3>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
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
                                <td>{{ $fan->id_qrcode }}</td>
                                <td>{{ $fan->nom }}</td>
                                <td>{{ $fan->prenom }}</td>
                                <td>{{ $fan->nin }}</td>
                                <td>{{ $fan->numero_tele }}</td>
                                <td>{{ $fan->date_de_nai }}</td>
                                <td>
                                    <!-- Show -->
                                    <a href="{{ route('fans.show', $fan->id) }}" class="text-info" title="Show">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6s-6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6s6.6 2 9 6" />
                                        </svg>
                                    </a>



                                   

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No fans found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal unique pour renouveler Abonnement -->
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
    document.addEventListener('DOMContentLoaded', function() {
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
@endsection
