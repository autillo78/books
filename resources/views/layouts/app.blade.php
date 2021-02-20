<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Books</title>

    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    {{-- font awesome 4 --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/myJs.js')}}"></script>

</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-grey">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                <a class="nav-link font-weight-bold" href="{{route('readings.index')}}">Readings</a>
                <a class="nav-link font-weight-bold" href="{{route('books.index')}}">Books</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">

        @yield('body')

    </div>

    <footer class="mt-5">
        {{-- <div class="footer">
            books logged
        </div> --}}
    </footer>

</body>
</html>