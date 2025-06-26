<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ url('css/general.css') }}">
    <link rel="stylesheet" href="{{ url('css/signup.css') }}">
    <script src="{{ url('js/sigup.js')}}" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/hw1/icons/favicon.png">
    <meta charset="utf-8">
    <title>Iscriviti - DND</title>
</head>
<body>
    <div id="logo">
        <a class="home-anchor" href="/hw2/public">
            <img class="img-logo" src="/hw2/public/assets/images/login-logo.png" alt="DndBeyond Logo">
        </a>
    </div>
    <main>
        <section class="main_left"></section>
        <section class="main_right">
            <form name="signup" method="post" enctype="multipart/form-data" autocomplete="off" action="{{ url('register') }}">
                @csrf
                <div class="names">
                    <div class="name">
                        <label for="name">Nome</label>
                        <input type="text" name="name" value="{{ old('name') }}">
                        <div><img src="/hw1/icons/close.svg"/><span>Devi inserire il tuo nome</span></div>
                    </div>
                    <div class="surname">
                        <label for="surname">Cognome</label>
                        <input type="text" name="surname" value="{{ old('surname') }}">
                        <div><img src="/hw1/icons/close.svg"/><span>Devi inserire il tuo cognome</span></div>
                    </div>
                </div>
                <div class="email">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="{{ old('email') }}">
                    <div><img src="/hw1/icons/close.svg"/><span>Indirizzo email non valido</span></div>
                </div>
                <div class="password">
                    <label for="password">Password</label>
                    <input type="password" name="password" value="{{ old('password') }}">
                    <div><img src="/hw1/icons/close.svg"/><span>Inserisci almeno 8 caratteri</span></div>
                </div>
                <div class="confirm_password">
                    <label for="password_confirmation">Conferma Password</label>
                    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}">
                    <div><img src="/hw1/icons/close.svg"/><span>Le password non coincidono</span></div>
                </div>
                <div class="allow">
                    <input type="checkbox" name="allow" value="1" {{ old('allow') ? 'checked' : '' }}>
                    <label for="allow">Accetto i termini e condizioni d'uso di D&D Beyond.</label>
                </div>
                @if($error)
                    <div class="errorj"><img src="/hw1/icons/close.svg"/><span>{{ $error }}</span></div>
                @endif
                <div>
                    <input class="contained-button" type="submit" value="Registrati" id="submit">
                </div>
            </form>
            <div class="login"><h4>Hai già un account</h4></div>
            <a class="contained-button contained-button-red" href="{{ url('login') }}">ACCEDI</a>
        </section>
    </main>
</body>
</html>