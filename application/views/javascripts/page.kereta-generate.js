 $(function() {

 	$('#total_harga_usd').autoNumeric('init')
 	$('#total_harga_idr').autoNumeric('init')

 	//initializing datepicker
	$('#berangkat').datepicker({
		changeYear: true,
    	changeMonth: true,
      	minDate:0,
    	dateFormat: "yy-m-dd",
    	yearRange: "-100:+20", 
    })

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) 
	{
		console.log('The column', iColumn, ' has changed its status to', bVisible)
	}

	var table4 = $('#advanced-usage').DataTable(
	{
		"ajax": 
		{
			"url": "<?= base_url()?>kereta/generate/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": 
		[
			{ "data": "tikk_id" },
			{ "data": "tikk_jadk_kode" },
			{ "data": "keret_nama" },
			{ "data": "kela_nama" },
			{ "data": "kota_asal" },
			{ "data": "kota_tujuan" },
			{ "data": "stat_asal" },
			{ "data": "stat_tujuan" },
			{ "data": "jadk_tanggal_berangkat" },
			{ "data": "jadk_jam_berangkat" },
			{ "data": "jadk_jam_berangkat_sampai" },
			{
				data: "tikd_harga_idr", render: function(data, type, full, meta)
				{
					let nominal = window.apiClient.format.rupiah(data, 'Rp ')

					return '<p style="text-align:right">'+nominal+'</p>'
				}
			},
			{ "data": "keret_penumpang" },
			{ "data": "tikk_status" },
		],
		"aoColumnDefs": 
		[
		  	{ 'bSortable': false, 'aTargets': [ "no-sort" ] }
		]
	})


	var colvis = new $.fn.dataTable.ColVis(table4)

	$(colvis.button()).insertAfter('#colVis')
	$(colvis.button()).find('button').addClass('btn btn-default').removeClass('ColVis_Button')

	var tt = new $.fn.dataTable.TableTools(table4, 
	{
		sRowSelect: 'single',
		"aButtons": [
			'copy',
			'print'
		],
		"sSwfPath": "<?php echo base_url()?>assets/admin/non-angular/assets/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
	})

	$(tt.fnContainer()).insertAfter('#tableTools')
	//*initialize responsive datatable

	function dynamic()
	{
		//initialize responsive datatable
	
		var table4 = $('#advanced-usage').DataTable(
		{
			"ajax": 
			{
				"url": "<?= base_url()?>kereta/generate/ajax_data/",
				"data": null,
				"type": 'POST'
			},
			"columns": 
			[
				{ "data": "tikk_id" },
				{ "data": "tikk_jadk_kode" },
				{ "data": "keret_nama" },
				{ "data": "kela_nama" },
				{ "data": "kota_asal" },
				{ "data": "kota_tujuan" },
				{ "data": "stat_asal" },
				{ "data": "stat_tujuan" },
				{ "data": "jadk_tanggal_berangkat" },
				{ "data": "jadk_jam_berangkat" },
				{ "data": "jadk_jam_berangkat_sampai" },
				{
					data: "tikd_harga_idr", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, 'Rp ')

						return '<p style="text-align:right">'+nominal+'</p>'
					}
				},
				{ "data": "keret_penumpang" },
				{ "data": "tikk_status" },
			],
			"aoColumnDefs": 
			[
			  	{ 'bSortable': false, 'aTargets': [ "no-sort" ] }
			]
		})


		var colvis = new $.fn.dataTable.ColVis(table4)

		$(colvis.button()).insertAfter('#colVis')
		$(colvis.button()).find('button').addClass('btn btn-default').removeClass('ColVis_Button')

		var tt = new $.fn.dataTable.TableTools(table4, 
		{
			sRowSelect: 'single',
			"aButtons": [
				'copy',
				'print'
			],
			"sSwfPath": "<?php echo base_url()?>assets/admin/non-angular/assets/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
		})

		$(tt.fnContainer()).insertAfter('#tableTools')
	}

	$('#add').on('click', () =>
	{
		$('#myModalLabel').html('Generate Tiket Kereta')
		$('#id').val('')
		$('#berangkat').val('')
		$('#kereta').val('')
		$('#tipe-perjalanan').val('')
		
	})










	// Cari Jadwal
	$('#cariJadwal').on('click', () =>
	{
		let berangkat 			= $('#berangkat').val()
		let kereta 				= $('#kereta').val()
		let tipePerjalanan 		= $('#tipe-perjalanan').val()

		let cari 				= window.apiClient.keretaGenerate.searchJadwal(berangkat, kereta, tipePerjalanan)
		.done(function(data) {
			if(data.length > 0)
			{
				$.message('Jadwal Ditemukan.','Jadwal','success')


				$('#jadwal').val(data[0].jadk_kode)
				$('#jumlah_penumpang').val(data[0].keret_penumpang)
				$('#total_harga_usd').val(data[0].rute_harga_dolar)
				$('#total_harga_idr').val(data[0].rute_harga)

				let html = '<div class="row">'
								+'<div class="col-md-12">'
									+'<div class="form-group p-10">'
										+'<label for="tanggal">Pesawat</label>'
					                  	+'<input id="keretaBenar" readonly class="form-control" value="'+data[0].keret_nama+'">'
				                  	+'</div>'
				              	+'</div>'
			              	+'</div>'
							+'<div class="row">'
								+'<div class="col-md-6">'
									+'<div class="form-group p-10">'
										+'<label for="tanggal">Asal</label>'
					                  	+'<input id="asal" readonly class="form-control" type="hidden" value="'+data[0].kota_asal_id+'">'
					                  	+'<input readonly class="form-control" value="'+data[0].kota_asal+'">'
				                  	+'</div>'
				              	+'</div>'
				              	+'<div class="col-md-6">'
									+'<div class="form-group p-10">'
										+'<label for="tanggal">Tujuan</label>'
					                  	+'<input id="tujuan" readonly class="form-control" type="hidden" value="'+data[0].kota_tujuan_id+'">'
					                  	+'<input readonly class="form-control" value="'+data[0].kota_tujuan+'">'
				                  	+'</div>'
				              	+'</div>'
							+'</div>'
							+'<div class="row">'
								+'<div class="col-md-12">'
									+'<div class="form-group p-10">'
										+'<label for="tanggal">Berangkat</label>'
					                  	+'<input id="asal" readonly class="form-control" value="'+data[0].jadk_tanggal_berangkat+'">'
				                  	+'</div>'
				              	+'</div>'
							+'</div>'

				$('#hasil').html(html)
			}
			else
			{
				$.message('Jadwal Tidak Ditemukan.','Jadwal','error')

				$('#jadwal').val('')
				$('#jumlah_penumpang').val('')
				$('#hasil').html('')
			}
		})
		.fail(function($xhr) {
			console.log($xhr)
		})
	})










	// Kelas Harga
	$('#kelas').on('change', () =>
	{
		let kelas 	= $('#kelas').val()

		let harga 	= window.apiClient.keretaGenerate.getKelasHarga(kelas)
		.done(function(data) {
			// Harga Tiket
				let total 	= data.kela_harga
				let usd 	= $('#total_harga_usd').val()

				let total_harga 	= Number(total) + Number(usd)

				$('#total_harga_usd').val(total_harga)

				$.ajax({
			     	type: "GET",
			       	url: "http://apilayer.net/api/live?access_key=d209a6891820db9d68aee45d858bc01a&currencies=IDR&source=USD&format=1",
			    	success: (data) => 
			    	{
			    		let USD 				= total_harga
						let USD_IDR 			= Number(data.quotes.USDIDR)
						let IDR_TOTAL 			= Number(USD) * Number(USD_IDR)

						let total_dibulatkan 	= Math.ceil(IDR_TOTAL)

						$('#total_harga_idr').val(total_dibulatkan)
			        }
			    })
		    // End Total Harga
		})
		.fail(function($xhr) {
			console.log($xhr)
		})
	})









	// fungsi simpan 
	$('#form').submit(function(ev) {
		ev.preventDefault()

		let id 						= $('#id').val()
		let jadwal 					= $('#jadwal').val()
		let kelas 					= $('#kelas').val()
		let jumlah_penumpang 		= $('#jumlah_penumpang').val()
		let keterangan 				= $('#keterangan').val()
		let total_harga_usd 		= $('#total_harga_usd').val()
		let total_harga_idr 		= $('#total_harga_idr').val()

		total_harga_usd 			= window.apiClient.format.splitString(total_harga_usd, '.')
		total_harga_idr 			= window.apiClient.format.splitString(total_harga_idr, '.')

		let ajax = null
		if(id == 0) {
			$.message('Tunggu sebentar sedang proses generate.','Tiket','warning')

			ajax = window.apiClient.keretaGenerate.insert(jadwal, kelas, jumlah_penumpang, keterangan, total_harga_usd, total_harga_idr)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy()
				$.message('Berhasil digenerate.','Tiket','success')
				$('#splash').modal('toggle')
				dynamic()

			})
			.fail(function($xhr) {
				$("#advanced-usage").dataTable().fnDestroy()
				$.message('Berhasil digenerate.','Tiket','success')
				$('#splash').modal('toggle')
				dynamic()

			}).
			always(function() {
				$('#splash').modal('toggle')
			})
		}
	})


	// fungsi hapus
	$('#advanced-usage tbody').on('click', '.delete-button', function(ev) {
		var ids = $(this).val()
		$("#idHapus").val(ids)
		$("#labelHapus").text('Form Hapus')
		$("#contentHapus").text('Apakah anda yakin akan menghapus data ini?')
		$('#myModal3').modal('toggle')
	})

	// fungsi hapus jika ya
	$('#clickHapus').click(function() {
		let id 	= $("#idHapus").val()
		ajax 	= window.apiClient.referensiKelas.delete(id)
				.done(function(data) {
					$("#advanced-usage").dataTable().fnDestroy()
					$.message('Berhasil dihapus.','Tiket','success')
					dynamic()
					
				})
				.fail(function($xhr) {
					$.message('Gagal dihapus.','Tiket','error')
				}).
				always(function() {
					$('#myModal3').modal('toggle')
				})
	})

})