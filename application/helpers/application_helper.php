<?php defined('BASEPATH') OR exit('No direct script access allowed');

function generate($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function rupiah($angka){
    $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
    return $hasil_rupiah;
}

function dolar($angka)
{
	$dolar = " $" . number_format($angka, 0 , ',', '.');

	return $dolar;
}

function psql_date_format($time = NULL) {
	if($time === NULL) $time = time();
	return date('Y-m-d', $time);
}

function psql_datetime_format($time = NULL) {
	if($time === NULL) $time = time();
	return date('Y-m-d H:i:s', $time);
}

function psql_time_format($time = NULL) {
	if($time === NULL) $time = time();
	return date('H:i:s', $time);
}

const ID_MONTHS = array(
	1 => 'Januari',
	'Februari',
	'Maret',
	'April',
	'Mei',
	'Juni',
	'Juli',
	'Agustus',
	'September',
	'Oktober',
	'November',
	'Desember',
);

const ID_DAYS = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu');

function id_date_format($time = NULL, $format = 'long') {
	if($time === NULL) $time = time();
	$gd = getdate($time);
	if(!in_array($format, array('long', 'short', 'medium'))) {
		$format = 'long';
	}
	switch ($format) {
		case 'long':
			return ID_DAYS[$gd['wday']] . ', ' . $gd['mday'] . ' ' . ID_MONTHS[$gd['mon']] . ' ' . $gd['year'];
			break;

		case 'short':
			return $gd['mday'] . ' ' . substr(ID_MONTHS[$gd['mon']], 0, 3) . ' ' . $gd['year'];
			break;

		case 'medium':
			return $gd['mday'] . ' ' . ID_MONTHS[$gd['mon']] . ' ' . $gd['year'];
			break;
	}
}

function diff_minutes($d1, $d2) {
	$d1 = new DateTime($d1);
	$d2 = new DateTime($d2);
	$diff = $d1->diff($d2);
	$hours = (Int) $diff->format('%r%h');
	$minutes = (Int) $diff->format('%r%i');
	return round(($hours * 60 + $minutes) / 60);
}