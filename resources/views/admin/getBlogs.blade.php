<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บล็อกทั้งหมด</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script defer>
        // ฟังก์ชันสำหรับเปิด Modal
        function openModal(blogId) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('confirmDeleteBtn').setAttribute('data-blog-id', blogId);
        }

        // ฟังก์ชันสำหรับปิด Modal
        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // ฟังก์ชันสำหรับยืนยันการลบ
        function confirmDelete() {
            const blogId = document.getElementById('confirmDeleteBtn').getAttribute('data-blog-id');
            document.getElementById(`deleteForm_${blogId}`).submit();
        }
    </script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-4xl font-bold mb-5">บล็อกทั้งหมด</h1>

        <table class="min-w-full bg-white shadow rounded-lg">
            <thead>
                <tr class="w-full bg-gray-200 text-gray-600 uppercase text-2xl leading-normal">
                    <th class="py-3 px-6 text-left">รูปภาพ</th>
                    <th class="py-3 px-6 text-left">ชื่อบล็อก</th>
                    <th class="py-3 px-6 text-left">รายละเอียด</th>
                    <th class="py-3 px-6 text-left">ประเภท</th>
                    <th class="py-3 px-6 text-center">อื่นๆ</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                @foreach($blogs as $blog)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">
                            @if($blog->image)
                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->name }}" class="h-16 w-16 object-cover rounded">
                            @else
                                ไม่มีรูปภาพ
                            @endif
                        </td>
                        <td class="py-3 px-6 text-left font-bold">{{ $blog->name }}</td>
                        <td class="py-3 px-6 text-left font-bold">{{ $blog->description }}</td>
                        <td class="py-3 px-6 text-left font-bold">{{ $blog->category->name }}</td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('admin.editBlog', $blog->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded w-24 font-bold">แก้ไข</a>
                                <button onclick="openModal({{ $blog->id }})" class="bg-red-500 text-white px-4 py-2 rounded w-24 font-bold">ลบ</button>

                                <!-- ฟอร์มสำหรับลบบล็อก -->
                                <form id="deleteForm_{{ $blog->id }}" action="{{ route('admin.deleteBlog', $blog->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('admin.active') }}" class="mt-5 inline-block bg-gray-500 text-white px-4 py-2 rounded">ย้อนกลับ</a>
    </div>

    <!-- Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md">
            <h2 class="text-xl font-bold mb-4 text-center">ยืนยันการลบ</h2>
            <p class="mb-6 text-center">คุณแน่ใจใช่ไหมว่าจะลบบล็อกนี้?</p>
            <div class="flex justify-center space-x-4"> <!-- เปลี่ยนจาก justify-end เป็น justify-center -->
                <button class="bg-green-500 text-white px-4 py-2 rounded" id="confirmDeleteBtn" onclick="confirmDelete()">ยืนยัน</button>
                <button class="bg-red-500 text-white px-4 py-2 rounded" onclick="closeModal()">ยกเลิก</button>
            </div>
        </div>
    </div>

</body>
</html>
