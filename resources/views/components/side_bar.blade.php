<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">


                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                        {{ Auth::user()->name}}
                        <b class="caret"></b>
                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                        <div class="dropdown-divider"></div>


                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <div class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                        this.closest('form').submit(); " role="button">
                                    <i class="fas fa-sign-out-alt"></i>

                                    {{ __('Log Out') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->

            <a href="" class="brand-link" style="padding-left: 35px;">
                <img src="{{asset('Image/Cogent_Logo.png')}}" alt="Cogent Logo">
            </a>
            {{-- <a href="" class="brand-link" style="padding-left: 35px;">
                <img src="{{asset('Image/logo.png')}}" alt="Cogent Logo" style="width: 200px; height: auto;">
            </a>    --}}
            
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <?php
                        if (Auth::user()->usertype != 'Agent') {
                        ?>
                            <li class="nav-item">
                                <a href="{{route('usermanagementshow')}}" class="nav-link">
                                    <i class="nav-icon fa fa-users"></i>
                                    <p>
                                        User Management
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('reportshow')}}" class="nav-link">
                                    <i class="nav-icon fa fa-file"></i>
                                    <p>
                                        Report
                                    </p>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                        <li class="nav-item">
                            <a href="{{route('AgentInputShow')}}" class="nav-link">
                                <i class="nav-icon fa fa-file"></i>
                                <p>
                                    Agent Input
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('updateticket')}}" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Update Ticket
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>