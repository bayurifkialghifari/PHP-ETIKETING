<link rel="stylesheet" href="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/chosen/chosen.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
<section id="content">

	<div class="page page-tables-datatables">

		<div class="pageheader">

			<div class="page-bar">

				<ul class="page-breadcrumb">
					<li>
						<a href="<?=base_url()?>"><i class="fa fa-home"></i> Dashboard</a>
					</li>
					<li>
						<a href="#">Pesawat</a>
					</li>
					<li>
						<a href="<?=base_url()?>pesawat/data">Data</a>
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
								<th>Maskapai</th>
								<th>Pesawat</th>
								<th>Rute</th>
								<th>Tanggal Berangkat</th>
								<th>Tanggal Berangkat Sampai</th>
								<th>Jam Berangkat</th>
								<th>Jam Berangkat Sampai</th>
								<th>Tanggal Pulang</th>
								<th>Tanggal Pulang Sampai</th>
								<th>Jam Pulang</th>
								<th>Jam Pulang Sampai</th>
								<th>Tipe Penerbangan</th>
								<th>Keterangan</th>
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
									<input type="text" id="kode" readonly="readonly" class="form-control" name="kode" required="required"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="tanggal">Pesawat</label>
									<div>
										<select id="pesawat" class="chosen-select" style="width: 100%;" tabindex="3" required="">
											<option value="">Pilih Pesawat</option>
											<?php foreach($pesawat as $pesawat) : ?>
												<option value="<?= $pesawat['pesa_id'] ?>"><?= $pesawat['mask_nama'] ?> - <?= $pesawat['pesa_nama'] ?></option>
											<?php endforeach; ?>
							          	</select>    
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="tanggal">Rute</label>
									<div>
										<select id="rute" class="chosen-select" style="width: 100%;" tabindex="3" required="">
											<option value="">Pilih Rute</option>
											<?php foreach($rute as $rute) : ?>
												<option value="<?= $rute['rute_kode'] ?>"><?= $rute['band_asal'] ?> ( <?= $rute['kota_asal'] ?> )  -  <?= $rute['band_tujuan'] ?> ( <?= $rute['kota_tujuan'] ?> ) </option>
											<?php endforeach; ?>
							          	</select>    
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="tanggal">Tipe Penerbangan</label>
									<select id="tipe-penerbangan" class="form-control" name="status" required="required">
										<option value="">Pilih Tipe Penerbangan</option>
										<option value="SJ">Sekali Jalan</option>
										<option value="PP">Pulang Pergi</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="tanggal">Tanggal Berangkat</label>
				                  	<input id="berangkat" class="form-control" required="">
			                  	</div>
			              	</div>
			              	<div class="col-md-6">
								<div class="form-group">
									<label for="tanggal">Tanggal Berangkat Sampai</label>
				                  	<input id="berangkat-sampai" class="form-control" required="">
			                  	</div>
			              	</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="tanggal">Jam Berangkat</label>
				                  	<input id="jam-berangkat" type="time" class="form-control" required="">
			                  	</div>
			              	</div>
			              	<div class="col-md-6">
								<div class="form-group">
									<label for="tanggal">Jam Berangkat Sampai</label>
				                  	<input id="jam-berangkat-sampai" type="time" class="form-control" required="">
			                  	</div>
			              	</div>
						</div>
						<hr border="1">
						<div id="pp" style="display: none;">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="tanggal">Tanggal Pulang</label>
					                  	<input id="pulang" class="form-control">
				                  	</div>
				              	</div>
				              	<div class="col-md-6">
									<div class="form-group">
										<label for="tanggal">Tanggal Pulang Sampai</label>
					                  	<input id="pulang-sampai" class="form-control">
				                  	</div>
				              	</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="tanggal">Jam Pulang</label>
					                  	<input id="jam-pulang" type="time"  class="form-control">
				                  	</div>
				              	</div>
				              	<div class="col-md-6">
									<div class="form-group">
										<label for="tanggal">Jam Pulang Sampai</label>
					                  	<input id="jam-pulang-sampai" type="time" class="form-control">
				                  	</div>
				              	</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="tanggal">Keterangan</label>
									<textarea required="" class="form-control" id="keterangan"></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="tanggal">Status</label>
									<select id="status" class="form-control" name="status" required="required">
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
