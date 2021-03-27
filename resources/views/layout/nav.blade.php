@if (Auth::user()->role == 'admin')
    <li class="nav-item">
        <a href="{{route('dashboard')}}" class="nav-link font-weight-bold {{ (request()->is('dashboard')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            Dashboard
        </a>
    </li>
    <li class="nav-divider">
        Data
    </li>
    <li class="nav-item">
        <a href="{{route('user.index')}}" class="nav-link font-weight-bold {{ (request()->is('user')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            Pengguna
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('ppc.index')}}" class="nav-link font-weight-bold {{ (request()->is('ppc')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            Staff PPC
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('marketing.index')}}" class="nav-link font-weight-bold {{ (request()->is('marketing')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            Staff Marketing
        </a>
    </li>
    <li class="nav-divider">
        Sistem
    </li>
    <li class="nav-item">
        <a href="{{route('ccr.index')}}" class="nav-link font-weight-bold {{ (request()->is('ccr')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            Data C.C.R
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('sparepart.index')}}" class="nav-link font-weight-bold {{ (request()->is('sparepart')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            Data Sparepart
        </a>
    </li>
    @endif
    
@if (Auth::user()->role == 'marketing')
    <li class="nav-item">
        <a href="{{route('dashboard')}}" class="nav-link font-weight-bold {{ (request()->is('dashboard')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            Dashboard
        </a>
    </li>
    <li class="nav-divider">
        Data
    </li>
    <li class="nav-item">
        <a href="{{route('customer.index')}}" class="nav-link font-weight-bold {{ (request()->is('customer')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            Customer
        </a>
    </li>
    <li class="nav-divider">
        Sistem
    </li>
    <li class="nav-item">
        <a href="{{route('rjo.index')}}" class="nav-link font-weight-bold {{ (request()->is('rjo')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            Repair Job Order
        </a>
    </li>

@endif

@if (Auth::user()->role == 'ppc')
    <li class="nav-item">
        <a href="{{route('dashboard')}}" class="nav-link font-weight-bold {{ (request()->is('dashboard')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            Dashboard
        </a>
    </li>
    <li class="nav-divider">
        Data
    </li>
    <li class="nav-item">
        <a href="{{route('rjo.browse')}}" class="nav-link font-weight-bold {{ (request()->is('rjo')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            Data R.J.O
        </a>
    </li>
    <li class="nav-divider">
        Sistem
    </li>
    <li class="nav-item">
        <a href="{{route('selesai.index')}}" class="nav-link font-weight-bold {{ (request()->is('selesai')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            Pekerjaan Selesai
        </a>
    </li>
@endif