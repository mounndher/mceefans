@extends('backend.layouts.master')

@section('context')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Paiements List</h3>
                    <form method="GET" action="{{ route('Paimnts.index') }}" class="d-flex">
                        <input type="text" name="search" class="form-control me-2" placeholder="chercher..."
                            value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">chercher</button>
                    </form>
                </div>



                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fan Name</th>
                                    <th>Abonment</th>
                                    <th>Date</th>
                                    <th>Prix</th>
                                    <th>Nombre de Match</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($paimnts as $paimnt)
                                    <tr>
                                        <td>{{ $paimnt->id }}</td>
                                        <td>{{ $paimnt->fan->nom ?? 'N/A' }} {{ $paimnt->fan->prenom ?? '' }}</td>
                                        <td>{{ $paimnt->abonment->nom ?? 'N/A' }}</td>
                                        <td>{{ $paimnt->date }}</td>
                                        <td>{{ $paimnt->prix }}</td>
                                        <td>{{ $paimnt->nbrmatch }}</td>
                                        <td>


                                            <a href="{{ route('paimnts.moveToHistorique', $paimnt->id) }}"
                                                onclick="return confirm('Êtes-vous sûr de vouloir déplacer ce paiement vers l’historique ?')"
                                                class="btn btn-danger btn-sm">
                                                Passer à l'historique
                                            </a>
                                            


                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No paiements found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $paimnts->appends(request()->query())->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection