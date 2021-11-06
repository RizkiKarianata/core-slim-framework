<?php
function moveUploadedFile($directory, $uploadedFile)
{
	$extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
	$basename = bin2hex(random_bytes(8));
	$filename = sprintf('%s.%0.8s', $basename, $extension);

	$uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

	return $filename;
}

function splitText($value, $batas)
{
	$value = strip_tags($value);
	if (strlen($value) > $batas) {
		return substr($value, 0, $batas) . "...";
	} else {
		return $value;
	}
}

function formatRupiah($price = 0, $prefix = true, $decimal = 0)
{
	if ($price === '-' || empty($price)) {
		return '';
	} else {
		if ($prefix === "-") {
			return $price;
		} else {
			$rp = ($prefix) ? 'Rp. ' : '';

			if ($price < 0) {
				$price  = (float) $price * -1;
				$result = '(' . $rp . number_format($price, $decimal, ",", ".") . ')';
			} else {
				$price  = (float) $price;
				$result = $rp . number_format($price, $decimal, ",", ".");
			}
			return $result;
		}
	}
}

function timeSince($original)
{
	$chunks = array(array(60 * 60 * 24 * 365, 'tahun'), array(60 * 60 * 24 * 30, 'bulan'), array(60 * 60 * 24 * 7, 'minggu'), array(60 * 60 * 24, 'hari'), array(60 * 60, 'jam'), array(60, 'menit'));

	$today = time();
	$since = $today - $original;
	for($i = 0, $j = count($chunks); $i < $j; $i++) {
		$seconds = $chunks[$i][0];
		$name = $chunks[$i][1];
		if(($count = floor($since / $seconds)) != 0) {
			break;
		}
	}
	$print = ($count == 1) ? '1 '.$name : "$count {$name}";
	return $print.' yang lalu';
}

function configurationSeo($parameter)
{
	if ($parameter == "title") {
		return "title";
	} else if ($parameter == "description") {
		return "description";
	} else if ($parameter == "url") {
		return "url website";
	} else if ($parameter == "keyword") {
		return "keywords";
	} elseif ($parameter == "image") {
		return "image favicon";
	}
}

function getUserIp()
{
	if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
		$_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
		$_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
	}
	$client  = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote  = $_SERVER['REMOTE_ADDR'];
	if(filter_var($client, FILTER_VALIDATE_IP)) {
		$ip = $client;
	}
	elseif(filter_var($forward, FILTER_VALIDATE_IP)){
		$ip = $forward;
	}
	else {
		$ip = $remote;
	}
	return $ip;
}

function getClientBrowser()
{
	$browser = '';
	if(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape'))
		$browser = 'Netscape';
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox'))
		$browser = 'Firefox';
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome'))
		$browser = 'Chrome';
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera'))
		$browser = 'Opera';
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
		$browser = 'Internet Explorer';
	else
		$browser = 'Other';
	return $browser;
}

function formatDateIndonesia($str)
{
	$tr = trim($str);
	$str = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
	return $str;
}

function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
        $temp = penyebut($nilai - 10). " Belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " Seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " Seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
}

function terbilang($nilai)
{
    if($nilai < 0) {
        $hasil = "Minus ". trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }           
    return $hasil;
}
?>