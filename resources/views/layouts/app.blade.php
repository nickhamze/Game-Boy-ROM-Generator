<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/noty.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
        <div class="container">
          <div class="col-md-6 col-md-offset-3">
        <p>Welcome to the Game Boy ROM Generator by <a href="https://yokoi.shop">Yokoi</a> where you can turn your images into Game Boy ROM files. Creating carts with your custom graphics has never been easier.</p>
        <p>The images (you can upload up to 256 of them) need to be exactly PNGS that are 160x144 pixels with no more than 4 colors/shades of gray.</p>
        <p>This site is based off the work of <a href="http://blog.gg8.se/wordpress">Nitro</a> and makes use of the script he wrote <a href="http://blog.gg8.se/wordpress/2013/02/19/gameboy-project-week-7-a-rom-for-showing-custom-graphics/">here</a>.</p>
          </div>
        </div>
    </div>

    <!-- Scripts -->

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ asset('js/noty.min.js') }}" type="text/javascript"></script>
</body>
</html>
