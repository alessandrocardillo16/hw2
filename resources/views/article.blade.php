<!DOCTYPE html>
<html lang="en">
<head>
    <title>D&D Beyond</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="D&D Beyond is a digital toolset and game companion for Dungeons & Dragons tabletop roleplaying game.">
    <link rel="icon" type="image/png" href="/hw2/public/assets/icons/favicon.png">

    <link rel="stylesheet" href="{{ url('css/header-footer.css') }}">
    <link rel="stylesheet" href="{{ url('css/article.css') }}">
    <link rel="stylesheet" href="{{ url('css/general.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,100..900;1,9..144,100..900&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap" rel="stylesheet">
    
    <script src="/hw2/public/js/header.js" defer></script>
    <script src="{{ url('js/openLibrary.js') }}" defer></script>
    <script src="{{ url('js/ipGeolocation.js') }}" defer></script>
</head>
<body>
    @include('partials/header')

    <div class="background-texture"></div>

    <article>
        <div class="container">
            <h1>{{ $article['title'] }}</h1>
        </div>
        <div class="content-container container">
            <div class="publisher-info">
                <img class="publisher-img" src="{{ $article['author']['avatar'] ?? url('assets/images/default-avatar.jpg') }}" alt="">
                <div>
                    <span class="publisher-username">by {{ $article['author']['name'] }} {{ $article['author']['surname'] }}</span>
                    <span class="publish-date">{{ $article['publishDate'] }}</span>
                </div>
            </div>
            <div class="content">
                {!! $article['content'] !!}
            </div>
        </div>
    </article>

    @include('partials/footer')
</body>
</html>