@extends('backend.layouts.master')

@section('context')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Paiements List</h3>
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
                                    <td>{{ number_format($paimnt->prix, 2) }}</td>
                                    <td>{{ $paimnt->nbrmatch }}</td>
                                     <td>
                                        <a href="" class="btn-sm btn-primary">
                                            <!-- edit icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="icon icon-tabler icon-tabler-edit">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                        </a>

                                        <form action=""
                                              method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn-danger"
                                                onclick="return confirm('Are you sure to delete this abonment?')">
                                                <!-- trash icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="icon icon-tabler icon-tabler-trash-x">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M4 7h16" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    <path d="M10 12l4 4m0 -4l-4 4" />
                                                </svg>
                                            </button>
                                        </form>
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
            </div>

        </div>
    </div>
</div>
@endsection
