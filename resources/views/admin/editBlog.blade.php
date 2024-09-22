<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-5">Edit Blog</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-2 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.updateBlog', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Blog Title</label>
                <input type="text" id="name" name="name" value="{{ old('name', $blog->name) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                @error('name')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea id="description" name="description" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>{{ old('description', $blog->description) }}</textarea>
                @error('description')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="content" class="block text-gray-700">Content</label>
                <textarea id="content" name="content" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>{{ old('content', $blog->content) }}</textarea>
                @error('content')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-gray-700">Category</label>
                <select id="category_id" name="category_id" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $blog->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700">Image (optional)</label>
                <input type="file" id="image" name="image" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                @error('image')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Blog</button>
            <a href="{{ route('admin.getblog') }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</a>
        </form>
    </div>
</body>
</html>
