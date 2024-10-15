<!-- main header -->
<header class="main-header">
    <!-- header-top -->
    <div class="header-top">
        <div class="shape" style="background-image: url({{asset('FE/images/shape/shape-16.png')}})"></div>
        <div class="auto-container">
            <div class="top-inner clearfix">
                <div class="left-column pull-left">
                    <ul class="social-links clearfix"></ul>
                </div>
                <div class="right-column pull-right">
                    <ul class="info-box clearfix">
                    <li>
                        <div class="icon-box"><i class="fas fa-envelope"></i></div>
                        <p>Email: <a href="tel:ruhoya.ina@gmail.com">ruhoya.ina@gmail.com</a></p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- header-lower -->
<div class="header-lower">
    <div class="auto-container">
        <div class="outer-box">
            <div class="logo-box">
                <div class="shape" style="background-image: url({{asset('FE/images/shape/shape-1.png')}})"></div>
                <figure class="logo">
                    <a href="{{url('/')}}"><img src="{{asset('FE/images/ruhoya-logo.png')}}" alt="" /></a>
                </figure>
            </div>
            <div class="menu-area clearfix">
                <!--Mobile Navigation Toggler-->
                <div class="mobile-nav-toggler">
                    <i class="icon-bar"></i>
                    <i class="icon-bar"></i>
                    <i class="icon-bar"></i>
                </div>
                <nav class="main-menu navbar-expand-md navbar-light">
                    <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                        <ul class="navigation clearfix">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><a href="{{url('/tentang')}}">Tentang</a></li>
                            <li><a href="{{url('/galeri')}}">Galeri</a></li>
                            <li><a href="{{url('/identifikasi')}}">Identifikasi</a></li>
                            <li><a href="{{url('/database')}}">Database Hoya</a></li>
                            {{-- <li><a href="{{url('/tim-ahli')}}">Tim Ahli</a></li> --}}
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="nav-right">
                <div class="btn-box">
                    <a href="{{url('/login')}}" class="theme-btn btn-one">Login</a>
                </div>
                <div class="btn-box">
                    <a href="{{ route('register') }}" class="theme-btn btn-one mx-2">Daftar</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!--sticky Header-->
<div class="sticky-header">
    <div class="auto-container">
        <div class="outer-box">
            <div class="logo-box">
                <figure class="logo">
                    <a href="{{url('/')}}"><img src="{{asset('FE/images/ruhoya-logo.png')}}" alt="" /></a>
                </figure>
            </div>
            <div class="menu-area clearfix">
                <nav class="main-menu clearfix">
                    <!--Keep This Empty / Menu will come through Javascript-->
                </nav>
            </div>
            <div class="nav-right">
                <div class="btn-box"><a href="{{url('/login')}}" class="theme-btn btn-one">Login</a></div>
            </div>
        </div>
    </div>
</div>
</header>
<!-- main-header end -->

<!-- Mobile Menu  -->
<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <div class="close-btn"><i class="fas fa-times"></i></div>
    
    <nav class="menu-box">
        <div class="nav-logo w-50">
            <a href="{{url('/')}}"><img src="{{asset('FE/images/ruhoya-logo.png')}}" alt="" title="" /></a>
        </div>
        <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
        <div class="contact-info">
            <h4>Kontak</h4>
            <ul>
                <li>Center for Plant Conservation-Bogor Botanical Gardens, Indonesian Institute of Sciences. Jln. Ir. H. Juanda No. 13 Bogor 16122</li>
                <li><a href="mailto:ruhoya.ina@gmail.com">ruhoya.ina@gmail.com</a></li>
            </ul>
        </div>
        <div class="social-links">
            <ul class="clearfix"></ul>
        </div>
    </nav>
</div>
<!-- End Mobile Menu -->