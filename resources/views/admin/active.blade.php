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
    <a href="{{ route('admin.getblog') }}">get blog</a>
    <a href="{{ route('admin.formaddcategory') }}">add category</a>
    <a href="{{ route('admin.getCategory') }}">get category</a>
    <a href="{{ route('admin.getfromblog') }}">add blog</a>
</body>

</html>
