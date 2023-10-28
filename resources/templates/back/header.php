<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>POS SCHOOL | SYSTEMS | By:TH</title>
    <link rel='shortcut icon' href="../ui/logo/256.ico" type="image/x-icon">
    <link rel="icon" href="../ui/logo/32.ico" sizes="32x32">
    <link rel="icon" href="../ui/logo/48.ico" sizes="48x48">
    <link rel="icon" href="../ui/logo/96.ico" sizes="96x96">
    <link rel="icon" href="../ui/logo/256.ico" sizes="144x144">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../dist/css/castermkk.css">
    <link rel="stylesheet" href="../dist/css/stylek.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">

    <!-- SweetAlert2 -->
    <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="../plugins/toastr/toastr.min.js"></script>
    <!-- jautocalcg -->
    <script src="../dist/js/jquery.js"></script>
    <script src="../dist/js/jautocalcg.min.js"></script>
    <script src="../dist/js/scripts.js"></script>

    <!-- daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">


</head>
<style>
    @font-face {
        font-family: "OSbattambang";
        src: url(../fone/KhmerOSbattambang.ttf)format("truetype");
    }

    * {
        font-family: "OSbattambang";
    }
</style>

<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="itemt?dashboard" class="nav-link">Home</a>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> -->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li> -->

                <!-- <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" onclick="history.back()">
                        <i class="fa fa-chevron-circle-left"></i>
                    </a>
                </li>

            </ul>


        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container style="opacity: .8"-->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="itemt?dashboard" class="brand-link">
                <img src="../ui/logo/sf.png" alt="TH Logo" class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light">POS SCHOOL</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../productimages/user/<?php img_user(); ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                    <p class="text-white" style="margin-bottom: unset;">WELCOME- <?php name_user(); ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> <?php show_online();?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <!-- <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div> -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="itemt?dashboard" class="nav-link <?php actr("dashboard"); ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="itemt?tudentslist" class="nav-link <?php actr("tudentslist"); ?>">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    បញ្ជីឈ្មោះសិស្ស

                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="itemt?teacher_list" class="nav-link <?php actr("teacher_list"); ?>">
                                <i class="nav-icon fas fa-donate"></i>
                                <p>
                                    គ្រូបង្រៀន

                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="itemt?driverlist" class="nav-link <?php actr("driverlist"); ?>">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    អ្នកបើកបររថយន្ត

                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="" class="nav-link <?php actr("subject");
                                                        actr("studytime"); ?>">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Category
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="itemt?subject" class="nav-link <?php actr("subject"); ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>មុខវិជ្ជា</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="itemt?studytime" class="nav-link <?php actr("studytime"); ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>ម៉ោងសិក្សារ</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="itemt?Classroom" class="nav-link <?php actr("Classroom"); ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>ថ្នាក់រៀន</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="itemt?branch" class="nav-link <?php actr("branch"); ?>">
                                        <i class="nav-icon fas fa-code-branch"></i>
                                        <p>
                                            សាខា
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="itemt?students_pay" class="nav-link <?php actr("students_pay"); ?>">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>
                                    បញ្ជីឈ្មោះសិស្សបង់ប្រាក់

                                </p>
                            </a>
                        </li>



                        <li class="nav-item">
                            <a href="itemt?registration" class="nav-link <?php actr("registration"); ?>">
                                <i class="nav-icon fas fa-user-lock"></i>
                                <p>
                                    Registration
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="itemt?chang_branch" class="nav-link <?php actr("chang_branch"); ?>">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    សាខា <?php name_branch()?>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="itemt?logout" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->