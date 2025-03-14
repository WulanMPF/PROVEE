<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ url('/xpro') }}" class="nav-link {{ $activeMenu == 'xpro' ? 'active' : '' }}">
                    <img src="{{ asset('assets/Icon_XPRO.png') }}" alt="Xpro Icon" class="nav-icon">
                    <p>Report Xpro</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/orbit') }}" class="nav-link {{ $activeMenu == 'orbit' ? 'active' : '' }}">
                    <img src="{{ asset('assets/Icon_ORBIT.png') }}" alt="Orbit Icon" class="nav-icon">
                    <p>Report Orbit</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/endstate') }}" class="nav-link {{ $activeMenu == 'endstate' ? 'active' : '' }}">
                    <img src="{{ asset('assets/Icon_ENDSTATE.png') }}" alt="Endstate Icon" class="nav-icon">
                    <p>Report Endstate</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/pivotendstate') }}"
                    class="nav-link {{ $activeMenu == 'pivotendstate' ? 'active' : '' }}">
                    <img src="{{ asset('assets/Icon_PIVOTENDSTATE.png') }}" alt="Pivot Endstate Icon"
                        class="nav-icon">
                    <p>Report Pivot Endstate</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/provimanja') }}"
                    class="nav-link {{ $activeMenu == 'provimanja' ? 'active' : '' }}">
                    <img src="{{ asset('assets/Icon_PROVIMANJA.png') }}" alt="Provi Manja Icon" class="nav-icon">
                    <p>Report Provi Manja</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/provikpro') }}" class="nav-link {{ $activeMenu == 'provikpro' ? 'active' : '' }}">
                    <img src="{{ asset('assets/Icon_PROVIKPRO.png') }}" alt="Provi Kpro Icon" class="nav-icon">
                    <p>Report Provi Kpro</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/profile') }}" class="nav-link {{ $activeMenu == 'profile' ? 'active' : '' }}">
                    <img src="{{ asset('assets/Icon_Profile.png') }}" alt="Profile Icon" class="nav-icon">
                    <p>Profile</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->

<style>
    .nav-link {
        display: flex;
        align-items: center;
        padding: 10px;
        border-radius: 5px;
        transition: background 0.3s ease, color 0.3s ease;
    }

    .nav-link:hover {
        background: #E5E5E8 !important;
        /* color: #84858C !important; */
    }
    .nav-link.active {
        background: #C8170D !important;
        color: white !important;
    }

    .nav-link:hover img {
        color: #696A71;
    }
    .nav-link.active img {
        filter: brightness(0) invert(1);
        /* Mengubah ikon menjadi putih */
    }

    .nav-link:hover p {
        color: #696A71;
    }
    .nav-link.active p {
        color: white !important;
    }

    .nav-link img {
        width: 40px !important;
        height: 40px !important;
        margin-right: 10px;
        object-fit: contain;
    }

    .nav-link p {
        margin: 0;
    }
</style>