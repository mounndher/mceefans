@extends('layout.app')

@section('content')
<div class="container">
    <h1>{{ $fan->name }}'s Card</h1>

    @if($fan->qr_path)
        <div>
            <h3>QR Code</h3>
            <img src="{{ asset('storage/' . $fan->qr_path) }}" width="200" alt="QR">
        </div>
    @endif

    @if($fan->card_image)
        <div style="margin-top:20px">
            <h3>Virtual Card</h3>
            <img src="{{ asset('storage/' . $fan->card_image) }}" width="500" alt="Card">
            <div style="margin-top:10px">
                <a href="{{ asset('storage/' . $fan->card_image) }}" download>Download card</a>
            </div>
        </div>
    @endif
</div>
@endsection
