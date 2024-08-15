<div class="sidebar-menu">
    <ul class="menu">




        @if (Auth::check() && Auth::user()->role == 0 || Auth::user()->role == 2)
            <li class='sidebar-title'>Main Menu</li>
            <li class="sidebar-item {{ request()->is('admin') ? 'active' : '' }} ">
                <a href="{{ route('admin-dashboard') }}" class='sidebar-link'>
                    <i data-feather="home" width="20"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        @endif

        @if (Auth::check() && Auth::user()->role == 3 || Auth::user()->role == 0)
            <li class='sidebar-title'>Facility Management</li>
            <li class="sidebar-item {{ request()->is('admin/category-facility*') ? 'active' : '' }}">
                <a href="{{ route('category-facility.index') }}" class='sidebar-link'>
                    <i data-feather="flag" width="20"></i>
                    <span>Facility Category</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('admin/facility*') ? 'active' : '' }}">
                <a href="{{ route('facility.index') }}" class='sidebar-link'>
                    <i data-feather="flag" width="20"></i>
                    <span>Facility</span>
                </a>
            </li>

            <li class='sidebar-title'>Award Management</li>

            <li class="sidebar-item {{ request()->is('admin/rewardCategory*') ? 'active' : '' }}">
                <a href="{{ route('rewardCategory.index') }}" class='sidebar-link'>
                    <i data-feather="award" width="20"></i>
                    <span>Award Category</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('admin/award*') ? 'active' : '' }}">
                <a href="{{ route('reward.index') }}" class='sidebar-link'>
                    <i data-feather="award" width="20"></i>
                    <span>Award</span>
                </a>
            </li>
        @endif

        @if (Auth::check() && Auth::user()->role == 0)
            <li class='sidebar-title'>User Management</li>
            <li class="sidebar-item {{ request()->is('admin/user*') ? 'active' : '' }}">
                <a href="{{ route('user.index') }}" class='sidebar-link'>
                    <i data-feather="user" width="20"></i>
                    <span>User</span>
                </a>
            </li>
        @endif

        @if (Auth::check() && Auth::user()->role == 2 || Auth::user()->role == 0)
            <li class='sidebar-title'>Project Management</li>
            <li class="sidebar-item {{ request()->is('admin/company*') ? 'active' : '' }}">
                <a href="{{ route('company.index') }}" class='sidebar-link'>
                    <i data-feather="briefcase" width="20"></i>
                    <span>Company</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('admin/project*') ? 'active' : '' }}">
                <a href="{{ route('project.index') }}" class='sidebar-link'>
                    <i data-feather="trello" width="20"></i>
                    <span>Project</span>
                </a>
            </li>
        @endif

        @if (Auth::check() && Auth::user()->role == 1 || Auth::user()->role == 0)
            <li class='sidebar-title'>Managemen Penduduk</li>

            <li class="sidebar-item {{ request()->is('admin/poverty') ? 'active' : '' }} ">
                <a href="{{ route('poverty-dashboard') }}" class='sidebar-link'>
                    <i data-feather="home" width="20"></i>
                    <span>Dashboard Map Penduduk</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('admin/management/poverty*') ? 'active' : '' }}">
                <a href="{{ route('poverty.index') }}" class='sidebar-link'>
                    <i data-feather="triangle" width="20"></i>
                    <span>Penduduk</span>
                </a>
            </li>
        @endif

        <li class='sidebar-title'>Auth</li>

        <li class="sidebar-item  ">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
            <button type="submit" class='sidebar-link border-0 bg-white'>
                <i data-feather="user" width="20"></i>
                <span>Logout</span>
            </button>
            </form>
        </li>

    </ul>
</div>
