<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Simple usage of PetStore API.">
    <meta name="author" content="Maciej Gdula">

    <title>PetsStore API - @yield('title', 'default')</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body>
@yield('content')
</body>
</html>
