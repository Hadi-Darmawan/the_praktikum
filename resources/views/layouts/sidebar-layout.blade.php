<aside class="main-sidebar sidebar-dark-primary elevation-2">

{{-- Brand Logo Start --}}
<a href="" class="brand-link text-decoration-none">
    <img src="{{ asset('the_praktikum.png') }}" alt="SIPANDU Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text fw-bold fs-6">The Praktikum</span>
</a>
{{-- Brand Logo End --}}

<!-- Sidebar Menu Start -->
<div class="sidebar">
    <nav class="mt-2 mb-5 pb-5">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item" id="admin-authentication">
                <a href="#" class="nav-link" id="authentication">
                    <i class="nav-icon fas fa-user-circle"></i>
                    <p>
                        1805551041
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('Profile') }}" id="admin-profile" class="nav-link">
                            <i class="nav-icon fas fa-id-badge"></i>
                            <p>Profile</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="" class="nav-link p-0 m-0">
                            @csrf
                            <button class="nav-link text-danger text-start btn-block">
                                <i class="nav-icon fas fa-power-off"></i>
                                <p>Keluar</p>
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
            <div class="dropdown-divider bg-light"></div>
            <li class="nav-item" id="dashboard">
                <a href="{{ route('Dashboard') }}" id="dashboard-link" class="nav-link">
                    <i class="nav-icon fas fa-house-user"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <div class="dropdown-divider bg-light"></div>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-info-circle"></i>
                    <p>Tentang</p>
                </a>
            </li>
        </ul>
    </nav>
</div>
{{-- Sidebar Menu End --}}

</aside>
