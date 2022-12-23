<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background: #007bff;
            background: linear-gradient(to right, #eaeaea, #ffffff);
        }

        .btn-login {
            font-size: 0.9rem;
            letter-spacing: 0.05rem;
            padding: 0.75rem 1rem;
        }
    </style>
</head>

<body>
    <div class="container ">
        <div class="row py-4 mt-4">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title text-center mb-5 fw-light fs-5">Sign In</h5>
                        <form method="post" action="<?php echo base_url('index.php/authuser/Login'); ?>">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="email" name="email" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-danger btn-login text-uppercase fw-bold" type="submit">Sign
                                    in</button>
                            </div>
                            <div class="px-2">Ngga punya akun ? <a href="<?= site_url('authuser/register'); ?>" class="text-decoration-none text-danger">Register</a></div>
                            <a href="<?= base_url(); ?>" class="text-decoration-none text-danger px-2">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/jquery.min.js'); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var gagal = '<?php echo $this->session->gagal; ?>';

            if (gagal == 1) {
                alert('Username atau Password Salah');
            }
        })
    </script>
</body>

</html>