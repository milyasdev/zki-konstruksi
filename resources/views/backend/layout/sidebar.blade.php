<nav>
    <ul class="menu-aside">
        <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a class="menu-link" href="{{ route('admin.dashboard') }}">
                <i class="icon material-icons md-home"></i>
                <span class="text">Dashboard</span>
            </a>
        </li>

        <li class="menu-item has-submenu {{ request()->routeIs('admin.indexProduct') ? 'active' : '' }}">
            <a class="menu-link" href="#">
                <i class="icon material-icons md-shopping_bag"></i>
                <span class="text">Products</span>
            </a>

            <div class="submenu">
                <a href="{{ route('admin.indexProduct') }}"
                    class="{{ request()->routeIs('admin.indexProduct') ? 'active' : '' }}">
                    Listing Produk
                </a>
            </div>
        </li>
    </ul>
    <hr />
    <ul class="menu-aside">
        <li class="menu-item has-submenu {{ request()->routeIs('admin.indexKategori') ? 'active' : '' }}">
            <a class="menu-link" href="#">
                <i class="icon material-icons md-settings"></i>
                <span class="text">Master</span>
            </a>
            <div class="submenu">
                <a href="{{ route('admin.indexKategori') }}" class="{{ request()->routeIs('admin.indexKategori') ? 'active' : '' }}">Kategori</a>
            </div>
        </li>
    </ul>
    <br />
    <br />
</nav>
