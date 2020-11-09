@extends('canevas')
@section('title', 'Messages')
@section('content')

<h1>Messages de {{$channel}}</h1>

<div>
    <table id="target">
    </table>
</div>

<form id="form">
    @csrf

    <textarea id="content" name="content" placeholder="Votre message..."></textarea></br>

</form>

<button id="post">Poster un message</button>

<script>
    $.ajax({
        url: "/api/channels/{{$channel}}",
        dataType: "json"
    }).then(function(reponse) {
        if (!$.trim(reponse)) {
            $("<p>").text("Aucun message pour le moment").appendTo($("#target"));
        }
        for (let message of reponse) {
            displayMsg(message);
        }
    }).fail(function(reponse) {
        alert("Un problème est survenu. Veuillez réessayer plus tard.");
    })

    $(document).ready(function() {
        $("#post").click(function() {
            let userLogin = "{{Session::get('key')}}";
            let userMsg = $("#content").val();

            $.post("/api/channels/{{$channel}}", {
                    login: userLogin,
                    content: userMsg
                },
                function(data, status) {
                    displayMsg(data);
                    $("textarea").val("");
                }
            ).fail(function(reponse) {
                alert("Un problème est survenu. Veuillez réessayer plus tard.");
            })
        });
    });

    function displayMsg(message) {
        let dateHour = (message.added_on).split(' ');
        let date = convertDate(dateHour[0]);
        let hour = convertHour(dateHour[1]);
        let id = message.id;

        $("<tr>").attr("id", id).append(
            $("<td>").text("Le " + date + " à " + hour)
        ).append(
            $("<td>").text(message.author_name)
        ).append(
            $("<td>").text(message.content)
        ).append($("<button>").text("Supprimer").click(function() {
            $.ajax({
                url: "/api/channels/{{$channel}}/" + id,
                type: "DELETE"
            }).then(function(reponse) {
                if (reponse != -1) {
                    $("#" + id).fadeOut();
                } else {
                    alert("Vous ne pouvez pas supprimer les messages des autres!");
                }
            }).fail(function(reponse) {
                alert("Un problème est survenu. Veuillez réessayer plus tard.");
            })
        })).appendTo($("#target"));
    }

    function convertDate($date) {
        let splitted = $date.split("-");

        let year = splitted[0];
        let month = splitted[1];
        let day = splitted[2];

        let monthNames = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "novembre", "décembre"];

        return day + " " + monthNames[month - 1] + " " + year;
    }

    function convertHour($hour) {
        let splitted = $hour.split(":");

        let hour = splitted[0];
        let minute = splitted[1];

        return hour + "h" + minute;
    }
</script>

@endsection