<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Books</title>

    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/app.js')}}"></script>

</head>
<body>

    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-light bg-grey">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                <a class="nav-link" href="{{route('readings.index')}}">Readings</a>
                <a class="nav-link" href="{{route('books.index')}}">Books</a>
                </div>
            </div>
        </nav>

        @yield('body')

    </div>

    <footer class="container mt-5">
        <div class="footer">
            books logged
        </div>
    </footer>

</body>
</html>