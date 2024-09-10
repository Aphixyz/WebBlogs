<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>
        @if (session('message'))
            <p>Welcome, {{ session('message') }}!</p>
        @endif
    </h1>
    <form action="">
        
    </form>

    <a href="{{ route('people.getfrom') }}">add</a>
</body>
