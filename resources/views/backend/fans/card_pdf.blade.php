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
        }
        .card img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Keeps proportions and fills page */
        }
    </style>
</head>
<body>
    <div class="card">
         <img src="{{ public_path(ltrim($fan->card, '/')) }}" alt="Fan Card">
    </div>
</body>
</html>
