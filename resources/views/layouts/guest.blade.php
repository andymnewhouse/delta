<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles
    </head>
    <body class="bg-gray-100 dark:bg-gray-900">
        <div class="font-sans text-gray-900 dark:text-gray-200 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts
    </body>
</html>
