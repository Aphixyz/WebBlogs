<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>Writer Panel</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
    <link rel="stylesheet" href="{{ asset('static/backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/backend/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('static/backend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('static/backend/css/themes.css') }}">
    <script src="{{ asset('static/backend/js/vendor/modernizr.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div id="page-wrapper">
        <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">
            <!-- Main Sidebar -->
            <div id="sidebar">
                <!-- Wrapper for scrolling functionality -->
                <div id="sidebar-scroll">
                    <!-- Sidebar Content -->
                    <div class="sidebar-content">
                        <!-- Brand -->
                        <a href="{{ route('people.active') }}" class="sidebar-brand">
                            <i class="gi gi-flash"></i><span
                                class="sidebar-nav-mini-hide"><strong>Writer</strong>Panel</span>
                        </a>
                        <!-- END Brand -->

                        <!-- User Info -->
                        <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                            <div class="sidebar-user-avatar">
                                <a href="{{ route('people.active') }}">
                                    <img src="{{ asset('static/backend/img/placeholders/avatars/avatar2.jpg') }}"
                                        alt="avatar">
                                </a>
                            </div>
                            <div class="sidebar-user-name">{{ Auth::user()->name }}</div>
                        </div>
                        <!-- END User Info -->
                        <!-- Sidebar Navigation -->
                        <ul class="sidebar-nav">
                            <li>
                                <a href="{{ route('people.active') }}" class=" active"><i
                                        class="gi gi-stopwatch sidebar-nav-icon"></i><span
                                        class="sidebar-nav-mini-hide">ภาพรวม</span></a>
                            </li>
                            <li class="sidebar-header">
                                <span class="sidebar-header-options clearfix"><a href="javascript:void(0)"
                                        data-toggle="tooltip" title="Quick Settings"><i
                                            class="gi gi-settings"></i></a></span>
                                <span class="sidebar-header-title">จัดการข้อมูล</span>
                            </li>
                            <li>
                                <a href="#" class="sidebar-nav-menu"><i
                                        class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i
                                        class="gi gi-notes_2 sidebar-nav-icon"></i><span
                                        class="sidebar-nav-mini-hide">Forms</span></a>
                                <ul>
                                    <li>
                                        <a href="#">General</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="sidebar-nav-menu"><i
                                        class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i
                                        class="gi gi-table sidebar-nav-icon"></i><span
                                        class="sidebar-nav-mini-hide">Tables</span></a>
                                <ul>
                                    <li>
                                        <a href="#">General</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <!-- END Sidebar Navigation -->
                    </div>
                    <!-- END Sidebar Content -->
                </div>
                <!-- END Wrapper for scrolling functionality -->
            </div>
            <!-- END Main Sidebar -->

            <!-- Main Container -->
            <div id="main-container">
                <header class="navbar navbar-default">
                    <!-- Left Header Navigation -->
                    <ul class="nav navbar-nav-custom">
                        <!-- Main Sidebar Toggle Button -->
                        <li>
                            <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                                <i class="fa fa-bars fa-fw"></i>
                            </a>
                        </li>
                        <!-- END Main Sidebar Toggle Button -->
                    </ul>
                    <!-- END Left Header Navigation -->
                    <!-- Search Form -->
                    <form action="page_ready_search_results.html" method="post" class="navbar-form-custom">
                        <div class="form-group">
                            <input type="text" id="top-search" name="top-search" class="form-control"
                                placeholder="Search..">
                        </div>
                    </form>
                    <!-- END Search Form -->

                    <!-- Right Header Navigation -->
                    <ul class="nav navbar-nav-custom pull-right">
                        <!-- User Dropdown -->
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset('static/backend/img/placeholders/avatars/avatar2.jpg') }}"
                                    alt="avatar"> <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                <li class="dropdown-header text-center">บัญชีผู้ใช้</li>
                                <li class="divider"></li>
                                <li>
                                    @if (Auth::check() && Auth::user()->id)
                                        <a href="{{ route('searchUser', ['user_id' => Auth::user()->id]) }}"
                                            target="_blank">
                                            <i class="fa fa-user fa-fw pull-right"></i>
                                            ดูบทความของฉัน
                                        </a>
                                    @endif
                                    <!-- Opens the user settings modal that can be found at the bottom of each page (page_footer.html in PHP version) -->
                                    <a href="{{ route('logout') }}"><i class="fa fa-ban fa-fw pull-right"></i>
                                        ออกจากระบบ</a>
                                </li>
                                <li class="divider"></li>
                            </ul>
                        </li>
                        <!-- END User Dropdown -->
                    </ul>
                    <!-- END Right Header Navigation -->
                </header>
                <!-- END Header -->

                <!-- Page content -->
                <div id="page-content">
                    <!-- Mini Top Stats Row -->
                    <div class="row">
                        <div class="col-sm-6 col-lg-3">
                            <!-- Widget -->
                            <a href="{{ route('people.getfrom') }}" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <div class="widget-icon pull-left themed-background-autumn animation-fadeIn">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <h3 class="widget-content text-right animation-pullDown">
                                        เขียน<strong>บทความ</strong><br>
                                        <small>ของคุณที่นี่!</small>
                                    </h3>
                                </div>
                            </a>
                            <!-- END Widget -->
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <!-- Widget -->
                            <a href="{{ route('people.active') }}" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <div class="widget-icon pull-left themed-background-spring animation-fadeIn">
                                        <i class="gi gi-table"></i>
                                    </div>
                                    <h3 class="widget-content text-right animation-pullDown">
                                        จำนวน <strong>{{ number_format($blogCount) }}</strong><br>
                                        <small>บทความ</small>
                                    </h3>
                                </div>
                            </a>
                            <!-- END Widget -->
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <!-- Widget -->
                            <a href="{{ route('people.active') }}" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <div class="widget-icon pull-left themed-background-amethyst animation-fadeIn">
                                        <i class="fa fa-heart"></i>
                                    </div>
                                    <h3 class="widget-content text-right animation-pullDown">
                                        + {{ number_format($viewCount) }}<strong>Views</strong>
                                        <small>ยอดเข้าชมทั้งหมด</small>
                                    </h3>
                                </div>
                            </a>
                            <!-- END Widget -->
                        </div>
                    </div>
                    <!-- END Mini Top Stats Row -->
                    @yield('block-content')
                </div>
                <!-- END Page Content -->
            </div>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
    </div>
    <!-- END Page Wrapper -->
    <!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
    <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>
    <!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
    <script src="{{ asset('static/backend/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('static/backend/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('static/backend/js/plugins.js') }}"></script>
    <script src="{{ asset('static/backend/js/app.js') }}"></script>

    <script src="{{ asset('static/backend/js/pages/ecomProducts.js') }}"></script>
    <script>
        $(function() {
            EcomProducts.init();
        });
    </script>
</body>

</html>
