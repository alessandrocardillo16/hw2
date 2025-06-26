<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ url('css/general.css') }}">
    <link rel="stylesheet" href="{{ url('css/login.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accedi - DND</title>
</head>
<body>
    <div id="logo">
        <a class="home-anchor" href="/hw2/public">
            <img class="img-logo" src="/hw2/public/assets/images/login-logo.png" alt="DndBeyond Logo">
        </a>
    </div>
    <main class="login">
        <section class="login-container">
            <h5>Per continuare, accedi a D&D Beyond.</h5>
            @if($error)
                <p class="error">{{ $error }}</p>
            @endif
            <form name="login" method="post" action="{{ url('login') }}">
                @csrf
                <div class="email">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="{{ old('email') }}">
                </div>
                <div class="password">
                    <label for="password">Password</label>
                    <input type="password" name="password" value="{{ old('password') }}">
                </div>
                <input class="contained-button" type="submit" value="ACCEDI">
            </form>
            <div class="signup"><h4>Non hai un account?</h4></div>
            <a class="contained-button contained-button-red" href="{{ url('register') }}">ISCRIVITI</a>
        </section>
    </main>
</body>
</html>