<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{ url('css/header-footer.css') }}">
        <link rel="stylesheet" href="{{ url('css/index.css') }}">
        <link rel="stylesheet" href="{{ url('css/profile.css') }}">
        <link rel="stylesheet" href="{{ url('css/general.css') }}">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,100..900;1,9..144,100..900&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap" rel="stylesheet">

        <script src="/hw2/public/js/ipGeolocation.js" defer></script>
        <script src="/hw2/public/js/openLibrary.js" defer></script>
        <script src="/hw2/public/js/header.js" defer></script>
        <script src="/hw2/public/js/profile.js" defer></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">

        <title>D&D - {{ $user['name'] }} {{ $user['surname'] }}</title>
    </head>

    <body>
        @include('partials/header')
        <div class="background-texture"></div>
        <section>
            <div class="container">
            <div class="info">
                <img class="avatar" src="{{ $user['avatar'] ?? url('assets/images/default-avatar.jpg') }}" alt="">
                <h1 class="username"> {{ $user['name'] }} {{ $user['surname'] }} </h1>
            </div>
            </div>
            <div class="container">
                <div class="userInfo">
                    <div class="content-card-container" id="results"></div>
                    <button class="contained-button contained-button-red see-more">See More</button>
                </div>
            </div>
        </section>
        @include('partials/footer')
    </body>
</html>