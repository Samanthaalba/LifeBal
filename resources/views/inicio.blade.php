<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIFEBAL</title>
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1 class="text-center">BIENVENIDO A LIFEBAL</h1>
        <br>
        <br>
        <div class="card-grid">
            @foreach($cards as $card)
                <div class="card {{ $card['color'] }}">
                    <h2>{{ $card['title'] }}</h2>
                    <p>{{ $card['description'] }}</p>
                    <button class="btn btn-primary">PLAY</button>
                </div>
            @endforeach
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>