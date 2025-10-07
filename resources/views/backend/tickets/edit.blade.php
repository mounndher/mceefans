<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Test QR Codes</title>
    <style>
        body { font-family: sans-serif; }
        .ticket {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 15px;
            text-align: center;
            display: inline-block;
            width: 180px;
        }
        .qr svg { width: 150px; height: 150px; }
    </style>
</head>
<body>

<h1>{{ $event->title ?? 'Événement' }}</h1>

@foreach ($tickets as $ticket)
    <div class="ticket">
        <div>Ticket ID: {{ $ticket['code'] }}</div>
        <div>Prix: {{ number_format($ticket['price'], 2) }} €</div>
        <div class="qr">
            {!! $ticket['qr_svg'] !!}
        </div>
    </div>
@endforeach

</body>
</html>
