<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tokokomputer</title>
    <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/boxicons.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/all.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/style.css'); ?>">
    <script src="<?= base_url("assets/js/bootstrap.bundle.min.js"); ?>"></script>
    <script src="<?= base_url('assets/js/310ccd6629.js'); ?>"></script>
    <script src="<?= base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/script.js'); ?>"></script>
    <style>
        a.disabled {
            pointer-events: none;
            cursor: default;
        }

        @media (max-width: 991px) {
            .hidden-mobile {
                display: none;
            }

            .card-brand {
                width: 11rem;
            }

            .card-detail {
                width: 11rem;
            }

            .card-detail .card {
                height: 17rem;
            }

            .card-brand .card {
                height: 23rem;
            }

            .card-brand .btn {
                margin-top: 15px;
            }

            .card-brand .card img {
                width: 100%;
                height: auto;
            }

            .card-detail .card img {
                width: 100%;
                height: auto;
            }
        }

        .text-logo {
            color: gray;
            font-size: 2rem;
            font-family: snes;
        }

        .text-logo:hover {
            color: red;
        }

        .text-submenu {
            color: gray;
            font-size: 1.2rem;
            margin-left: 25px;
            margin-right: 25px;
            font-family: calibri;
        }

        @media (min-width: 991px) {
            .hidden-desktop {
                display: none;
            }
        }

        .form-control:focus {
            box-shadow: none;
        }

        .form-control-underlined {
            border-width: 0;
            border-bottom-width: 1px;
            border-radius: 0;
            padding-left: 0;
        }

        .form-control::placeholder {
            font-size: 0.95rem;
            color: #aaa;
            font-style: italic;
        }

        .navbar-toggler {
            background-color: default;
            border: none;
        }

        ul,
        body,
        p {
            margin: 0;
            padding: 0;
        }

        .slider {
            box-sizing: border-box;
            width: 100vw;
            height: 25vw;
            overflow: hidden;
        }

        .slider .slides-container {
            display: flex;
            width: 100%;
            height: 100%;
            cursor: -webkit-grab;
            cursor: grab;
            transition: transform .5s;
        }

        .slider-image {
            width: 100%;
            height: auto;
        }

        .slider:active .slides-container {
            cursor: -webkit-grabbing;
            cursor: grabbing;
        }

        .slider .slides-container.moving {
            transition: none;
        }

        .slider .slides-container.moving .slide {
            transition: none;
        }

        .slider .slides-container.moving .parallax {
            transition: none;
        }

        .slider .slide {
            position: relative;
            display: block;
            width: 100%;
            height: 100%;
            opacity: .8;
            transform: scale(.9);
            transform-origin: center;
            transition: transform .5s, opacity .5s;
        }

        .slider .slide.current {
            opacity: 1;
            transform: scale(1);
        }

        .slider .slide .parallax {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            pointer-events: none;
            transition: transform .5s, opacity .5s;
        }

        .slider .slide.current .parallax {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }

        .slider .slide .parallax p {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            transform: translateY(-50%);
            text-align: center;
            color: white;
            font-family: Circular, sans-serif;
            font-size: 3em;
        }
    </style>
</head>

<body class="bg-light">
    <span class="loader"><span class="loader-inner"></span></span>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-lg">
        <div class="container">
            <h4><a class="navbar-brand px-4 text-logo" href="<?= site_url('frontapp'); ?>">Tokokomputer</a></h4>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-submenu hidden-desktop">
                    <li class="nav-item">
                        <?php if ($this->session->logged_in == TRUE) { ?>
                            <?php if ($jumlah_brg > 0) { ?>
                                <a class="nav-link active" aria-current="page" href="<?= site_url('cart/index'); ?>">Keranjang <span class="badge text-bg-warning text-white"><?php echo $jumlah_brg ?></span></a>
                            <?php } else {  ?>
                                <a class="nav-link active" aria-current="page" href="<?= site_url('cart/index'); ?>">Keranjang</a>
                            <?php } ?>
                        <?php } else { ?>
                            <a class="nav-link active" aria-current="page" href="<?= site_url('cart/index'); ?>">Keranjang</a>
                        <?php } ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active dropdown-toggle" aria-current="page" href="#" data-bs-toggle="dropdown">Setting</a>
                        <ul class="dropdown-menu text-submenu">
                            <li><a class="dropdown-item" href="<?= site_url('frontapp/profil'); ?>">Profil</a></li>
                            <li><a class="dropdown-item" href="<?= site_url('transaksi/transaksi'); ?>">Transaksi</a></li>
                            <?php if ($this->session->logged_in == TRUE) { ?>
                                <li><a class="dropdown-item" href="<?php echo base_url('index.php/authuser/Logout'); ?>">Logout</a></li>
                            <?php } else { ?>
                                <li><a class="dropdown-item" href="<?= site_url('authuser'); ?>">Login</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
                <form class="input-group bg-light rounded rounded-pill shadow-sm mb-2 me-2 mt-2" action="<?= site_url('frontapp/index') ?>" action="GET">
                    <input type="search" placeholder="What're you searching for?" id="find" name="find" aria-describedby="button-addon1" class="form-control border-0 bg-light">
                    <button class="btn btn-link text-danger" type="submit" value="Find"><i class="fas fa-search"></i></button>
                </form>
                <form class="d-flex justify-content-end px-4">
                    <?php if ($this->session->logged_in == TRUE) { ?>
                        <?php if ($jumlah_brg > 0) { ?>
                            <a href="<?= site_url('cart/index'); ?>" class="btn btn-default text-danger rounded-pill shadow-sm position-relative me-3 hidden-mobile"><i class="fas fa-cart-shopping"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                                    <?php echo $jumlah_brg ?>
                                    <span class="visually-hidden">unread messages</span>
                            </a>
                        <?php } else {  ?>
                            <a href="<?= site_url('cart/index'); ?>" class="btn btn-default text-danger rounded rounded-pill shadow-sm position-relative me-3 hidden-mobile"><i class="fas fa-cart-shopping"></i></a>
                        <?php } ?>
                    <?php } else { ?>
                        <a href="<?= site_url('cart/index'); ?>" class="btn btn-default text-danger rounded rounded-pill shadow-sm position-relative me-3 hidden-mobile"><i class="fas fa-cart-shopping"></i>
                        </a>
                    <?php } ?>
                    <div class="btn-group hidden-mobile">
                        <button type="button" class="btn btn-default text-danger rounded rounded-pill shadow-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= site_url('frontapp/profil'); ?>">Profil </a></li>
                            <li><a class="dropdown-item" href="<?= site_url('transaksi/transaksi'); ?>">Transaksi</a></li>
                            <?php if ($this->session->logged_in == TRUE) { ?>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?php echo base_url('index.php/authuser/Logout'); ?>">Logout</a></li>
                            <?php } else { ?>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?= site_url('authuser'); ?>">Login</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </nav>