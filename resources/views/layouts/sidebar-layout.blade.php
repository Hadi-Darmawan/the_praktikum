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
                        {{ auth()->guard()->user()->detailLogin->nim }}
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
                        <form action="{{ route('Logout') }}" method="POST" class="nav-link p-0 m-0">
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
            <li class="nav nav-treeview">
                <li class="nav-item" id="account-management">
                    <a href="#" class="nav-link" id="account-management-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Account Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ms-3">
                        <li class="nav-item">
                            <a href="{{ route('Account Data') }}" id="account-data" class="nav-link">
                                <i class="fas fa-user-friends nav-icon"></i>
                                <p>Account Data</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('Add Account') }}" id="add-account" class="nav-link">
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>Add Account</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('Roles Data') }}" id="roles" class="nav-link">
                                <i class="fas fa-user-tag nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </li>
            <li class="nav nav-treeview">
                <li class="nav-item" id="additional-data">
                    <a href="#" class="nav-link" id="additional-data-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Additional Data
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ms-3">
                        <li class="nav-item">
                            <a href="{{ route('All Lecture') }}" id="lecture-data" class="nav-link">
                                <i class="fas fa-user-graduate nav-icon"></i>
                                <p>Data Dosen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('All Asisten Praktikum') }}" id="asisten-praktikum-data" class="nav-link">
                                <i class="fas fa-user-friends nav-icon"></i>
                                <p>Asisten Praktikum</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('All Peserta Praktikum') }}" id="peserta-praktikum-data" class="nav-link">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Peserta Praktikum</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('Jenis Praktikum') }}" id="jenis-praktikum" class="nav-link">
                                <i class="fas fa-layer-group nav-icon"></i>
                                <p>Jenis Praktikum</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </li>
            <li class="nav nav-treeview">
                <li class="nav-item" id="praktikum-management">
                    <a href="#" class="nav-link" id="praktikum-management-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Praktikum
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ms-3">
                        <li class="nav-item">
                            <a href="{{ route('All Praktikum') }}" id="praktikum" class="nav-link">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>Praktikum</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('All Data Penilaian') }}" id="data-penilaian" class="nav-link">
                                <i class="fas fa-tags nav-icon"></i>
                                <p>Data Penilaian</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('All Penilaian') }}" id="penilaian" class="nav-link">
                                <i class="fas fa-tag nav-icon"></i>
                                <p>Penilaian</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('All Nilai') }}" id="nilai" class="nav-link">
                                <i class="fas fa-clipboard-check nav-icon"></i>
                                <p>Nilai</p>
                            </a>
                        </li>
                    </ul>
                </li>
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
