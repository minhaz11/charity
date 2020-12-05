        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary">
            <!-- Brand Logo -->
            <a href="index.html" class="brand-link text-center">
                <span class="brand-text font-weight-bold">{{ isset($company_name) ? $company_name : '' }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-overflow-x">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                        <li class="nav-item">
                            <a href="{{ url('dashboard') }}" class="nav-link {{ (isset($menu) && $menu == 'dashboard') ? 'active' : '' }}">
                                <i class="nav-icon  fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('donations') }}" class="nav-link {{ (isset($menu) && $menu == 'donations') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-store"></i>
                                <p>Donations</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.campaigns') }}" class="nav-link {{menuActive('admin.campaigns',2)}}">
                                <i class="nav-icon fas fa-store"></i>
                                <p>Campaigns</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('banner-image') }}" class="nav-link {{ (isset($menu) && $menu == 'banner') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-image"></i>
                                <p>Banner</p>
                            </a>
                        </li>
                        @can('view_user', 'add_user', 'edit_user', 'delete_user')
                        <li class="nav-item">
                            <a href="{{ url('users') }}" class="nav-link {{ (isset($menu) && $menu == 'users') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        @endcan




                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-window-maximize"></i>
                                <p>
                                    Website
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Header</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Footer</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Apperance</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @can('view_role', 'add_role', 'edit_role', 'delete_role')
                        <li class="nav-item">
                            <a href="{{ url('roles') }}" class="nav-link {{ (isset($menu) && $menu == 'roles') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shield-alt"></i>
                                <p>Roles and Permissions</p>
                            </a>
                        </li>
                        @endcan
                        <li class="nav-item {{ (isset($menu) && $menu == 'company-details') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link  {{ (isset($menu) && $menu == 'company-details') ? 'active' : '' }}">

                                <i class="nav-icon fas fa-cog"></i>
                                <p>Settings<i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('company-details/save') }}" class="nav-link {{ (isset($menu) && $menu == 'company-details') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Company Details</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>General Settings</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Store Categories</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Email</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Logout</p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
