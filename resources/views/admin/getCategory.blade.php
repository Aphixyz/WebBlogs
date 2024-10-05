@extends('admin.layout')

@section('block-content')
<div class="container mx-auto mt-10 p-8 bg-white shadow-lg rounded-lg max-w-4xl">
    <h1 class="text-3xl font-bold mb-6 text-gray-700">เพิ่มประเภท</h1>
    <form action="{{ route('admin.addcategory') }}" method="POST" enctype="multipart/form-data" class="mb-10">
        @csrf
        <div class="mb-4">
            <input type="text" name="name" id="name" required placeholder="ใส่ชื่อประเภท" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition duration-200 ease-in-out">
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200 ease-in-out">เพิ่ม</button>
    </form>

    <h1 class="text-3xl font-bold mb-5 text-gray-700">รายการประเภท</h1>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-lg rounded-lg">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ชื่อประเภท</th>
                    <th class="py-3 px-6 text-center">เลือก</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($categories as $category)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap font-medium">{{ $category->name }}</td>
                        <td class="py-3 px-6 text-center">
                            <a href="{{ route('admin.editCategory', $category->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-200 ease-in-out">แก้ไข</a>
                            <form action="{{ route('admin.deleteCategory', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-200 ease-in-out" onclick="return confirm('คุณต้องการลบ Category นี้หรือไม่?')">ลบ</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- ปุ่มกลับ -->
    <div class="mt-6">
        <a href="{{route('admin.active')}}" class="inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-200 ease-in-out">กลับ</a>
    </div>
</div>
@endsection
