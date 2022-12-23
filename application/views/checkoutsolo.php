<div class="container py-4 mb-4 mt-2">
    <h1 class="h3 mb-4">Payment</h1>
    <div class="row">
        <!-- Left -->
        <div class="col-lg-9">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="container">
                        <form method="post" action="<?php echo site_url('transaksi/simpansolo'); ?>">
                            <input type="hidden" name="kode_checkout" id="kode_checkout" value="<?php $mt_rand = mt_rand(1000, 9999);
                                                                                                echo $mt_rand; ?>" max="10">
                            <input type="hidden" name="paket" id="paket" value="<?php $mt_rand = mt_rand(1000, 9999);
                                                                                echo $mt_rand; ?>" max="10">
                            <input type="hidden" name="id_user" id="id_user" value="<?= $user['id'] ?>">
                            <input type="hidden" name="date" id="date" value="<?php echo date("Y-m-d") ?>">
                            <input type="hidden" name="status" id="status" value="1">
                            <div class="form-group mb-3">
                                <label class="mb-1 px-1" for="">Nama lengkap (Nama penerima)</label>
                                <input type="text" name="nama_lngkp" class="form-control" placeholder="Yohanes Saputro" value="<?= $user['nama'] ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1 px-1" for="">Nomer telepon aktif</label>
                                <input type="text" name="no_tlp" class="form-control" placeholder="0822 XXXX XXXX" value="<?= $user['no_tlp'] ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1 px-1" for="">Alamat lengkap</label>
                                <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="5" placeholder="Jl.Sukodadi Panglima Soedirman, Makasar"><?= $user['alamat'] ?></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1 px-1" for="">Pengiriman</label>
                                <select name="pengiriman" id="" class="form-control">
                                    <option value="jnt express">JNT Express</option>
                                    <option value="jne express">JNE Express</option>
                                    <option value="tiki express">TIKI Express</option>
                                    <option value="wahana express">Wahana Express</option>
                                    <option value="ninja express">Ninja Express</option>
                                    <option value="shopee express">Shopee Express</option>
                                    <option value="sicepat">Sicepat</option>
                                    <option value="gosend">Gosend</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1 px-1" for="">Pembayaran</label>
                                <select name="pembayaran" id="" class="form-control">
                                    <option value="bca virtual">BCA Virtual Account</option>
                                    <option value="bri">BRI</option>
                                </select>
                            </div>
                            <table class="table table-borderless py-3">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Info Transaksi</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $item) { ?>
                                        <tr>
                                            <td width="15px"></td>
                                            <td width="375px">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <img src="<?= base_url() ?>/assets/img/gambar/<?php echo $item->gambar1 ?>" width="75px" height="75px" alt="">
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <h6><?= $item->nama_brg ?></h6>
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <input type="number" class="form-control border-danger" name="qty[]" value="1">
                                                                <input type="hidden" name="idcart[]" value="<?php $mt_rand = mt_rand(1000000, 999999999);
                                                                                                            echo $mt_rand; ?>" max="10">
                                                                <input type="hidden" name="idbrg[]" value="<?= $item->id; ?>">
                                                            </div>
                                                            <div class="col-sm-10"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="125px">
                                                Rp <?php
                                                    $angka_format = number_format($item->harga_jual);
                                                    echo $angka_format;
                                                    ?> ;-
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Right -->
        <div class="col-lg-3">
            <div class="card position-sticky top-0">
                <div class="p-3 bg-light bg-opacity-10">
                    <h6 class="card-title mb-3">Order Summary</h6>
                    <div class="d-flex justify-content-between mb-1 small">
                        <span>Subtotal</span> <span>$214.50</span>
                    </div>
                    <div class="d-flex justify-content-between mb-1 small">
                        <span>Shipping</span> <span>$20.00</span>
                    </div>
                    <div class="d-flex justify-content-between mb-1 small">
                        <span>Coupon (Code: NEWYEAR)</span> <span class="text-danger">-$10.00</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4 small">
                        <span>TOTAL</span> <strong class="text-dark">$224.50</strong>
                    </div>
                    <button type="submit" class="btn btn-danger w-100 mt-2">Bayar</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>