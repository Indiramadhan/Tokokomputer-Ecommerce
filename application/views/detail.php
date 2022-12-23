<div class="container">
    <div class="card bg-light py-4 mt-4">
        <div class="card-body">
            <?php foreach ($detail as $item) { ?>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="container d-flex justify-content-center">
                            <img id="main-image" src="<?= base_url(); ?>/assets/img/gambar/<?= $item->gambar1; ?>" width="300px" height="300px" alt="">
                        </div>
                        <div class="container d-flex justify-content-center g-0">
                            <img onclick="change_image(this)" src="<?= base_url(); ?>/assets/img/gambar/<?= $item->gambar1; ?>" width="75px" height="75px" alt="">
                            <img onclick="change_image(this)" src="<?= base_url(); ?>/assets/img/gambar/<?= $item->gambar2; ?>" width="75px" height="75px" alt="">
                            <img onclick="change_image(this)" src="<?= base_url(); ?>/assets/img/gambar/<?= $item->gambar3; ?>" width="75px" height="75px" alt="">
                            <img onclick="change_image(this)" src="<?= base_url(); ?>/assets/img/gambar/<?= $item->gambar4; ?>" width="75px" height="75px" alt="">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="mt-2">
                            <?php if ($item->id_ktg == 1) {
                                echo "Processor";
                            } elseif ($item->id_ktg == 2) {
                                echo "Ram";
                            } elseif ($item->id_ktg == 3) {
                                echo "Vga";
                            } elseif ($item->id_ktg == 4) {
                                echo "Motherboard";
                            } elseif ($item->id_ktg == 5) {
                                echo "SSD";
                            } elseif ($item->id_ktg == 6) {
                                echo "HDD";
                            } elseif ($item->id_ktg == 7) {
                                echo "PSU";
                            } ?>
                        </div>
                        <h4><?php echo $item->nama_brg ?></h4>
                        <h4 class="mb-2">Rp
                            <?php
                            $angka_format = number_format($item->harga_jual);
                            echo $angka_format;
                            ?>
                            ;-
                        </h4>
                        <b>Stok : <?php echo $item->stok ?></b>
                        <div class="mt-2 mb-2">
                            <?php echo $item->spesifikasi ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="mt-4">
                            <h5 class="text-danger mb-2">Contact Us :</h5>
                            <div class="container mb-3">
                                <a href="#">
                                    <img src="<?= base_url(); ?>/assets/img/media/tokopedia.png" alt="tokopedia" width="50px" height="50px">
                                </a>
                                <a href="#">
                                    <img src="<?= base_url(); ?>/assets/img/media/whatsapp.png" alt="tokopedia" width="50px" height="50px">
                                </a>
                                <a href="#">
                                    <img src="<?= base_url(); ?>/assets/img/media/facebook.png" alt="tokopedia" width="50px" height="50px">
                                </a>

                                <a href="#">
                                    <img src="<?= base_url(); ?>/assets/img/media/instagram.png" alt="tokopedia" width="50px" height="50px">
                                </a>
                            </div>
                            <div class="row mb-3">
                                <div class="col-5">
                                    <label for="" class="mb-1">Jumlah : </label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-sm btn-danger" id="btnkurang">-</button>
                                        <input type="text" name="quantity" id='quantity' class="form-control form-control-sm text-center" value="1" readonly>
                                        <button type="button" class="btn btn-sm btn-danger" id="btntambah">+</button>
                                    </div>
                                </div>
                            </div>
                            <span class="me-4">Subtotal : </span>
                            <b>Rp </b><b id="total" class="total"><?php $angka_format = number_format($item->harga_jual);
                                                                    echo $angka_format ?></b> <b>;-</b>

                        </div>
                        <div class="row py-4 g-1">
                            <div class="col-sm-4">
                                <div class="d-grid gap-2">
                                    <a class="btn btn-danger shadow-sm" href="<?= site_url('transaksi/checkoutsolo/') ?><?php echo $item->id ?>">Beli</a>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="d-grid gap-2">
                                    <input type="hidden" name="id_brg" value="<?= $item->id ?>">
                                    <?php if ($item->stok == 0) { ?>
                                        <button class="btn btn-default text-danger border-danger rounded-phil shadow-sm add_cart">Ajukan stok</button>
                                    <?php } else { ?>
                                        <?php if ($this->session->logged_in == TRUE) { ?>
                                            <input type="hidden" name="id_user" value="<?= $user['id']; ?>">
                                            <button class="btn btn-default text-danger border-danger rounded-phil shadow-sm add_cart" data-idbrg="<?= $item->id ?>" data-stok="<?= $item->stok ?>" data-prevharga="<?= $item->harga_jual ?>" data-iduser="<?= $user['id']; ?>">Keranjang</button>
                                        <?php } else { ?>
                                            <button class="btn btn-default text-danger border-danger rounded-phil shadow-sm add_cart">Keranjang</button>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="container-fluid py-4 mt-4">
    <div class="row justify-content-center">
        <?php foreach ($produk as $data) { ?>
            <div class="col-md-2 col-xl-2 mb-4 card-detail me-2">
                <div class="card">
                    <?php if ($data->stok == 0) { ?>
                        <a class="disabled" href="<?= site_url('frontapp/detail/') ?><?php echo $data->id ?>">
                            <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <img src="<?= base_url(); ?>/assets/img/gambar/<?= $data->gambar1 ?>" height="200px" width="300px" class="card-img-top" alt="...">
                        </a>
                    <?php } else { ?>
                        <a href="<?= site_url('frontapp/detail/') ?><?php echo $data->id ?>">
                            <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <img src="<?= base_url(); ?>/assets/img/gambar/<?= $data->gambar1 ?>" height="200px" width="300px" class="card-img-top" alt="...">
                        </a>
                    <?php } ?>
                    <div class="card-body">
                        <h6 class="card-title text-center text-break"><?= $data->nama_brg; ?></h6>
                        <?php if ($data->stok == 0) { ?>
                            <p class="card-text text-danger text-center">Stok Habis</p>
                        <?php } else { ?>
                            <p class="card-text text-center">Rp
                                <?php
                                $angka_format = number_format($data->harga_jual);
                                echo $angka_format;
                                ?>
                            </p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script src="<?= base_url() ?>/assets/js/rupiah.js"></script>
<script type="text/javascript">
    var count = '<?php echo 1 ?>';
    var harga = ' <?php echo $item->harga_jual ?>';
    var btntambah = document.getElementById("btntambah");
    var btnkurang = document.getElementById("btnkurang");
    var tampil = document.getElementById("tampil");
    var total = document.getElementById("total");
    var base_url = '<?= base_url(); ?>';

    btntambah.onclick = function() {
        count++;
        $('[id="quantity"]').attr("value", count);
        $('.add_cart').attr("data-qty", count);
        $('.add_cart').attr("data-harga", count * harga);
        total.innerHTML = count * harga;
        $('.total').simpleMoneyFormat();
    }

    btnkurang.onclick = function() {
        count--;
        $('[id="quantity"]').attr("value", count);
        $('.add_cart').attr("data-qty", count);
        $('.add_cart').attr("data-harga", count * harga);
        total.innerHTML = count * harga;
        $('.total').simpleMoneyFormat();

    }

    function change_image(image) {

        var container = document.getElementById("main-image");

        container.src = image.src;
    }
    document.addEventListener("DOMContentLoaded", function(event) {});

    $(document).ready(function() {
        $('.add_cart').click(function() {
            var id_brg = $(this).data("idbrg");
            var id_user = $(this).data("iduser");
            var stok = $(this).data("stok");
            var harga = $(this).data("harga");
            var prevharga = $(this).data("prevharga");
            var quantity = $(this).data("qty");
            $.ajax({
                url: base_url + "index.php/cart/tambahdet",
                method: "POST",
                data: {
                    id_brg: id_brg,
                    id_user: id_user,
                    stok: stok,
                    harga: harga,
                    prevharga: prevharga,
                    quantity: quantity
                },
                success: window.location.reload(),
            });
        });
    });
</script>