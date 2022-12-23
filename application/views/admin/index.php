        <div class="bg-dark" id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="card text-white mb-4 bg-dark mt-4">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <img src="<?= base_url(); ?>/assets/img/profile/<?= $user['image']; ?>" alt="avatar" class="rounded-circle">
                                            </div>
                                            <div class="col-sm-8">
                                                <div>Selamat Datang</div>
                                                <h6><?= $user['name']; ?></h6>
                                                <div class="text-secondary" id="clock"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-8">
                            <div class="card text-white mb-4 bg-dark mt-4">
                                <div class="card-body">
                                    <div class="container">
                                        <h4>Dashboard</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-dark mb-4">
                        <div class="container">
                            <div class="row mt-4 px-2">
                                <div class="col-xl-3 col-md-6">
                                    <?php if ($stok > 10) { ?>
                                        <div class="card bg-primary text-white mb-4">
                                            <div class="card-body">
                                                <h5>Total Stok</h5>
                                                <h1><?php echo $stok ?></h1>
                                            </div>
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <a class="small text-white stretched-link" href="<?= site_url(); ?>">View Details</a>
                                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                    <?php } elseif ($stok < 10) { ?>
                                        <div class="card bg-warning text-white mb-4">
                                            <div class="card-body">
                                                <h5>Total Stok</h5>
                                                <h1><?php echo $stok ?></h1>
                                            </div>
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <a class="small text-white stretched-link" href="<?= site_url(); ?>">View Details</a>
                                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-primary text-white mb-4">
                                        <div class="card-body">
                                            <h5>Jumlah Barang</h5>
                                            <h1><?php echo $barang ?></h1>
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="small text-white stretched-link" href="#">View Details</a>
                                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <?php if ($pesanan == 0) { ?>
                                        <div class="card bg-primary text-white mb-4">
                                            <div class="card-body">
                                                <h5>Pesanan Pending</h5>
                                                <h1><?php echo $pesanan ?></h1>
                                            </div>
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <a class="small text-white stretched-link" href="#">View Details</a>
                                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="card bg-warning text-white mb-4">
                                            <div class="card-body">
                                                <h5>Pesanan Pending</h5>
                                                <h1><?php echo $pesanan ?></h1>
                                            </div>
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <a class="small text-white stretched-link" href="#">View Details</a>
                                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-primary text-white mb-4">
                                        <div class="card-body">
                                            <h5>Total Transaksi</h5>
                                            <h1><?php echo $proses ?></h1>
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="small text-white stretched-link" href="#">View Details</a>
                                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4 px-2">
                                <div class="col-sm-12 mb-4">
                                    <div class="card border-primary">
                                        <div class="card-header bg-primary text-white">
                                            Grafik Stok Barang
                                        </div>
                                        <div class="card-body">
                                            <div class="init-grafik-loading grafik" style="height: 350px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xl-8 mb-4">
                                    <div class="card border-primary">
                                        <div class="card-header bg-primary text-white">
                                            Datatable Pesanan
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-borderless" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kode Checkout</th>
                                                        <th>Status</th>
                                                        <th>Created Date</th>
                                                        <th>Opsi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xl-4">
                                    <div class="card border-primary">
                                        <div class="card-header bg-primary text-white">
                                            Chart Pie Example
                                        </div>
                                        <div class="card-body">
                                            <div class="init-pie-loading pie" style="height: 350px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="acceptmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="<?php site_url('app/admin') ?>" id="formaccept">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <h6>
                                                <div id="pengguna"></div>
                                            </h6> telah chekout pada tanggal
                                            <i>
                                                <div id="created_date"></div>
                                            </i>
                                        </div>
                                    </div>
                                    <input type="hidden" name="kode_checkout">
                                    <input type="hidden" name="id_brg">
                                    <input type="hidden" name="qty">
                                    <input type="hidden" name="status" value="2">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" onclick="simpan()">Proses</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="kirimmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-judul">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="<?php site_url('app/admin') ?>" id="formkirim">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control" name="resi_pengiriman">
                                        </div>
                                    </div>
                                    <input type="hidden" name="kode_checkout">
                                    <input type="hidden" name="status" value="3">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="simpan()">Proses</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <script type="text/javascript" src="<?= base_url(); ?>/js/admin.js"></script>
            </main>