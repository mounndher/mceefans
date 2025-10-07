<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tickets PDF</title>
    <style>
        @page {
            size: 100mm 150mm;
            margin: 0;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
        }

        .ticket {
            width: 100mm;
            height: 150mm;
            box-sizing: border-box;
            text-align: center;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .qr img {
            width: 60mm;
            height: 60mm;
            margin-top: 5mm;
        }

        h1 {
            font-size: 14pt;
            margin: 0 0 4mm 0;
        }

        strong {
            display: block;
            margin-bottom: 2mm;
            font-weight: bold;
        }

        /* Make sure each ticket starts on a new page */
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

@foreach ($tickets as $ticket)
    <div class="ticket">
        <h1>{{ $event->nom ?? 'Événement' }}</h1>
       
        <p> Ticket n°{{ $ticket['number'] }}</p>
        <strong>Prix:</strong> {{ number_format($ticket['price'], 2) }} DZ
        <div class="qr">
            <img src="{{ $ticket['qr_svg_base64'] }}" alt="QR Code">
        </div>
        <div class="date-time">
            Date creation {{ $ticket['created_at'] }}
        </div>
    </div>

    @if(!$loop->last)
        <div class="page-break"></div>
    @endif
@endforeach

</body>
</html>
