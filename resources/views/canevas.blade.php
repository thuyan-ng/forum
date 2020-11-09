<!DOCTYPE html>
<html lang="fr">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/stylesheet.css" />
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>

    <ul class="navbar">
        <li><a class="active" href="/channels">Home</a></li>
        @if(Session::has('key'))
        <li id="navbarLogin">{{Session::get('key')}}</li>
        <li><a href="/connexion/logout">Deconnexion</a></li>
        @else
        <li><a href="/connexion">Connexion</a></li>
        @endif
    </ul>

    <main>
        @yield('content')
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    </main>
</body>

</html>