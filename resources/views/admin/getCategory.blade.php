<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-5">รายการประเภท</h1>
        <table class="min-w-full bg-white shadow rounded-lg">
            <thead>
                <tr class="w-full bg-gray-200 text-gray-600 uppercase text-xl leading-normal">
                    <th class="py-3 px-6 text-left">ชื่อประเภท</th>
                    <th class="py-3 px-6 text-center">เลือก</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                @foreach($categories as $category)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap font-bold">{{ $category->name }}</td>
                        <td class="py-3 px-6 text-center">
                            <a href="{{ route('admin.editCategory', $category->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">แก้ไข</a>
                            <form action="{{ route('admin.deleteCategory', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded" onclick="return confirm('คุณต้องการลบ Category นี้หรือไม่?')">ลบ</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{route('admin.active')}}" class="mt-5 inline-block bg-gray-500 text-white px-4 py-2 rounded">กลับ</a>
    </div>
</body>
</html>
