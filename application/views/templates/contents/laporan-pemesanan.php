<section id="content">

	<div class="page page-tables-datatables">

		<div class="pageheader">

			<div class="page-bar">

				<ul class="page-breadcrumb">
					<li>
						<a href="<?=base_url()?>"><i class="fa fa-home"></i> Dashboard</a>
					</li>
					<li>
						<a href="#">Laporan</a>
					</li>
					<li>
						<a href="<?=base_url()?>laporan/pemesanan">Pemesanan</a>
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
								<!-- <button style="float: right;" id="add" class="btn btn-ef btn-ef-5 btn-ef-5b btn-success mb-10" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14"><i class="fa fa-plus"></i> <span>Tambah</span></button> -->
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-12 text-right">
								<a class="btn btn-success btn-sm" href="<?= base_url() ?>laporan/pemesanan/exportExcel" target="_blank"><i class="fa fa-file"></i> Export Excel</a>
								<a class="btn btn-danger btn-sm" href="<?= base_url() ?>laporan/pemesanan/exportPDF" target="_blank"><i class="fa fa-file"></i> Export PDF</a>
							</div>
						</div>
						<br>
						<table class="table table-custom" id="advanced-usage">
							<thead id="thead">
							<tr>
								<th>Kode</th>
								<th>Pemesan</th>
								<th>Penumpang</th>
								<th>Status Pemesanan</th>
								<th>Tipe Tiket</th>
								<th>Tanggal Pemesanan</th>
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
