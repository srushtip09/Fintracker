<header class="site-header header-light-social header-transparent header-fixed" data-header-fixed="true" data-mobile-menu-resolution="992">
    <div class="container">
        <div class="header-inner">
            <nav id="site-navigation" class="main-nav">
                <div class="site-logo">
                    <a href="index.html" class="logo">
                        <h4 class="main-logo color-light">FinTracker</h4>
                        <h4 class="logo-sticky">FinTracker</h4>
                        {{-- <img src="assets/img/logo-social-sticky.png" alt="site logo" class="logo-sticky"> --}}
                    </a>
                </div>
                <!-- /.site-logo -->
                <div class="menu-wrapper main-nav-container canvas-menu-wrapper" id="mega-menu-wrap">
                    <div class="canvas-header">
                        <div class="mobile-offcanvas-logo">
                            <a href="index.html">
                                {{-- <img src="assets/img/logo-social-sticky.png" alt="site logo" class="logo-sticky"> --}}
                                <h4 class="logo-sticky">FinTracker</h4>
                            </a>
                        </div>
                        <div class="close-menu" id="page-close-main-menu">
                            <i class="ti-close"></i>
                        </div>
                    </div>
                    <ul class="astriol-main-menu">
                        <li class=" menu-item-depth-0">
                            <a href="#">Home</a>
                        </li>
                        <li class="menu-item-depth-0"><a href="#analytics">Features</a></li>
                        <li class="menu-item-depth-0"><a href="#our_team">Our Team</a></li>
                    </ul>
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <div class="nav-right">
                            <a href="{{ route('dashboard') }}" class="gp-btn color-six btn-circle">Dashboard</a>
                        </div>
                    @else
                        <div class="nav-right">
                            <a href="{{route('login')}}" class="gp-btn color-six btn-circle">Login</a>
                        </div>
                    @endif
                </div>
                <!-- /.menu-wrapper -->
                <div class="astriol-burger-menu" id="mobile-menu-open">
                    <span class="bar-one"></span>
                    <span class="bar-two"></span>
                    <span class="bar-three"></span>
                </div>
            </nav>
            <!-- /.site-nav -->
        </div>
        <!-- /.header-inner -->
    </div>
    <!-- /.container-full -->
</header>
