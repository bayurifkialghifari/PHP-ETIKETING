 $(function() {

 	value_code()

	//initializing datepicker
	$('#berangkat').datepicker({
		changeYear: true,
    	changeMonth: true,
      	minDate:0,
    	dateFormat: "yy-m-dd",
    	yearRange: "-100:+20", 
    })

    $('#berangkat-sampai').datepicker({
		changeYear: true,
    	changeMonth: true,
      	minDate:0,
    	dateFormat: "yy-m-dd",
    	yearRange: "-100:+20", 
    })

    $('#pulang').datepicker({
		changeYear: true,
    	changeMonth: true,
      	minDate:0,
    	dateFormat: "yy-m-dd",
    	yearRange: "-100:+20", 
    })

    $('#pulang-sampai').datepicker({
		changeYear: true,
    	changeMonth: true,
      	minDate:0,
    	dateFormat: "yy-m-dd",
    	yearRange: "-100:+20", 
    })

    $('#tipe-penerbangan').on('change', () =>
    {
    	let tipe 	= $('#tipe-penerbangan').val()

    	if(tipe == 'SJ')
    	{
    		$('#pp').css('display', 'none')
    	}
    	else if(tipe == 'PP')
    	{
    		$('#pp').css('display', 'block')
    	}
    })

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) 
	{
		console.log('The column', iColumn, ' has changed its status to', bVisible)
	}

	function value_code()
 	{
		window.apiClient.code.getCodeJadwal().done(function(res) {
			$("#kode").val(res.id)
		}).fail(function($xhr) {
			console.log($xhr)
		})
	}

	var table4 = $('#advanced-usage').DataTable(
	{
		"ajax": 
		{
			"url": "<?= base_url()?>penerbangan/jadwal/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": 
		[
			{ "data": "jadp_kode" },
			{ "data": "mask_nama" },
			{ "data": "pesa_nama" },
			{
				data: "pesa_id", render: function(data, type, full, meta)
				{
					return '<p style="text-align:left">'+full.kota_asal+' - '+full.kota_tujuan+'</p>'
				}
			},
			{ "data": "jadp_tanggal_berangkat" },
			{ "data": "jadp_tanggal_berangkat_sampai" },
			{ "data": "jadp_jam_berangkat" },
			{ "data": "jadp_jam_berangkat_sampai" },
			{ "data": "jadp_tanggal_pulang" },
			{ "data": "jadp_tanggal_pulang_sampai" },
			{ "data": "jadp_jam_pulang" },
			{ "data": "jadp_jam_pulang_sampai" },
			{ "data": "jadp_tipte_penerbangan" },
			{ "data": "jadp_keterangan" },
			{ "data": "jadp_status" },
			{
				"data": "jadp_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
								+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.jadp_id+'|'+full.jadp_kode+'|'+full.jadp_pesa_id+'|'+full.jadp_rute_kode+'|'+full.jadp_tipte_penerbangan+'|'+full.jadp_tanggal_berangkat+'|'+full.jadp_tanggal_berangkat_sampai+'|'+full.jadp_jam_berangkat+'|'+full.jadp_jam_berangkat_sampai+'|'+full.jadp_tanggal_pulang+'|'+full.jadp_tanggal_pulang_sampai+'|'+full.jadp_jam_pulang+'|'+full.jadp_jam_pulang_sampai+'|'+full.jadp_keterangan+'|'+full.jadp_status+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
				"url": "<?= base_url()?>penerbangan/jadwal/ajax_data/",
				"data": null,
				"type": 'POST'
			},
			"columns": 
			[
				{ "data": "jadp_kode" },
				{ "data": "mask_nama" },
				{ "data": "pesa_nama" },
				{
					data: "pesa_id", render: function(data, type, full, meta)
					{
						return '<p style="text-align:left">'+full.kota_asal+' - '+full.kota_tujuan+'</p>'
					}
				},
				{ "data": "jadp_tanggal_berangkat" },
				{ "data": "jadp_tanggal_berangkat_sampai" },
				{ "data": "jadp_jam_berangkat" },
				{ "data": "jadp_jam_berangkat_sampai" },
				{ "data": "jadp_tanggal_pulang" },
				{ "data": "jadp_tanggal_pulang_sampai" },
				{ "data": "jadp_jam_pulang" },
				{ "data": "jadp_jam_pulang_sampai" },
				{ "data": "jadp_tipte_penerbangan" },
				{ "data": "jadp_keterangan" },
				{ "data": "jadp_status" },
				{
					"data": "jadp_id", render: function(data, type, full, meta)
					{
						return '<div class="pull-right">'
									+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.jadp_id+'|'+full.jadp_kode+'|'+full.jadp_pesa_id+'|'+full.jadp_rute_kode+'|'+full.jadp_tipte_penerbangan+'|'+full.jadp_tanggal_berangkat+'|'+full.jadp_tanggal_berangkat_sampai+'|'+full.jadp_jam_berangkat+'|'+full.jadp_jam_berangkat_sampai+'|'+full.jadp_tanggal_pulang+'|'+full.jadp_tanggal_pulang_sampai+'|'+full.jadp_jam_pulang+'|'+full.jadp_jam_pulang_sampai+'|'+full.jadp_keterangan+'|'+full.jadp_status+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
		$('#myModalLabel').html('Tambah Data Penerbangan')
		$('#id').val('')
		$('#pesawat').val('')
		$('#rute').val('')
		$('#tipe-penerbangan').val('')
		$('#berangkat').val('')
		$('#berangkat-sampai').val('')
		$('#jam-berangkat').val('')
		$('#jam-berangkat-sampai').val('')
		$('#pulang').val('')
		$('#pulang-sampai').val('')
		$('#jam-pulang').val('')
		$('#jam-pulang-sampai').val('')
		$('#keterangan').val('')
		$('#status').val('')
		
	})

	// fungsi simpan 
	$('#form').submit(function(ev) {
		ev.preventDefault()

		let id 					= $('#id').val()
		let kode 				= $('#kode').val()
		let pesawat 			= $('#pesawat').val()
		let rute 				= $('#rute').val()
		let tipePenerbangan 	= $('#tipe-penerbangan').val()
		let berangkat 			= $('#berangkat').val()
		let berangkatSampai 	= $('#berangkat-sampai').val()
		let jamBerangkat 		= $('#jam-berangkat').val()
		let jamBerangkatSampai 	= $('#jam-berangkat-sampai').val()
		let pulang				= $('#pulang').val()
		let pulangSampai 		= $('#pulang-sampai').val()
		let jamPulang 			= $('#jam-pulang').val()
		let jamPulangSampai 	= $('#jam-pulang-sampai').val()
		let keterangan 			= $('#keterangan').val()
		let status 				= $('#status').val()


		let ajax = null
		if(id == 0) {
			ajax = window.apiClient.penerbanganJadwal.insert(kode, pesawat, rute, tipePenerbangan, berangkat, berangkatSampai, jamBerangkat, jamBerangkatSampai, pulang, pulangSampai, jamPulang, jamPulangSampai, keterangan, status)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy()
				$.message('Berhasil ditambahkan.','Jadwal','success')
				dynamic()
				value_code()

			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','Jadwal','error')
			}).
			always(function() {
				$('#splash').modal('toggle')
			})
		}
		else {
			ajax = window.apiClient.penerbanganJadwal.update(id, kode, pesawat, rute, tipePenerbangan, berangkat, berangkatSampai, jamBerangkat, jamBerangkatSampai, pulang, pulangSampai, jamPulang, jamPulangSampai, keterangan, status)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy()
				$.message('Berhasil diubah.','Jadwal','success')
				dynamic()
				value_code()
				
			})
			.fail(function($xhr) {
				$.message('Gagal diubah.','Jadwal','error')
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

		$('#myModalLabel').html('Ubah Data Penerbangan')
		$('#id').val(res[0])
		$('#kode').val(res[1])
		$('#pesawat').val(res[2])
		$('#rute').val(res[3])
		$('#tipe-penerbangan').val(res[4])
		$('#berangkat').val(res[5])
		$('#berangkat-sampai').val(res[6])
		$('#jam-berangkat').val(res[7])
		$('#jam-berangkat-sampai').val(res[8])
		$('#pulang').val(res[9])
		$('#pulang-sampai').val(res[10])
		$('#jam-pulang').val(res[11])
		$('#jam-pulang-sampai').val(res[12])
		$('#keterangan').val(res[13])
		$('#status').val(res[14])

		let tipe 	= $('#tipe-penerbangan').val()

    	if(tipe == 'SJ')
    	{
    		$('#pp').css('display', 'none')
    	}
    	else if(tipe == 'PP')
    	{
    		$('#pp').css('display', 'block')
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
		ajax 	= window.apiClient.penerbanganJadwal.delete(id)
				.done(function(data) {
					$("#advanced-usage").dataTable().fnDestroy()
					$.message('Berhasil dihapus.','Jadwal','success')
					dynamic()
					value_code()
					
				})
				.fail(function($xhr) {
					$.message('Gagal dihapus.','Jadwal','error')
				}).
				always(function() {
					$('#myModal3').modal('toggle')
				})
	})

})