<style>
    @page {
        margin: 0;
        size: 80mm 150mm;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: "DejaVu Sans", Arial, sans-serif;
        background: #fff;
    }

    .ticket {
        width: 80mm;
        height: 150mm;
        padding: 6mm 4mm;
        background: #fff;
        display: table;
        page-break-after: always;
        page-break-inside: avoid;
    }

    .ticket-inner {
        display: table-cell;
        vertical-align: top;
        text-align: center;
    }

    .header {
        text-align: center;
        margin-bottom: 3mm;
    }

    .header-text {
        font-size: 9pt;
        font-weight: bold;
        text-transform: uppercase;
        line-height: 1.4;
        color: #000;
    }

    .event-image {
        width: 60mm;
        height: 30mm;
        object-fit: cover;
        margin: 0 auto 4mm auto;
        border-radius: 2mm;
        display: block;
    }

    .event-name {
        font-size: 11pt;
        font-weight: bold;
        text-transform: uppercase;
        color: #222;
        text-align: center;
        margin-bottom: 4mm;
        border-bottom: 1px dashed #aaa;
        padding-bottom: 2mm;
    }

    /* ✅ Ticket number + price on same line */
    .ticket-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 12pt;
        font-weight: bold;
        color: #000;
        margin: 4mm auto;
        width: 65mm;
        text-transform: uppercase;
    }

    .ticket-info span {
        display: inline-block;
    }

    .qr {
        margin: 4mm auto;
        text-align: center;
    }

    .qr img {
        width: 32mm;
        height: 32mm;
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

        <!-- ✅ Header -->
        <div class="header">
            <div class="header-text">
                Fédération Algérienne de Football <br>
                Ligue Interrégions de Football
            </div>
        </div>

        <!-- ✅ Event image -->
        @if(!empty($event->image_post))
            <img src="{{ asset('uploads/event/' . $event->image_post) }}" alt="Event Image" class="event-image">
        @endif

        <div class="event-name">{{ Str::limit($event->nom, 40) }}</div>

        <!-- ✅ Ticket number + price same line -->
        <div class="ticket-info">
            <span>Ticket #{{ str_pad($ticket['number'], 4, '0', STR_PAD_LEFT) }}</span>
            <span>{{ number_format($ticket['price'], 2) }} DZD</span>
        </div>

        <!-- ✅ QR code -->
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
    window.onload = function() {
        window.print();
    };
    window.onafterprint = function() {
        window.location.href = "{{ route('tickets.create', $event->id) }}";
    };
</script>
