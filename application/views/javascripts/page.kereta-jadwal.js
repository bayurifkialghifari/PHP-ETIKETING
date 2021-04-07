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

    $('#tipe-perjalanan').on('change', () =>
    {
    	let tipe 	= $('#tipe-perjalanan').val()

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
		window.apiClient.code.getCodeJadwalPerjalanan().done(function(res) {
			$("#kode").val(res.id)
		}).fail(function($xhr) {
			console.log($xhr)
		})
	}

	var table4 = $('#advanced-usage').DataTable(
	{
		"ajax": 
		{
			"url": "<?= base_url()?>kereta/jadwal/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": 
		[
			{ "data": "jadk_kode" },
			{ "data": "keret_kode" },
			{ "data": "keret_nama" },
			{
				data: "jadk_id", render: function(data, type, full, meta)
				{
					return '<p style="text-align:left">'+full.kota_asal+' - '+full.kota_tujuan+'</p>'
				}
			},
			{ "data": "jadk_tanggal_berangkat" },
			{ "data": "jadk_jam_berangkat" },
			{ "data": "jadk_jam_berangkat_sampai" },
			{ "data": "jadk_tanggal_pulang" },
			{ "data": "jadk_jam_pulang" },
			{ "data": "jadk_jam_pulang_sampai" },
			{ "data": "jadk_tipe" },
			{ "data": "jadk_keterangan" },
			{ "data": "jadk_status" },
			{
				"data": "jadk_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
								+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.jadk_id+'|'+full.jadk_kode+'|'+full.jadpk_keret_id+'|'+full.jadk_rute_kode+'|'+full.jadk_tipe+'|'+full.jadk_tanggal_berangkat+'|'+full.jadk_tanggal_berangkat_sampai+'|'+full.jadk_jam_berangkat+'|'+full.jadk_jam_berangkat_sampai+'|'+full.jadk_tanggal_pulang+'|'+full.jadk_tanggal_pulang_sampai+'|'+full.jadk_jam_pulang+'|'+full.jadk_jam_pulang_sampai+'|'+full.jadk_keterangan+'|'+full.jadk_status+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
				"url": "<?= base_url()?>kereta/jadwal/ajax_data/",
				"data": null,
				"type": 'POST'
			},
			"columns": 
			[
				{ "data": "jadk_kode" },
				{ "data": "keret_kode" },
				{ "data": "keret_nama" },
				{
					data: "jadk_id", render: function(data, type, full, meta)
					{
						return '<p style="text-align:left">'+full.kota_asal+' - '+full.kota_tujuan+'</p>'
					}
				},
				{ "data": "jadk_tanggal_berangkat" },
				{ "data": "jadk_jam_berangkat" },
				{ "data": "jadk_jam_berangkat_sampai" },
				{ "data": "jadk_tanggal_pulang" },
				{ "data": "jadk_jam_pulang" },
				{ "data": "jadk_jam_pulang_sampai" },
				{ "data": "jadk_tipe" },
				{ "data": "jadk_keterangan" },
				{ "data": "jadk_status" },
				{
					"data": "jadk_id", render: function(data, type, full, meta)
					{
						return '<div class="pull-right">'
									+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.jadk_id+'|'+full.jadk_kode+'|'+full.jadpk_keret_id+'|'+full.jadk_rute_kode+'|'+full.jadk_tipe+'|'+full.jadk_tanggal_berangkat+'|'+full.jadk_tanggal_berangkat_sampai+'|'+full.jadk_jam_berangkat+'|'+full.jadk_jam_berangkat_sampai+'|'+full.jadk_tanggal_pulang+'|'+full.jadk_tanggal_pulang_sampai+'|'+full.jadk_jam_pulang+'|'+full.jadk_jam_pulang_sampai+'|'+full.jadk_keterangan+'|'+full.jadk_status+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
		$('#myModalLabel').html('Tambah Data Kereta')
		$('#id').val('')
		$('#pesawat').val('')
		$('#rute').val('')
		$('#tipe-perjalanan').val('')
		$('#berangkat').val('')
		$('#jam-berangkat').val('')
		$('#jam-berangkat-sampai').val('')
		$('#pulang').val('')
		$('#jam-pulang').val('')
		$('#jam-pulang-sampai').val('')
		$('#keterangan').val('')
		$('#status').val('')
		value_code()
		
	})

	// fungsi simpan 
	$('#form').submit(function(ev) {
		ev.preventDefault()

		let id 					= $('#id').val()
		let kode 				= $('#kode').val()
		let kereta 				= $('#kereta').val()
		let rute 				= $('#rute').val()
		let tipePerjalanan 		= $('#tipe-perjalanan').val()
		let berangkat 			= $('#berangkat').val()
		let jamBerangkat 		= $('#jam-berangkat').val()
		let jamBerangkatSampai 	= $('#jam-berangkat-sampai').val()
		let pulang				= $('#pulang').val()
		let jamPulang 			= $('#jam-pulang').val()
		let jamPulangSampai 	= $('#jam-pulang-sampai').val()
		let keterangan 			= $('#keterangan').val()
		let status 				= $('#status').val()

		// console.log(id + ' ' + kode + ' ' + kereta + ' ' + rute + ' ' + tipePerjalanan + ' ' + berangkat + ' ' + jamBerangkat + ' ' + jamBerangkatSampai + ' ' + pulang + ' ' + jamPulang + ' ' + jamPulangSampai + ' ' + keterangan + ' ' + status)


		let ajax = null
		if(id == 0) {
			ajax = window.apiClient.keretaJadwal.insert(kode, kereta, rute, tipePerjalanan, berangkat, jamBerangkat, jamBerangkatSampai, pulang, jamPulang, jamPulangSampai, keterangan, status)
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
			ajax = window.apiClient.keretaJadwal.update(id, kode, kereta, rute, tipePerjalanan, berangkat, jamBerangkat, jamBerangkatSampai, pulang, jamPulang, jamPulangSampai, keterangan, status)
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

		$('#myModalLabel').html('Ubah Data Kereta')
		$('#id').val(res[0])
		$('#kode').val(res[1])
		$('#pesawat').val(res[2])
		$('#rute').val(res[3])
		$('#tipe-perjalanan').val(res[4])
		$('#berangkat').val(res[5])
		$('#jam-berangkat').val(res[7])
		$('#jam-berangkat-sampai').val(res[8])
		$('#pulang').val(res[9])
		$('#jam-pulang').val(res[11])
		$('#jam-pulang-sampai').val(res[12])
		$('#keterangan').val(res[13])
		$('#status').val(res[14])

		let tipe 	= $('#tipe-perjalanan').val()

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
		ajax 	= window.apiClient.keretaJadwal.delete(id)
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