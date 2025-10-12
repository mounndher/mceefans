<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tickets PDF</title>
    <style>
        @page {
            size: 80mm 80mm;
            margin: 0;
        }
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
        }
        .ticket {
            width: 80mm;
            height: 80mm;
            box-sizing: border-box;
            background: #ffffff;
            position: relative;
            overflow: hidden;
        }
        
        .ticket::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2mm;
            background: linear-gradient(90deg, #FF6B6B 0%, #FFE66D 25%, #4ECDC4 50%, #556270 75%, #FF6B6B 100%);
        }
        
        .event-image-container {
            width: 70%;
            height: 12mm;
            overflow: hidden;
            position: relative;
            margin: 3mm auto 0 auto;
            border-radius: 2mm;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }
        
        .event-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .ticket-body {
            padding: 1.5mm 3mm;
            text-align: center;
        }
        
        .event-name {
            background: #000000;
            color: white;
            padding: 1.5mm 2.5mm;
            margin: 2mm auto 1mm auto;
            border-radius: 2mm;
            font-size: 6pt;
            font-weight: bold;
            text-transform: uppercase;
            width: 65mm;
        }
        
        .divider {
            width: 40mm;
            height: 1px;
            background: linear-gradient(90deg, transparent, #4ECDC4, transparent);
            margin: 0.8mm auto;
        }
        
        .ticket-number-container {
            margin: 0.8mm 0;
        }
        
        .ticket-label {
            font-size: 6pt;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5mm;
        }
        
        .ticket-number {
            font-size: 10pt;
            font-weight: bold;
            color: #333;
            letter-spacing: 1px;
        }
        
        .price-section {
            background: #f8f9fa;
            border: 1.5px solid #000000;
            border-radius: 3mm;
            padding: 1.2mm;
            margin: 0.8mm auto;
            width: 55mm;
        }
        
        .price-label {
            font-size: 6pt;
            color: #666;
            margin-bottom: 0.3mm;
        }
        
        .price-amount {
            font-size: 12pt;
            font-weight: bold;
            color: #000000;
        }
        
        .qr-section {
            background: #f8f9fa;
            padding: 1.2mm;
            border-radius: 2mm;
            display: inline-block;
            margin: 0.8mm 0;
            border: 1px dashed #ddd;
        }
        
        .qr-section img {
            width: 14mm;
            height: 14mm;
            display: block;
        }
        
        .scan-text {
            font-size: 5pt;
            color: #999;
            margin-top: 0.5mm;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        
        .ticket-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: #2d3748;
            color: white;
            padding: 1mm;
            text-align: center;
        }
        
        .footer-text {
            font-size: 4.5pt;
            margin: 0;
            opacity: 0.8;
        }
        
        .decorative-dots {
            position: absolute;
            width: 2.5mm;
            height: 2.5mm;
            border-radius: 50%;
            background: #4ECDC4;
            opacity: 0.3;
        }
        
        .dot1 { top: 8mm; left: 2.5mm; }
        .dot2 { top: 12mm; right: 2.5mm; }
        .dot3 { top: 55mm; left: 3.5mm; }
        .dot4 { top: 52mm; right: 3mm; }
        
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
@foreach ($tickets as $ticket)
    <div class="ticket">
        <div class="decorative-dots dot1"></div>
        <div class="decorative-dots dot2"></div>
        <div class="decorative-dots dot3"></div>
        <div class="decorative-dots dot4"></div>
        
        <div class="event-image-container">
            @if($eventImageBase64)
                <img src="{{ $eventImageBase64 }}" alt="Event Image" class="event-image">
            @else
                <div style="background: linear-gradient(135deg, #4ECDC4, #556270); height: 100%; display: flex; align-items: center; justify-content: center; border-radius: 2mm;">
                    <span style="color: white; font-size: 7pt; font-weight: bold;">IMAGE</span>
                </div>
            @endif
        </div>
        
        <div class="ticket-body">
            <div class="event-name">
                {{ $event->nom ?? 'Événement' }}
            </div>
            
            <div class="divider"></div>
            
            <div class="ticket-number-container">
                <div class="ticket-label">Numéro de Ticket</div>
                <div class="ticket-number">#{{ str_pad($ticket['number'], 4, '0', STR_PAD_LEFT) }}</div>
            </div>
            
            <div class="price-section">
                <div class="price-label">PRIX DU BILLET</div>
                <div class="price-amount">{{ number_format($ticket['price'], 2) }}</div>
                <div class="price-label">DZD</div>
            </div>
            
            <div class="qr-section">
                <img src="{{ $ticket['qr_svg_base64'] }}" alt="QR Code">
                <div class="scan-text">Scannez pour valider</div>
            </div>
        </div>
        
        <div class="ticket-footer">
            <p class="footer-text">Créé le {{ $ticket['created_at'] }} • Valable une fois</p>
        </div>
    </div>
    @if(!$loop->last)
        <div class="page-break"></div>
    @endif
@endforeach
</body>
</html>