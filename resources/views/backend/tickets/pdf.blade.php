<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Test QR Codes</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .ticket {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 15px;
            text-align: center;
            display: inline-block;
            width: 180px;
        }
        .qr img { width: 150px; height: 150px; }
    </style>
</head>
<body>

<h1>{{ $event->nom ?? 'Événement' }}</h1>

@foreach ($tickets as $ticket)
    <div class="ticket">
        <div><strong>Ticket ID:</strong> {{ $ticket['code'] }}</div>
        <div><strong>Prix:</strong> {{ number_format($ticket['price'], 2) }} €</div>
        <div class="qr">
            <img src="{{ $ticket['qr_svg_base64'] }}" alt="QR Code">
        </div>
    </div>
@endforeach

</body>
</html>
