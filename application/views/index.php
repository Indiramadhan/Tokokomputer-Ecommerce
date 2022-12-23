<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
	<div class="carousel-inner">
		<?php foreach ($carousel as $data) { ?>
			<div class="carousel-item active">
				<img src="<?= base_url(); ?>/assets/img/carousel/<?php echo $data->gambar ?>" class="d-block w-100" alt="<?php echo $data->nama_brand ?>">
			</div>
		<?php } ?>
	</div>
	<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Previous</span>
	</button>
	<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Next</span>
	</button>
</div>
<div class="container py-2 mt-4 mb-4">
	<div class="card">
		<div class="card-body text-center">
			<div class="mb-4">
				<h5 class="text-danger">Kategori</h5>
			</div>
			<div class="row d-flex justify-content-center">
				<?php
				if (count($showktg) > 0) {
					foreach ($showktg as $data) { ?>
						<div class="col-sm-2 col-md-2 col-xl-1">
							<form class="input-group me-4 d-flex justify-content-center" action="<?= site_url('frontapp/index') ?>" action="GET">
								<img class=" hidden-mobile" src="<?= base_url(); ?>/assets/img/ikon/<?= $data->ikon; ?>" width="75px" height="75px" id="kategori" name="kategori" class="rounded-circle" alt="">
								<input type="hidden" id="kategori" name="kategori" value="<?= $data->id; ?>">
								<button type="submit" class="btn dark" value="kategori"><?php echo $data->nama_ktg ?></button>
							</form>
						</div>
				<?php }
				} ?>
			</div>
		</div>
	</div>
</div>
<div class="container mb-4">
	<div class="row px-4 mb-2">
		<div class="col-sm-8">
			<h4 class="text-danger">Product List</h4>
		</div>
		<div class="col-sm-1">
			Urutkan :
		</div>
		<div class="col-sm-3">
			<?php echo form_open('frontapp/index') ?>
			<div class="input-group">
				<select name="pilih" class="form-control text-center">
					<option>-- paling sesuai --</option>
					<option value="1">Harga terendah</option>
					<option value="2">Harga tertinggi</option>
				</select>
				<input type="submit" class="btn btn-default text-danger shadow-sm" name="cek" value="cek">
			</div>
			<?php echo form_close() ?>
		</div>
	</div>
</div>
<div class="container-fluid mt-4">
	<div class="row justify-content-center">
		<?php
		if (count($kategori) > 0) {
			foreach ($kategori as $data) { ?>
				<div class="col-md-2 col-xl-2 mb-4 card-brand me-2">
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
							<div class="d-grid gap-2">
								<input type="text" name="quantity" id="<?php echo $data->id; ?>" value="<?php echo $data->stok ?>" class="quantity">
								<?php if ($data->stok == 0) { ?>
									<button class="btn btn-danger add_cart">Ajukan stok</button>
								<?php } else { ?>
									<?php if ($this->session->logged_in == TRUE) { ?>
										<button class="btn btn-danger add_cart" data-idbrg="<?php echo $data->id; ?>" data-iduser="<?= $user['id']; ?>">Keranjang</button>
									<?php } else { ?>
										<button class="btn btn-danger add_cart">Keranjang</button>
									<?php } ?>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			<?php }
		} elseif (count($find) > 0) {
			foreach ($find as $data) { ?>
				<div class="col-sm-2 col-md-2 col-xl-2 card-brand mb-4">
					<div class="card ">
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
							<div class="d-grid gap-2">
								<input type="hidden" name="quantity" id="<?php echo $data->id; ?>" value="<?php echo $data->stok ?>" class="quantity">
								<?php if ($data->stok == 0) { ?>
									<button class="btn btn-danger mt-2 add_cart">Ajukan stok</button>
								<?php } else { ?>
									<?php if ($this->session->logged_in == TRUE) { ?>
										<button class="btn btn-danger mt-2 add_cart" data-idbrg="<?php echo $data->id; ?>" data-stok="<?php echo $data->stok; ?>" data-iduser="<?= $user['id']; ?>" data-qty="1" data-harga="<?php echo $data->harga_jual; ?>">Keranjang</button>
									<?php } else { ?>
										<button class="btn btn-danger mt-2 add_cart">Keranjang</button>
									<?php } ?>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			<?php }
		} else { ?>
			<div class="col-sm-2 col-md-2 col-xl-2 card-brand mb-4">
				Data tidak ditemukan
			</div>
		<?php } ?>
	</div>
	<script type="text/javascript" src="<?= base_url(); ?>/js/beranda.js"></script>
</div>