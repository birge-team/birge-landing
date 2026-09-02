<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <style>
        @font-face {
            font-family: 'Roboto';
            src: url('/fixed/fonts/Roboto/Roboto-VariableFont_wdth,wght.ttf') format('truetype');
            font-style: normal;
            font-weight: 100 900;
            font-display: swap;
        }

        @font-face {
            font-family: 'Roboto';
            src: url('/fixed/fonts/Roboto/Roboto-Italic-VariableFont_wdth,wght.ttf') format('truetype');
            font-style: italic;
            font-weight: 100 900;
            font-display: swap;
        }

        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased flex flex-col min-h-screen @stack('body-class')">
<x-preloader/>
<x-header/>
{{ $slot }}
<x-footer/>
@stack('scripts')
<div id="pixel-page-transition" class="pixel-page-transition" aria-hidden="true"></div>
</body>
</html>
