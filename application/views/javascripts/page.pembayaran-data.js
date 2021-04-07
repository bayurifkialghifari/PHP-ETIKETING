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
			"url": "<?= base_url()?>pembayaran/data/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": 
		[
			{ "data": "peme_email"},
			{ "data": "PaymentMethod" },
			{ 
				"data": "payerBuktiPembayaran", render(data, type, full, meta)
				{
					return '<img src="<?=base_url()?>assets/upload/buktiPembayaran/'+data+'" width="25%">'
				} 
			},
			{ "data": "PayerStatus" },
			{
				"data": "txn_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
								+'<button class="btn btn-sm btn-success cek btn-ef btn-ef-5 btn-ef-5b" value="'+data+'"><i class="fa fa-check"></i> <span>Verivikasi</span></button>'
								+'<button class="btn btn-sm btn-danger cekGagal btn-ef btn-ef-5 btn-ef-5b" value="'+data+'"><i class="fa fa-times"></i> <span>Tidak Valid</span></button>'
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
				"url": "<?= base_url()?>pembayaran/data/ajax_data/",
				"data": null,
				"type": 'POST'
			},
			"columns": 
			[
				{ "data": "peme_email"},
				{ "data": "PaymentMethod" },
				{ 
					"data": "payerBuktiPembayaran", render(data, type, full, meta)
					{
						return '<img src="<?=base_url()?>assets/upload/buktiPembayaran/'+data+'" width="25%">'
					} 
				},
				{ "data": "PayerStatus" },
				{
					"data": "txn_id", render: function(data, type, full, meta)
					{
						return '<div class="pull-right">'
									+'<button class="btn btn-sm btn-success cek btn-ef btn-ef-5 btn-ef-5b" value="'+data+'"><i class="fa fa-check"></i> <span>Verivikasi</span></button>'
									+'<button class="btn btn-sm btn-danger cekGagal btn-ef btn-ef-5 btn-ef-5b" value="'+data+'"><i class="fa fa-times"></i> <span>Tidak Valid</span></button>'
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

	// Fungsi Validasi
	$('#advanced-usage tbody').on('click', '.cek', function(ev) {
		var ids = $(this).val()
		$("#idHapus").val(ids)
		$('#status').val('valid')
		$("#labelHapus").text('Form Validasi')
		$("#contentHapus").text('Apakah anda yakin data ini sudah valid ?')
		$('#myModal3').modal('toggle')
	})

	$('#advanced-usage tbody').on('click', '.cekGagal', function(ev) {
		var ids = $(this).val()
		$("#idHapus").val(ids)
		$('#status').val('tidak')		
		$("#labelHapus").text('Form Validasi')
		$("#contentHapus").text('Apakah anda yakin data ini sudah tidak valid ?')
		$('#myModal3').modal('toggle')
	})


	// Fungsi Validasi Jika Ya
	$('#clickHapus').click(function() {
		let status 	= $('#status').val()
		let id 		= $("#idHapus").val()


		if(status == 'valid')
		{
			$.message('Tunggu sebentar.','Validasi','warning')
			ajax 	= window.apiClient.validasiPembayaran.valid(id)
					.done(function(data) {
						$("#advanced-usage").dataTable().fnDestroy()
						$.message('Data tervalidasi.','Validasi','success')
						dynamic()
						
					})
					.fail(function($xhr) {
						$("#advanced-usage").dataTable().fnDestroy()
						$.message('Data tervalidasi.','Validasi','success')
						dynamic()
					}).
					always(function() {
						$('#myModal3').modal('toggle')
					})
		}
		else
		{
			ajax 	= window.apiClient.validasiPembayaran.tidakValid(id)
					.done(function(data) {
						$("#advanced-usage").dataTable().fnDestroy()
						$.message('Data tervalidasi.','Validasi','success')
						dynamic()
						
					})
					.fail(function($xhr) {
						$.message('Gagal divalidasi.','Validasi','error')
					}).
					always(function() {
						$('#myModal3').modal('toggle')
					})
		}
	})

})