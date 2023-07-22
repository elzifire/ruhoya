<div class="app-menu navbar-menu">
    <div class="navbar-brand-box">
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{asset('BE/images/logo-sm.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{asset('BE/images/logo-dark.png')}}" alt="" height="21">
            </span>
        </a>
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{asset('BE/images/logo-sm.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{asset('BE/images/logo-light.png')}}" alt="" height="21">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                @foreach (\App\Helpers\Menu::get() as $key => $menu)
                    @if ($menu["url"] === null)
                        <li class="menu-title"><span>{{$menu["title"]}}</span></li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{url($menu['url'])}}" data-menu-url="{{$menu['url']}}">
                            <i class="{{$menu['icon']}}"></i> <span>{{$menu["title"]}}</span>
                        </a>
                    </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>