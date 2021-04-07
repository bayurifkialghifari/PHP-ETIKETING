$(() =>
{
	//initializing datepicker
  $('#berangkat').datepicker({
      changeYear: true,
      changeMonth: true,
      minDate:0,
      dateFormat: "yy-m-dd",
      yearRange: "-100:+20", 
  })

  $('#sampai').datepicker({
      changeYear: true,
      changeMonth: true,
      minDate:0,
      dateFormat: "yy-m-dd",
      yearRange: "-100:+20", 
  })

  $('#jenis-penerbangan').on('change', () =>
  {
    let jenis   = $('#jenis-penerbangan').val()

    if(jenis == 'PP')
    {
      $('#sampai').css('display', 'block')
    }
    else
    {
      $('#sampai').css('display', 'none')
    }
  })
})