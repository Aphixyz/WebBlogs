@extends('people.layout')

@section('block-content')
    <div class="block">
        <!-- Basic Form Elements Title -->
        <div class="block-title">
            <h2><strong>แก้ไขบทความของคุณ</strong></h2>
        </div>

        <!-- END Form Elements Title -->
        <!-- Basic Form Elements Content -->
        <form id="update-form" enctype="multipart/form-data" class="form-horizontal form-bordered">
            @csrf
            @method('PUT')

            <div class="form-group">
                <div class="col-md-6">
                    <input type="text" id="name" name="name" class="form-control" placeholder="ชื่อบทความ"
                        value="{{ $blogEdit->name }}">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6">
                    <select name="category_id" class="select-chosen" style="width: 250px;">
                        <option value="{{ $blogEdit->category_id }}">{{ $blogEdit->category->name }}</option>
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
                    <textarea type="text" name="description" rows="2" class="form-control" placeholder="รายละเอียดบทความ">{{ $blogEdit->description }}</textarea>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <textarea type="text" name="content" rows="5" class="form-control" placeholder="เนื้อหาบทความ">{{ $blogEdit->content }}</textarea>
                    @error('content')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <img src="{{ asset($blogEdit->image) }}" width="100px" height="100px">
                    <input type="file" name="image" class="form-control" placeholder="ภาพปก">
                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <button type="button" class="btn btn-sm btn-primary" onclick="confirmUpdate()">
                        <i class="fa fa-angle-right"></i> อัปเดต
                    </button>
                    <button type="reset" class="btn btn-sm btn-default"><i class="fa fa-times"></i> ยกเลิก</button>
                    <a href="{{ route('people.active') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-left"></i>
                        กลับ</a>
                </div>
            </div>
        </form>
        <!-- END Basic Form Elements Content -->
    </div>

    <!-- SweetAlert2 Confirmation -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        function confirmUpdate() {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณต้องการบันทึกการเปลี่ยนแปลงนี้ใช่หรือไม่?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, อัปเดตเลย!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    // ทำการส่งคำขอด้วย AJAX
                    updateBlogAjax();
                }
            })
        }

        function updateBlogAjax() {
            var form = $('#update-form')[0];
            var formData = new FormData(form); // เก็บข้อมูลจากฟอร์ม

            $.ajax({
                url: '{{ url('updateData', $blogEdit->id) }}', // URL สำหรับส่งข้อมูล
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        title: 'อัปเดตข้อมูลเรียบร้อย!',
                        icon: 'success',
                        confirmButtonText: 'ตกลง',
                        timer: 2000
                    }).then(() => {
                        window.location.href =
                        "{{ route('people.active') }}"; // เปลี่ยนหน้าไปยัง people.active
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'เกิดข้อผิดพลาด!',
                        text: 'ไม่สามารถบันทึกข้อมูลได้',
                        icon: 'error',
                        confirmButtonText: 'ตกลง'
                    });
                }
            });
        }
    </script>
@endsection
