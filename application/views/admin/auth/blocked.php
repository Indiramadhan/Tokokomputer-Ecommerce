<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $title; ?></title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link href="<?= base_url(); ?>/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <div id="layoutError">
        <div id="layoutError_content">
            <main>
                <div class="container mb-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="text-center mt-4">
                                <img class="mb-4 img-error" src="<?= base_url(); ?>assets/img/error-404-monochrome.svg" />
                                <p class="lead">Loginnya kesana malah kesini</p>
                                <a href="<?= site_url('admin/user'); ?>" class="text-decoration-none text-dark me-3">
                                    <i class="fas fa-arrow-left me-1"></i>
                                    Kembali
                                </a>
                                <a href="<?= site_url('admin/auth/logout'); ?>" class="text-decoration-none text-dark">
                                    <i class="fas fa-door-open me-1"></i>
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutError_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Tokokomputer <?php echo date('Y') ?></div>
                        <div>
                            <a href="#" class="text-decoration-none text-dark">Privacy Policy</a>
                            &middot;
                            <a href="#" class="text-decoration-none text-dark">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>