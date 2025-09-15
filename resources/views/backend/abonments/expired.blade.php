@extends('backend.layouts.master')

@section('context')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Liste des abonnements</h3>
               
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prix</th>
                                <th>Nombre de Match</th>
                                <th>Design Card</th>
                                <th>statut</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($abonments as $abonment)
                            <tr>
                                <td>{{ $abonment->nom }}</td>
                                <td>{{ $abonment->prix }}</td>
                                <td>{{ $abonment->nbrmatch }}</td>
                                <td>
                                    @if($abonment->desgin_card)
                                    <img src="{{ asset($abonment->desgin_card) }}" width="80">
                                    @else
                                    No Image
                                    @endif
                                </td>
                                <td>
                                    <label class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input toggle-status" data-id="{{ $abonment->id }}" {{ $abonment->status === 'active' ? 'checked' : '' }}>

                                        <span class="form-check-label status-label-{{ $abonment->id }}">
                                            {{ $abonment->status === 'active' ? 'Actif' : 'Expiré' }}
                                        </span>
                                    </label>
                                </td>



                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No abonments found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).on('change', '.toggle-status', function () {
    let abonmentId = $(this).data('id');
    let isChecked = $(this).is(':checked');

    $.ajax({
        url: '/abonments/' + abonmentId + '/toggle',
        type: 'PATCH',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function (response) {
            // update label text dynamically
            let label = $('.status-label-' + abonmentId);
            label.text(response.status === 'active' ? 'Actif' : 'Expiré');

            // (optional) change label color
            if (response.status === 'active') {
                label.css('color', 'green');
            } else {
                label.css('color', 'red');
            }
        },
        error: function () {
            alert('Failed to update status.');
        }
    });
});
</script>

@endsection
