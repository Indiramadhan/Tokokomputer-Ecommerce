<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tokokomputer - Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/style.css">
    <style>
        .text-logo {
            color: gray;
            font-size: 2rem;
            font-family: snes;
        }

        .text-logo:hover {
            color: red;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-lg mb-4">
        <div class="container">
            <h4><a class="navbar-brand px-4 text-logo" href="<?= site_url('frontapp'); ?>">Tokokomputer</a></h4>
        </div>
    </nav>
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-lg-12">
                <?= $this->session->flashdata('message'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 mb-3">
                <div class="card text-center">
                    <div class="card-header bg-danger text-white">
                        Data diri pribadi
                    </div>
                    <div class="card-body">
                        <img src="<?= base_url(); ?>/assets/img/profile/<?= $user['image']; ?>" alt="avatar" class="rounded-circle img-fluid mb-3" style="width: 110px;">
                        <h5><?= $user['nama']; ?></h5>
                        <p class="text-muted mb-1"><?= $user['email']; ?></p>
                        <div>Bergabung pada :</div>
                        <p class="text-muted mb-1"><?= $user['created_date']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        Ubah Profile
                    </div>
                    <div class="card-body">
                        <?= form_open_multipart('frontapp/edit'); ?>
                        <div class="form-group row mb-3">
                            <label for="email" class="col-sm-2 col-from-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="nama" class="col-sm-2 col-from-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama']; ?>">
                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="name" class="col-sm-2 col-from-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea name="alamat" class="form-control" cols="30" rows="2"><?= $user['alamat']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10 d-grid gap-2">
                                <button type="submit" class="btn btn-danger">Edit</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 mb-3">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        Ubah Password
                    </div>
                    <div class="card-body">
                        <form action="<?= site_url('frontapp/changepassword'); ?>" method="post">
                            <div class="form-group mb-2">
                                <label for="current_password">Current Password</label>
                                <input type="password" class="form-control form-control-sm" id="current_password" name="current_password">
                                <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group mb-2">
                                <label for="new_password1">New Password</label>
                                <input type="password" class="form-control form-control-sm" id="new_password1" name="new_password1">
                                <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group mb-4">
                                <label for="new_password2">Repeat Password</label>
                                <input type="password" class="form-control form-control-sm" id="new_password2" name="new_password2">
                                <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group d-grid gap-2">
                                <button type="submit" class="btn btn-danger">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>