$(() =>
{
	$('#form').submit((ev) =>
	{
		ev.preventDefault()

		let email 		= $('#email').val()
		let password 	= $('#password').val()

		$.ajax({
			url: '<?= base_url() ?>login/doLogin',
			method: 'post',
			data: {email: email, password: password},
			dataType: 'json',
			success(data)
			{
				if(data.status == 1)
				{
					window.location.href = '<?= base_url() ?>dashboard'
				}
				else if(data.status == 2)
				{
					window.location.href = '<?= base_url() ?>users/home'
				}
				else
				{
					$('#password').val('')

					$.message('Email atau password tidak sama !!.','Login','error')
				}
			},
			error($xhr)
			{
				console.log($xhr)
			}
		})
	})
})

function onSignIn(googleUser) 
{
    let profile = googleUser.getBasicProfile()

    $.ajax({
    	url: '<?= base_url() ?>login/loginWithGoogle',
    	method: 'post',
    	data: 	{
    				id: profile.getId(),
    				name: profile.getName(),
    				email: profile.getEmail(),
    				gambar: profile.getImageUrl() 
    			},
    	dataType: 'json',
    	success(data)
    	{
    		$.ajax({
    			url: 'https://accounts.google.com/logout',
    			method: 'get',
    			data: null,
    			success()
    			{
    				console.log('logout')
    			}
    		})

    		window.location.href = '<?= base_url() ?>users/home'
    	},
    	error($xhr)
    	{
    		console.log($xhr)
    	}
    })
}