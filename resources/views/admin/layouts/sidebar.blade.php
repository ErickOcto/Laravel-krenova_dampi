<div class="sidebar-menu">
    <ul class="menu">


        <li class='sidebar-title'>Main Menu</li>


        <li class="sidebar-item {{ request()->is('admin') ? 'active' : '' }} ">
            <a href="{{ route('admin-dashboard') }}" class='sidebar-link'>
                <i data-feather="home" width="20"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class='sidebar-title'>Facility Management</li>


        <li class="sidebar-item {{ request()->is('admin/category-facility*') ? 'active' : '' }}">
            <a href="{{ route('category-facility.index') }}" class='sidebar-link'>
                <i data-feather="triangle" width="20"></i>
                <span>Facility Category</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->is('admin/facility*') ? 'active' : '' }}">
            <a href="{{ route('facility.index') }}" class='sidebar-link'>
                <i data-feather="triangle" width="20"></i>
                <span>Facility</span>
            </a>
        </li>

        <li class='sidebar-title'>Auth</li>


        <li class="sidebar-item  ">
            <form action="{{ route('logout') }}" method="POST">
            @csrf
            </form>
            <button type="submit" class='sidebar-link border-0 bg-white'>
                <i data-feather="user" width="20"></i>
                <span>Logout</span>
            </button>
        </li>

    </ul>
</div>
