<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AddBlog</title>
</head>

<body>
    <h2>Blogs</h2>
    <form action="{{ route('people.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" id="name" required>ชื่อบทความ<br><br>
        <input type="text" name="description" id="description" required>คำอธิบาย<br><br>
        <input type="text" name="content" id="content" required>เนื้อหาบทความ<br><br>
        <input type="number" name="connection" id="connection" required>เกี่ยวข้องของบทความ<br><br>
        <input type="file" name="image" id="image" accept="image/*"><br>รูปภาพของบทความ<br>
        <label for="category_id">Select a category:</label>
        <select name="category_id" id="category_id" required>
            <option value="" disabled selected>Select a category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <div class="flex justify-end">
            <button type="submit">Submit</button>
        </div>
    </form>

</body>

</html>
