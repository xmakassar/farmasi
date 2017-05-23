<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* fungsi non database */
function tjs ($tgl, $tipe) {
	$pc_satu	= explode(" ", $tgl);
	if (count($pc_satu) < 2) {	
		$tgl1		= $pc_satu[0];
		$jam1		= "";
	} else {
		$jam1		= $pc_satu[1];
		$tgl1		= $pc_satu[0];
	}
	
	$pc_dua		= explode("-", $tgl1);
	$tgl		= $pc_dua[2];
	$bln		= $pc_dua[1];
	$thn		= $pc_dua[0];
	
	$bln_pendek		= array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des");
	$bln_panjang	= array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	
	$bln_angka		= intval($bln) - 1;
	
	if ($tipe == "l") {
		$bln_txt = $bln_panjang[$bln_angka];
	} else if ($tipe == "s") {
		$bln_txt = $bln_pendek[$bln_angka];
	}
	
	return $tgl." ".$bln_txt." ".$thn."  ".$jam1;
}

function hari($wekday) {
	$hari	= array("Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu","Minggu");
	return $hari[$wekday];
}

function emtpy_check($data, $teks) {
	if (empty($data)) {
		return $teks;
	} else {
		return $data;
	}
}

function terbilang($bilangan){
	$bilangan = abs($bilangan);

	$angka 	= array("Nol","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan","sepuluh","sebelas");
	$temp 	= "";

	if($bilangan < 12){
		$temp = " ".$angka[$bilangan];
	}else if($bilangan < 20){
		$temp = terbilang($bilangan - 10)." belas";
	}else if($bilangan < 100){
		$temp = terbilang($bilangan/10)." puluh".terbilang($bilangan%10);
	}else if ($bilangan < 200) {
		$temp = " seratus".terbilang($bilangan - 100);
	}else if ($bilangan < 1000) {
		$temp = terbilang($bilangan/100). " ratus". terbilang($bilangan % 100);
	}else if ($bilangan < 2000) {
		$temp = " seribu". terbilang($bilangan - 1000);
	}else if ($bilangan < 1000000) {
		$temp = terbilang($bilangan/1000)." ribu". terbilang($bilangan % 1000);
	}else if ($bilangan < 1000000000) {
		$temp = terbilang($bilangan/1000000)." juta". terbilang($bilangan % 1000000);
	}

	return $temp;
}

function tambah_jam_sql($menit) {
	$str = "";
	if ($menit < 60) {
		$str = "00:".str_pad($menit, 2, "0", STR_PAD_LEFT).":00";
	} else if ($menit >= 60) {
		$mod = $menit % 60;
		$bg = floor($menit / 60);
		$str = str_pad($bg, 2, "0", STR_PAD_LEFT).":".str_pad($mod, 2, "0", STR_PAD_LEFT).":00";
	}
	return $str;
}

function obj_to_array($obj, $pilih) {
	$pilihpc	= explode(",", $pilih);
	$array 		= array(""=>"-");
	foreach ($obj as $o) {
		$array[$o->$pilihpc[0]] = strtoupper($o->$pilihpc[1]); 
	}
	return $array;
}

function confirmed($status) {
	if ($status) {
		return "Ya";
	} else {
		return 'Tidak';
	}
}

function getData($list,$field) {
	$data = array();
    $header = array();
    foreach ($field as $field_name) {
        $header[] = array(strtoupper(str_replace("_"," ",$field_name))) ;   
    }
    foreach ($list as $customers) {
        $row = array();
        foreach ($field as $field_name) {
            $row[] = $customers->$field_name; ;   
        }
        $data[] = $row;
    }
    $getData = array(
    	"header" => $header,
    	"data" => $data
    	);
    return $getData;
}

function besar($text) {
	return strtoupper(str_replace("_"," ",$text));
}

function rupiah($angka) {
	$hasil = "Rp " . number_format($angka,2,',','.');
	return ($hasil);
}

function status($int) {
	if ($int==1) {
		$text = "YA";
	} else {
		$text = "Tidak";
	}
	return $text;
}

function date_database($date) {
	return date("Y-m-d",strtotime($date));
}

function date_show($date) {
	return date("d-m-Y",strtotime($date));
}
