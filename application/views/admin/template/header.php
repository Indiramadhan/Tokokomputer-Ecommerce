<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tokokomputer - admin</title>
    <link href="<?= base_url(); ?>/assets/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="//www.amcharts.com/lib/4/themes/animated.js"></script>
    <style>
        img {
            width: 75px;
        }

        a.disabled {
            pointer-events: none;
            cursor: default;
        }

        .card {
            border: none;
            border-radius: 15px;
            background: rgba(255, 255, 255, .25);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .5);
        }

        .btn {
            border-radius: 6px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
        }

        .bg-primary {
            background-image: linear-gradient(to right, #3C4CAD, #787FF6);
        }

        .bg-warning {
            background-image: linear-gradient(to right, #ff921e, #ffa342);
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="<?= base_url(); ?>">Tokokomputer</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?= site_url('admin/user/profile'); ?>">Profile</a></li>
                        <li><a class="dropdown-item" href="<?= site_url('admin/auth/logout'); ?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>