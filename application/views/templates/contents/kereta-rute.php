<link rel="stylesheet" href="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/chosen/chosen.css">
<section id="content">

	<div class="page page-tables-datatables">

		<div class="pageheader">

			<div class="page-bar">

				<ul class="page-breadcrumb">
					<li>
						<a href="<?=base_url()?>"><i class="fa fa-home"></i> Dashboard</a>
					</li>
					<li>
						<a href="#">Kereta</a>
					</li>
					<li>
						<a href="<?=base_url()?>kereta/rute">Rute</a>
					</li>
				</ul>

			</div>

		</div>

		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">



				<!-- tile -->
				<section class="tile">

					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">Data <strong><?=$title?></strong></h1>
						<ul class="controls">
							<li class="dropdown">

								<a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
									<i class="fa fa-cog"></i>
									<i class="fa fa-spinner fa-spin"></i>
								</a>

								<ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
									<li>
										<a role="button" tabindex="0" class="tile-toggle">
											<span class="minimize"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;&nbsp;Minimize</span>
											<span class="expand"><i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;Expand</span>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
					<!-- /tile header -->

					<!-- tile body -->
					<div class="tile-body">
						<div class="row">
							<div class="col-md-6"><div id="tableTools"></div></div>
							<div class="col-md-6">
								<button style="float: right;" id="add" class="btn btn-ef btn-ef-5 btn-ef-5b btn-success mb-10" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14"><i class="fa fa-plus"></i> <span>Tambah</span></button>
							</div>
						</div>
						<br>
						<table class="table table-custom" id="advanced-usage">
							<thead>
							<tr>
								<th>Kode</th>
								<th>Kota Asal</th>
								<th>Kota Tujuan</th>
								<th>Bandara Asal</th>
								<th>Bandara Tujuan</th>
								<!-- <th>Jarak</th> -->
								<th>Total Harga</th>
								<th>Status</th>
								<th style="text-align: right;">Pilihan &nbsp;&nbsp;</th>
							</tr>
							</thead>
						</table>
					</div>
					<!-- /tile body -->

				</section>
				<!-- /tile -->

			</div>
			<!-- /col -->
		</div>
		<!-- /row -->

	</div>
	
</section>

	<!-- Splash Modal -->
	<div class="modal splash fade" id="splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title custom-font" id="myModalLabel"></h3>
				</div>
				<form role="form" id="form" method="post">
					<div class="modal-body">
						<input type="hidden" id="id" name="id" value="0">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="tanggal">Kode</label>
									<input type="text" id="kode" readonly="" class="form-control" name="kode" required="required"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="tanggal">Kota Asal</label>
									<div>
										<select required="" id="kota-asal" class="chosen-select" style="width: 100%;" tabindex="3">
											<option value="">Pilih Kota Asal</option>
											<?php foreach($kota as $ka) : ?>
												<option value="<?= $ka['kota_id'] ?>"><?= $ka['kota_nama'] ?></option>
											<?php endforeach; ?>
							          	</select>    
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="tanggal">Kota Tujuan</label>
									<div>
										<select required="" id="kota-tujuan" class="chosen-select" style="width: 100%;" tabindex="3">
											<option value="">Pilih Kota Tujuan</option>
											<?php foreach($kota as $kt) : ?>
												<option value="<?= $kt['kota_id'] ?>"><?= $kt['kota_nama'] ?></option>
											<?php endforeach; ?>
							          	</select>    
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="tanggal">Stasiun Asal</label>
									<div>
										<select required="" id="stasiun-asal" class="chosen-select" style="width: 100%;" tabindex="3">
											<option value="">Pilih Bandara Asal</option>
											<?php foreach($stasiun as $ba) : ?>
												<option value="<?= $ba['stat_id'] ?>"><?= $ba['stat_nama'] ?></option>
											<?php endforeach; ?>
							          	</select>    
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="tanggal">Stasiun Tujuan</label>
									<div>
										<select required="" id="stasiun-tujuan" class="chosen-select" style="width: 100%;" tabindex="3">
											<option value="">Pilih Bandara Tujuan</option>
											<?php foreach($stasiun as $bt) : ?>
												<option value="<?= $bt['stat_id'] ?>"><?= $bt['stat_nama'] ?></option>
											<?php endforeach; ?>
							          	</select>    
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="tanggal">Jarak (KM) </label>
									<input type="number" id="jarak" class="form-control" name="jarak" required="required">
								</div>
							</div>
						</div> -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="tanggal">Harga</label>
									<input type="text"  id="harga" class="form-control" name="harga" required="required">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="tanggal">Status</label>
									<select required="" id="status" class="form-control" name="status" required="required">
										<option value="">Pilih status</option>
										<option value="Aktif">Aktif</option>
										<option value="Tidak Aktif">Tidak Aktif</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<div class="modal-footer">
						<button type="submit" class="btn btn-default btn-border">Simpan</button>
						<button class="btn btn-default btn-border" data-dismiss="modal">Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
