<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>

<body>
    <form action="{{ route('admin.addcategory') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" id="name" required placeholder="category">
        <button type="submit">Submit</button>
    </form>
    <a href="{{ route('admin.active') }}">black</a>
</body>

</html>
