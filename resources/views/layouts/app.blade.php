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

    <title>Game Boy ROM Generator by Yokoi</title>

    <!-- Styles -->
    <link href="{{ asset('css/appv3.css') }}" rel="stylesheet">
    <link href="{{ asset('css/noty.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Game Boy ROM Generator
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
        <p>Creating Game Boy ROMs from custom graphics has never been easier.</p>
        <p>Images need to PNGs that are 160px by 144px and contain less than 4 colors.</p>
        <p>Once you upload the images you can drag and drop them into any order you like.</p>
        <p>This app was created by <a href="https://yokoi.shop">Yokoi</a> and is based off Nitro's amazing <a href="http://blog.gg8.se/wordpress/2013/02/19/gameboy-project-week-7-a-rom-for-showing-custom-graphics/">script</a>.</p>
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
