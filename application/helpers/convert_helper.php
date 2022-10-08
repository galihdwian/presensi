<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('tgl_indo')) {

    function tgl_indo($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        return $pecah[2] . '-' . $pecah[1] . '-' . $pecah[0];
    }

}

if (!function_exists('detail_jk')) {

    function detail_jk($jk)
    {
        $detail = "";
        if ($jk == 'L') {
            $detail = "Laki-Laki";
        } elseif ($jk == 'P') {
            $detail = "Perempuan";
        }
        return $detail;
    }

}

if (!function_exists('detail_agama')) {

    function detail_agama($agama)
    {
        $detail = "";
        if ($agama == 'IS') {
            $detail = "Islam";
        } elseif ($agama == 'KP') {
            $detail = "Kristen Protestan";
        } elseif ($agama == 'KA') {
            $detail = "Katolik";
        } elseif ($agama == 'HI') {
            $detail = "Hindu";
        } elseif ($agama == 'BU') {
            $detail = "Buddha";
        }
        return $detail;
    }

}

if (!function_exists('tgl_sql')) {

    function tgl_sql($tgl)
    {
        //dd-mm-yyyy
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        return $pecah[2] . '-' . $pecah[1] . '-' . $pecah[0];
    }

}

if (!function_exists('date_indo')) {

    function date_indo($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = $pecah[1];
        $tahun = $pecah[0];
        $pecahtanggal = explode(" ", $tanggal);
        $waktu = $pecahtanggal[1];
        $tgl = $pecahtanggal[0];
        return $tgl . '-' . $bulan . '-' . $tahun . ' ' . $waktu;
    }

}

if (!function_exists('getUrls')) {

    function getUrls($string)
    {
        $regex = '/http?\:\/\/[^\" ]+/i';
        preg_match_all($regex, $string, $matches);
        return ($matches[0]);
    }

}

if (!function_exists('nama_bulan')) {

    function nama_bulan($str)
    {
        $nama_bln = "";
        switch ($str) {
            case '1':
                $nama_bln = 'Januari';
                break;
            case '2':
                $nama_bln = 'Februari';
                break;
            case '3':
                $nama_bln = 'Maret';
                break;
            case '4':
                $nama_bln = 'April';
                break;
            case '5':
                $nama_bln = 'Mei';
                break;
            case '6':
                $nama_bln = 'Juni';
                break;
            case '7':
                $nama_bln = 'Juli';
                break;
            case '8':
                $nama_bln = 'Agustus';
                break;
            case '9':
                $nama_bln = 'September';
                break;
            case '10':
                $nama_bln = 'Oktober';
                break;
            case '11':
                $nama_bln = 'November';
                break;
            case '12':
                $nama_bln = 'Desember';
                break;
            default:
                break;
        }
        return $nama_bln;
    }

}
if (!function_exists('get_date_from_time')) {

    function get_date_from_time($tgl)
    {
        if (!empty($tgl)):
            $ubah = gmdate($tgl, time() + 60 * 60 * 8);
            $pecah = explode("-", $ubah);
            $tanggal = $pecah[2];
            $bulan = nama_bulan($pecah[1]);
            $tahun = $pecah[0];
            $pecahtanggal = explode(" ", $tanggal);
            $tgl = $pecahtanggal[0];
            return $tgl . ' ' . $bulan . ' ' . $tahun;
        endif;
    }

}

if (!function_exists('date_sql')) {

    function date_sql($tgl)
    {
        //10-11-2016 15:29:44
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[0];
        $bulan = $pecah[1];
        $tahun = $pecah[2];
        $pecahtahun = explode(" ", $tahun);
        $waktu = $pecahtahun[1];
        $th = $pecahtahun[0];
        return $th . '-' . $bulan . '-' . $tanggal . ' ' . $waktu;
    }

}

if (!function_exists('validate_date')) {

    /**
     * validate_date
     * @param string $tgl
     * @param string $format ID / SQL
     * @return boolean
     */
    function validate_date($tgl = null, $format = 'ID')
    {
        if ($tgl != null) {
            $explode_tgl = explode('-', $tgl);
            if (count($explode_tgl) == 3) {
                $valid_date = false;
                if ($format == 'ID') {
                    //dd-mm-yyyy
                    $day = $explode_tgl[0];
                    $month = $explode_tgl[1];
                    $year = $explode_tgl[2];
                    $valid_date = checkdate($month, $day, $year);
                }
                if ($format == 'SQL') {
                    //yyyy-mm-dd
                    $day = $explode_tgl[2];
                    $month = $explode_tgl[1];
                    $year = $explode_tgl[0];
                    $valid_date = checkdate($month, $day, $year);
                }
                return $valid_date;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
