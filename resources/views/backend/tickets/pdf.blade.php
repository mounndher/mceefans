<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket #{{ str_pad($ticket->number, 4, '0', STR_PAD_LEFT) }}</title>
    <style>
        @page {
            margin: 0;
            size: 80mm 170mm;
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
            height: 170mm;
            padding: 4mm 3mm;
            background: #fff;
            display: table;
            page-break-after: avoid;
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
            height: 28mm;
            object-fit: cover;
            margin: 0 auto 3mm auto;
            border-radius: 2mm;
            display: block;
        }

        .event-name {
            font-size: 10pt;
            font-weight: bold;
            text-transform: uppercase;
            color: #222;
            text-align: center;
            margin-bottom: 3mm;
            border-bottom: 1px dashed #aaa;
            padding-bottom: 2mm;
        }

        .ticket-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 8pt;
            font-weight: bold;
            color: #000;
            margin: 3mm auto;
            width: 65mm;
            text-transform: uppercase;
        }

        .qr {
            margin: 2mm auto;
            text-align: center;
        }

        .qr img {
            width: 25mm;
            height: 25mm;
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
            font-size: 7pt;
            font-weight: bold;
            color: #000;
            margin-top: 1.5mm;
            padding-top: 1.5mm;
            line-height: 1.3;
            white-space: pre-line;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="ticket">
        <div class="ticket-inner">
            <div class="header">
                <div class="header-text">
                    Fédération Algérienne de Football <br>
                    Ligue Interrégions de Football
                </div>
            </div>

            @if(!empty($event->image_post))
                <img src="{{ asset('uploads/event/' . $event->image_post) }}" alt="Event Image" class="event-image">
            @endif

            <div class="event-name">{{ Str::limit($event->nom, 40) }}</div>

            <div class="ticket-info">
                <span>Ticket {{ str_pad($ticket->number, 4, '0', STR_PAD_LEFT) }}</span>
                <span>{{ number_format($ticket->price, 2) }} DZD</span>
            </div>

            <div class="qr">
                <img src="{{ $ticket->qr_svg }}" alt="QR Code">
            </div>

            <div class="footer">
                <div>Créé le : {{ $ticket->created_at->format('Y-m-d H:i') }}</div>

                <div>
                    هذه البطاقة فردية يجب تقديمها عند مدخل الملعب.<br>
                    - ممنوع دخول القصر أقل من 18 سنة دون مرافق.<br>
                    - يتعهد حامل البطاقة بـ:<br>
                    * التحلي بالروح الرياضية مهما كانت نتيجة المقابلة.<br>
                    * المحافظة على الممتلكات العامة والمرافق الموجودة داخل الملعب.<br>
                    * احترام الآداب العامة.<br>
                    (كل مخالفة لهذا النظام يعاقب عليها القانون والتشريع الجزائري).<br>
                    تستعمل هذه البطاقة مرة واحدة من طرف شخص واحد.
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onafterprint = function() {
            window.location.href = "{{ route('tickets.create', $event->id) }}";
        };
    </script>
</body>
</html>
