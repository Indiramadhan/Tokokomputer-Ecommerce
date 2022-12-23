<div class="container">
    <h1 class="h3 py-3">Daftar transaksi</h1>
    <div class="card">
        <div class="card-body">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th>Info Pembayaran</th>
                        <th>Progress</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($checkout as $data) { ?>
                        <tr class="td-middle">
                            <td><?php echo $i++ ?></td>
                            <td width="225px">
                                <div>No Resi : <b class="text-danger"> <?= $data->resi_pengiriman; ?> </b></div>
                                <div class="hidden-mobile">Pembayaran via <b class="text-danger"><?= $data->pembayaran; ?></b></div>
                                <div class="hidden-mobile">Pengiriman : <b class="text-danger"><?= $data->pengiriman; ?></b></div>
                            </td>
                            <td>
                                <?php if ($data->status == 1) { ?>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" aria-label="Basic example" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                <?php } elseif ($data->status == 2) { ?>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" aria-label="Basic example" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                <?php } elseif ($data->status == 3) { ?>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" aria-label="Basic example" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                <?php } elseif ($data->status == 4) { ?>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" aria-label="Basic example" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                <?php } ?>
                                <div>
                            </td>
                            <td width="150px">
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="detail(<?= $data->kode_checkout; ?>)">Detail</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="#" id="form">
                <div class="modal-body">
                    <h5>Detail pesanan</h5>
                    <div class="px-2">Pesan tanggal : <span class="text-danger" id="tglpesan"></span></div>
                    <div class="px-2">Nomer Resi : <span class="text-danger" id="noresi"></span></div>
                    <div class="px-2">Pembayaran : <span class="text-danger" id="pembayaran"></span></div>
                    <div class="px-2">Pengiriman : <span class="text-danger" id="pengiriman"></span></div>
                    <hr>
                    <div class="track">
                        <div class="step" id="proses"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Terproses</span> </div>
                        <div class="step" id="kirim"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Terkirim</span> </div>
                        <div class="step" id="terima"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Telah diterima</span> </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="">
                    <input type="hidden" name="status" value="4">
                    <div id="btn-selesai"></div>
                </div>
            </form>
        </div>
        <script type="text/javascript" src="<?= base_url(); ?>/js/transaksi.js"></script>
    </div>
</div>