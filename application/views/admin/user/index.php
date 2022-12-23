<div id="layoutSidenav_content" class="bg-dark text-white">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">profile</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="<?= base_url(); ?>">dashboard</a> / profile</li>
            </ol>
            <div class="row">
                <div class="col-lg-12">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="card text-center">
                        <div class="card-header bg-primary text-white">
                            Data diri pribadi
                        </div>
                        <div class="card-body">
                            <img src="<?= base_url(); ?>/assets/img/profile/<?= $user['image']; ?>" alt="avatar" class="rounded-circle img-fluid mb-3" style="width: 110px;">
                            <h5><?= $user['name']; ?></h5>
                            <p class="text-muted mb-1"><?= $user['email']; ?></p>
                            <div>Bergabung pada :</div>
                            <p class="text-muted mb-1"><?= $user['created_date']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Ubah Profile
                        </div>
                        <div class="card-body">
                            <?= form_open_multipart('admin/user/edit'); ?>
                            <div class="form-group row mb-3">
                                <label for="email" class="col-sm-2 col-from-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="name" class="col-sm-2 col-from-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="from-group row mb-3">
                                <div class="col-sm-2">Picture</div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img src="<?= base_url(); ?>/assets/img/profile/<?= $user['image']; ?>" class="img-thumbnail">
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control" id="image" name="image">
                                                <label class="input-group-text" for="image">Upload</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row justify-content-end">
                                <div class="col-sm-10 d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Ubah Password
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('admin/user/changepassword'); ?>" method="post">
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
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>