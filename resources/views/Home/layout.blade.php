<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Blogging</title>
<link rel="shortcut icon" href="{{ asset('static/frontend/images/favicon.ico') }}" type="image/x-icon" />
<link rel="apple-touch-icon" href="{{ asset('static/frontend/images/apple-touch-icon.png') }}">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('static/frontend/css/bootstrap.css') }}">
<link href="{{ asset('static/frontend/css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('static/frontend/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('static/frontend/css/responsive.css') }}" rel="stylesheet">
<link href="{{ asset('static/frontend/css/colors.css') }}" rel="stylesheet">
<link href="{{ asset('static/frontend/css/version/tech.css') }}" rel="stylesheet">

</head>

<body>
    <div id="wrapper">
        <header class="tech-header header">
            <div class="container-fluid">
                <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                        data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="/"><img
                            src="{{ asset('static/frontend/images/version/tech-logo.png') }}" alt=""></a>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/login">writer</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div><!-- end container-fluid -->
        </header><!-- end market-header -->
        <section class="section first-section">
            <div class="container-fluid">
                <div class="masonry-blog clearfix">
                    <div class="row">
                        @foreach ($latest as $blog)
                            <div class="col-md-4">
                                <div class="masonry-box post-media">
                                    <img src="{{ $blog->image }}" alt="" class="img-fluid">
                                    <div class="shadoweffect">
                                        <div class="shadow-desc">
                                            <div class="blog-meta">
                                                <span class="bg-orange"><a
                                                        href="{{ route('searchCategory', $blog->category->id) }}"
                                                        title="">{{ $blog->category ? $blog->category->name : 'No Category' }}</a></span>
                                                <h4><a href="{{ route('blogDetail', $blog->id) }}"
                                                        title="">{{ $blog->name }}</a></h4>
                                                <small><a href="#"
                                                        title="">{{ $blog->created_at }}</a></small>
                                                <small><a href="{{ route('searchUser', $blog->user->id) }}"
                                                        title="">by
                                                        {{ $blog->user->name }}</a></small>
                                                <small><a href="#" title=""><i
                                                            class="fa fa-eye">{{ $blog->connection }}</i>
                                                    </a></small>
                                            </div><!-- end meta -->
                                        </div><!-- end shadow-desc -->
                                    </div><!-- end shadow -->
                                </div><!-- end post-media -->
                            </div><!-- end col-md-4 -->
                        @endforeach
                    </div><!-- end row -->
                </div><!-- end masonry -->
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="row">
                    @yield('content')

                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="sidebar">
                            <div class="widget">
                                <h2 class="widget-title">บทความยอดนิยม</h2>
                                <div class="trend-videos">
                                    @foreach ($popular as $pop)
                                        <div class="blog-box">
                                            <div class="post-media">
                                                <a href="{{ route('blogDetail', $pop->id) }}" title="">
                                                    <img src="{{ asset($pop->image) }}" alt=""
                                                        class="img-fluid">
                                                    <div class="hovereffect">
                                                        <span class="videohover"></span>
                                                    </div><!-- end hover -->
                                                </a>
                                            </div><!-- end media -->
                                            <div class="blog-meta">
                                                <h4><a href="{{ route('blogDetail', $pop->id) }}"
                                                        title="">{{ $pop->name }}</a></h4>
                                            </div><!-- end meta -->
                                        </div><!-- end blog-box -->
                                        <hr class="invis">
                                    @endforeach
                                </div><!-- end videos -->
                            </div><!-- end widget -->

                            <div class="widget">
                                <h2 class="widget-title">บทความแนะนำ</h2>
                                <div class="blog-list-widget">
                                    <div class="list-group">
                                        @foreach ($suggestion as $sugges)
                                            <a href="{{ route('blogDetail', $sugges->id) }}"
                                                class="list-group-item list-group-item-action flex-column align-items-start">
                                                <div class="w-100 justify-content-between">
                                                    <img src="{{ asset($sugges->image) }}" alt=""
                                                        class="img-fluid float-left">
                                                    <h5 class="mb-1">{{ $sugges->name }}</h5>
                                                    <small>{{ $sugges->created_at }}</small>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div><!-- end blog-list -->
                            </div><!-- end widget -->
                            <hr class="invis">
                        </div><!-- end sidebar -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>
        <div class="dmtop">Scroll to Top</div>

    </div><!-- end wrapper -->

    <!-- Core JavaScript
    ================================================== -->
    <script src="{{ asset('static/frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('static/frontend/js/tether.min.js') }}"></script>
    <script src="{{ asset('static/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('static/frontend/js/custom.js') }}"></script>

</body>

</html>
