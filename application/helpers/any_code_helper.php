<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('setFlashData')) {
	function setFlashData($status, $flashMsg)
	{
		$CI = &get_instance();
		$CI->session->set_flashdata($status, $flashMsg);
	}
}

if (!function_exists('format_rupiah')) {
	function format_rupiah($value)
	{
		$a = (string)$value; //membuat $value menjadi string
		$len = strlen($a); //menghitung panjang string $a

		if ($len <= 18) {
			$ratril = $len - 3 - 1;
			$ramil = $len - 6 - 1;
			$rajut = $len - 9 - 1; //untuk mengecek apakah ada nilai ratusan juta (9angka dari belakang)
			$juta = $len - 12 - 1; //untuk mengecek apakah ada nilai jutaan (6angka belakang)
			$ribu = $len - 15 - 1; //untuk mengecek apakah ada nilai ribuan (3angka belakang)

			$angka = '';
			for ($i = 0; $i < $len; $i++) {
				if ($i == $ratril) {
					$angka = $angka . $a[$i] . ".";
				} else if ($i == $ramil) {
					$angka = $angka . $a[$i] . ".";
				} else if ($i == $rajut) {
					$angka = $angka . $a[$i] . "."; //meletakkan tanda titik setelah 3angka dari depan
				} else if ($i == $juta) {
					$angka = $angka . $a[$i] . "."; //meletakkan tanda titik setelah 6angka dari depan
				} else if ($i == $ribu) {
					$angka = $angka . $a[$i] . "."; //meletakkan tanda titik setelah 9angka dari depan
				} else {
					$angka = $angka . $a[$i];
				}
			}
		}
		return $angka . ",-";
	}
}

if (!function_exists('tgl_indo')) {
	function tgl_indo($tgl)
	{
		$ubah = gmdate($tgl, time() + 60 * 60 * 8);
		$pecah = explode("-", $ubah);
		$tanggal = $pecah[2];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[0];
		return $tanggal . ' ' . $bulan . ' ' . $tahun;
	}
}

if (!function_exists('bulan')) {
	function bulan($bln)
	{
		switch ($bln) {
			case 1:
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	}
}

if (!function_exists('indonesian_date')) {

	function indonesian_date($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = 'WIB')
	{
		if (trim($timestamp) == '') {
			$timestamp = time();
		} elseif (!ctype_digit($timestamp)) {
			$timestamp = strtotime($timestamp);
		}
		# remove S (st,nd,rd,th) there are no such things in indonesia :p
		$date_format = preg_replace("/S/", "", $date_format);
		$pattern = array(
			'/Mon[^day]/', '/Tue[^sday]/', '/Wed[^nesday]/', '/Thu[^rsday]/',
			'/Fri[^day]/', '/Sat[^urday]/', '/Sun[^day]/', '/Monday/', '/Tuesday/',
			'/Wednesday/', '/Thursday/', '/Friday/', '/Saturday/', '/Sunday/',
			'/Jan[^uary]/', '/Feb[^ruary]/', '/Mar[^ch]/', '/Apr[^il]/', '/May/',
			'/Jun[^e]/', '/Jul[^y]/', '/Aug[^ust]/', '/Sep[^tember]/', '/Oct[^ober]/',
			'/Nov[^ember]/', '/Dec[^ember]/', '/January/', '/February/', '/March/',
			'/April/', '/June/', '/July/', '/August/', '/September/', '/October/',
			'/November/', '/December/',
		);
		$replace = array(
			'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min',
			'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu',
			'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des',
			'Januari', 'Februari', 'Maret', 'April', 'Juni', 'Juli', 'Agustus', 'Sepember',
			'Oktober', 'November', 'Desember',
		);
		$date = date($date_format, $timestamp);
		$date = preg_replace($pattern, $replace, $date);
		$date = "{$date} {$suffix}";
		return $date;
	}
}

if (!function_exists('text_shorter')) {
	function text_shorter($text, $chars_limit)
	{
		// Check if length is larger than the character limit
		if (strlen($text) > $chars_limit)
		{
			// If so, cut the string at the character limit
			$new_text = substr($text, 0, $chars_limit);
			// Trim off white space
			$new_text = trim($new_text);
			// Add at end of text ...
			return $new_text . "...";
		}
		// If not just return the text as is
		else
		{
		return $text;
		}
	}
}
?>
