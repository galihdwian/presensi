<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('tgl_indo')) {

    function tgl_indo($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = bulan($pecah[1]);
        $tahun = $pecah[0];
        $pecahtanggal = explode(" ", $tanggal);
        $waktu = $pecahtanggal[1];
        $tgl = $pecahtanggal[0];
        return $tgl . ' ' . $bulan . ' ' . $tahun . ' - ' . $waktu;
    }
}
if (!function_exists('tgl_indo2')) {

    function tgl_indo2($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = $pecah[1];
        $tahun = $pecah[0];
        $pecahtanggal = explode(" ", $tanggal);
        $waktu = $pecahtanggal[1];
        $tgl = $pecahtanggal[0];
        return $tgl . '/' . $bulan . '/' . $tahun . ' - ' . $waktu;
    }
}

if (!function_exists('format_indo')) {

    function format_indo($tgl, $namabulan = FALSE)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = $namabulan == FALSE ? $pecah[1] : nama_bulan($pecah[1]);
        $tahun = $pecah[0];
        $pecahtanggal = explode(" ", $tanggal);
        $waktu = $pecahtanggal[1];
        $tgl = $pecahtanggal[0];
        return $namabulan == FALSE ? $tgl . '-' . $bulan . '-' . $tahun . ' ' . $waktu : $tgl . ' ' . $bulan . ' ' . $tahun . ' Pukul ' . $waktu . ' WIB';
    }
}

if (!function_exists('nama_bulan')) {

    function nama_bulan($bln)
    {
        switch ($bln) {
            case 0;
                return "Pilih Bulan";
                break;
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

if (!function_exists('bulan_romawi')) {

    function bulan_romawi($bln)
    {
        switch ($bln) {
            case 1:
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            case 12:
                return "XII";
                break;
        }
    }
}

if (!function_exists('bulan_doble')) {

    function bulan_doble($bln)
    {
        switch ($bln) {
            case 1:
                return "01";
                break;
            case 2:
                return "02";
                break;
            case 3:
                return "03";
                break;
            case 4:
                return "04";
                break;
            case 5:
                return "05";
                break;
            case 6:
                return "06";
                break;
            case 7:
                return "07";
                break;
            case 8:
                return "08";
                break;
            case 9:
                return "09";
                break;
            case 10:
                return "10";
                break;
            case 11:
                return "11";
                break;
            case 12:
                return "12";
                break;
        }
    }
}

if (!function_exists('bulan_singgle')) {

    function bulan_singgle($bln)
    {
        switch ($bln) {
            case "01":
                return "1";
                break;
            case "02":
                return "2";
                break;
            case "03":
                return "3";
                break;
            case "04":
                return "4";
                break;
            case "05":
                return "5";
                break;
            case "06":
                return "6";
                break;
            case "07":
                return "7";
                break;
            case "08":
                return "8";
                break;
            case "09":
                return "9";
                break;
            case "10":
                return "10";
                break;
            case "11":
                return "11";
                break;
            case "12":
                return "12";
                break;
        }
    }
}

if (!function_exists('tgl_indo1')) {

    function tgl_indo1($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = $pecah[1];
        $tahun = $pecah[0];
        return $tanggal . '-' . $bulan . '-' . $tahun;
    }
}
if (!function_exists('tgl_indo3')) {

    function tgl_indo3($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal . ' ' . $bulan . ' ' . $tahun;
    }
}

if (!function_exists('nama_hari')) {

    function nama_hari($tanggal)
    {
        $ubah = gmdate($tanggal, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tgl = $pecah[2];
        $bln = $pecah[1];
        $thn = $pecah[0];

        $nama = date("l", mktime(0, 0, 0, $bln, $tgl, $thn));
        $nama_hari = "";
        if ($nama == "Sunday") {
            $nama_hari = "Minggu";
        } else if ($nama == "Monday") {
            $nama_hari = "Senin";
        } else if ($nama == "Tuesday") {
            $nama_hari = "Selasa";
        } else if ($nama == "Wednesday") {
            $nama_hari = "Rabu";
        } else if ($nama == "Thursday") {
            $nama_hari = "Kamis";
        } else if ($nama == "Friday") {
            $nama_hari = "Jumat";
        } else if ($nama == "Saturday") {
            $nama_hari = "Sabtu";
        }
        return $nama_hari;
    }
}

if (!function_exists('hitung_mundur')) {

    function hitung_mundur($wkt)
    {
        $hitung = strtotime(date("Y-m-d H:i:s", time())) - $wkt;
        $hasil = array();
        if ($hitung < 1) {
            $hasil = $hitung;
        } else {
            $hasil = $hitung;
        }
        return $hasil;
    }
}

if (!function_exists('nama_pasaran')) {

    function nama_pasaran($tgl2)
    {
        // cari tanggal yang memiliki pasaran Pon
        $tgl1 = "1991-09-12";
        // array urutan nama hari pasaran dimulai dari 'Pon'
        $pasaran = array('Pon', 'Wage', 'Kliwon', 'Legi', 'Pahing');

        // proses mencari selisih hari antara kedua tanggal
        $pecah1 = explode("-", $tgl1);
        $date1 = $pecah1[2];
        $month1 = $pecah1[1];
        $year1 = $pecah1[0];

        $pecah2 = explode("-", $tgl2);
        $date2 = $pecah2[2];
        $month2 = $pecah2[1];
        $year2 = $pecah2[0];

        $jd1 = GregorianToJD($month1, $date1, $year1);
        $jd2 = GregorianToJD($month2, $date2, $year2);

        $selisih = $jd2 - $jd1;

        // hitung modulo 5 dari selisih harinya
        $mod = $selisih % 5;

        // menampilkan nama hari pasaran, yaitu elemen ke-$mod dari array $pasaran
        return $pasaran[$mod];
    }
}

//cek tanggal lahir
if (!function_exists('cek_lahir')) {

    function cek_lahir($tgl)
    {
        $pecah = explode("-", $tgl);
        $tanggal = $pecah[0];
        $bulan = $pecah[1];
        $tahun = $pecah[2];

        $tanggalnow = date('d');
        $bulannow = date('m');
        $tahunnow = date('Y');
        $hasil = $tanggal;
        if ($tahun === $tahunnow) {
            if ($bulan === $bulannow) {
                if ($tanggal === $tanggalnow) {
                    return TRUE;
                } elseif ($tanggal < $tanggalnow) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            } elseif ($bulan < $bulannow) {
                return TRUE;
            } else {
                return FALSE;
            }
        } elseif ($tahun < $tahunnow) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

//cek tgl bila nilainya 0000
if (!function_exists('tgl_nol')) {

    function tgl_nol($tgl)
    {
        $pecah = explode("-", $tgl);
        $tanggal = $pecah[0];
        $bulan = $pecah[1];
        $tahun = $pecah[2];
        if ($tanggal == 0 || $bulan == 0 || $tahun == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}

//format tgl input ke sql
if (!function_exists('tgl_sql')) {

    function tgl_sql($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        if (count($pecah) == 3) {
            $tanggal = $pecah[0];
            $bulan = $pecah[1];
            $tahun = $pecah[2];
            return $tahun . '-' . $bulan . '-' . $tanggal;
        }
    }
}

if (!function_exists('format_sql')) {

    function format_sql($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[0];
        $bulan = $pecah[1];
        $tahun = $pecah[2];
        $pecahtanggal = explode(" ", $tahun);
        $waktu = $pecahtanggal[1];
        $tahun = $pecahtanggal[0];
        return $tahun . '-' . $bulan . '-' . $tanggal . ' ' . $waktu;
    }
}

//saat ini
if (!function_exists('saat_ini')) {

    function saat_ini()
    {
        $timezone = "Asia/Jakarta";
        date_default_timezone_set($timezone);
        $tanggal = date('Y-m-d', time());
        $saatini = nama_hari($tanggal) . ' ' . nama_pasaran($tanggal) . ', ' . tgl_indo($tanggal);
        return $saatini;
    }
}

if (!function_exists('saat_ini1')) {

    function saat_ini1()
    {
        $timezone = "Asia/Jakarta";
        date_default_timezone_set($timezone);
        $tanggal = date('Y-m-d', time());
        $saatini = tgl_indo1($tanggal);
        return $saatini;
    }
}

if (!function_exists('jenis_kelamin_detail')) {

    function jenis_kelamin_detail($jk)
    {
        if ($jk == 'L') {
            $jk_detail = 'Laki-Laki';
        } elseif ($jk == 'P') {
            $jk_detail = 'Perempuan';
        }
        return $jk_detail;
    }
}

if (!function_exists('hitungumurduatgl')) {

    function hitungumurduatgl($tgllahir, $pertgl, $show = 'PLAIN')
    {
        // list($tgl_lahir, $bln_lahir, $thn_lahir) = explode("-", $tgllahir);
        // list($tanggal_today, $bulan_today, $tahun_today) = explode("-", $perpage);
        // $harilahir = gregoriantojd($bln_lahir, $tgl_lahir, $thn_lahir);
        // $hariini = gregoriantojd($bulan_today, $tanggal_today, $tahun_today);
        // $umur = $hariini - $harilahir;
        // $tahun = $umur / 365; //menghitung usia tahun
        // $sisa = $umur % 365; //sisa pembagian dari tahun untuk menghitung bulan
        // $bulan = $sisa / 30; //menghitung usia bulan
        // $hari = $sisa % 30; //menghitung sisa hari
        $bday = new DateTime($tgllahir); // Your date of birth
        $today = new Datetime($pertgl);
        $diff = $today->diff($bday);
        if ($show == 'PLAIN')
            return $diff->y . "-" . $diff->m . "-" . $diff->d;
        if ($show == 'BEAUTY')
            return $diff->y . " Th " . $diff->m . " Bln " . $diff->d . " Hari";
    }
}

if (!function_exists('safe_b64encode')) {

    function safe_b64encode($string)
    {

        $data = base64_encode($string);
        $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
        return $data;
    }
}

if (!function_exists('safe_b64decode')) {

    function safe_b64decode($string)
    {
        $data = str_replace(array('-', '_'), array('+', '/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
}

//end
