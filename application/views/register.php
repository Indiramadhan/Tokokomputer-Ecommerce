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
                        <h5 class="card-title text-center mb-5 fw-light fs-5">Sign Up</h5>
                        <form method="post" action="<?= site_url('authuser/register'); ?>">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Andrew Tate">
                                <label for="floatingInput">Nama lengkap</label>
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                                <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password2" name="password2" placeholder="Password">
                                <label for="floatingPassword">Confirm Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10"></textarea>
                                <label for="floatingInput">Nama lengkap</label>
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="no_tlp" name="no_tlp" placeholder="Andrew Tate">
                                <label for="floatingInput">Nama lengkap</label>
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <input type="hidden" id="is_active" name="is_active" value="1">
                            <div class="d-grid">
                                <button class="btn btn-danger btn-login text-uppercase fw-bold" type="submit">Sign in</button>
                            </div>
                            <div class="px-2">Punya akun ? <a href="<?= site_url('authuser'); ?>" class="text-decoration-none text-danger">Login</a></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>