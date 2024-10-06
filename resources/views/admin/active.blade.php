{{-- <h1>
        @if (session('message'))
            <p>Welcome, {{ session('message') }}!</p>
        @endif
    <form action="{{route('admin.active')}}">
        </h1>
        <a href="{{ route('admin.getblog') }}">get blog</a>
        <a href="{{ route('admin.formaddcategory') }}">add category</a>
        <a href="{{ route('admin.getCategory') }}">get category</a>
        <a href="{{ route('admin.getfromblog') }}">add blog</a>

        <a href="{{route('logout')}}">logout</a>
    </form> --}}

@extends('admin.layout')

@section('block-content')
    <!-- ตารางบทความ -->
    <div class="block full">
        <!-- All Title -->
        <div class="block-title">
            <div class="block-options pull-right">
                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Settings"><i
                        class="fa fa-cog"></i></a>
            </div>
            <h2><strong>บทความทั้งหมด</strong></h2>
        </div>
        <!-- Title -->

        <!--Content -->
        <table id="ecom-products" class="table table-bordered table-striped table-vcenter">
            <thead>
                <tr>
                    <th class="text-center" style="width: 70px;">รหัส</th>
                    <th>ภาพปก</th>
                    <th class="text-right hidden-xs">ชื่อบทความ</th>
                    <th class="hidden-xs">ยอดเข้าชม (View)</th>
                    <th class="hidden-xs text-center">หมวดหมู่บทความ</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $item)
                    <tr id="blog-{{ $item->id }}"> <!-- Add ID to the row for removal after delete -->
                        <td class="text-center">{{ $item->id }}</td>
                        <td><img src="{{ asset($item->image) }}" alt="" style="width: 60px; height: 50px"></td>
                        <td class="text-right hidden-xs"><strong>{{ $item->name }}</strong></td>
                        <td class="text-center">{{ $item->connection }}</td>
                        <td class="hidden-xs text-center">{{ $item->category->name }}</td>
                        <td class="text-center">
                            <div class="btn-group btn-group-xs">
                                <a href="{{ route('admin.editData', $item->id) }}" data-toggle="tooltip" title="Edit"
                                    class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                <!-- ปุ่ม Delete ใช้ JavaScript -->
                                <button class="btn btn-xs btn-danger" onclick="confirmDelete({{ $item->id }})">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- END All Products Content -->
    </div>

    <!-- JavaScript function to handle delete with confirmation -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณจะไม่สามารถกู้ข้อมูลนี้กลับมาได้!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, ลบเลย!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    // ใช้ Ajax เพื่อลบข้อมูล
                    $.ajax({
                        url: "/deleteData/" + id,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            $("#blog-" + id).remove();
                            Swal.fire({
                                title: 'ลบข้อมูลเรียบร้อย',
                                icon: 'success',
                                confirmButtonText: 'ตกลง',
                                timer: 2000
                            });
                        },
                        error: function(response) {
                            Swal.fire({
                                title: 'เกิดข้อผิดพลาด',
                                text: 'ไม่สามารถลบข้อมูลได้',
                                icon: 'error',
                                confirmButtonText: 'ตกลง'
                            });
                        }
                    });
                }
            })
        }
    </script>
@endsection
