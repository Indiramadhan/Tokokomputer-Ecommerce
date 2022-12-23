<div id="layoutSidenav_content" class="bg-dark text-white">
    <main>
        <div class="container-fluid px-4">
            <h5 class="mt-4">Halaman Produk</h5>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="<?= base_url(); ?>">dashboard</a> / produk</li>
            </ol>
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary mb-4" onclick="tambah()"><i class="fas fa-plus"></i> Tambah</button>
            </div>
            <div class="card bg-dark text-white mb-4" id="card_table">
                <div class="card-header">
                    <div class="card-title">
                        Datatable produk
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless text-white" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>info produk</th>
                                <th>stok produk</th>
                                <th>harga jual</th>
                                <th>harga kulak</th>
                                <th>tanggal update</th>
                                <th>opsi lainnya</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card bg-dark text-white mb-4" id="card_tambah">
                <div class="card-header">
                    <div class="card-title">
                        Tambah
                    </div>
                </div>
                <div class="card-body">
                    <form action="#" id="form">
                        <div class="row">
                            <input type="hidden" name="id">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <label for="nama_brg">Nama Barang</label>
                                            <input type="text" class="form-control" name="nama_brg">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="stok">Stok</label>
                                            <input type="number" class="form-control" name="stok">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="spesifikasi">Spesifikasi</label>
                                    <textarea name="spesifikasi" id="spesifikasi" class="form-control" cols="30" rows="2"></textarea>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="harga_beli">Harga Kulak</label>
                                            <input type="text" class="form-control" name="harga_beli">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <div class="form-group">
                                            <label for="harga_jual">Harga Jual</label>
                                            <input type="text" class="form-control" name="harga_jual">
                                        </div>
                                    </div>
                                    <div class="form-group tgltambah">
                                        <label for="created_date">Tanggal Tambah</label>
                                        <input type="date" class="form-control" name="created_date">
                                    </div>
                                    <div class="form-group tglupdate">
                                        <label for="updated_date">Tanggal Update</label>
                                        <input type="date" class="form-control" name="updated_date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="id_ktg">Kategori</label>
                                            <select name="id_ktg" class="form-control">
                                                <?php foreach ($kategori as $data) { ?>
                                                    <option value="<?php echo $data->id ?>"><?php echo $data->nama_ktg ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="nick">Nick Barang</label>
                                                <input type="text" class="form-control" name="nick">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-1">
                                        <label for="gambar1">Gambar 1 (Thumbnail)</label>
                                        <input type="file" class="form-control" name="gambar1">
                                        <div class="form-group" id="gambar1-preview">
                                            <label class="control-label col-md-3"></label>
                                            <div class="col-md-9">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-1">
                                        <label for="gambar2">Gambar 2</label>
                                        <input type="file" class="form-control" name="gambar2">
                                        <div class="form-group" id="gambar2-preview">
                                            <label class="control-label col-md-3"></label>
                                            <div class="col-md-9">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="gambar3">Gambar 3</label>
                                        <input type="file" class="form-control" name="gambar3">
                                        <div class="form-group" id="gambar3-preview">
                                            <label class="control-label col-md-3"></label>
                                            <div class="col-md-9">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="gambar4">Gambar 4</label>
                                        <input type="file" class="form-control" name="gambar4">
                                        <div class="form-group" id="gambar4-preview">
                                            <label class="control-label col-md-3"></label>
                                            <div class="col-md-9">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-light me-2" id="back">Kembali</button>
                        <button type="button" class="btn btn-primary" onclick="simpan()">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?= base_url(); ?>/js/produk.js"></script>
    </main>