<div class="page-wrapper chiller-theme">
    @if (request()->is('/'))
    <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
        <i class="fas fa-bars"></i>
    </a>
    @else
    <a id="back" class="btn btn-sm btn-dark" href="{{ route('home') }}">
        <i class="fa-solid fa-arrow-left font-weight-bolder"></i>
    </a>
    @endif
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

            <li>
                <a href="#">
                  <i class="fa fa-home"></i>
                  <span>Home</span>
                </a>
            </li>

            <li>
                <a href="{{ route('employee.index') }}">
                  <i class="fa fa-users"></i>
                  <span>Employees</span>
                </a>
            </li>

            <li>
                <a href="{{ route('department.index') }}">
                    <i class="fa-solid fa-sitemap"></i>
                  <span>Department</span>
                </a>
            </li>

            <li class="sidebar-dropdown">
              <a href="#">
                <i class="fa fa-tachometer-alt"></i>
                <span>Dashboard</span>
                <span class="badge badge-pill badge-warning">New</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a href="#">Dashboard 1
                      <span class="badge badge-pill badge-success">Pro</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">Dashboard 2</a>
                  </li>
                  <li>
                    <a href="#">Dashboard 3</a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="header-menu">
              <span>Extra</span>
            </li>

            <li>
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Documentation</span>
                <span class="badge badge-pill badge-primary">Beta</span>
              </a>
            </li>

            <li>
              <a href="#">
                <i class="fa fa-calendar"></i>
                <span>Calendar</span>
              </a>
            </li>

          </ul>
        </div>
        <!-- sidebar-menu  -->
      </div>
      <!-- sidebar-content  -->
      <div class="sidebar-footer">
        <a href="#">
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
        </a>
        <a href="#">
          <i class="fa fa-power-off"></i>
        </a>
      </div>
    </nav>
    <!-- sidebar-wrapper  -->
</div>
