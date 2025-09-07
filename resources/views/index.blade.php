
<div class="container">
    <h2>Cards List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Numero</th>
                <th>QR Code</th>
               
            </tr>
        </thead>
        <tbody>
            @foreach($cards as $card)
            <tr>
                <td>{{ $card->name }}</td>
                <td>{{ $card->numero }}</td>
                <td>
                    <img src="data:image/png;base64,{{ $card->qr_code }}" width="200">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
