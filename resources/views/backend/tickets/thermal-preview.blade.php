

    <style>
        @page {
            margin: 0;
            size: 80mm 130mm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: "DejaVu Sans", Arial, sans-serif;
            background: #fff;
        }

        .ticket {
            width: 80mm;
            height: 130mm;
            background: #fff;
            padding: 6mm 4mm;
            display: table;
            page-break-after: always;
            page-break-inside: avoid;
        }

        .ticket:last-child {
            page-break-after: auto;
        }

        .ticket-inner {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }

        .event-name {
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            color: #222;
            text-align: center;
            margin-bottom: 5mm;
            border-bottom: 1px dashed #aaa;
            padding-bottom: 3mm;
        }

        .ticket-number {
            font-size: 13pt;
            font-weight: bold;
            color: #000;
            margin: 3mm 0;
        }

        .price-box {
            text-align: center;
            border: 1px solid #000;
            border-radius: 2mm;
            padding: 3mm 6mm;
            width: 50mm;
            background: #fafafa;
            margin: 6mm auto;
            display: inline-block;
        }

        .price-label {
            font-size: 6pt;
            color: #666;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }

        .price-amount {
            font-size: 13pt;
            font-weight: bold;
            margin-top: 1mm;
            color: #000;
        }

        .qr {
            margin: 3mm auto;
            text-align: center;
        }

        .qr img {
            width: 35mm;
            height: 35mm;
            display: inline-block;
        }

        .scan-text {
            font-size: 6pt;
            color: #777;
            margin-top: 1mm;
            text-transform: uppercase;
        }

        .footer {
            text-align: center;
            border-top: 1px dashed #aaa;
            font-size: 6pt;
            color: #777;
            margin-top: 5mm;
            padding-top: 3mm;
            line-height: 1.3;
        }
    </style>


@foreach($tickets as $ticket)
<div class="ticket">
    <div class="ticket-inner">
        <div class="event-name">{{ Str::limit($event->nom, 40) }}</div>

        <div class="ticket-number">
            Ticket #{{ str_pad($ticket['number'], 4, '0', STR_PAD_LEFT) }}
        </div>

        <div class="price-box">
            <div class="price-label">Prix du billet</div>
            <div class="price-amount">{{ number_format($ticket['price'], 2) }} DZD</div>
        </div>

        <div class="qr">
            <img src="{{ $ticket['qr_svg'] }}" alt="QR Code">
            <div class="scan-text">Scannez pour valider</div>
        </div>

        <div class="footer">
            <div>Créé le : {{ $ticket['created_at'] }}</div>
            <div>Valable une seule fois</div>
        </div>
    </div>
</div>
@endforeach
<script>
    // Auto print when page loads
    window.onload = function() {
        window.print();

        // Redirect back after print dialog closes
       
    };
</script>

