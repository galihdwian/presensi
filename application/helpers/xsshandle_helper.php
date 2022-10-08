<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('xss_cetak')) {

    function xss_cetak($string) {
        $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
        echo $string;
    }

}

if (!function_exists('xss_check')) {

    function xss_check($string = null) {
        $contain_xss = false;
        if ($string != null) {
            if ($string != strip_tags($string)) {
                $contain_xss = true;
            } else {
                $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
                if (preg_match('/[\'^£$%&*}{@#~?><>,|=_+¬]/', $string)) {
                    $contain_xss = true;
                }
            }
        }
        return $contain_xss;
    }

}
?>