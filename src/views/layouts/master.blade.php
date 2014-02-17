<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>

        <div class="container">
            @if (Session::has('message'))
            <div class="flash alert alert-info">
                <p>{{ Session::get('message') }}</p>
            </div>
            @endif

            @yield('main')
        </div>

    </body>

</html>