<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/">Vital Clan</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/">V</a>
        </div>
        <ul class="sidebar-menu">
       @if(auth()->user()->role == 'admin')

            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>

             <li class="{{ request()->routeIs('projects') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('projects') }}"><i class="fas fa-fire"></i> <span>Projects</span></a></li>
               <li class="{{ request()->routeIs('blogs') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('blogs') }}"><i class="fas fa-fire"></i> <span>Blogs</span></a></li>


            {{-- <li class="dropdown {{ request()->routeIs(['main.categories', 'sub.categories']) ? 'active' : '' }} ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Categories</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('main.categories') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('main.categories') }}">Main Categories</a></li>
                    <li class="{{ request()->routeIs('sub.categories') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('sub.categories') }}">Sub Categories</a></li>
                </ul>
            </li> --}}
            {{-- <li
                class="dropdown {{ request()->routeIs(['customer.index', 'warehouse.index', 'admin.index']) ? 'active' : '' }} ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>User
                        management</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('customer.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('customer.index') }}"><i class="far fa-square"></i> <span>Customers
                                list</span></a></li>
                    <li class="{{ request()->routeIs('warehouse.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('warehouse.index') }}"><i class="far fa-square"></i>
                            <span>Warehouse</span></a></li>
                    <li class="{{ request()->routeIs('admin.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.index') }}"><i class="far fa-square"></i> <span>Admins</span></a>
                    </li>
                </ul>
            </li> --}}
            {{-- <li class="menu-header">Starter</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
              </ul>
            </li> --}}

            {{-- <li class="{{ request()->routeIs('brand.index') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('brand.index') }}"><i class="far fa-square"></i> <span>Brands</span></a></li> --}}

            {{-- <li class="menu-header">Pages</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Auth</span></a>
              <ul class="dropdown-menu">
                <li><a href="auth-forgot-password.html">Forgot Password</a></li>
                <li><a href="auth-login.html">Login</a></li>
                <li><a href="auth-register.html">Register</a></li>
                <li><a href="auth-reset-password.html">Reset Password</a></li>
              </ul>
            </li> --}}

       @elseif(auth()->user()->role == 'warehouse')

       <li class="menu-header">Dashboard</li>
            <li class="{{ request()->routeIs('warehouse.dashboard') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('warehouse.dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>

            <li class="{{ request()->routeIs('warehouse.products') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('warehouse.products') }}"><i class="far fa-square"></i> <span>Products</span></a></li>
            <li class="{{ request()->routeIs('warehouse.orders') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('warehouse.orders') }}"><i class="far fa-square"></i> <span>Orders</span></a></li>
            <li class="{{ request()->routeIs('warehouse.refunds') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('warehouse.refunds') }}"><i class="far fa-square"></i> <span>Refunds</span></a></li>



       @endif
       </ul>
        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="/logout" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Logout
            </a>
        </div>
    </aside>
</div>
