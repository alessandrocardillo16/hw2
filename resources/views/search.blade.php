<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Ricerca | D&D</title>
    <link rel="stylesheet" href="{{ url('css/header-footer.css') }}">
    <link rel="stylesheet" href="{{ url('css/search.css') }}">
    <link rel="stylesheet" href="{{ url('css/general.css') }}">
    <script src="/hw2/public/js/ipGeolocation.js" defer></script>
    <script src="/hw2/public/js/openLibrary.js" defer></script>
    <script src="/hw2/public/js/search.js" defer></script>
    <script src="/hw2/public/js/header.js" defer></script>
</head>
<body>
@include('partials.header')
<div class="background-texture"></div>
<section>
    <div id="search-results" class="container"></div>
</section>

<div id="search-results"></div>
@include('partials.footer')
</body>
</html>