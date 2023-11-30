<!-- main header -->
<header class="main-header">
    <!-- header-top -->
    <div class="header-top">
        <div class="shape" style="background-image: url({{asset('FE/images/shape/shape-16.png')}})"></div>
        <div class="auto-container">
            <div class="top-inner clearfix">
                <div class="left-column pull-left">
                    <ul class="social-links clearfix">
                        <li><p>Ikuti Kami:</p></li>
                        <li>
                            <a href="{{url('/')}}"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href="{{url('/')}}"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="{{url('/')}}"><i class="fab fa-linkedin-in"></i></a>
                        </li>
                        <li>
                            <a href="{{url('/')}}"><i class="fab fa-pinterest-p"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="right-column pull-right">
                    <ul class="info-box clearfix">
                        <li class="search-box-outer">
                            <div class="dropdown">
                                <button
                                class="search-box-btn"
                                type="button"
                                id="dropdownMenu3"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                >
                                <i class="fas fa-search"></i>
                            </button>
                            <div class="dropdown-menu search-panel" aria-labelledby="dropdownMenu3">
                                <div class="form-container">
                                    <form method="post" action="blog.html">
                                        <div class="form-group">
                                            <input
                                            type="search"
                                            name="search-field"
                                            value=""
                                            placeholder="Search...."
                                            required=""
                                            />
                                            <button type="submit" class="search-btn">
                                                <span class="fas fa-search"></span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="icon-box"><i class="fas fa-phone"></i></div>
                        <p>Call: <a href="tel:12345615523">123 4561 5523</a></p>
                    </li>
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
                            {{-- <li><a href="{{url('/identifikasi')}}">Identifikasi</a></li> --}}
                            <li><a href="{{url('/database')}}">Database Hoya</a></li>
                            {{-- <li><a href="{{url('/tim-ahli')}}">Tim Ahli</a></li> --}}
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="nav-right">
                <div class="btn-box"><a href="{{url('/login')}}" class="theme-btn btn-one">Login</a></div>
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
            <h4>Contact Info</h4>
            <ul>
                <li>Center for Plant Conservation-Bogor Botanical Gardens, Indonesian Institute of Sciences. Jln. Ir. H. Juanda No. 13 Bogor 16122</li>
                <li><a href="tel:+8801682648101">+88 01682648101</a></li>
                <li><a href="mailto:ruhoya.ina@gmail.com">ruhoya.ina@gmail.com</a></li>
            </ul>
        </div>
        <div class="social-links">
            <ul class="clearfix">
                <li>
                    <a href="{{url('/')}}"><span class="fab fa-twitter"></span></a>
                </li>
                <li>
                    <a href="{{url('/')}}"><span class="fab fa-facebook-square"></span></a>
                </li>
                <li>
                    <a href="{{url('/')}}"><span class="fab fa-pinterest-p"></span></a>
                </li>
                <li>
                    <a href="{{url('/')}}"><span class="fab fa-instagram"></span></a>
                </li>
                <li>
                    <a href="{{url('/')}}"><span class="fab fa-youtube"></span></a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<!-- End Mobile Menu -->