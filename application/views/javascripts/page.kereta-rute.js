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
		window.apiClient.code.getCodeKeretaRute().done(function(res) {
			$("#kode").val(res.id)
		}).fail(function($xhr) {
			console.log($xhr)
		})
	}

	var table4 = $('#advanced-usage').DataTable(
	{
		"ajax": 
		{
			"url": "<?= base_url()?>kereta/rute/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": 
		[
			{ "data": "rute_kode" },
			{ "data": "kota_asal" },
			{ "data": "kota_tujuan" },
			{ "data": "stat_asal" },
			{ "data": "stat_tujuan" },
			{
				data: "rute_harga", render: function(data, type, full, meta)
				{
					let nominal = window.apiClient.format.rupiah(data, 'Rp')

					return '<p style="text-align:right">'+nominal+'</p>'
				}
			},
			{ "data": "rute_status" },
			{
				"data": "rute_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
								+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.rute_id+'|'+full.rute_kode+'|'+full.kota_asal_id+'|'+full.kota_tujuan_id+'|'+full.stat_asal_id+'|'+full.stat_tujuan_id+'|'+full.rute_jarak+'|'+full.rute_harga+'|'+full.rute_status+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
				"url": "<?= base_url()?>kereta/rute/ajax_data/",
				"data": null,
				"type": 'POST'
			},
			"columns": 
			[
				{ "data": "rute_kode" },
				{ "data": "kota_asal" },
				{ "data": "kota_tujuan" },
				{ "data": "stat_asal" },
				{ "data": "stat_tujuan" },
				{
					data: "rute_harga", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, 'Rp. ')

						return '<p style="text-align:right">'+nominal+'</p>'
					}
				},
				{ "data": "rute_status" },
				{
					"data": "rute_id", render: function(data, type, full, meta)
					{
						return '<div class="pull-right">'
									+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.rute_id+'|'+full.rute_kode+'|'+full.kota_asal_id+'|'+full.kota_tujuan_id+'|'+full.stat_asal_id+'|'+full.stat_tujuan_id+'|'+full.rute_jarak+'|'+full.rute_harga+'|'+full.rute_status+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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

	// fungsi simpan 
	$('#form').submit(function(ev) {
		ev.preventDefault()

		let id 				= $('#id').val()
		let kode 			= $('#kode').val()
		let kota_asal 		= $('#kota-asal').val()
		let kota_tujuan 	= $('#kota-tujuan').val()
		let stasiun_asal 	= $('#stasiun-asal').val()
		let stasiun_tujuan 	= $('#stasiun-tujuan').val()
		let harga 			= window.apiClient.format.splitString($('#harga').val(), '.')
		let harga_dolar 	= Math.ceil(Number(harga) / 14000)
		let status 			= $('#status').val()


		let ajax = null
		if(id == 0) {
			ajax = window.apiClient.keretaRute.insert(kode, kota_asal, kota_tujuan, stasiun_asal, stasiun_tujuan, harga, harga_dolar, status)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy()
				$.message('Berhasil ditambahkan.','Rute','success')
				dynamic()
				value_code()

			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','Rute','error')
			}).
			always(function() {
				$('#splash').modal('toggle')
			})
		}
		else {
			ajax = window.apiClient.keretaRute.update(id, kode, kota_asal, kota_tujuan, stasiun_asal, stasiun_tujuan, harga, harga_dolar, status)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy()
				$.message('Berhasil diubah.','Rute','success')
				dynamic()
				value_code()
				
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
		$('#stasiun-asal').val(res[4])
		$('#stasiun-tujuan').val(res[5])
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
		ajax 	= window.apiClient.keretaRute.delete(id)
				.done(function(data) {
					$("#advanced-usage").dataTable().fnDestroy()
					$.message('Berhasil dihapus.','Rute','success')
					dynamic()
					value_code()
					
				})
				.fail(function($xhr) {
					$.message('Gagal dihapus.','Rute','error')
				}).
				always(function() {
					$('#myModal3').modal('toggle')
				})
	})

})