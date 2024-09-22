<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขประเภท</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-5">แก้ไขประเภท</h1>
        <form action="{{ route('admin.updateCategory', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold	">ชื่อประเภท:</label>
                <input type="text" name="name" value="{{ $category->name }}" class="w-full p-2 border border-gray-300 rounded">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">อัพเดท</button>
            <a href="{{route('admin.getCategory')}}" class="mt-5  inline-block bg-gray-500 text-white px-4 py-2 rounded">กลับ</a>
        </form>

    </div>
</body>
</html>
