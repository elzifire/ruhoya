<div class="app-menu navbar-menu">
    <div class="navbar-brand-box">
        <a href="{{ url('/admin') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('FE/images/ruhoya-logo.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('FE/images/ruhoya-logo.png') }}" alt="" height="50">
            </span>
        </a>
        <a href="{{ url('/admin') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('FE/images/ruhoya-logo.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('FE/images/ruhoya-logo.png') }}" alt="" height="50">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>MENU</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ url('admin/') }}">
                        <i class="bx bx-home"></i> <span>Dashboard</span>
                    </a>
                </li>
                @can('isAdmin')

                <li class="menu-title"><span>MASTER HOYA</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ url('admin/morfology') }}">
                        <i class="bx bx-leaf"></i> <span>Morfologi</span>
                    </a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('admin/hoya') }}">
                            <i class="bx bx-spa"></i> <span>Hoya</span>
                        </a>
                    </li>
                    @endcan

                    @can('isAdmin')
                    <li class="menu-title"><span>MASTER DATA</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('admin/insect-association') }}">
                            <i class="bx bx-bug"></i> <span>Asosiasi Serangga</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('admin/pest') }}">
                            <i class="bx bx-spray-can"></i> <span>Hama</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('admin/enumeration') }}">
                            <i class="bx bx-collection"></i> <span>Enumeration</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('admin/slider') }}">
                            <i class="bx bx-image"></i> <span>Slider</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('admin/collaborator') }}">
                            <i class="bx bxs-user-badge"></i> <span>Kolaborator</span>
                        </a>
                    </li>

                    <li class="menu-title"><span>MASTER USER</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('admin/user') }}">
                            <i class="bx bx-user"></i> <span>User</span>
                        </a>
                    </li>
                    @endcan

                </ul>
            </div>
        </div>
        <div class="sidebar-background"></div>
    </div>
