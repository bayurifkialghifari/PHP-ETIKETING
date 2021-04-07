 $(function() {

 	value_code()

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) 
	{
		console.log('The column', iColumn, ' has changed its status to', bVisible)
	}

	function value_code()
 	{
		window.apiClient.code.getCodeMaskapai().done(function(res) {
			$("#kode").val(res.id)
		}).fail(function($xhr) {
			console.log($xhr)
		})
	}

	var table4 = $('#advanced-usage').DataTable(
	{
		"ajax": 
		{
			"url": "<?= base_url()?>referensi/maskapai/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": 
		[
			{ "data": "mask_kode" },
			{ "data": "mask_nama" },
			{ "data": "mask_deskripsi" },
			{
				data: "mask_logo", render: function(data, type, full, meta)
				{
					return '<img src="<?= base_url() ?>assets/upload/maskapai/'+data+'" width="20%"></p>'
				}
			},
			{
				"data": "mask_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
								+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.mask_id+'|'+full.mask_kode+'|'+full.mask_nama+'|'+full.mask_deskripsi+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
				"url": "<?= base_url()?>referensi/maskapai/ajax_data/",
				"data": null,
				"type": 'POST'
			},
			"columns": 
			[
				{ "data": "mask_kode" },
				{ "data": "mask_nama" },
				{ "data": "mask_deskripsi" },
				{
					data: "mask_logo", render: function(data, type, full, meta)
					{
						return '<img src="<?= base_url() ?>assets/upload/maskapai/'+data+'" width="20%"></p>'
					}
				},
				{
					"data": "mask_id", render: function(data, type, full, meta)
					{
						return '<div class="pull-right">'
									+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.mask_id+'|'+full.mask_kode+'|'+full.mask_nama+'|'+full.mask_deskripsi+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
		$('#myModalLabel').html('Tambah Data Maskapai')
		$('#id').val('')
		$('#nama').val('')
		$('#keterangan').val('')
		$('#file').val('')
		
	})

	// fungsi simpan 
	$('#form').submit(function(ev) {
		ev.preventDefault()

		let fd 			= new FormData()

		let id 			= $('#id').val()
		let kode 		= $('#kode').val()
		let nama 		= $('#nama').val()
		let keterangan 	= $('#keterangan').val()
		let logo 	= $('#file')[0].files[0]

		fd.append('id', id)
		fd.append('kode', kode)
		fd.append('nama', nama)
		fd.append('keterangan', keterangan)
		fd.append('logo', logo)

		let ajax = null

		if(id == 0) 
		{
			$.ajax({
				url: '<?= base_url() ?>referensi/maskapai/insert',
				type: 'post',
				data: fd,
				dataType: 'json',
				processData: false,
             	contentType: false,
             	cache: false,
             	async: false,
             	success(data)
             	{
             		$.message('Berhasil ditambahkan.','Maskapai','success')
             		$("#advanced-usage").dataTable().fnDestroy()
					dynamic()
					value_code()
             	},
             	error($xhr)
             	{
					$.message('Gagal ditambahkan.','Maskapai','error')
             		console.log($xhr)
             	}
			})
		}
		else 
		{
			$.ajax({
				url: '<?= base_url() ?>referensi/maskapai/update',
				type: 'post',
				data: fd,
				dataType: 'json',
				processData: false,
             	contentType: false,
             	cache: false,
             	async: false,
             	success(data)
             	{
             		$.message('Berhasil diubah.','Maskapai','success')
             		$("#advanced-usage").dataTable().fnDestroy()
					dynamic()
					value_code()
             	},
             	error($xhr)
             	{
					$.message('Gagal diubah.','Maskapai','error')
             		console.log($xhr)
             	}
			})
		}

		$('#splash').modal('toggle')
	})

	
	// fungsi ubah
	$('#advanced-usage tbody').on('click', '.edit-button', function(ev) {
		ev.preventDefault()
		var ids = $(this).val()

		var res = ids.split("|")

		$('#myModalLabel').html('Ubah Data Maskapai')
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
		ajax 	= window.apiClient.referensiMaskapai.delete(id)
					.done(function(data) {
						$("#advanced-usage").dataTable().fnDestroy()
						$.message('Berhasil dihapus.','Maskapai','success')
						dynamic()
						value_code()
						
					})
					.fail(function($xhr) {
						$.message('Gagal dihapus.','Maskapai','error')
					}).
					always(function() {
						$('#myModal3').modal('toggle')
					})
	})

})