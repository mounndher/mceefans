<!DOCTYPE html>
<html>
<head>
    <title>Fan Card</title>
    <style>
        .card { width: 400px; border:2px solid #000; padding:20px; text-align:center; }
        .card img { width:150px; height:150px; object-fit:cover; margin-bottom:15px; }
        .qr { margin-top:10px; }
        table { width:100%; border-collapse: collapse; margin-top:15px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 5px; text-align: center; }
    </style>
</head>
<body>
    <div class="card">
        <h2>{{ $fan->nom }} {{ $fan->prenom }}</h2>
        <img src="{{ asset('uploads/fans/' . $fan->image) }}" alt="Fan Photo">
        <div class="qr">
            <img src="{{ $qrBase64 }}" alt="QR Code">
        </div>
        <p>NIN: {{ $fan->nin }}</p>

        <h4>Abonnement:</h4>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Nb Match</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fan->transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->abonment->nom }}</td>
                        <td>{{ $transaction->prix }}</td>
                        <td>{{ $transaction->nbrmatch }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
