<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ url('/') }}">
            <img src="{{ asset('assets/img/icon.png') }}" width="30" height="40" alt="icon">
        </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('/') }}">
            <img src="{{ asset('assets/img/icon.png') }}" width="30" height="40" alt="icon">
        </a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Main Menu</li>
        <li class="{{ Route::is('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fire"></i>
                <span>Dashboard</span>
            </a>
        </li>
         {{-- aktifkan ini jika mau dropdown  --}}
        {{-- <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i>
                <span>Dropdown Menu</span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#">Dropdown Item</a></li>
            </ul>
        </li> --}}

        {{-- sidebar superadmin  --}}
        {{--  @can('superadmin')
        <li class="menu-header">Administrator</li>
        @endcan --}}

        {{-- sidebar admin  --}}
        @can('superadmin')
        <li class="menu-header">Administrator</li>
        <li class="{{ Route::is('user*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.index') }}">
                <i class="fas fa-users"></i>
                <span>Kelola User</span>
            </a>
        </li>
        <li class="{{ Route::is('kompartement*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kompartement.index') }}">
                <i class="fas fa-users"></i>
                <span>Kelola Kompartement</span>
            </a>
        </li>
        <li class="{{ Route::is('department*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('department.index') }}">
                <i class="fas fa-users"></i>
                <span>Kelola Department</span>
            </a>
        </li>
        <li class="{{ Route::is('jabatan*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('jabatan.index') }}">
                <i class="fas fa-users"></i>
                <span>Kelola Jabatan</span>
            </a>
        </li>
        @endcan

        <li class="menu-header">Evaluasi</li>
        <li class="{{ Route::is('arahan*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('arahan.index') }}">
                <i class="fas fa-users"></i>
                <span>Kelola Arahan</span>
            </a>
        </li>
        <li class="{{ Route::is('hasil*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('hasil.index') }}">
                <i class="fas fa-users"></i>
                <span>Kelola Hasil</span>
            </a>
        </li>
    </ul>
</aside>
