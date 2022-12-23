<div id="layoutSidenav_content" class="bg-dark text-white">
    <main>
        <div class="container-fluid">
            <h5 class="mt-4"><?= $title; ?></h5>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= site_url('admin/app'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('admin/app/role'); ?>">Role</a> / <?= $title; ?></li>
            </ol>
            <?= $this->session->flashdata('message'); ?>
            <div class="card bg-dark text-white">
                <div class="card-header">
                    Role : <?= $role['role']; ?>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center text-center">
                        <table class="table table-borderless text-white">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($menu as $m) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $m['menu']; ?></td>
                                        <td>
                                            <div class="form-check d-flex justify-content-center">
                                                <input type="checkbox" class="form-check-input" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>