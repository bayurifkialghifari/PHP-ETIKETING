 $(function() {

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) 
	{
		console.log('The column', iColumn, ' has changed its status to', bVisible)
	}

	var table4 = $('#advanced-usage').DataTable(
	{
		"ajax": 
		{
			"url": "<?= base_url()?>pesawat/data/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": 
		[
			{ "data": "mask_nama" },
			{ "data": "pesa_kode" },
			{ "data": "pesa_nama" },
			{ "data": "pesa_deskripsi" },
			{ "data": "pesa_jumlah_kursi" },
			{ "data": "pesa_status" },
			{
				"data": "pesa_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
								+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.pesa_id+'|'+full.pesa_kode+'|'+full.pesa_nama+'|'+full.pesa_deskripsi+'|'+full.pesa_jumlah_kursi+'|'+full.pesa_status+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
				"url": "<?= base_url()?>pesawat/data/ajax_data/",
				"data": null,
				"type": 'POST'
			},
			"columns": 
			[
				{ "data": "mask_nama" },
				{ "data": "pesa_kode" },
				{ "data": "pesa_nama" },
				{ "data": "pesa_deskripsi" },
				{ "data": "pesa_jumlah_kursi" },
				{ "data": "pesa_status" },
				{
					"data": "pesa_id", render: function(data, type, full, meta)
					{
						return '<div class="pull-right">'
									+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.pesa_id+'|'+full.pesa_kode+'|'+full.pesa_nama+'|'+full.pesa_deskripsi+'|'+full.pesa_jumlah_kursi+'|'+full.pesa_status+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
		$('#myModalLabel').html('Tambah Data Pesawat')
		$('#id').val('')
		$('#maskapai').val('')
		$('#kode').val('')
		$('#nama').val('')
		$('#deskripsi').val('')
		$('#kursi').val('')
		$('#status').val('')
		
	})

	// fungsi simpan 
	$('#form').submit(function(ev) {
		ev.preventDefault()

		let id 			= $('#id').val()
		let maskapai 	= $('#maskapai').val()
		let kode 		= $('#kode').val()
		let nama 		= $('#nama').val()
		let deskripsi 	= $('#deskripsi').val()
		let kursi 		= $('#kursi').val()
		let status 		= $('#status').val()


		let ajax = null
		if(id == 0) {
			ajax = window.apiClient.pesawatData.insert(maskapai, kode, nama, deskripsi, kursi, status)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy()
				$.message('Berhasil ditambahkan.','Pesawat','success')
				dynamic()

			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','Pesawat','error')
			}).
			always(function() {
				$('#splash').modal('toggle')
			})
		}
		else {
			ajax = window.apiClient.pesawatData.update(id, maskapai, kode, nama, deskripsi, kursi, status)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy()
				$.message('Berhasil diubah.','Pesawat','success')
				dynamic()
				
			})
			.fail(function($xhr) {
				$.message('Gagal diubah.','Pesawat','error')
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
		$('#nama').val(res[2])
		$('#deskripsi').val(res[3])
		$('#kursi').val(res[4])
		$('#status').val(res[5])
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
		ajax 	= window.apiClient.pesawatData.delete(id)
				.done(function(data) {
					$("#advanced-usage").dataTable().fnDestroy()
					$.message('Berhasil dihapus.','Pesawat','success')
					dynamic()
					
				})
				.fail(function($xhr) {
					$.message('Gagal dihapus.','Pesawat','error')
				}).
				always(function() {
					$('#myModal3').modal('toggle')
				})
	})

})