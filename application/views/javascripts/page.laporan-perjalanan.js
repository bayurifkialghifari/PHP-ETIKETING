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
			"url": "<?= base_url()?>laporan/perjalanan/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": 
		[
			{ "data": "tikk_id" },
			{ "data": "tikk_jadk_kode" },
			{ "data": "keret_nama" },
			{ "data": "kela_nama" },
			{ "data": "kota_asal" },
			{ "data": "kota_tujuan" },
			{ "data": "stat_asal" },
			{ "data": "stat_tujuan" },
			{ "data": "jadk_tanggal_berangkat" },
			{ "data": "jadk_jam_berangkat" },
			{ "data": "jadk_jam_berangkat_sampai" },
			{
				data: "tikd_harga_usd", render: function(data, type, full, meta)
				{
					let nominal = window.apiClient.format.dolar(data, 'Rp ')

					return '<p style="text-align:right">'+nominal+'</p>'
				}
			},
			{ "data": "tikd_no_kursi" },
			{ "data": "tikd_status" },
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