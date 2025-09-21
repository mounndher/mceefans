@extends('backend.layouts.master')

@section('context')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">supprime Payments</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('paimnts.supprime') }}" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                               placeholder="Search...">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Fan</th>
                            <th>Abonment</th>
                            <th>Prix</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($paimnts as $paimnt)
                            <tr>
                                <td>{{ $paimnt->fan->nom ?? '' }} {{ $paimnt->fan->prenom ?? '' }}</td>
                                <td>{{ $paimnt->abonment->nom ?? '' }}</td>
                                <td>{{ $paimnt->prix }}</td>
                                <td><span class="badge">{{ ucfirst($paimnt->status) }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No historique payments found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $paimnts->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
