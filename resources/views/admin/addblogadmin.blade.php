@extends('admin.layout')

@section('block-content')
    <div class="block">
        <!-- Basic Form Elements Title -->
        <div class="block-title">
            <h2><strong>เขียนบทความของคุณ</strong></h2>
        </div>
        <!-- Check for success message and display it -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <!-- END Form Elements Title -->
        <!-- Basic Form Elements Content -->
        <form action="{{ route('admin.addblod') }}" method="post" enctype="multipart/form-data"
            class="form-horizontal form-bordered">
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
                    <button type="reset" class="btn btn-sm btn-default"><i class="fa fa-times"></i> ยกเลิก</button>
                    <a href="{{ route('admin.active') }}" class="btn btn-sm btn-primary"><i
                            class="fa fa-angle-left"></i>กลับ</a>
                </div>
            </div>
        </form>
        <!-- END Basic Form Elements Content -->
    </div>
@endsection
