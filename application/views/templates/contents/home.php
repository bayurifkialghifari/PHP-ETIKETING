<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

	<div class="page page-dashboard">

		<div class="pageheader">

			<!-- <h2>Dashboard <span></span></h2> -->

			<div class="page-bar">

				<ul class="page-breadcrumb">
					<li>
						<a href="#"><i class="fa fa-home"></i> Dashboard</a>
					</li>
				</ul>

				<div class="page-toolbar">

				</div>

			</div>

		</div>

		<!-- Atas -->
		<div class="row">
			<div class="col-md-12">
				<!-- cards row -->
				<div class="row">

					<!-- col -->
					<div class="card-container col-lg-4 col-sm-6 col-sm-12">
                    	<div class="card" >
							
                            <!-- tile -->
                            <section class="tile tile-simple tbox">

                                <!-- tile widget -->
                                <div class="tile-widget bg-blue text-center p-30 tcol">
                                <a class="myIcon icon-drank icon-ef-8 icon-color"><i class="fa fa-plane"></i></a>
                                </div>
                                <!-- /tile widget -->

                                <!-- tile body -->
                                <div class="tile-body text-center tcol">
                                    <br>
									<p style="center">
									<h4 class="m-0"><?=number_format($tiket_pesawat)?></h4>
                                    <span class="text-muted">Tiket Penerbangan</span>
									</p>

                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->
						</div>
					</div>
					<!-- /col -->

					<!-- col -->
					<div class="card-container col-lg-4 col-sm-6 col-sm-12">
						<div class="card">
							
                            <!-- tile -->
                            <section class="tile tile-simple tbox">

                                <!-- tile widget -->
                                <div class="tile-widget bg-warning text-center p-30 tcol">
                                <a class="myIcon icon-drank icon-ef-8 icon-color"><i class="fa fa-train"></i></a>
                                </div>
                                <!-- /tile widget -->

                                <!-- tile body -->
                                <div class="tile-body text-center tcol">
                                    <br>
									<p style="center">
									<h4 class="m-0"><?=number_format($tiket_kereta)?></h4>
                                    <span class="text-muted">Tiket Perjalanan Kereta</span>
									</p>

                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->
						</div>
					</div>
					<!-- /col -->

					<!-- col -->
					<div class="card-container col-lg-4 col-sm-6 col-sm-12">
						<div class="card">
							
                        <!-- tile -->
                        <section class="tile tile-simple tbox">

                            <!-- tile widget -->
                            <div class="tile-widget bg-success text-center p-30 tcol">
                            <a class="myIcon icon-drank icon-ef-8 icon-color"><i class="fa fa-users"></i></a>
                            </div>
                            <!-- /tile widget -->

                            <!-- tile body -->
                            <div class="tile-body text-center tcol">
                                <br>
								<p style="center">
								<h4 class="m-0"><?=number_format($customer)?></h4>
                                <span class="text-muted">Customer</span>
								</p>

                            </div>
                            <!-- /tile body -->

                        </section>
                        <!-- /tile -->
						</div>
					</div>
					<!-- /col -->
				</div>
				<!-- /row -->

				<!-- cards row -->
				<div class="row">

					<!-- col -->
					<div class="card-container col-lg-4 col-sm-6 col-sm-12">
						<div class="card">
							
                            <!-- tile -->
                            <section class="tile tile-simple tbox">

                                <!-- tile widget -->
                                <div class="tile-widget bg-success text-center p-30 tcol">
                                <a class="myIcon icon-drank icon-ef-8 icon-color"><i class="fa fa-users"></i></a>
                                </div>
                                <!-- /tile widget -->

                                <!-- tile body -->
                                <div class="tile-body text-center tcol"><br>
									<p style="center">
                                    <h4 class="m-0"><?=number_format($pemesanan)?></h4>
                                    <span class="text-muted">Pemesanan</span>
									</p>
                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->
						</div>
					</div>
					<!-- /col -->

					<div class="card-container col-lg-4 col-sm-6 col-sm-12">
						<div class="card">
                        <!-- tile -->
							<section class="tile tile-simple tbox">
								<!-- tile widget -->
								<div class="tile-widget bg-blue text-center p-30 tcol">
									<a class="myIcon icon-drank icon-ef-8 icon-color"><i class="fa fa-money"></i></a>
								</div>
								<!-- /tile widget -->
								<!-- tile body -->
								<div class="tile-body text-center tcol">
									<br>
									<p style="center">
									<h4 class="m-0"><?=dolar($pembayaran_paypal)?></h4>
									<span class="text-muted">Pembayaran PayPal</span>
									</p>
								</div>
								<!-- /tile body -->
							</section>
                        <!-- /tile -->
						</div>
					</div>

					<!-- col -->
					<div class="card-container col-lg-4 col-sm-6 col-sm-12">
						<div class="card">
							
                        <!-- tile -->
							<section class="tile tile-simple tbox">
								<!-- tile widget -->
								<div class="tile-widget bg-info text-center p-30 tcol">
									<a class="myIcon icon-drank icon-ef-8 icon-color"><i class="fa fa-money"></i></a>
								</div>
								<!-- /tile widget -->
								<!-- tile body -->
								<div class="tile-body text-center tcol">
									<br>
									<p style="center">
										<h4 class="m-0"><?=number_format($manual)?></h4>
										<span class="text-muted">Pembayaran Manual</span>
									</p>
								</div>
								<!-- /tile body -->
							</section>
                        <!-- /tile -->
						</div>
					</div>
					<!-- /col -->
				</div>
				<!-- /row -->
			</div>
		</div>
		<!-- Atas -->

		<!-- Tengah -->
		<section class="tile">
			<div class="tile-header bg-greensea dvd dvd-btm">
                <h1 class="custom-font"><strong>Statistik Pembelian Tiket</strong></h1>
            </div>

            <div class="tile-widget bg-greensea">
                <div id="statistics-chart" style="height: 250px;"></div>
            </div>

		</section>
		<!-- Tengah -->




	</div>


</section>
<!--/ CONTENT -->

<script type="text/javascript">
	var data = [{
        data: [
        	
        		<?php $no = 1; foreach($statistik_kereta as $kereta) : ?>
	        		[<?= $no ++ ?>,1],
	        	<?php endforeach; ?>
        	  
        	  ],
        label: 'Tiket Kereta',
        points: {
            show: true,
            radius: 4
        },
        splines: {
            show: true,
            tension: 0.45,
            lineWidth: 4,
            fill: 0
        }
    }, {
        data: [

        		<?php $no2 =1; foreach($statistik_pesawat as $pesawat) : ?>
	        		[<?= $no2++ ?>,1],
	        	<?php endforeach; ?>

        	  ],
        label: 'Tiket Pesawat',
        bars: {
            show: true,
            barWidth: 0.6,
            lineWidth: 0,
            fillColor: { colors: [{ opacity: 0.3 }, { opacity: 0.8}] }
        }
    }];
</script>
