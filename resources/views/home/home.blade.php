<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Installment Plan</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
</head>
<body>
    <div id="app">
        @auth
            <sidepanel-component></sidepanel-component>
        @else
            <home-component></home-component>
        @endauth
    </div>
</body>

<script src="{{ asset('js/app.js') }}" defer></script>

</html>