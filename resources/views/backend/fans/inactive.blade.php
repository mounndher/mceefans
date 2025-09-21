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
                <h3 class="card-title mb-0">Liste des fans inactive</h3>
                <form method="GET" action="{{ route('fansfans.inactive') }}" class="d-flex ms-4">
                    <input type="text" name="search" class="form-control me-2" placeholder="Rechercher par nom, email, téléphone..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </form>




            </div>

            <div class="card-body">
                <!-- Bulk PDF Form -->


                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>

                                    <th>ID QR</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Status</th>
                                    <th>Téléphone</th>
                                    <th>Date Naissance</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($fans as $fan)
                                <tr>

                                    <td>{{ $fan->id_qrcode }}</td>
                                    <td>{{ $fan->nom }}</td>
                                    <td>{{ $fan->prenom }}</td>
                                    
                                    <td>
                                        <!-- ✅ Toggle Switch -->
                                        <label class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input toggle-status" data-id="{{ $fan->id }}" {{ $fan->status === 'active' ? 'checked' : '' }}>
                                            <span class="form-check-label status-label-{{ $fan->id }}">
                                                {{ $fan->status === 'active' ? 'Actif' : 'Désactivé' }}
                                            </span>
                                        </label>
                                    </td>
                                    </td>
                                    <td>{{ $fan->numero_tele }}</td>
                                    <td>{{ $fan->date_de_nai }}</td>

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

            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-status').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            let fanId = this.getAttribute('data-id');
            let newStatus = this.checked ? 'active' : 'inactive';

            fetch("{{ url('fans/toggle-status') }}/" + fanId, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.querySelector(".status-label-" + fanId).textContent =
                        newStatus === 'active' ? 'Actif' : 'Désactivé';
                } else {
                    alert("Erreur: " + data.message);
                }
            })
            .catch(err => console.error(err));
        });
    });
});
</script>


@endsection
