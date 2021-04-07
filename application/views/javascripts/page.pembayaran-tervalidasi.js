$(() =>
{
	//initialize responsive datatable
	function stateChange(iColumn, bVisible) 
	{
		console.log('The column', iColumn, ' has changed its status to', bVisible)
	}
	
	$('#advanced-usage').DataTable()
})