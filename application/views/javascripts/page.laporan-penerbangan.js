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
			"url": "<?= base_url()?>laporan/penerbangan/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": 
		[
			{ "data": "tikp_id" },
			{ "data": "tikp_jadp_kode" },
			{ "data": "mask_nama" },
			{ "data": "pesa_nama" },
			{ "data": "kela_nama" },
			{ "data": "kota_asal" },
			{ "data": "kota_tujuan" },
			{ "data": "band_asal" },
			{ "data": "band_tujuan" },
			{ "data": "jadp_tanggal_berangkat" },
			{ "data": "jadp_tanggal_berangkat_sampai" },
			{ "data": "jadp_jam_berangkat" },
			{ "data": "jadp_jam_berangkat_sampai" },
			{
				data: "tikp_harga_usd", render: function(data, type, full, meta)
				{
					let nominal = window.apiClient.format.dolar(data, '$')

					return '<p style="text-align:right">'+nominal+'</p>'
				}
			},
			{ "data": "tipd_no_kursi" },
			{ "data": "tipd_status" },
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

})