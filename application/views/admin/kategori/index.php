<div id="layoutSidenav_content" class=" bg-dark">
    <main>
        <div class="container-fluid px-4">
            <h5 class="mt-4 text-white">Kategori Produk</h5>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="<?= base_url(); ?>">dashboard</a> / kategori</li>
            </ol>
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary mb-4" onclick="tambah()"><i class="fas fa-plus"></i> Tambah</button>
            </div>
            <div class="card mb-4 bg-dark" id="card_table">
                <div class="card-header">
                    <div class="card-title">
                        Datatable kategori
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless text-white" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>info kategori</th>
                                <th>tanggal update</th>
                                <th>opsi lainnya</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card" id="card_tambah">
                <div class="card-header">
                    <div class="card-title">
                        Tambah
                    </div>
                </div>
                <div class="card-body">
                    <form action="#" id="form">
                        <input type="hidden" value="" name="id" />
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="nama_kategori">Nama Kategori</label>
                                    <input type="text" class="form-control" name="nama_ktg">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="ikon">Ikon Kategori</label>
                                    <input type="file" class="form-control" name="ikon">
                                </div>
                                <div class="form-group" id="ikon-preview">
                                    <label class="control-label col-md-3"></label>
                                    <div class="col-md-9">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group" id="tgltambah">
                                    <label for="created_date">Tanggal Tambah</label>
                                    <input type="date" class="form-control" name="created_date">
                                </div>
                                <div class="form-group" id="tglupdate">
                                    <label for="updated_date">Tanggal Update</label>
                                    <input type="date" class="form-control" name="updated_date">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-light me-2" id="back">Kembali</button>
                        <button class="btn btn-primary" id="btnsimpan" onclick="simpan()">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?= base_url(); ?>/js/kategori.js"></script>
    </main>