<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?= (isset($title)?$title:'Watch Anime Free Watch Anime Free Watch Anime Free') ?></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="robots" content="all,follow">
<link rel="icon" type="image/png" href="<?= ROOTURL ?>images/icons/logo-icon.png" />

    <!-- Bootstrap CSS-->
<link rel="stylesheet" href="<?= ROOTURL ?>assets/css/bootstrap.min.css">

    <!-- Font Awesome CSS-->
<link rel="stylesheet" href="<?= ROOTURL ?>assets/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="<?= ROOTURL ?>assets/fontawesome/css/all.min.css">

    <!-- Google fonts - Poppins -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">

    <!-- For Data Table -->
<link rel="stylesheet" type="text/css" href="<?= ROOTURL ?>assets/css/datatables.min.css"/>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css">
    <!-- Multi select -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/css/bootstrap-multiselect.css">

    <!-- Theme stylesheet-->
<link rel="stylesheet" href="<?= ROOTURL ?>assets/css/style.green.css" id="theme-stylesheet">
    <!-- Style -->
<link rel="stylesheet" href="<?= ROOTURL ?>css/admin-styles.css">
</head>
<body>
<div class="page">
<!-- Main Navbar-->
<header class="header">
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-holder d-flex align-items-center justify-content-between">
            <!-- Navbar Header-->
            <div class="navbar-header">
                <!-- Navbar Brand -->
                <a href="index" class="navbar-brand d-none d-sm-inline-block">
                    <div class="brand-text d-none d-lg-inline-block"><span>Anime</span><strong>Anime</strong></div>
                    <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>Anime</strong></div></a>
                <!-- Toggle Button-->
                <a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
            </div>
            <!-- Navbar Menu -->
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Notifications-->
                <li class="nav-item dropdown <?= (($request+$report) > 0?'mr-n2':'mr-n3') ?>">
                    <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
                        <i class="fas fa-bell"></i>
                        <?php if(($request+$report) > 0): ?>
                            <span class="badge bg-red badge-corner"><?= ($request+$report) ?></span>
                        <?php endif; ?>
                    </a>
                  <ul aria-labelledby="notifications" class="dropdown-menu">
                    <?php if($request > 0): ?>
                        <li>
                            <a rel="nofollow" href="<?= ROOTURL ?>admin/request" class="dropdown-item">
                                <div class="notification">
                                    <div class="notification-content"><i class="fas fa-album bg-green"></i>There are <?= $request ?> new anime request.</div>
<!--                                    <div class="notification-time"><small></small></div>-->
                                </div>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if($report > 0): ?>
                        <li>
                            <a rel="nofollow" href="<?= ROOTURL ?>admin/report" class="dropdown-item">
                                <div class="notification">
                                    <div class="notification-content"><i class="fa fa-video bg-blue"></i><?= $report ?> episode have been reported.</div>
                                </div>
                            </a>
                        </li>
                    <?php endif; ?>
                      <?php if($report+$request == 0):  ?>
                      <li>
                          <a rel="nofollow" href="#" class="dropdown-item">
                              <div class="notification">
                                  <div class="notification-content"><i class="fa fa-check bg-yellow"></i>No request or report.</div>
                              </div>
                          </a>
                      </li>
                      <?php endif; ?>
<!--                    <li>-->
<!--                        <a rel="nofollow" href="#" class="dropdown-item all-notifications text-center">-->
<!--                            <strong>View all notifications</strong>-->
<!--                        </a>-->
<!--                    </li>-->
                  </ul>
                </li>
                <!-- Logout    -->
                <li class="nav-item"><a href="<?= ROOTURL ?>admin/logout" class="nav-link logout"> <span class="d-none d-sm-inline">Logout</span><i class="fas fa-sign-out-alt"></i></a></li>
            </ul>
        </div>
    </div>
</nav>
</header>
<div class="page-content d-flex align-items-stretch">
<!-- Side Navbar -->
<nav class="side-navbar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar">
            <img src="<?= ROOTURL ?>images/icons/logo-icon.png" alt="logo" class="img-fluid">
        </div>
        <div class="title">
            <h1 class="h4"><?= Session::get('user')->username ?></h1>
            <p><?= Session::get('user')->role ?></p>
        </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">

<!--        <li class=""><a href="admin"><i class="fas fa-home-alt"></i>Dashboard</a></li>-->
        <!-- Type -->
        <li class="<?php if(isset($navActive) && $navActive === 'slider') echo 'active'  ?>">
            <a href="<?= ROOTURL ?>admin/slider"><i class="fas fa-sliders-h"></i>Home Slider</a>
        </li>
        <!-- Genre -->
        <li class="<?php if(isset($navActive) && $navActive === 'genre') echo 'active' ?>">
            <a href="#genreDropdown" aria-expanded="false" data-toggle="collapse"><i class="fas fa-stream"></i>Genre</a>
            <ul id="genreDropdown" class="collapse list-unstyled ">
                <li><a href="<?= ROOTURL ?>admin/genre/new">New</a></li>
                <li><a href="<?= ROOTURL ?>admin/genre">View All</a></li>
            </ul>
        </li>
        <!-- Type -->
        <li class="<?php if(isset($navActive) && $navActive === 'type') echo 'active' ?>">
            <a href="#typeDropdown" data-toggle="collapse"><i class="fas fa-random"></i>Type</a>
            <ul id="typeDropdown" class="collapse list-unstyled">
                <li><a href="<?= ROOTURL ?>admin/type/new">New</a></li>
                <li><a href="<?= ROOTURL ?>admin/type">View All</a></li>
            </ul>
        </li>
        <!-- Anime -->
        <li class="<?php if(isset($navActive) && $navActive === 'anime' || $navActive === 'episode') echo 'active' ?>">
            <a href="#animeDropdown" data-toggle="collapse"><i class="fa fa-database"></i>Anime</a>
            <ul id="animeDropdown" class="collapse list-unstyled">
                <li><a href="<?= ROOTURL ?>admin/anime/new">New Anime</a></li>
                <li><a href="<?= ROOTURL ?>admin/anime">Anime List</a></li>
                <li><a href="<?= ROOTURL ?>admin/episode">New/List Episodes</a></li>
            </ul>
        </li>

        <!-- Report -->
        <li class="<?php if(isset($navActive) && $navActive === 'requestReport') echo 'active' ?>">
            <a href="#rDropdown" data-toggle="collapse"><i class="fa fa-exclamation"></i>Request / Report</a>
            <ul id="rDropdown" class="collapse list-unstyled">
                <li><a href="<?= ROOTURL ?>admin/request">Requests</a></li>
                <li><a href="<?= ROOTURL ?>admin/report">Reports</a></li>
            </ul>
        </li>

        <!-- User -->
        <?php if(Session::get('user')->role == 'Admin'): ?>
            <li class="<?php if(isset($navActive) && $navActive === 'user') echo 'active' ?>">
                <a href="#userDropdown" data-toggle="collapse"><i class="fa fa-user"></i>User</a>
                <ul id="userDropdown" class="collapse list-unstyled">
                    <li><a href="<?= ROOTURL ?>admin/user/new">Add User</a></li>
                    <li><a href="<?= ROOTURL ?>admin/user">View</a></li>
                </ul>
            </li>
        <?php endif; ?>
    </ul>
</nav>
    <div class="content-inner">