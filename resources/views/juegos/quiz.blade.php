<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeBal</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

</head>
<body>
    <a href="/inicio"><button id="btn-regresar">regresar</button></a>

    <div class="containerquiz">
        <h1>Quiz sobre Prevención del Embarazo Adolescente</h1>
        @if (session('score'))
        <div class="alert alert-success">
            {{ session('score') }}
        </div>
        @endif  
        <form action="{{ route('quiz.process') }}" method="post">
        @csrf
        @foreach ($questions as $question)
        <div class="question">
                <p>{{ $question->question }}</p>
                <label><input type="radio" name="answers[{{ $question->id }}]" value="A"> A) {{ $question->option_a }}</label><br>
                <label><input type="radio" name="answers[{{ $question->id }}]" value="B"> B) {{ $question->option_b }}</label><br>
                <label><input type="radio" name="answers[{{ $question->id }}]" value="C"> C) {{ $question->option_c }}</label><br>
                <label><input type="radio" name="answers[{{ $question->id }}]" value="D"> D) {{ $question->option_d }}</label>
            </div>
        @endforeach
        <button type="submit">Enviar</button>
    </form>
    </div>

    <script src="/js/app.js"></script>
</body>
</html>