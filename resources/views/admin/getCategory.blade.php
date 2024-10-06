@extends('admin.layout')

@section('block-content')
<div class="container">
    <h1 class="title">เพิ่มประเภท</h1>
    <form action="{{ route('admin.addcategory') }}" method="POST" enctype="multipart/form-data" class="form">
        @csrf
        <div class="input-group">
            <input type="text" name="name" id="name" required placeholder="ใส่ชื่อประเภท" class="input-field">
        </div>
        <button type="submit" class="submit-button">เพิ่ม</button>
    </form>

    <h1 class="title">รายการประเภท</h1>
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr class="table-header">
                    <th class="table-cell">ชื่อประเภท</th>
                    <th class="table-cell">เลือก</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr class="table-row">
                        <td class="table-cell">{{ $category->name }}</td>
                        <td class="table-cell">
                            <a href="{{ route('admin.editCategory', $category->id) }}" class="edit-button">แก้ไข</a>
                            <form action="{{ route('admin.deleteCategory', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button" onclick="return confirm('คุณต้องการลบ Category นี้หรือไม่?')">ลบ</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- ปุ่มกลับ -->
    <div class="back-button-container">
        <a href="{{route('admin.active')}}" class="back-button">กลับ</a>
    </div>
</div>


<style>
    /* Container */
/* .container {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 0.5rem;
} */

/* Titles */
.title {
    font-size: 30px; /* 3xl */
    font-weight: bold;
    margin-bottom: 1.5rem;
    color: #4A5568; /* text-gray-700 */
}

/* Form */
.form {
    margin-bottom: 2.5rem;
}

.input-group {
    margin-bottom: 1rem;
}

a {
    text-decoration: none !important;

}

.input-field {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #CBD5E0; /* border-gray-300 */
    border-radius: 0.375rem;
    transition: border-color 0.2s ease-in-out;
}

.input-field:focus {
    outline: none;
    border-color: #4299E1; /* border-blue-500 */
}

/* Button */
.submit-button {
    background-color: #3182CE; /* bg-blue-500 */
    color: white;
    font-weight: bold;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    transition: background-color 0.2s ease-in-out;
}

.submit-button:hover {
    background-color: #2B6CB0; /* hover:bg-blue-700 */
}

/* Table */
.table-container {
    overflow-x: auto;
}

.data-table {
    width: 100%;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 0.5rem;
}

.table-header {
    background-color: #E2E8F0; /* bg-gray-200 */
    color: #4A5568; /* text-gray-600 */
    text-transform: uppercase;
    font-size: 24px; /* text-sm */
    line-height: 1.5;
}

.table-row {
    border-bottom: 1px solid #E2E8F0; /* border-gray-200 */
}

.table-row:hover {
    background-color: #EDF2F7; /* hover:bg-gray-100 */
}

.table-cell {
    padding: 0.75rem 1.5rem;
    text-align: left;
}

/* Buttons in table */
.edit-button {
    background-color: rgba(207, 177, 5, 0.644); /* bg-green-500 */
    color: white;
    font-weight: bold;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    transition: background-color 0.2s ease-in-out;
    text-decoration: none;
}

.edit-button:hover {
    background-color: rgb(197, 197, 12); /* hover:bg-green-700 */
}

.delete-button {
    background-color: #F56565; /* bg-red-500 */
    color: white;
    font-weight: bold;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    transition: background-color 0.2s ease-in-out;
}

.delete-button:hover {
    background-color: #C53030; /* hover:bg-red-700 */
}

/* Back Button */
.back-button-container {
    margin-top: 1.5rem;
}

.back-button {
    background-color: #A0AEC0; /* bg-gray-500 */
    color: white;
    font-weight: bold;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    transition: background-color 0.2s ease-in-out;
    text-decoration: none;
}

.back-button:hover {
    background-color: #718096; /* hover:bg-gray-700 */
}

</style>
@endsection
