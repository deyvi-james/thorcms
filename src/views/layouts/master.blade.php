<!doctype html>
<html lang="{{lang_code()}}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>{{$admin_window_title}}</title>
        
        <style type="text/css" id="relativecss">html,body{position:static}body *{position:relative}</style>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
        @if(Config::get('thor::bootswatch_theme')!==false)
        <link href="//netdna.bootstrapcdn.com/bootswatch/3.1.0/{{Config::get('thor::bootswatch_theme')}}/bootstrap.min.css" rel="stylesheet">
        @else
        <!-- Optional theme -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
        @endif
        <link href="{{admin_asset('css/admin.css')}}" rel="stylesheet">
        
        @yield('head_append')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        @section('admin_navbar')
            @include(Config::get('thor::views.admin_navbar'))
        @stop
        @yield('admin_navbar')
        
        @section('admin_sidebar')
            @include(Config::get('thor::views.admin_sidebar'))
        @stop
        @yield('admin_sidebar')
        
        <div class="admin-main" role="main">
            <div class="container">
                @if (Session::has('message'))
                <div class="alert alert-flash alert-info">
                    <p>{{ Session::get('message') }}</p>
                </div>
                @endif

                @yield('main')
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <script src="{{admin_asset('js/admin.js')}}"></script>
        @yield('body_append')
    </body>
</html>