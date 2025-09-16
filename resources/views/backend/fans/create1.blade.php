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
<form action="{{ route('fans.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="text" name="prenom" placeholder="Prenom" required>
    <input type="text" name="nin" placeholder="NIN" required>
    <input type="text" name="numero_tele" placeholder="Numéro Téléphone" required>
    <input type="date" name="date_de_nai" required>
    <input type="file" name="image" required>

    <h4>Choisir Abonnement:</h4>
    @foreach($abonments as $abonment)
        <input type="radio" name="abonment" value="{{ $abonment->id }}" required>
        {{ $abonment->nom }} ({{ $abonment->prix }})<br>
    @endforeach

    <button type="submit">Créer Fan</button>
</form>
@endsection
