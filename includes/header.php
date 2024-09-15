<?php

include_once 'classes/User.php';
$database = new Database();

$user = new User($database);

$isLogin = null;
if(isset($_SESSION['username']))
    $isLogin = true;

    //print_r($_SESSION);exit;
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>THEMosque - Mosque Website Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&family=Pacifico&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">

        

    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->


        <!-- Topbar start -->
        <div class="container-fluid px-0 fixed-top" id="home">
            <div class="topbar d-none d-lg-block">
                <div class="topbar-inner">
                    <div class="row gx-0">
                        <div class="col-lg-7 text-start">
                            <div class="h-100 d-inline-flex align-items-center me-4">
                                <span class="fa fa-phone-alt me-2 text-white"></span>
                                <a href="#" class="text-white"><span>+91 920 786 4324</span></a>
                            </div>
                            <div class="h-100 d-inline-flex align-items-center">
                                <span class="far fa-envelope me-2 text-white"></span>
                                <a href="#" class="text-white"><span>vazhimukkumj@gmail.com</span></a>
                            </div>
                        </div>
                        <div class="col-lg-5 text-end">
                            <div class="h-100 d-inline-flex align-items-center">
                                <span class="text-white">Follow Us:</span>
                                <a class="text-white px-2" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="text-white px-2" href=""><i class="fab fa-twitter"></i></a>
                                <a class="text-white px-2" href=""><i class="fab fa-linkedin-in"></i></a>
                                <a class="text-white px-2" href=""><i class="fab fa-instagram"></i></a>
                                <?php if (isset($isLogin)) { echo "<a class='text-white ps-4' href='gallery-upload.php'><i class='fas fa-upload'></i> Upload</a>"; } ?>
                                <?php if (isset($isLogin)) { echo "<a class='text-white ps-4' href='login.php?logout=true'><i class='fa fa-lock text-white me-1'></i> Logout</a>"; } ?>
                                <?php if (!isset($isLogin)) { echo "<a class='text-white ps-4' href='login.php'><i class='fa fa-lock text-white me-1'></i> Login</a>"; } ?>
                                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="navbar px-3 py-2 navbar-light navbar-expand-lg">
                <a href="index.php" class="navbar-brand">
                    <h1 class="mb-0"><img class="img-fluid masjid-logo" src="./img/logo-text.png" /></h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav ms-lg-auto mx-xl-s-auto">
                        <a href="index.php#home" class="nav-item nav-link active">Home</a>
                        <a href="#about" class="nav-item nav-link">About</a>
                        <a href="#teachers" class="nav-item nav-link">Teachers</a>
                        <a href="#members" class="nav-item nav-link">Members</a>
                        <a href="gallery-list.php" class="nav-item nav-link">Gallery</a>
                        <a href="#contact" class="nav-item nav-link">Contact</a>
                    </div>
                    <a href="" class="btn btn-primary py-2 px-4 ms-5 d-none d-xl-inline-block">Donate</a>
                </div>
            </nav>
        </div>
        <!-- Topbar End -->