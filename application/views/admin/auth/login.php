<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <h2 class="d-flex justify-content-center mt-5"></h2>
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h2 class="d-flex justify-content-center font-weight-light my-4"> <i class="text-primary">Admin </i> Tokokomputer</h2>
                            </div>

                            <?= $this->session->flashdata('message'); ?>

                            <div class="card-body">
                                <form method="post" action="<?= site_url('admin/auth'); ?>" class="user">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?= set_value('email'); ?>" />
                                        <label for="inputEmail">Email address</label>
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                                        <label for="inputPassword">Password</label>
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <div class="d-grid gap-2 col-12 mx-auto">
                                            <button type="submit" class="btn btn-primary">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="<?= site_url('admin/auth/registration'); ?>" class=" text-decoration-none text-dark">Need an account? Sign up!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>