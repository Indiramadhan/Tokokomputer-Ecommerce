<div class="container">
    <h1 class="h3 py-4 mt-2 mb-2">Keranjang</h1>
    <div class="row">
        <div class="col-sm-9 mb-4">
            <div class="card">

                <!-- Tambah dan Kurang Quantity -->
                <?php foreach ($barang as $item) { ?>
                    <input type="hidden" name="stok" id="tmbh<?php echo $item->id ?>" value="<?php echo $item->stok - 1 ?>">
                    <input type="hidden" name="stok" id="krng<?php echo $item->id ?>" value="<?php echo $item->stok + 1 ?>">
                <?php } ?>

                <!-- Tabel Keranjang -->
                <div class="card-body">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Info Barang</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($cart as $item) { ?>
                                <tr>
                                    <td width="35px"><?php echo $i++ ?></td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-3 d-flex justify-content-center">
                                                <img src="<?= base_url() ?>/assets/img/gambar/<?php echo $item->gambar1 ?>" height="75px" width="75px" alt="">
                                            </div>
                                            <div class="col-sm-9">
                                                <h6><?php echo $item->nick ?></h6>
                                                <div><?php echo $item->nama_ktg ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td width="100px">
                                        <div class="input-group mb-3">
                                            <?php if ($item->quantity <= 1) { ?>
                                                <button class="btn btn-sm btn-danger btn-kurang-qty" data-id="<?php echo $item->id ?>" data-idbrg="<?php echo $item->id_brg ?>" data-quantity="<?php echo $item->quantity - 1; ?>" data-harga="<?php echo $item->harga - $item->prev_harga ?>" id="button-addon1" disabled>-</button>
                                            <?php } else { ?>
                                                <button class="btn btn-sm btn-danger btn-kurang-qty" data-id="<?php echo $item->id ?>" data-idbrg="<?php echo $item->id_brg ?>" data-quantity="<?php echo $item->quantity - 1; ?>" data-harga="<?php echo $item->harga - $item->prev_harga ?>" id="button-addon1">-</button>
                                            <?php  } ?>
                                            <input type="text" class="form-control form-control-sm text-center" value="<?php echo $item->quantity ?>" readonly>
                                            <button class="btn btn-sm btn-danger btn-tambah-qty" data-id="<?php echo $item->id ?>" data-idbrg="<?php echo $item->id_brg ?>" data-quantity="<?php echo $item->quantity + 1; ?>" data-harga="<?php echo $item->harga + $item->prev_harga ?>" data-qty="<?php echo $item->quantity; ?>" id="button-addon2">+</button>
                                        </div>
                                    </td>
                                    <td>
                                        Rp <?php echo number_format($item->harga) ?> ;-
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-danger btn-kembalikan" data-idcart="<?php echo $item->id ?>" data-idbrg="<?php echo $item->id_brg ?>" data-stokbrg="<?php echo $item->stok_brg ?>" onclick="hapus(<?php echo $item->id ?>)">Hapus</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card position-sticky top-0">
                <div class="p-3 bg-light bg-opacity-10">
                    <h6 class="card-title mb-3">Order Summary</h6>
                    <div class="d-flex justify-content-between mb-4 small">
                        <span>TOTAL</span> <strong class="text-dark">Rp <?php
                                                                        foreach ($total as $data) {
                                                                            echo number_format($data->harga);
                                                                        }
                                                                        ?> ;-</strong>
                    </div>
                    <?php if ($jumlah_brg > 0) { ?>
                        <a href="<?= site_url('transaksi/checkout'); ?>" class="btn btn-danger w-100 mt-2 d-grid">Bayar</a>
                    <?php } else { ?>
                        <a href="<?= site_url('transaksi/checkout'); ?>" class="btn btn-danger w-100 mt-2 d-grid disabled">Bayar</a>
                    <?php } ?>
                </div>
            </div>
            <script type="text/javascript" src="<?= base_url(); ?>/js/cart.js"></script>
        </div>
    </div>
</div>