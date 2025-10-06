<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tickets</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
        }
        .page {
            page-break-after: always;
        }
        .card {
            width: 100%;
            height: 100%;
        }
        .card img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Remplit bien la page sans déformer */
        }
    </style>
</head>
<body>
    @foreach($tickets as $ticket)
        <div class="page">
            <div class="card">
                <img src="{{ public_path(ltrim($ticket->imgticket, '/')) }}" alt="Ticket">
            </div>
        </div>
    @endforeach
</body>
</html>
