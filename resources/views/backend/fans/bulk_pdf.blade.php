<!DOCTYPE html>
<html>
<head>
    <style>
        html, body {
            margin: 0;
            padding: 0;
        }
        .card {
            width: 100%;
            height: 100%;
            page-break-after: always; /* يعمل صفحة جديدة لكل بطاقة */
        }
        .card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>

@foreach($fans as $fan)
    <div class="card">
        <img src="{{ public_path(ltrim($fan->card, '/')) }}" alt="Fan Card">
    </div>
@endforeach

</body>
</html>
