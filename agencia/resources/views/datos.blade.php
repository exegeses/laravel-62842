<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <header class="p-3 bg-warning">
        <nav>menu</nav>
    </header>
    <main class="container">
        <h1>Impresión de datos</h1>

        @if( $nombre == 'marcos' )
            {{ $nombre }}
        @else
            usuario desconocido
        @endif

        <hr>
        
        @foreach ($marcas as $marca)
            {{ $marca }} <br>
        @endforeach


    </main>



</body>
</html>
