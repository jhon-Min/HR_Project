<div class="page-wrapper chiller-theme">
    {{-- @if (request()->is('/'))
    <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
        <i class="fas fa-bars"></i>
    </a>
    @else
    <a id="back" class="btn btn-sm btn-dark" href="{{ route('home') }}">
        <i class="fa-solid fa-arrow-left font-weight-bolder"></i>
    </a>
    @endif --}}

    <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
        <i class="fas fa-bars"></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper">
        <div class="sidebar-content">
            <div class="sidebar-brand">
                <a href="#">Ninja HR</a>
                <div id="close-sidebar">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="sidebar-header">
                <div class="user-pic">
                    <img class="img-responsive img-rounded" src="{{ auth()->user()->profile_img_path() }}"
                        alt="User picture">
                </div>
                <div class="user-info">
                    <span class="user-name font-weight-bold">
                        {{ auth()->user()->name }}
                    </span>
                    <span class="user-role">
                        {{ auth()->user()->department->title }}
                    </span>
                    <span class="user-status">
                        <i class="fa fa-circle"></i>
                        <span>Online</span>
                    </span>
                </div>
            </div>
            <!-- sidebar-header  -->

            <!-- sidebar-search  -->
            <div class="sidebar-menu">
                <ul>
                    <li class="header-menu">
                        <span>General</span>
                    </li>

                    <x-menu-item icon="fa fa-home" link="{{ route('home') }}">Home</x-menu-item>

                    @can('view_employee')
                        <x-menu-item icon="fa fa-users" link="{{ route('employee.index') }}">Employees</x-menu-item>
                    @endcan

                    @can('view_attendance', 'view_attendance_overview')
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa-solid fa-calendar-days"></i>
                                <span>Attendance Management</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    @can('view_attendance')
                                        <x-menu-item icon="fa-solid fa-clipboard" link="{{ route('attendance.index') }}">
                                            Attendance
                                        </x-menu-item>
                                    @endcan

                                    @can('view_attendance_overview')
                                        <x-menu-item icon="fa-solid fa-chalkboard-user"
                                            link="{{ route('attendance.overview') }}">
                                            Overview
                                        </x-menu-item>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan

                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa-solid fa-coins"></i>
                            <span>Salary Management</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                @can('view_salary')
                                    <x-menu-item icon="fa-solid fa-circle-dollar-to-slot"
                                        link="{{ route('salary.index') }}">
                                        Salary Info
                                    </x-menu-item>
                                @endcan

                                <x-menu-item icon="fa-solid fa-money-check-dollar"
                                    link="{{ route('payroll.index') }}">
                                    Payroll
                                </x-menu-item>
                            </ul>
                        </div>
                    </li>

                    @can('view_department')
                        <x-menu-item icon="fa-solid fa-sitemap" link="{{ route('department.index') }}">Department
                        </x-menu-item>
                    @endcan

                    @can('view_role')
                        <x-menu-item icon="fa-solid fa-sliders" link="{{ route('role.index') }}">Role</x-menu-item>
                    @endcan

                    @can('view_permission')
                        <x-menu-item icon="fa-solid fa-user-shield" link="{{ route('permission.index') }}">Permission
                        </x-menu-item>
                    @endcan

                    @can('view_company_setting')
                        <x-menu-item icon="fa-solid fa-gears" link="{{ route('company-setting.show', 1) }}">
                            Company Setting
                        </x-menu-item>
                    @endcan

                    @can('view_project')
                        <x-menu-item icon="fa-solid fa-diagram-project" link="{{ route('project.index') }}">
                            Projects
                        </x-menu-item>
                    @endcan
                </ul>
            </div>
            <!-- sidebar-menu  -->
        </div>
        <!-- sidebar-content  -->
        <div class="sidebar-footer">
            {{-- <a href="#">
                <i class="fa fa-bell"></i>
                <span class="badge badge-pill badge-warning notification">3</span>
            </a>
            <a href="#">
                <i class="fa fa-envelope"></i>
                <span class="badge badge-pill badge-success notification">7</span>
            </a>
            <a href="#">
                <i class="fa fa-cog"></i>
                <span class="badge-sonar"></span>
            </a> --}}
            <a href="#" class="btn-logout" id="logoutBtn">
                <i class="fa-solid fa-right-from-bracket"></i>
            </a>
        </div>

        <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
            @csrf
        </form>
    </nav>
    <!-- sidebar-wrapper  -->
</div>
