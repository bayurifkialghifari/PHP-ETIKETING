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
						<a href="#">Perjalanan</a>
					</li>
					<li>
						<a href="<?=base_url()?>kereta/generate">Generate</a>
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
						<h1 class="custom-font"><strong><?=$title?></strong></h1>
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
								<button style="float: right;" id="add" class="btn btn-ef btn-ef-5 btn-ef-5b btn-success mb-10" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14"><i class="fa fa-plus"></i> <span>Generate Tiket</span></button>
							</div>
						</div>
						<br>
						<table class="table table-custom" id="advanced-usage">
							<thead>
							<tr>
								<th>ID Tiket</th>
								<th>Kode</th>
								<th>Nama Kereta</th>
								<th>Kelas</th>
								<th>Kota Asal</th>
								<th>Kota Tujuan</th>
								<th>Stasiun Asal</th>
								<th>Stasiun Tujuan</th>
								<th>Tanggal Berankat</th>
								<th>Jam Berangkat</th>
								<th>Jam Sampai</th>
								<th>Total Harga</th>
								<th>Jumlah Kursi</th>
								<th>Status</th>
								<!-- <th style="text-align: right;">Pilihan &nbsp;&nbsp;</th> -->
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
						<input type="hidden" id="jadwal" name="jadwal" value="0">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="tanggal">Tanggal Berangkat</label>
				                  	<input id="berangkat" class="form-control">
			                  	</div>
			              	</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="tanggal">Kereta</label>
									<div>
										<select id="kereta" class="chosen-select" style="width: 100%;" tabindex="3">
											<option value="">Pilih Kereta</option>
											<?php foreach($kereta as $kereta) : ?>
												<option value="<?= $kereta['keret_id'] ?>"><?= $kereta['keret_kode'] ?> - ( <?= $kereta['keret_nama'] ?> )</option>
											<?php endforeach; ?>
							          	</select>    
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="tanggal">Tipe Perjalanan</label>
									<select id="tipe-perjalanan" class="form-control" name="tipe-perjalanan">
										<option value="">Pilih Tipe Perjalanan</option>
										<option value="SJ">Sekali Jalan</option>
										<option value="PP">Pulang Pergi</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="text-center">
								<button type="button" id="cariJadwal" class="btn btn-ef btn-ef-5 btn-ef-5b btn-success mb-10"><i class="fa fa-plus"></i> <span>Cari Jadwal</span></button>
							</div>
						</div>
					</div>
					<hr>
					<div id="hasil">
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group p-10">
								<label for="tanggal">Kelas</label>
								<div>
									<select id="kelas" class="chosen-select" style="width: 100%;" tabindex="3" required="">
										<option value="">Pilih Kelas</option>
										<?php foreach($kelas as $kelas) : ?>
											<option value="<?= $kelas['kela_id'] ?>"><?= $kelas['kela_nama'] ?></option>
										<?php endforeach; ?>
						          	</select>    
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group p-10">
								<label for="tanggal">Jumlah Penumpang</label>
								<input type="number" class="form-control" id="jumlah_penumpang" readonly="" required="" name="jumlah_penumpang">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group p-10">
								<label for="tanggal">Total Harga (USD)</label>
								<input type="text" class="form-control" id="total_harga_usd" readonly="" required="" name="total_harga_usd">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group p-10">
								<label for="tanggal">Total Harga (IDR)</label>
								<input type="text" class="form-control" id="total_harga_idr" readonly="" required="" name="total_harga_idr">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group p-10">
								<label for="tanggal">Keterangan</label>
								<textarea class="form-control" id="keterangan" required="" name="keterangan"></textarea>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-default btn-border">Generate</button>
						<button class="btn btn-default btn-border" data-dismiss="modal">Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
