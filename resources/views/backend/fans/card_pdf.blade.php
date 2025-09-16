<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fan Card</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #fff;
        }
        .card {
            width: 220px;
            height: 349px;
            margin: 0;
            position: relative;
        }
        img {
            width: 220px;
            height: 349px;
            display: block;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="card">
        <img src="{{ public_path($fan->card) }}" alt="Fan Card" />
    </div>
</body>
</html>
