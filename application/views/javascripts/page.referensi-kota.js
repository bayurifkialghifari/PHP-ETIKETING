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
			"url": "<?= base_url()?>referensi/kota/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": 
		[
			{ "data": "kota_kode" },
			{ "data": "kota_nama" },
			{ "data": "kota_keterangan" },
			{
				"data": "kota_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
								+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.kota_id+'|'+full.kota_kode+'|'+full.kota_nama+'|'+full.kota_keterangan+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
				"url": "<?= base_url()?>referensi/kota/ajax_data/",
				"data": null,
				"type": 'POST'
			},
			"columns": 
			[
				{ "data": "kota_kode" },
				{ "data": "kota_nama" },
				{ "data": "kota_keterangan" },
				{
					"data": "kota_id", render: function(data, type, full, meta)
					{
						return '<div class="pull-right">'
									+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.kota_id+'|'+full.kota_kode+'|'+full.kota_nama+'|'+full.kota_keterangan+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
		$('#myModalLabel').html('Tambah Data Kota')
		$('#id').val('')
		$('#kode').val('')
		$('#nama').val('')
		$('#keterangan').val('')
		
	})

	// fungsi simpan 
	$('#form').submit(function(ev) {
		ev.preventDefault()

		let id 			= $('#id').val()
		let kode 		= $('#kode').val()
		let nama 		= $('#nama').val()
		let keterangan 	= $('#keterangan').val()

		let ajax = null

		if(id == 0) {
			ajax = window.apiClient.referensiKota.insert(kode, nama, keterangan)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy()
				$.message('Berhasil ditambahkan.','Kota','success')
				dynamic()

			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','Kota','error')
			}).
			always(function() {
				$('#splash').modal('toggle')
			})
		}
		else {
			ajax = window.apiClient.referensiKota.update(id, kode, nama, keterangan)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy()
				$.message('Berhasil diubah.','Kota','success')
				dynamic()
				
			})
			.fail(function($xhr) {
				$.message('Gagal diubah.','Kota','error')
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

		$('#myModalLabel').html('Ubah Data Kota')
		$('#id').val(res[0])
		$('#kode').val(res[1])
		$('#nama').val(res[2])
		$('#keterangan').val(res[3])
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
		ajax 	= window.apiClient.referensiKota.delete(id)
				.done(function(data) {
					$("#advanced-usage").dataTable().fnDestroy()
					$.message('Berhasil dihapus.','Kota','success')
					dynamic()
					
				})
				.fail(function($xhr) {
					$.message('Gagal dihapus.','Kota','error')
				}).
				always(function() {
					$('#myModal3').modal('toggle')
				})
	})

})