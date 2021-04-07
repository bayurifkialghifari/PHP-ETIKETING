 $(function() {

 	value_code()

	$('#harga').autoNumeric('init')

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) 
	{
		console.log('The column', iColumn, ' has changed its status to', bVisible)
	}

	function value_code()
 	{
		window.apiClient.code.getCodePenerbanganRute().done(function(res) {
			$("#kode").val(res.id)
		}).fail(function($xhr) {
			console.log($xhr)
		})
	}

	var table4 = $('#advanced-usage').DataTable(
	{
		"ajax": 
		{
			"url": "<?= base_url()?>penerbangan/rute/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": 
		[
			{ "data": "rute_kode" },
			{ "data": "kota_asal" },
			{ "data": "kota_tujuan" },
			{ "data": "band_asal" },
			{ "data": "band_tujuan" },
			{ "data": "rute_jarak" },
			{
				data: "rute_harga", render: function(data, type, full, meta)
				{
					let nominal = window.apiClient.format.dolar(data, '$')

					return '<p style="text-align:right">'+nominal+'</p>'
				}
			},
			{ "data": "rute_status" },
			{
				"data": "rute_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
								+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.rute_id+'|'+full.rute_kode+'|'+full.kota_asal_id+'|'+full.kota_tujuan_id+'|'+full.band_asal_id+'|'+full.band_tujuan_id+'|'+full.rute_jarak+'|'+full.rute_harga+'|'+full.rute_status+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
								+'<button class="btn btn-sm btn-danger btn-ef btn-ef-5 btn-ef-5b delete-button" value="'+data+'"><i class="fa fa-trash"></i> <span>Hapus</span></button>'
							+'</div>'
				}
			}
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
				"url": "<?= base_url()?>penerbangan/rute/ajax_data/",
				"data": null,
				"type": 'POST'
			},
			"columns": 
			[
				{ "data": "rute_kode" },
				{ "data": "kota_asal" },
				{ "data": "kota_tujuan" },
				{ "data": "band_asal" },
				{ "data": "band_tujuan" },
				{ "data": "rute_jarak" },
				{
					data: "rute_harga", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.dolar(data, '$')

						return '<p style="text-align:right">'+nominal+'</p>'
					}
				},
				{ "data": "rute_status" },
				{
					"data": "rute_id", render: function(data, type, full, meta)
					{
						return '<div class="pull-right">'
									+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.rute_id+'|'+full.rute_kode+'|'+full.kota_asal_id+'|'+full.kota_tujuan_id+'|'+full.band_asal_id+'|'+full.band_tujuan_id+'|'+full.rute_jarak+'|'+full.rute_harga+'|'+full.rute_status+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
									+'<button class="btn btn-sm btn-danger btn-ef btn-ef-5 btn-ef-5b delete-button" value="'+data+'"><i class="fa fa-trash"></i> <span>Hapus</span></button>'
								+'</div>'
					}
				}
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
		$('#myModalLabel').html('Tambah Data Rute')
		$('#id').val('')
		$('#jarak').val('')
		$('#harga').val('')
		$('#status').val('')
	})

	// Hitungan Harga
	$('#jarak').on('change', () =>
	{
		// Api Key
		let apiKey 			= '5c542c9b7e196d7be948'

		let jarak 			= $('#jarak').val()

		let BahanBakar 		= (Number(jarak) / 100) * 2.25 * 9300
		// Rumus sewa pesawat
		// 1. Harga pesawat Airbus A320 : USD 107.000.000
		// 2. Lifespans : 60.000 Cycle
		// 3. Kapasitas : 154
		// ☑️ Biaya sewa pesawat per penumpang = 107.000.000 : 60.000 : 154 = US$ 11,5 = Rp 155.250,- 
		let sewaPesawat 	= 170000
		let asuransi 		= 5000
		// Biaya Maintenance Standart Internasional
		// 2. Suku cadang : US$ 276
		// 3. Inspeksi & Overhaul : US$ 603
		// 4. Perbaikan mesin : US$ 596
		let maintenance 	= 160000
		let biayaCrew		= 15000
		let airportHandling = 85000
		let administrasi 	= 50000
		let pajak 			= (BahanBakar + sewaPesawat + asuransi + maintenance + biayaCrew + airportHandling + administrasi) * (10/100)

		let totalNonPajak 	= (BahanBakar + sewaPesawat + asuransi + maintenance + biayaCrew + airportHandling + administrasi)
		let total 			= Math.ceil(totalNonPajak + pajak)

		$.ajax({
		    type: "GET",
	 	    url: "https://free.currconv.com/api/v7/convert?q=IDR_USD&compact=ultra&apiKey="+apiKey,
	 	   	success: (data) =>
	 	   	{
				let IDR_USD 			= data.IDR_USD
				let USD_total 			= total * Number(IDR_USD)

				let total_dibulatkan 	= Math.ceil(USD_total)

				$('#harga').val(total_dibulatkan)
	 	       }
	 	   })
	})

	// fungsi simpan 
	$('#form').submit(function(ev) {
		ev.preventDefault()

		let id 				= $('#id').val()
		let kode 			= $('#kode').val()
		let kota_asal 		= $('#kota_asal').val()
		let kota_tujuan 	= $('#kota_tujuan').val()
		let bandara_asal 	= $('#bandara_asal').val()
		let bandara_tujuan 	= $('#bandara_tujuan').val()
		let jarak 			= $('#jarak').val()
		let harga 			= $('#harga').val()
		let status 			= $('#status').val()


		let ajax = null
		if(id == 0) {
			ajax = window.apiClient.penerbanganRute.insert(kode, kota_asal, kota_tujuan, bandara_asal, bandara_tujuan, jarak, harga, status)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy()
				$.message('Berhasil ditambahkan.','Rute','success')
				dynamic()

			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','Rute','error')
			}).
			always(function() {
				$('#splash').modal('toggle')
			})
		}
		else {
			ajax = window.apiClient.penerbanganRute.update(id, kode, kota_asal, kota_tujuan, bandara_asal, bandara_tujuan, jarak, harga, status)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy()
				$.message('Berhasil diubah.','Rute','success')
				dynamic()
				
			})
			.fail(function($xhr) {
				$.message('Gagal diubah.','Rute','error')
			}).
			always(function() {
				$('#splash').modal('toggle')
			})
		}
	})

	
	// fungsi ubah
	$('#advanced-usage tbody').on('click', '.edit-button', function(ev) {
		ev.preventDefault()
		var ids = $(this).val()

		var res = ids.split("|")

		$('#myModalLabel').html('Ubah Data Pesawat')
		$('#id').val(res[0])
		$('#kode').val(res[1])
		$('#kota_asal').val(res[2])
		$('#kota_tujuan').val(res[3])
		$('#bandara_asal').val(res[4])
		$('#bandara_tujuan').val(res[5])
		$('#jarak').val(res[6])
		$('#harga').val(res[7])
		$('#status').val(res[8])
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
		ajax 	= window.apiClient.penerbanganRute.delete(id)
				.done(function(data) {
					$("#advanced-usage").dataTable().fnDestroy()
					$.message('Berhasil dihapus.','Rute','success')
					dynamic()
					
				})
				.fail(function($xhr) {
					$.message('Gagal dihapus.','Rute','error')
				}).
				always(function() {
					$('#myModal3').modal('toggle')
				})
	})

})