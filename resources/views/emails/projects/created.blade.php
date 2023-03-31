<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style>
            * {
                font-family: sans-serif;
                color: #076168
            }
        </style>
        <title>Hai creato un nuovo progetto!</title>
    </head>
    <body>
        <header>
            <h1>Nuovo progetto creato!</h1>
        </header>

        <main>
            <h2>Titolo: {{ $project->title }}</h2>
            <h5>Link:
                <a href="#">{{ $project->link }}</a>
            </h5>
            <p>Descrizione: {!! nl2br($project->description) !!}</p>
        </main>

    </body>
</html>