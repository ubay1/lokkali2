<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="logo.png" type="image/png">
    <link rel="manifest" href="{{ asset('manifest/manifest.json') }}">
    <title>Lokkali Indonesia</title>

    {{-- bootstrap --}}
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    {{-- service worker --}}
    {{-- <script src="{{ asset('manifest/main.js') }}" type="text/javascript"></script> --}}

</head>
<body>
    <div id="app">
        <app></app>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
