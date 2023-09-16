<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <title>Matrix Admin Lite Free Versions Template by WrapPixel</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="{{ asset('images/icon/cover.png') }}">

    <!-- Custom CSS -->
    <link href="{{ asset('assets/style.min.css') }}" rel="stylesheet">

    <!-- select2 -->
    <link href="{{ asset('assets/select2/select2.min.css') }}" rel="stylesheet">
    
    {{-- fonawesome  --}}
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/font-awesome_6.4.2_css_all.min.css') }}">

    {{--main css style--}}
    <link rel="stylesheet" href="{{ asset('assets/sweetalert/sweetalert2@10.10.1_dist_sweetalert2.min.css') }}"/>

    {{-- Datepicker --}}
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    {{-- bootstrap date picker --}}
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}"/>

    {{-- bootstrap toggle --}}
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-togglemin/bootstrap-toggle.css') }}"/>

    {{-- css for datatables --}}
    <link rel="stylesheet" href="{{ asset('assets/datatables/DataTables-1.10.25/css/jquery.dataTables.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/datatables/FixedHeader-3.1.9/css/fixedHeader.bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/datatables/Responsive-2.2.9/css/responsive.bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/datatables/Buttons-1.7.1/css/buttons.bootstrap4.min.css') }}"/>

    <style>
        .modal-lg{
            max-width: 90% !important;
         }
    </style>

    @yield('adminallteacherspagestyles')
</head>

<body>

    <?php use App\Models\Grade; 
         $allgrades=Grade::get();
    ?>

    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                        <b class="logo-icon ps-2">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="{{ asset('images/logo-icon.png') }}" alt="homepage" class="light-logo" />

                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="{{ asset('images/logo-text.png') }}" alt="homepage" class="light-logo" />

                        </span>
                        <!-- Logo icon -->
                        <!-- <b class="logo-icon"> -->
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <!-- <img src="../../assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

                        <!-- </b> -->
                        <!--End Logo icon -->
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-start me-auto"> 
                        <li class="nav-item d-none d-lg-block"><a
                                class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                                data-sidebartype="mini-sidebar">
                                <i class="fa-solid fa-bars m-2" style="color: #ffffff; font-size:20px;">
                                </i> 
                            </a></li>
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== 
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="d-none d-md-block">Create New <i class="fa fa-angle-down"></i></span>
                                <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        {{-- <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark"
                                href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a
                                    class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li> --}}
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-end">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            {{-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-bell font-24"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul> --}}
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            {{-- <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="2" role="button" data-bs-toggle="dropdown" aria-expanded="false"> 
                                 <i class="font-24 mdi mdi-comment-processing"></i>
                            </a>
                            {{-- <ul class="dropdown-menu dropdown-menu-end mailbox animated bounceInDown" aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="">
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-success btn-circle"><i
                                                            class="ti-calendar"></i></span>
                                                    <div class="ms-2">
                                                        <h5 class="mb-0">Event today</h5>
                                                        <span class="mail-desc">Just a reminder that event</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-info btn-circle"><i
                                                            class="ti-settings"></i></span>
                                                    <div class="ms-2">
                                                        <h5 class="mb-0">Settings</h5>
                                                        <span class="mail-desc">You can customize this template</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-primary btn-circle"><i
                                                            class="ti-user"></i></span>
                                                    <div class="ms-2">
                                                        <h5 class="mb-0">Pavan kumar</h5>
                                                        <span class="mail-desc">Just see the my admin!</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-danger btn-circle"><i
                                                            class="fa fa-link"></i></span>
                                                    <div class="ms-2">
                                                        <h5 class="mb-0">Luanch Admin</h5>
                                                        <span class="mail-desc">Just see the my new admin!</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </ul> --}}
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('avatar.jpg') }}" alt="user" class="rounded-circle" width="31">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user me-1 ms-1"></i>
                                    Edit My Profile</a>
                                <form method="POST" action="{{ url ('log_out') }}">
                                    @csrf
                    
                                    <button class="dropdown-item" type="submit" href="#">
                                    <i class="mdi mdi-logout text-primary"></i>Logout
                                    </button>
                                </form>
                                <div class="dropdown-divider"></div>
                            </ul>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="pt-4">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                                <i class="fa-solid fa-gauge m-2" style="color: #ffffff; font-size:20px;"></i>
                            <span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                            href="javascript:void(0)" aria-expanded="false">
                            <i class="fa-solid fa-user-graduate m-2" style="color: #ffffff; font-size:20px;">
                            </i> 
                            <span
                                class="hide-menu">Pupils Management</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{ route('admin.pupils.page') }}" class="sidebar-link"><span class="hide-menu"> All Our Pupils
                                        </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('admin.create.pupil.page') }}" class="sidebar-link"><span class="hide-menu"> Add a Pupil
                                        </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="grid.html" aria-expanded="false">
                            <i class="fa-solid fa-landmark m-2" style="color: #ffffff; font-size:20px;"></i>
                            <span
                                class="hide-menu">Grades</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="grid.html" aria-expanded="false">
                            <i class="fa-solid fa-book-open m-2" style="color: #ffffff; font-size:20px;"></i>
                            <span
                                class="hide-menu">Subjects</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('admin.teachers.page') }}" aria-expanded="false">
                            <i class="fa-solid fa-chalkboard-user m-2" style="color: #ffffff; font-size:20px;"></i>
                            <span
                                class="hide-menu">Manage Teachers</span></a></li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="#" aria-expanded="false">
                            <i class="fa-solid fa-square-poll-vertical m-2" style="color: #ffffff; font-size:20px;"></i>
                            <span
                                class="hide-menu">Exam Results</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="grid.html" aria-expanded="false">
                            <i class="fa-solid fa-sack-dollar m-2" style="color: #ffffff; font-size:20px;"></i>
                            <span
                                class="hide-menu">School Fees Payments</span></a></li>
                        
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            @yield('content')
            
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by Matrix-admin. Designed and Developed by <a
                    href="https://www.wrappixel.com">WrapPixel</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    {{-- modal to assign role to an admin--}}
    <div class="modal fade" id="assignteachermodal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body" style="
              box-shadow: 2px 2px 4px #000000">
                 <form id="assignteacheragrade" method="POST" action="javascript:void(0);">
                    @csrf
                    <div class="modal-body">
                       <h4>Assign a Teacher a Class</h4>
                       <input type="hidden" name="teachergrade_id" id="teachergrade_id">

                       <div class="form-group">
                          <label style="font-size:15px;">Name</label>
                          <input type="text" class="read-only form-control" name="name" id="edit_name">
                      </div>
                      <div class="form-group">
                          <label style="font-size:15px;">Admin Roles</label><br>
                          <select name="selectedgrade" id="gradeid" class="adminselect form-control text-white bg-dark" required style="width: 100%;">
                             <option disabled>Assign A user a different Role</option>
                             @foreach ($allgrades as $grade)
                                <option value="{{ $grade->id }}">
                                   {{ $grade->grade_name }}
                                </option>
                             @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                       <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                       <button type="submit" class="btn btn-danger waves-effect assign_role_toadmin">Update</button>
                    </div>
                 </form>
             </div> 
           </div>
        </div>
     </div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('assets/admin_js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin_js/jquery.ui.touch-punch-improved.js') }}"></script>
    <script src="{{ asset('assets/admin_js/jquery-ui.min.js') }}"></script>

    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('assets/admin_js/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('assets/admin_js/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin_js/libs/sparkline/sparkline.js') }}"></script>

    <!--Wave Effects -->
    <script src="{{ asset('assets/admin_js/waves.js') }}"></script>

    <!--Select2 -->
    <script src="{{ asset('assets/select2/select2.min.js') }}"></script>

    {{-- bootstrap toggle --}}
    <script src="{{ asset('assets/bootstrap-togglemin/bootstrap-toggle.min.js') }}"></script>

    <!--Menu sidebar -->
    <script src="{{ asset('assets/admin_js/sidebarmenu.js') }}"></script>

    <!--Custom JavaScript -->
    <script src="{{ asset('assets/admin_js/custom.min.js') }}"></script>

    {{-- font-awesome --}}
    <script src="{{ asset('assets/fontawesome/font-awesome_6.4.2_js_all.min.js') }}"></script>
    
    {{-- bootsrap date picker --}}
  <script src="{{ asset('assets/moment/moment.min.js') }}"></script>
  <script src="{{ asset('assets/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>

    {{-- sweetalert --}}
    <script src="{{ asset('assets/sweetalert/sweetalert2@10.16.6_dist_sweetalert2.all.min.js') }}"></script>

    {{-- js for datatables --}}
    <script type="text/javascript" src="{{ asset('assets/datatables/DataTables-1.10.25/js/jquery.dataTables.min.js')}}"></script> 
    {{-- <script type="text/javascript" src="{{ asset('assets/datatables/DataTables-1.10.25/js/dataTables.bootstrap.min.js')}}"></script> --}}
    <script type="text/javascript" src="{{ asset('assets/datatables/Responsive-2.2.9/js/dataTables.responsive.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/datatables/Buttons-1.7.1/js/dataTables.buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/datatables/jszip3.1.3/jszip.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/datatables/pdfmake-0.1.36/pdfmake.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/datatables/pdfmake-0.1.36/vfs_fonts.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/datatables/Buttons-1.7.1/js/buttons.html5.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/datatables/Buttons-1.7.1/js/buttons.print.min.js')}}"></script>


    @yield('adminaddpupilscript')

    @yield('adminallpupilsscript')

    @yield('adminallteachersscript')
    
    @section('scripts')
      <script>

         $(document).ready(function() {

            // select 2
            $('.adminselect2').select2();

         });
      </script>
</body>

</html>