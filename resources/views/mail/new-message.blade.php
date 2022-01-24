<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>nouveau message sur la discussion {{ $talk->subject}}</h1>
    <p>L'utilisateur {{ $newMessage->author->name }} a écrit ceçi : </p>
    <p>{{ $newMessage->text}}</p>
    <a href="{{url('/'.$talk->id)}}">voir la discussion</a>
</body>
</html>