<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('template/src/assets/images/logos/favicon.png')}}" />
    <link rel="stylesheet" href="{{ asset('template/src/assets/css/styles.min.css')}}" />
</head>

<body>

    <div id="auth">
        {{ $slot }}
    </div>
    
    <script src="{{ asset('template/src/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset('template/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>