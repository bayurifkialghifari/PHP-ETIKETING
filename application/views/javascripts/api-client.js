$(() => {
  	
  	function initAjax() {
    	$.ajaxSetup({
      		accepts: ['application/json'],
      		dataType: 'json'
    	})
  	}

	window.apiClient = {
		cekSelisih:
		{
			jam(jam1, jam2)
			{
				var timeOfCall = jam1,
		        timeOfResponse = jam2,
				hours = timeOfResponse.split(':')[0] - timeOfCall.split(':')[0],
		        minutes = timeOfResponse.split(':')[1] - timeOfCall.split(':')[1]

		      	if (timeOfCall <= "12:00:00" && timeOfResponse >= "13:00:00")
		      	{
		        	a = 1
		      	} else {
		        	a = 0
		      	}
		      	
		      	minutes = minutes.toString().length<2?'0'+minutes:minutes
		      	
		      	if(minutes<0)
		      	{
		          	hours--
		          	minutes = 60 + minutes        
		      	}
		      	
		      	hours = hours.toString().length<2?'0'+hours:hours

		      	return hours-a+ ':' + minutes
			}
		},
		format:{
			rupiah(angka, prefix) {
					 if(angka){
			        var number_string = angka.replace(/[^,\d]/g, '').toString(),
					split   		= number_string.split(','),
					sisa     		= split[0].length % 3,
					rupiah     		= split[0].substr(0, sisa),
					ribuan     		= split[0].substr(sisa).match(/\d{3}/gi)

					// tambahkan titik jika yang di input sudah menjadi angka ribuan
					if(ribuan){
						separator = sisa ? '.' : ''
						rupiah += separator + ribuan.join('.')
					}

					rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah
					// return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '')
					return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '')
			    }else{
			        return 0
			    }
			},
			dolar(angka, prefix) {
				 if(angka){
			        var number_string = angka.replace(/[^,\d]/g, '').toString(),
					split   		= number_string.split(','),
					sisa     		= split[0].length % 3,
					rupiah     		= split[0].substr(0, sisa),
					ribuan     		= split[0].substr(sisa).match(/\d{3}/gi)

					// tambahkan titik jika yang di input sudah menjadi angka ribuan
					if(ribuan){
						separator = sisa ? '.' : ''
						rupiah += separator + ribuan.join('.')
					}

					rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah
					// return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '')
					return prefix == undefined ? rupiah : (rupiah ? '$' + rupiah : '')
			    }else{
			        return 0
			    }
			},
			tanggal(tanggal) {
				tanggal = tanggal.split('-')

				var hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
				var bulan = ['Januari', 'Februari', 'Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']

				var hari = hari[tanggal[2]]
				var bulan = bulan[tanggal[1]]
				var tahun = (tanggal[0] < 1000)?tanggal[0] + 1900 : tanggal[0]

				return hari +', ' + tanggal + ' ' + bulan + ' ' + tahun
			},
			splitString(stringToSplit, separator) {
			  var arrayOfStrings = stringToSplit.split(separator)
			  return arrayOfStrings.join('')
			}
		},
		voucherData:
		{
			insert(nama, kode, persen, batas, jumlah, keterangan, tanggal_akhir)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>voucher/data/insert',
					data: 
					{
						nama: nama,
						kode: kode,
						persen: persen,
						batas: batas,
						jumlah: jumlah,
						keterangan: keterangan,
						tanggal_akhir: tanggal_akhir
					}
				})
			},
			update(id, nama, kode, persen, batas, jumlah, keterangan, tanggal_akhir)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>voucher/data/update',
					data: 
					{
						id: id,
						nama: nama,
						kode: kode,
						persen: persen,
						batas: batas,
						jumlah: jumlah,
						keterangan: keterangan,
						tanggal_akhir: tanggal_akhir
					}
				})
			},
			delete(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>voucher/data/delete',
					data: {id:id}
				})
			}
		},
		laporan:
		{
			
		},
		pajakData:
		{
			insert(nama, persen, keterangan)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pajak/data/insert',
					data: {
						nama: nama,
						persen: persen,
						keterangan: keterangan
					}
				})
			},
			update(id, nama, persen, keterangan)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pajak/data/update',
					data: {
						id: id,
						nama: nama,
						persen: persen,
						keterangan: keterangan
					}
				})
			},
			delete(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pajak/data/delete',
					data: {id:id}
				})
			}
		},
		order:
		{
			cekOrder(email, kode)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>order/cek/orderan',
					data:
					{
						email: email,
						kode: kode
					}
				})
			},
			cekOrderDetailKereta(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>order/cek/orderanKereta',
					data: { id:id }
				})
			},
			cekOrderDetailPesawat(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>order/cek/orderanPesawat',
					data: { id:id }
				})
			}
		},
		validasiPembayaran:
		{
			valid(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pembayaran/data/valid',
					data:
					{
						id:id
					}
				})
			},
			tidakValid(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pembayaran/data/tidakValid',
					data:
					{
						id:id
					}
				})
			}
		},
		keretaRute:
		{
			insert(kode, kota_asal, kota_tujuan, stasiun_asal, stasiun_tujuan, harga, harga_dolar, status)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>kereta/rute/insert',
					data:
					{
						kode: kode,
						kota_asal: kota_asal,
						kota_tujuan: kota_tujuan,
						stasiun_asal: stasiun_asal,
						stasiun_tujuan: stasiun_tujuan,
						harga: harga,
						harga_dolar: harga_dolar,
						status: status
					}
				})
			},
			update(id, kode, kota_asal, kota_tujuan, stasiun_asal, stasiun_tujuan, harga, harga_dolar, status)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>kereta/rute/update',
					data:
					{
						id: id,
						kode: kode,
						kota_asal: kota_asal,
						kota_tujuan: kota_tujuan,
						stasiun_asal: stasiun_asal,
						stasiun_tujuan: stasiun_tujuan,
						harga: harga,
						harga_dolar: harga_dolar,
						status: status
					}
				})
			},
			delete(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>kereta/rute/delete',
					data: {id:id}
				})
			}
		},
		keretaGenerate:
		{
			insert(jadwal, kelas, jumlah_penumpang, keterangan, total_harga_usd, total_harga_idr)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>kereta/generate/insert',
					data:
					{
						jadwal: jadwal,
						kelas: kelas,
						jumlah_penumpang: jumlah_penumpang,
						keterangan: keterangan,
						total_harga_usd: total_harga_usd,
						total_harga_idr: total_harga_idr
					}
				})
			},
			searchJadwal(berangkat, kereta, tipePerjalanan)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>kereta/generate/searchJadwal',
					data: 
					{
						berangkat: berangkat,
						kereta: kereta,
						tipePerjalanan: tipePerjalanan
					}
				})
			},
			getKelasHarga(kelas)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penerbangan/generate/getKelasHarga',
					data: {kelas: kelas}
				})
			}
		},
		penerbanganGenerate:
		{
			insert(jadwal, kelas, jumlah_penumpang, keterangan, total_harga_usd, total_harga_idr)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penerbangan/generate/insert',
					data:
					{
						jadwal: jadwal,
						kelas: kelas,
						jumlah_penumpang: jumlah_penumpang,
						keterangan: keterangan,
						total_harga_usd: total_harga_usd,
						total_harga_idr: total_harga_idr
					}
				})
			},
			searchJadwal(berangkat, pesawat, tipePenerbangan)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penerbangan/generate/searchJadwal',
					data: 
					{
						berangkat: berangkat,
						pesawat: pesawat,
						tipePenerbangan: tipePenerbangan
					}
				})
			},
			getKelasHarga(kelas)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penerbangan/generate/getKelasHarga',
					data: {kelas: kelas}
				})
			}
		},
		keretaJadwal:
		{
			insert(kode, kereta, rute, tipePerjalanan, berangkat, jamBerangkat, jamBerangkatSampai, pulang, jamPulang, jamPulangSampai, keterangan, status)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>kereta/jadwal/insert',
					data:
					{
						kode: kode,
						kereta: kereta,
						rute: rute,
						tipePerjalanan: tipePerjalanan,
						berangkat: berangkat,
						jamBerangkat: jamBerangkat,
						jamBerangkatSampai: jamBerangkatSampai,
						pulang: pulang,
						jamPulang: jamPulang,
						jamPulangSampai: jamPulangSampai,
						keterangan: keterangan,
						status: status
					}
				})
			},
			update(id, kode, kereta, rute, tipePerjalanan, berangkat, jamBerangkat, jamBerangkatSampai, pulang, jamPulang, jamPulangSampai, keterangan, status)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>kereta/jadwal/update',
					data:
					{
						id: id,
						kode: kode,
						kereta: kereta,
						rute: rute,
						tipePerjalanan: tipePerjalanan,
						berangkat: berangkat,
						jamBerangkat: jamBerangkat,
						jamBerangkatSampai: jamBerangkatSampai,
						pulang: pulang,
						jamPulang: jamPulang,
						jamPulangSampai: jamPulangSampai,
						keterangan: keterangan,
						status: status
					}
				})
			},
			delete(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>kereta/jadwal/delete',
					data: {id:id}
				})
			}
		},
		penerbanganJadwal:
		{
			insert(kode, pesawat, rute, tipePenerbangan, berangkat, berangkatSampai, jamBerangkat, jamBerangkatSampai, pulang, pulangSampai, jamPulang, jamPulangSampai, keterangan, status)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penerbangan/jadwal/insert',
					data:
					{
						kode: kode,
						pesawat: pesawat,
						rute: rute,
						tipePenerbangan: tipePenerbangan,
						berangkat: berangkat,
						berangkatSampai: berangkatSampai,
						jamBerangkat: jamBerangkat,
						jamBerangkatSampai: jamBerangkatSampai,
						pulang: pulang,
						pulangSampai: pulangSampai,
						jamPulang: jamPulang,
						jamPulangSampai: jamPulangSampai,
						keterangan: keterangan,
						status: status
					}
				})
			},
			update(id, kode, pesawat, rute, tipePenerbangan, berangkat, berangkatSampai, jamBerangkat, jamBerangkatSampai, pulang, pulangSampai, jamPulang, jamPulangSampai, keterangan, status)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penerbangan/jadwal/update',
					data:
					{
						id: id,
						kode: kode,
						pesawat: pesawat,
						rute: rute,
						tipePenerbangan: tipePenerbangan,
						berangkat: berangkat,
						berangkatSampai: berangkatSampai,
						jamBerangkat: jamBerangkat,
						jamBerangkatSampai: jamBerangkatSampai,
						pulang: pulang,
						pulangSampai: pulangSampai,
						jamPulang: jamPulang,
						jamPulangSampai: jamPulangSampai,
						keterangan: keterangan,
						status: status
					}
				})
			},
			delete(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penerbangan/jadwal/delete',
					data: {id:id}
				})
			}
		},
		penerbanganRute:
		{
			insert(kode, kota_asal, kota_tujuan, bandara_asal, bandara_tujuan, jarak, harga, status)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penerbangan/rute/insert',
					data:
					{
						kode: kode,
						kota_asal: kota_asal,
						kota_tujuan: kota_tujuan,
						bandara_asal: bandara_asal,
						bandara_tujuan: bandara_tujuan,
						jarak: jarak,
						harga: harga,
						status
					}
				})
			},
			update(id, kode, kota_asal, kota_tujuan, bandara_asal, bandara_tujuan, jarak, harga, status)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penerbangan/rute/update',
					data:
					{
						id: id,
						kode: kode,
						kota_asal: kota_asal,
						kota_tujuan: kota_tujuan,
						bandara_asal: bandara_asal,
						bandara_tujuan: bandara_tujuan,
						jarak: jarak,
						harga: harga,
						status
					}
				})
			},
			delete(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penerbangan/rute/delete',
					data: {id: id}
				})
			}
		},
		keretaData:
		{
			insert(kode, nama, keterangan, kursi, status)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>kereta/data/insert',
					data:
					{
						kode: kode,
						nama: nama,
						keterangan: keterangan,
						kursi: kursi,
						status: status
					}
				})
			},
			update(id, kode, nama, keterangan, kursi, status)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>kereta/data/update',
					data:
					{
						id: id,
						kode: kode,
						nama: nama,
						keterangan: keterangan,
						kursi: kursi,
						status: status
					}
				})
			},
			delete(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>kereta/data/delete',
					data:
					{
						id:id
					}
				})
			}
		},
		pesawatData:
		{
			insert(maskapai, kode, nama, deskripsi, kursi, status)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pesawat/data/insert',
					data: 
					{
						maskapai: maskapai,
						kode: kode,
						nama: nama,
						deskripsi: deskripsi,
						kursi: kursi,
						status: status
					}
				})
			},
			update(id, maskapai, kode, nama, deskripsi, kursi, status)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pesawat/data/update',
					data: 
					{
						id: id,
						maskapai: maskapai,
						kode: kode,
						nama: nama,
						deskripsi: deskripsi,
						kursi: kursi,
						status: status
					}
				})
			},
			delete(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pesawat/data/delete',
					data: {id:id}
				})
			}
		},
		referensiBandara:
		{
			insert(kode, negara, kota, nama, deskripsi)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/bandara/insert',
					data: {
						kode: kode,
						negara: negara,
						kota: kota,
						nama: nama,
						deskripsi: deskripsi
					}
				})
			},
			update(id, kode, negara, kota, nama, deskripsi)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/bandara/update',
					data: {
						id: id,
						kode: kode,
						negara: negara,
						kota: kota,
						nama: nama,
						deskripsi: deskripsi
					}
				})
			},
			delete(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/bandara/delete',
					data: {id:id}
				})
			}
		},
		referensiStasiun:
		{
			insert(kota, nama, keterangan)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/stasiun/insert',
					data: 
					{
						kota: kota,
						nama: nama,
						keterangan: keterangan
					}
				})
			},
			update(id, kota, nama, keterangan)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/stasiun/update',
					data: 
					{
						id: id,
						kota: kota,
						nama: nama,
						keterangan: keterangan
					}
				})	
			},
			delete(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/stasiun/delete',
					data: { id: id }
				})	
			}
		},
		referensiKota:
		{
			insert(kode, nama, keterangan)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/kota/insert',
					data:
					{
						kode: kode,
						nama: nama,
						keterangan: keterangan
					}
				})
			},
			update(id, kode, nama, keterangan)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/kota/update',
					data:
					{
						id: id,
						kode: kode,
						nama: nama,
						keterangan: keterangan
					}
				})
			},
			delete(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/kota/delete',
					data: {id:id}
				})
			}
		},
		referensiMaskapai:
		{
			delete(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/maskapai/delete',
					data: {id:id}
				})
			}
		},
		referensiNegara:
		{
			delete(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/negara/delete',
					data: {id:id}
				})
			}
		},
		referensiKelas:
		{
			insert(kode, nama, harga)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/kelas/insert',
					data: 
					{
						kode: kode,
						nama: nama,
						harga: harga
					}
				})
			},
			update(id, kode, nama, harga)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/kelas/update',
					data: 
					{
						id: id,
						kode: kode,
						nama: nama,
						harga: harga
					}
				})
			},
			delete(id)
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/kelas/delete',
					data: {id:id}
				})
			}
		},
		login: {
			cekLogin: (email, password) =>
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>login/doLogin',
					data: {
						email: email,
						password: password
					}
				})
			}
		},
		pengaturanPengguna: {
			insert: function(password, email, name, phone, address, lev_id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/pengguna/insert',
					data: {
						password: password,
						email: email,
						name: name,
						phone: phone,
						address: address,
						lev_id: lev_id
					}
				})
			},

			update: function(id, password, email, name, phone, address, lev_id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/pengguna/update',
					data: {
						id: id,
						password: password,
						email: email,
						name: name,
						phone: phone,
						address: address,
						lev_id: lev_id
					}
				})
			},

			delete: function(id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/pengguna/delete',
					data: {
						id: id
					}
				})
			},
		},
		pengaturanLevel: {
			insert: function(nama, deskripsi, status) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/level/insert',
					data: {
						nama: nama,
						deskripsi: deskripsi,
						status: status
					}
				})
			},

			update: function(id, nama, deskripsi, status) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/level/update',
					data: {
						id: id,
						nama: nama,
						deskripsi: deskripsi,
						status: status
					}
				})
			},

			delete: function(id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/level/delete',
					data: {
						id: id
					}
				})
			},
		},
		pengaturanMenu: {
			insert: function(menu_menu_id, name, description, index, icon, url, status) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/menu/insert',
					data: {
						menu_menu_id: menu_menu_id,
						name: name,
						description: description,
						index: index,
						icon: icon,
						url: url,
						status: status
					}
				})
			},

			update: function(id, menu_menu_id, name, description, index, icon, url, status) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/menu/update',
					data: {
						id: id,
						menu_menu_id: menu_menu_id,
						name: name,
						description: description,
						index: index,
						icon: icon,
						url: url,
						status: status
					}
				})
			},

			delete: function(id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/menu/delete',
					data: {
						id: id
					}
				})
			},
		},
		pengaturanRoleAplikasi: {
			insert: function(lev_id, menu_id, menu_menu_id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/hakAkses/insert',
					data: {
						lev_id: lev_id,
						menu_id: menu_id,
						menu_menu_id: menu_menu_id
					}
				})
			},
			update: function(id, lev_id, menu_id, menu_menu_id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/hakAkses/update',
					data: {
						id: id,
						lev_id: lev_id,
						menu_id: menu_id,
						menu_menu_id: menu_menu_id
					}
				})
			},
			delete: function(id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/hakAkses/delete',
					data: {
						id: id
					}
				})
			},
		},
		code:
		{
			getCodeJadwalPerjalanan()
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>code/getCodeJadwalPerjalanan',
					data: null
				})
			},
			getCodeJadwal()
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>code/getCodeJadwal',
					data: null
				})
			},
			getCodeKereta()
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>code/getCodeKereta',
					data: null
				})
			},
			getCodeKeretaRute()
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>code/getCodeKeretaRute',
					data: null
				})
			},
			getCodePenerbanganRute()
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>code/getCodePenerbanganRute',
					data: null
				})
			},
			getCodeMaskapai()
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>code/getCodeMaskapai',
					data: null
				})
			},
			getCodeKelas()
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>code/getCodeKelas',
					data: null
				})
			},
			getCodeBandara()
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>code/getCodeBandara',
					data: null
				})
			}
		},
		filter:{
			getValueKota()
			{
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueKota',
					data: null
				})
			},
			pengaturanMenuParent: function() {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValuePengaturanMenuParent',
					data: null
				})
			},
			pengaturanSubMenu: function(menu_id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueSubMenu',
					data: {
						menu_id: menu_id
					}
				})
			},
			pengaturanPenggunaLevel: function() {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValuePengaturanPenggunaLevel',
					data: null
				})
			},
			pengaturanLevel: function() {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueLevel',
					data: null
				})
			},
			referensiMenu: function() {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueMenu',
					data: null
				})
			}
		},
	}

	initAjax()
})