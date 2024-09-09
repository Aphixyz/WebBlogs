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
    <form action="{{ route('addform') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="mt-1 p-2 border border-gray-300 rounded w-full" required>
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="3" class="mt-1 p-2 border border-gray-300 rounded w-full" required></textarea>
        </div>

        <!-- Content -->
        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
            <textarea name="content" id="content" rows="5" class="mt-1 p-2 border border-gray-300 rounded w-full" required></textarea>
        </div>

        <!-- Connection -->
        <div class="mb-4">
            <label for="connection" class="block text-sm font-medium text-gray-700">Connection</label>
            <input type="text" name="connection" id="connection" class="mt-1 p-2 border border-gray-300 rounded w-full">
        </div>

        <!-- Image -->
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
            <input type="file" name="image" id="image" class="mt-1 p-2 border border-gray-300 rounded w-full">
        </div>

        <!-- Category -->
        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
            <select name="category_id" id="category_id" class="mt-1 p-2 border border-gray-300 rounded w-full">
                <option value="" disabled selected>Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Submit</button>
        </div>
    </form>

</body>
</html>
