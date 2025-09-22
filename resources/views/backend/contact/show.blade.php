@extends('backend.layouts.master')

@section('context')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Messages de Contact</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Téléphone</th>
                                <th>Message</th>
                                <th>Date</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($messages as $message)
                                <tr>
                                    <td>{{ $message->id }}</td>
                                    <td>{{ $message->nom }}</td>
                                    <td>{{ $message->prenom }}</td>
                                    <td>{{ $message->phone }}</td>
                                    <td>{{ $message->message }}</td>
                                    <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Aucun message trouvé</td>
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
