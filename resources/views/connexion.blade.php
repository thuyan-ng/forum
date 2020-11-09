@extends('canevas')
@section('title', 'Connexion')
@section('content')

    <div>
        <h1>Connexion</h1>
    
        <form action="/connexion/login" method="get">
        @csrf

        <label id="loginLabel">Login: </label></br>
        <input type="text" name="login" id="login" placeholder="Votre login..."></br>

        <button>Confirmer</button></br>

        </form>

    </div>

    <div>
        <h1>Création d'un compte</h1>

        <form action="/connexion" method="post">
         @csrf

            <label id="newLogin">Login : </label></br>
            <input type="text" name="newLogin" placeholder="Votre login..."></br>
            <label id="name">Nom : </label></br>
            <input type="text" name="name" placeholder="Votre nom..."></br>

            <button>Créer un compte</button>
    
        </form>

    </div>      

@endsection