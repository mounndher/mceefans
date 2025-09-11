@extends('backend.layouts.master')

@section('context')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Fan Details</h3>
                <div class="card-actions">
                    <a href="{{ route('fans.index') }}" class="btn btn-primary">
                        <!-- Back icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="icon icon-tabler icon-tabler-arrow-left">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 12h14" />
                            <path d="M5 12l6 6" />
                            <path d="M5 12l6 -6" />
                        </svg>
                        Back
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Nom</th>
                        <td>{{ $fan->nom }}</td>
                    </tr>
                    <tr>
                        <th>Prénom</th>
                        <td>{{ $fan->prenom }}</td>
                    </tr>
                    <tr>
                        <th>NIN</th>
                        <td>{{ $fan->nin }}</td>
                    </tr>
                    <tr>
                        <th>Numéro Téléphone</th>
                        <td>{{ $fan->numero_tele }}</td>
                    </tr>
                    <tr>
                        <th>Date de Naissance</th>
                        <td>{{ $fan->date_de_nai }}</td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td>
                            @if($fan->image)
                                <img src="{{ asset($fan->image) }}" alt="Fan Image" height="100">
                            @else
                                <span class="text-muted">No image uploaded</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Image de la Carte Nationale</th>
                        <td>
                            @if($fan->imagecart)
                                <img src="{{ asset($fan->imagecart) }}" alt="Carte Image" height="100">
                            @else
                                <span class="text-muted">No image uploaded</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Card Image</th>
                        <td>
                            @if($fan->card)
                                <img src="{{ asset($fan->card) }}" alt="Carte Image" height="100">
                            @else
                                <span class="text-muted">No card generated</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>QR Code</th>
                        <td>
                            @if($fan->qr_img)
                                <img src="{{ asset($fan->qr_img) }}" alt="Carte Image" height="100">
                            @else
                                <span class="text-muted">No card generated</span>
                            @endif
                        </td>

                    </tr>
                </table>

                

            </div>
        </div>
    </div>
</div>
@endsection

