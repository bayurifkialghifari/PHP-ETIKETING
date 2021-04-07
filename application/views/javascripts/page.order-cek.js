$(() =>
{
	$('#form').submit((ev) =>
	{
		ev.preventDefault()
		
		$('#hasil-cari').html('')

		let email 		= $('#email').val()
		let kode 		= $('#kode').val()
		let html 		= ''

		window.apiClient.order.cekOrder(email, kode)
		.done(function(data) {

			if(data.length > 0)
			{
				if(data[0].pemt_status_pesanan == 'Kereta')
				{
		            for (let i = 0; i < data.length; i++)
		            {
		            	window.apiClient.order.cekOrderDetailKereta(data[i].pemt_tikd_id)
						.done(function(data2) 
						{
                           	let jam = window.apiClient.cekSelisih.jam(data2.jadk_jam_berangkat, data2.jadk_jam_berangkat_sampai)
                           	let idr = window.apiClient.format.rupiah(data2.tikd_harga_idr, 'Rp. ')
                           	let usd = window.apiClient.format.dolar(data2.tikd_harga_usd, '$ ')

                           	html += 
			            			'<br>'
			            			+'<div class="row">'
				            		  +'<div class="col-md-12">'
			                          
			                          +'<p class="text-center">' + data2.keret_nama +'</p>'
			                          
			                          +'<div class="row">'
			                            +'<div class="col-md-2 col-sm-2 text-center">'
			                              
			                              +'<img src="<?= base_url() ?>assets/upload/kai/Logo_PT_KAI_(Persero)_(New_version_2016).svg" class="img-penerbangan">'
			                            
			                            +'</div>'
			                            
			                            +'<div class="col-md-4 col-sm-4">'
			                              +'<p>'
			                                
			                                + data2.jadk_jam_berangkat + '&nbsp; --- &nbsp;' 
												+ jam + 'Jam'
			                                +'&nbsp; ---  &nbsp;' + data2.jadk_jam_berangkat_sampai
			                                  
			                              +'</p>'
			                            +'</div>'
			                            
			                            +'<div class="col-md-2 col-sm-2 text-center">'
			                              
			                              +'<p>'
			                                + data2.stat_asal +'-'+ data2.stat_tujuan + '&nbsp;'  
			                              +'</p>'
			                            
			                            +'</div>'

			                            +'<div class="col-md-4 col-sm-4 text-center">'
			                              
			                              +'<p>' + idr +' / &nbsp;' + usd + '</p>'
			                            +'</div>'
			                          +'</div>'
			                          
			                          +'<div class="text-right">'
			                          +'<button class="btn btn-success-costum" onclick="detailOrder('+data2.tikd_id+')"><i class="fa fa-search"></i> Detail</a>'
			                          +'</div>'
			                        
			                         +'</div>'
			                        +'</div>'

							$('#hasil-cari').html(html)
	                    })
		            }
				}
				else
				{
					for (let i = 0; i < data.length; i++)
		            {
		            	window.apiClient.order.cekOrderDetailPesawat(data[i].pemt_tipd_id)
						.done(function(data2) 
						{
							console.log(data2.tikp_harga_idr)
                           	let jam = window.apiClient.cekSelisih.jam(data2.jadp_jam_berangkat, data2.jadp_jam_berangkat_sampai)
                           	let idr = window.apiClient.format.rupiah(data2.tikp_harga_idr, 'Rp. ')
                           	let usd = window.apiClient.format.dolar(data2.tikp_harga_usd, '$ ')

			            	html += 
			            			'<br>'
			            			+'<div class="row">'
				            		  +'<div class="col-md-12">'
			                          
			                          +'<p class="text-center">' + data2.mask_nama +'</p>'
			                          
			                          +'<div class="row">'
			                            +'<div class="col-md-2 col-sm-2 text-center">'
			                              
			                              +'<img src="<?= base_url() ?>assets/upload/maskapai/'+ data2.mask_logo +'" class="img-penerbangan">'
			                            
			                            +'</div>'
			                            
			                            +'<div class="col-md-4 col-sm-4">'
			                              +'<p>'
			                                
			                                + data2.jadp_jam_berangkat + '&nbsp; --- &nbsp;' 
												+ jam + 'Jam'
			                                +'&nbsp; ---  &nbsp;' + data2.jadp_jam_berangkat_sampai
			                                  
			                              +'</p>'
			                            +'</div>'
			                            
			                            +'<div class="col-md-2 col-sm-2 text-center">'
			                              
			                              +'<p>'
			                                + data2.kota_asal +'-'+ data2.kota_tujuan + '&nbsp;'  
			                              +'</p>'
			                            
			                            +'</div>'

			                            +'<div class="col-md-4 col-sm-4 text-center">'
			                              
			                              +'<p>' + idr +' / &nbsp;' + usd + '</p>'
			                            +'</div>'
			                          +'</div>'
			                          
			                          +'<div class="text-right">'
			                          +'<button class="btn btn-success-costum" onclick="detailOrder2('+data2.tipd_id+')"><i class="fa fa-search"></i> Detail</a>'
			                          +'</div>'
			                        
			                         +'</div>'
			                        +'</div>'

							$('#hasil-cari').html(html)
	                    })
		            }
				}

				$.message('Pesanan ditemukan.','Cek Order','success')	
			}
			else
			{
				html = '<div class="text-dark text-center">'
			          	+'<b><p>Cek pesanan anda dengan mudah <br> Masukan email dan kode booking anda</p></b>'
			          	+'<div class="text-center pt-2">'
			            +'<img src="<?= base_url() ?>assets/front-end/images/svg/undraw_Booked_j7rj.svg" class="img-home">'
			          	+'</div>'
			        	+'</div>'

				$('#hasil-cari').html(html)

				$.message('Pesanan tidak ditemukan.','Cek Order','error')
			}
		})
		.fail(function($xhr) {
			console.log($xhr)
		})
	})
})

// Detail Tiket Kereta
function detailOrder(id)
{
	$('#download-tiket').val(id)
	$('#myModalTiket').modal('toggle')
	$('#myModalLabel').html('Detail Tiket Kereta')

	window.apiClient.order.cekOrderDetailKereta(id)
	.done(function(data) 
	{
		let tanggal = data.jadk_tanggal_berangkat
		let jam 	= window.apiClient.cekSelisih.jam(data.jadk_jam_berangkat, data.jadk_jam_berangkat_sampai)

		$('#kereta').html('<b>'+data.keret_nama+'</b>')
		$('#kota-tanggal').html('<b>'+data.kota_asal + '-' + data.kota_tujuan + ', ' + tanggal+'</b>')
		$('#stasiun').html('<b>'+ data.stat_asal + ' - ' + data.stat_tujuan +'</b>')
		$('#berangkat').html('<b>'+ data.jadk_jam_berangkat + ' --- ' + jam + 'Jam' + ' --- ' + data.jadk_jam_berangkat_sampai +'</b>')
		$('#kode-pemesan').val(data.peme_kode)
		$('#pemesan').val(data.peme_nama)
		$('#title').html(data.penu_title)
		$('#penumpang').html(data.penu_nama)
		$('#kode-tiket').html(data.penu_kode)
		$('#jenis').html(data.penu_status)
		$('#nomer-kursi').html(data.tikd_no_kursi)
	})
}

// Detail Tiket Pesawat
function detailOrder2(id)
{
	$('#download-tiket').val(id)
	$('#myModalTiket').modal('toggle')
	$('#myModalLabel').html('Detail Tiket Pesawat')

	window.apiClient.order.cekOrderDetailPesawat(id)
	.done(function(data) 
	{
		let tanggal = data.jadp_tanggal_berangkat
		let jam 	= window.apiClient.cekSelisih.jam(data.jadp_jam_berangkat, data.jadp_jam_berangkat_sampai)

		$('#kereta').html('<b>'+data.mask_nama+'</b>')
		$('#kota-tanggal').html('<b>'+data.kota_asal + '-' + data.kota_tujuan + ', ' + tanggal+'</b>')
		$('#stasiun').html('<b>'+ data.band_asal + ' - ' + data.band_tujuan +'</b>')
		$('#berangkat').html('<b>'+ data.jadp_jam_berangkat + ' --- ' + jam + 'Jam' + ' --- ' + data.jadp_jam_berangkat_sampai +'</b>')
		$('#kode-pemesan').val(data.peme_kode)
		$('#pemesan').val(data.peme_nama)
		$('#title').html(data.penu_title)
		$('#penumpang').html(data.penu_nama)
		$('#kode-tiket').html(data.penu_kode)
		$('#jenis').html(data.penu_status)
		$('#nomer-kursi').html(data.tipd_no_kursi)
	})
}