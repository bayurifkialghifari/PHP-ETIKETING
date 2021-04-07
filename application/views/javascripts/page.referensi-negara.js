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
			"url": "<?= base_url()?>referensi/negara/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": 
		[
			{ "data": "nega_nama" },
			{ "data": "nega_keterangan" },
			{
				data: "nega_bendera", render: function(data, type, full, meta)
				{
					return '<img src="<?= base_url() ?>assets/upload/bendera/'+data+'" width="10%"></p>'
				}
			},
			{
				"data": "nega_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
								+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.nega_id+'|'+full.nega_nama+'|'+full.nega_keterangan+'|'+full.nega_bendera+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
				"url": "<?= base_url()?>referensi/negara/ajax_data/",
				"data": null,
				"type": 'POST'
			},
			"columns": 
			[
				{ "data": "nega_nama" },
				{ "data": "nega_keterangan" },
				{
					data: "nega_bendera", render: function(data, type, full, meta)
					{
						return '<img src="<?= base_url() ?>assets/upload/bendera/'+data+'" width="10%"></p>'
					}
				},
				{
					"data": "nega_id", render: function(data, type, full, meta)
					{
						return '<div class="pull-right">'
									+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.nega_id+'|'+full.nega_nama+'|'+full.nega_keterangan+'|'+full.nega_bendera+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
		$('#myModalLabel').html('Tambah Data Negara')
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
		let nama 		= $('#nama').val()
		let keterangan 	= $('#keterangan').val()
		let bendera 	= $('#file')[0].files[0]

		fd.append('id', id)
		fd.append('nama', nama)
		fd.append('keterangan', keterangan)
		fd.append('bendera', bendera)

		let ajax = null

		if(id == 0) 
		{
			$.ajax({
				url: '<?= base_url() ?>referensi/negara/insert',
				type: 'post',
				data: fd,
				dataType: 'json',
				processData: false,
             	contentType: false,
             	cache: false,
             	async: false,
             	success(data)
             	{
             		$.message('Berhasil ditambahkan.','Negara','success')
             		$("#advanced-usage").dataTable().fnDestroy()
					dynamic()
             	},
             	error($xhr)
             	{
					$.message('Gagal ditambahkan.','Negara','error')
             		console.log($xhr)
             	}
			})
		}
		else 
		{
			$.ajax({
				url: '<?= base_url() ?>referensi/negara/update',
				type: 'post',
				data: fd,
				dataType: 'json',
				processData: false,
             	contentType: false,
             	cache: false,
             	async: false,
             	success(data)
             	{
             		$.message('Berhasil diubah.','Negara','success')
             		$("#advanced-usage").dataTable().fnDestroy()
					dynamic()
             	},
             	error($xhr)
             	{
					$.message('Gagal diubah.','Negara','error')
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

		$('#myModalLabel').html('Ubah Data Negara')
		$('#id').val(res[0])
		$('#nama').val(res[1])
		$('#keterangan').val(res[2])
		$('#file').val('<?= base_url() ?>assets/upload/bendera/'+res[3])
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
		ajax 	= window.apiClient.referensiNegara.delete(id)
					.done(function(data) {
						$("#advanced-usage").dataTable().fnDestroy()
						$.message('Berhasil dihapus.','Negara','success')
						dynamic()
						
					})
					.fail(function($xhr) {
						$.message('Gagal dihapus.','Negara','error')
					}).
					always(function() {
						$('#myModal3').modal('toggle')
					})
	})

})