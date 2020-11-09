@extends('canevas')
@section('title', 'Forum de discussion')
@section('content')

    <h1>Forum de discussion</h1>

@if(Session::has('key'))

    <div>
        <table id="target" class="chatroom">
        </table>
    </div>

    <div>
    <p class="h2">Créer un nouveau chatroom</p>

    <form action="/channels" method="post">
    @csrf

        <label id="title">Titre:</label></br>
        <input type="text" name="title"></br>
        <label id="topic">Description: </label></br>
        <textarea name="topic"></textarea></br>
        <button>Ajouter</button></br>
        </br>
    </div>

    <script>
    $.ajax({
        url: "/api/channels",
        dataType: "json"
    }).then(function(reponse){
        if(!$.trim(reponse)){
                $("<p>").text("Aucun chatroom pour le moment").appendTo($("#target"));
            }
        for(let channel of reponse){
            displayChannel(channel);
        }
    }).fail(function(reponse){
        console.log("Ooops");
        console.log(reponse);
    })

    function displayChannel(channel){
        $("#target").append(
                $("<tr>").attr("id", channel.id).append(
                    $("<td>").append(
                        $("<a href=channels/" + channel.name + ">").text(channel.name)
                    ).append(
                        $("<td>").text(channel.topic)
                    )
                )
            );
    }
    </script>

@else
    <div>
        <p> Vous devez vous identifier d'abord! </p>        
    </div>
@endif
@endsection