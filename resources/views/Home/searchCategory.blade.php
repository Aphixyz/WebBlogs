@extends('Home.layout')

@section('content')
    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
        <div class="page-wrapper">
            <div class="blog-top clearfix">
                <h4 class="pull-left">บทความหมวดหมู่ "{{ $categoryName }}" <a href="#"><i class="fa fa-rss"></i></a></h4>
            </div><!-- end blog-top -->

            <div class="blog-list clearfix">
                @foreach ($blogs as $blog)
                    <div class="blog-box row">
                        <div class="col-md-4">
                            <div class="post-media">
                                <a href="#" title="">
                                    <img src="{{ asset($blog->image) }}" alt="" class="img-fluid">
                                    <div class="hovereffect"></div>
                                </a>
                            </div><!-- end media -->
                        </div><!-- end col -->
                        <div class="blog-meta big-meta col-md-8">
                            <h4><a href="{{ route('blogDetail', $blog->id) }}" title="">{{ $blog->name }}</a></h4>
                            <p>{{ $blog->description }}</p>
                            <small class="firstsmall"><a class="bg-orange"
                                    href="{{ route('searchCategory', $blog->category->id) }}"
                                    title="">{{ $blog->category ? $blog->category->name : 'No Category' }}</a></small>
                            <small><a href="#" title="">{{ $blog->created_at }}</a></small>
                            <small><a href="{{ route('searchUser', $blog->user->id) }}" title="">by
                                    {{ $blog->user ? $blog->user->name : 'Unknown Author' }}</a></small>
                            <small><a href="#" title=""><i class="fa fa-eye">{{ $blog->connection }}</i>
                                </a></small>
                        </div><!-- end meta -->
                    </div><!-- end blog-box -->
                @endforeach
            </div><!-- end blog-list -->
        </div><!-- end page-wrapper -->
        <hr class="invis">
    </div><!-- end col -->
@endSection
