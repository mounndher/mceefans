
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Printing Tickets...</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>
    <!-- Load the generated PDF -->
    <iframe src="{{ $pdfUrl }}" id="ticketFrame"></iframe>

    <script>
        window.onload = function() {
            const iframe = document.getElementById('ticketFrame');
            iframe.onload = function() {
                // Focus inside the PDF and open print dialog automatically
                iframe.contentWindow.focus();
                iframe.contentWindow.print();
            };
        };
    </script>
</body>
</html>
