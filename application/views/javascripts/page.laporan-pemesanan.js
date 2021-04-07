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
			"url": "<?= base_url()?>laporan/pemesanan/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": 
		[
			{ "data": "peme_kode" },
			{ "data": "peme_nama" },
			{ "data": "penu_nama" },
			{ "data": "pemt_status" },
			{ "data": "pemt_status_pesanan" },
			{ "data": "pemt_tanggal" },
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