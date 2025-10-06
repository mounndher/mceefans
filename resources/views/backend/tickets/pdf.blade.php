<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tickets</title>
    <style>
        @page {
            size: 8cm 13cm; /* ✅ Taille du ticket */
            margin: 0; /* Aucun bord pour utiliser tout l’espace */
        }

        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }

        .page-break {
            page-break-after: always;
        }

        .ticket {
            width: 8cm;
            height: 8cm;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .qr {
            margin-top: 10px;
        }

        .info {
            margin: 3px 0;
            font-size: 13px;
        }

        h2 {
            font-size: 16px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    @foreach($tickets as $ticket)
        <div class="ticket">
            <h2>{{ strtoupper($event->nom) }}</h2>
            <div class="info"><strong>Ticket No:</strong> {{ $loop->iteration }}</div>
            <div class="info"><strong>Guichet:</strong> {{ rand(1,10) }}</div>
            <div class="info"><strong>Date:</strong> {{ $ticket->created_at->format('d/m/Y') }}</div>
            <div class="info"><strong>Heure:</strong> {{ $ticket->created_at->format('H:i:s') }}</div>

            <div class="qr">
                <img src="{{ public_path(ltrim($ticket->qr_image, '/')) }}" width="120" height="120" alt="QR Code">
            </div>
        </div>

        @if(!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
</body>
</html>
