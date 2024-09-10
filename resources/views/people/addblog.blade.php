<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AddBlog</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="h" rel="stylesheet">
</head>

<body>

    <form action="{{ route('people.add') }}" method="post" enctype="multipart/form-data"
            class="form-horizontal form-bordered">
            <h1>ADD Blogs</h1>
            @csrf
            <div class="form-group">
                <div class="col-md-6">
                    <input type="text" id="name" name="name" class="form-control" placeholder="ชื่อบทความ">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6">
                    <select name="category_id" class="select-chosen" style="width: 250px;">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <textarea type="text" name="description" rows="2" class="form-control" placeholder="รายละเอียดบทความ"></textarea>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <textarea type="text" name="content" rows="5" class="form-control" placeholder="เนื้อหาบทความ"></textarea>
                    @error('content')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <input type="file" name="image" class="form-control" placeholder="ภาพปก">
                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i>บันทึก</button>
                </div>
            </div>
        </form>

<style>
    /* ตั้งค่าพื้นหลังและการจัดวางของฟอร์ม */
form {
  background-color:#4F75FF; /* พื้นหลังสีฟ้าอ่อน */
  padding: 20px; /* ระยะห่างด้านในของฟอร์ม */
  border-radius: 10px; /* ขอบโค้งมน */
  max-width: 600px; /* กำหนดความกว้างสูงสุด */
  margin: 0 auto; /* จัดให้อยู่ตรงกลาง */
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); /* เพิ่มเงาเบาๆ */
}

/* กำหนดการจัดวางสำหรับ input, textarea, select */
input[type="text"],
textarea,
select,
input[type="file"] {
  width: 100%; /* ขยายให้กว้างเต็มที่ */
  padding: 10px; /* ระยะห่างด้านใน */
  margin-bottom: 15px; /* ระยะห่างด้านล่าง */
  border: 1px solid #ccc; /* ขอบสีเทาอ่อน */
  border-radius: 5px; /* ขอบโค้งมน */
  box-sizing: border-box; /* คำนวณขนาดกล่อง */
  font-size: 14px; /* ขนาดตัวอักษร */
}

/* ปุ่มบันทึก */
button[type="submit"] {
  background-color: white; /* สีพื้นหลังปุ่ม */
  color: #0056b3; /* สีตัวอักษรปุ่ม */
  padding: 10px 20px; /* ระยะห่างด้านในปุ่ม */
  border: 2px solid #0056b3; /* ขอบปุ่มสีน้ำเงิน */
  border-radius: 5px; /* ขอบโค้งมน */
  cursor: pointer; /* เปลี่ยนเคอร์เซอร์เมื่ออยู่เหนือปุ่ม */
  transition: background-color 0.3s ease, color 0.3s ease; /* เอฟเฟกต์เปลี่ยนสีเมื่อโฮเวอร์ */
}

button[type="submit"]:hover {
  background-color: #0056b3; /* สีพื้นหลังเมื่อโฮเวอร์ */
  color: white;
}

/* การตั้งค่าหัวข้อฟอร์ม */
h1 {
  text-align: center; /* จัดให้อยู่ตรงกลาง */
  color: white; /* สีของหัวข้อ */
}

/* การตั้งค่าสำหรับข้อความแจ้งเตือนข้อผิดพลาด */
.text-danger {
  color: red; /* สีของข้อความแจ้งข้อผิดพลาด */
  font-size: 12px; /* ขนาดของข้อความ */
}

/* การตั้งค่าแบ่งคอลัมน์ */
.form-group {
  margin-bottom: 20px; /* ระยะห่างระหว่างฟิลด์ */
}

</style>


</body>

</html>
