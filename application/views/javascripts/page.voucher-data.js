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
			"url": "<?= base_url()?>voucher/data/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": 
		[
			{ "data": "vouc_nama" },
			{ "data": "vouc_kode" },
			{ "data": "vouc_persen" },
			{ "data": "vouc_batas" },
			{ "data": "vouc_jumlah" },
			{ "data": "vouc_keterangan" },
			{ "data": "vouc_tanggal_akhir" },
			{
				"data": "vouc_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
								+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.vouc_id+'|'+full.vouc_nama+'|'+full.vouc_kode+'|'+full.vouc_persen+'|'+full.vouc_batas+'|'+full.vouc_jumlah+'|'+full.vouc_keterangan+'|'+full.vouc_tanggal_akhir+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
				"url": "<?= base_url()?>voucher/data/ajax_data/",
				"data": null,
				"type": 'POST'
			},
			"columns": 
			[
				{ "data": "vouc_nama" },
				{ "data": "vouc_kode" },
				{ "data": "vouc_persen" },
				{ "data": "vouc_batas" },
				{ "data": "vouc_jumlah" },
				{ "data": "vouc_keterangan" },
				{ "data": "vouc_tanggal_akhir" },
				{
					"data": "vouc_id", render: function(data, type, full, meta)
					{
						return '<div class="pull-right">'
									+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.vouc_id+'|'+full.vouc_nama+'|'+full.vouc_kode+'|'+full.vouc_persen+'|'+full.vouc_batas+'|'+full.vouc_jumlah+'|'+full.vouc_keterangan+'|'+full.vouc_tanggal_akhir+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
		$('#myModalLabel').html('Tambah Data Voucher')
		$('#id').val('')
		$('#nama').val('')
		$('#kode').val('')
		$('#persen').val('')
		$('#batas').val('')
		$('#jumlah').val('')
		$('#keterangan').val('')
		$('#tanggal_akhir').val('')
		
	})

	// fungsi simpan 
	$('#form').submit(function(ev) {
		ev.preventDefault()

		let id 				= $('#id').val()
		let nama 			= $('#nama').val()
		let kode 			= $('#kode').val()
		let persen 			= $('#persen').val()
		let batas 			= $('#batas').val()
		let jumlah 			= $('#jumlah').val()
		let keterangan 		= $('#keterangan').val()
		let tanggal_akhir 	= $('#tanggal_akhir').val()

		let ajax = null
		if(id == 0) {
			ajax = window.apiClient.voucherData.insert(nama, kode, persen, batas, jumlah, keterangan, tanggal_akhir)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy()
				$.message('Berhasil ditambahkan.','Voucher','success')
				dynamic()

			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','Voucher','error')
			}).
			always(function() {
				$('#splash').modal('toggle')
			})
		}
		else {
			ajax = window.apiClient.voucherData.update(id, nama, kode, persen, batas, jumlah, keterangan, tanggal_akhir)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy()
				$.message('Berhasil diubah.','Voucher','success')
				dynamic()
				
			})
			.fail(function($xhr) {
				$.message('Gagal diubah.','Voucher','error')
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

		$('#myModalLabel').html('Ubah Data Voucher')
		$('#id').val(res[0])
		$('#nama').val(res[1])
		$('#kode').val(res[2])
		$('#persen').val(res[3])
		$('#batas').val(res[4])
		$('#jumlah').val(res[5])
		$('#keterangan').val(res[6])
		$('#tanggal_akhir').val(res[7])
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
		ajax 	= window.apiClient.voucherData.delete(id)
				.done(function(data) {
					$("#advanced-usage").dataTable().fnDestroy()
					$.message('Berhasil dihapus.','Voucher','success')
					dynamic()
					
				})
				.fail(function($xhr) {
					$.message('Gagal dihapus.','Voucher','error')
				}).
				always(function() {
					$('#myModal3').modal('toggle')
				})
	})

})