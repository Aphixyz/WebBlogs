@extends('Home.layout')


@section('content')
    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
        <div class="page-wrapper">
            <div class="blog-title-area text-center">
                <span class="color-orange"><a href="{{ route('searchCategory', $blog->category->id) }}"
                        title="">{{ $blog->category->name }}</a></span>
                <h3>{{ $blog->name }}</h3>

                <div class="blog-meta big-meta">
                    <small><a href="#" title="">{{ $blog->created_at }}</a></small>
                    <small><a href="{{ route('searchUser', $blog->user->id) }}" title="">by
                            {{ $blog->user->name }}</a></small>
                    <small><a href="#" title=""><i class="fa fa-eye"></i> {{ $blog->connection }}</a></small>
                </div><!-- end meta -->
            </div><!-- end title -->

            <div class="single-post-media">
                <img src="{{ asset($blog->image) }}" alt="" class="img-fluid">
            </div><!-- end media -->
            <div class="blog-content">

                {{ $blog->description }}
                <br>
                {{ $blog->content }}
            </div><!-- end content -->
        </div><!-- end page-wrapper -->
    </div><!-- end col -->
@endsection
