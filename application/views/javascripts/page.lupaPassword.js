$(() =>
{
	$('#form').submit((ev) =>
	{
		ev.preventDefault()

		let email 	= $('#email').val()

		$.ajax({
			type: 'post',
			url: '<?= base_url() ?>lupaPassword/cekAkun',
			dataType: 'json',
			data: {
				email: email
			},
			success(data)
			{
				if(data.status == 0)
				{
					$.message('Akun tidak ditemukan !!','Lupa password','error')

					$('#detail-akun').css('display', 'none')
					$('#nama').html('')
					$('#email').html('')
					$('#no-telepon').html('')
					$('#lanjutkan').val('')
					$('#bukan').val('')
				}
				else
				{
					$.message('Akun ditemukan !!','Lupa password','success')

					$('#detail-akun').css('display', 'block')

					$('#nama').html('Nama : ' + data.data.user_name)
					$('#email2').html('Email : ' + data.data.user_email)
					$('#no-telepon').html('Telepon : ' + data.data.user_phone)
					$('#lanjutkan').val(data.data.user_id + '-' + data.data.user_email + '-' + data.data.user_token)
				}
			},
			error($xhr)
			{
				console.log($xhr)
			}
		})
	})

	$('#bukan').on('click', () =>
	{
		$.message('Masukan email yang anda sudah daftarkan !!','Lupa password','warning')

		$('#detail-akun').css('display', 'none')
		$('#nama').html('')
		$('#email').html('')
		$('#no-telepon').html('')
		$('#lanjutkan').val('')
		$('#bukan').val('')
	})

	$('#lanjutkan').on('click', () =>
	{
		$.message('Tunggu sebentar !!','Lupa password','warning')

		let lanjutkan 	= $('#lanjutkan').val()

		lanjutkan 		= lanjutkan.split('-')

		let id 				= lanjutkan[0]
		let email 			= lanjutkan[1]
		let token 			= lanjutkan[2]

		$.ajax({
			type: 'post',
			url: '<?= base_url() ?>lupaPassword/kirimLink',
			dataType: 'json',
			data: {
				id: id,
				email: email,
				token: token
			},
			success()
			{
				$.message('Cek email anda untuk mengganti password !!','Lupa password','success')

				$('#lanjutkan').attr('disabled', 'disabled')				
			}
		})
	})
})