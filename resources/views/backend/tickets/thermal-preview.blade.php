@extends('backend.layouts.master')

@section('context')
<style>
    @page {
        size: 80mm 80mm;
        margin: 0;
    }
    
    body {
        margin: 0;
        padding: 0;
    }
    
    .thermal-paper {
        width: 80mm;
        height: 80mm;
        background: white;
        font-family: 'Courier New', monospace;
        font-size: 8pt;
        position: relative;
        overflow: hidden;
        box-sizing: border-box;
        page-break-after: always;
    }
    
    .thermal-paper:last-child {
        page-break-after: auto;
    }
    
    .thermal-border {
        height: 2mm;
        background: linear-gradient(90deg, #FF6B6B, #4ECDC4, #FFE66D, #FF6B6B);
    }
    
    .thermal-body {
        padding: 2mm 3mm;
        height: calc(100% - 2mm);
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .event-image {
        width: 55mm;
        height: 18mm;
        object-fit: cover;
        border-radius: 1.5mm;
        margin: 1mm 0 2mm 0;
    }
    
    .event-name {
        font-size: 9pt;
        font-weight: bold;
        text-align: center;
        text-transform: uppercase;
        padding: 1mm 2mm;
        background: #000;
        color: white;
        border-radius: 1.5mm;
        margin: 1mm 0;
        max-width: 65mm;
        line-height: 1.2;
    }
    
    .divider {
        width: 50mm;
        border-top: 1px dashed #999;
        margin: 1mm 0;
    }
    
    .section {
        text-align: center;
        margin: 1mm 0;
    }
    
    .label {
        font-size: 6pt;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    
    .ticket-number {
        font-size: 14pt;
        font-weight: bold;
        letter-spacing: 1px;
        margin: 0.5mm 0;
    }
    
    .price-box {
        border: 1.5px solid #000;
        padding: 1.5mm 3mm;
        background: #f8f9fa;
        border-radius: 2mm;
        margin: 1mm 0;
        width: 48mm;
    }
    
    .price-label {
        font-size: 5.5pt;
        color: #666;
    }
    
    .price-amount {
        font-size: 13pt;
        font-weight: bold;
        margin: 0.5mm 0;
    }
    
    .qr-code {
        width: 28mm;
        height: 28mm;
        margin: 1mm 0;
    }
    
    .scan-text {
        font-size: 5pt;
        color: #666;
        margin-top: 0.5mm;
        text-transform: uppercase;
    }
    
    .footer {
        text-align: center;
        font-size: 4.5pt;
        color: #666;
        border-top: 1px dashed #999;
        padding-top: 1mm;
        margin-top: auto;
        width: 100%;
        line-height: 1.3;
    }
</style>

@foreach($tickets as $ticket)
<div class="thermal-paper">
    
    <div class="thermal-border"></div>
    
    <div class="thermal-body">
        
        @if($eventImage)
        <img src="{{ $eventImage }}" alt="Event" class="event-image">
        @endif
        
        <div class="event-name">{{ Str::limit($event->nom, 30) }}</div>
        
        <div class="divider"></div>
        
        <div class="section">
            <div class="label">Numéro de Ticket</div>
            <div class="ticket-number">#{{ str_pad($ticket['number'], 4, '0', STR_PAD_LEFT) }}</div>
        </div>
        
        <div class="price-box">
            <div class="price-label">PRIX DU BILLET</div>
            <div class="price-amount">{{ number_format($ticket['price'], 2) }} DZD</div>
        </div>
        
        <div class="section">
            <img src="{{ $ticket['qr_svg'] }}" alt="QR" class="qr-code">
            <div class="scan-text">Scannez pour valider</div>
        </div>
        
        <div class="footer">
            <div>Créé: {{ $ticket['created_at'] }}</div>
            <div>Valable une fois uniquement</div>
        </div>
        
    </div>
    
</div>
@endforeach

<script>
    // Auto print when page loads
    window.onload = function() {
        window.print();
        
        // Redirect back after print dialog closes
        window.onafterprint = function() {
            window.location.href = "{{ route('tickets.create', $event->id) }}";
        };
    };
</script>

@endsection