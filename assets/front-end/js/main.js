
$(() =>
{
	load()


    // Load Animation
	function load()
	{
        let width = screen.width

        if(width <= 1000)
        {
            $('#dari').css('width', '50%')
            $('#ke').css('width', '50%')
            
            $('table').addClass('table-responsive')
        }

		$('body').addClass('show')
	}

    // Animasi SideBar
	$('#menu-toggle').click((e) => 
	{
      	e.preventDefault()

      	$('.header-navbar-brand').toggleClass('hide')
      	$('#page-content-wrapper').toggleClass('padding-left')
        $('footer').toggleClass('padding-left')
      	$('#wrapper').toggleClass('toggled')
    })

    // Close Modal
    $('.close').on('click', () =>
    {
    	$('#myModal').modal('hide')
    })

    // Back To Top
    $('.go_top').on('click', (e) =>
    {
      $('html, body').animate({scrollTop: 0}, 500)
    })

    // Validasi Logout
    $('#logout').on('click', () => 
    {
        $("#contentHapus").text('Apakah anda yakin ingin logout ?')
        $('#myModal3').modal('toggle')
    })

    // Logout Ya
    $('#clickLogout').on('click', () =>
    {   
        location.href = base_url + 'login/logout'
    })
})


function detail(img, alt)
{
    $('#myModal').modal('show')
    $('.modal-content').attr('src', img)
    $('modal').css('display', 'block')
    $('#caption').html(alt)
}