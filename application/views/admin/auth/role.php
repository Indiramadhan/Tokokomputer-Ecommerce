<div id="layoutSidenav_content" class="bg-dark text-white">
    <main>
        <div class="container-fluid px-4">
            <h5 class="mt-4">Hak Akses Admin</h5>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="#">Dashboard</a> / Hak Akses Admin</li>
            </ol>
            <div class="card bg-dark text-white">
                <div class="card-header">
                    Hak Akses Admin
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center text-center">
                        <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <?= $this->session->flashdata('message'); ?>
                        <table class="table table-borderless text-white">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($role as $r) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $r['role']; ?></td>
                                        <td>
                                            <a href="<?= site_url('admin/app/roleaccess/') . $r['id']; ?>" class="btn btn-sm btn-warning">akses</a>
                                        </td>
                                    </tr>
                                <?php $i++;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>