<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


if (!function_exists('bridging_apps')) {

    function bridging_apps($url = NULL, $bridge = NULL) {
        if ($url != NULL && $bridge != NULL) {
            if ($bridge == 'APPS') {
                $apikey = "0dc56bbf95e2f4a7d3369c5446130c2cbc5e37e2";
            } elseif ($bridge == 'RSMSONLINE') {
                $apikey = "4cfa5fa72a1120a42baaca598cfe6ec8";
            }
            $base_appsurl = "http://36.67.13.3:6251/";
            $header_data = array(
                "Content-Type: application/json",
                "Accept: application/json",
                "X-API-KEY:" . $apikey
            );
            $ch = curl_init();
            $curlOpts = array(
                CURLOPT_URL => $base_appsurl . $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $header_data,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HEADER => 0,
            );
            curl_setopt_array($ch, $curlOpts);
            $answer = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($answer);
            return $result;
        }
    }

}

if (!function_exists('bridging_webrsms')) {

    function bridging_webrsms($url = NULL) {
        if ($url != NULL) {
            $base_weburl = "https://rsmargono.go.id/";
            $wsid = "WEBRSMS";
            $wssecret = "webRSMS2o17";
            $apikey = "0dc56bbf95e2f4a7d3369c5446130c2cbc5e37e2";
            date_default_timezone_set('UTC');
            $date = new DateTime();
            $tStamp = $date->getTimestamp();
            $signature = hash_hmac('sha256', $wsid . "&" . $tStamp, $wssecret, true);
            $encodedSignature = base64_encode($signature);
            $header_data = array(
                "Content-Type: application/json",
                "Accept: application/json",
                "X-API-KEY:" . $apikey,
                "X-WS-SIGNATURE:" . $encodedSignature,
                "X-WS-ID:" . $wsid,
                "X-TIMESTAMP:" . $tStamp
            );
            $ch = curl_init();
            $curlOpts = array(
                CURLOPT_URL => $base_weburl . $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $header_data,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HEADER => 0,
            );
            curl_setopt_array($ch, $curlOpts);
            $answer = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($answer);
            return $result;
        }
    }

}

if (!function_exists('bridging_opendata')) {

    function bridging_opendata($url = NULL) {
        if ($url != NULL) {     
            $apikey = "46A6A3813DC2A7AFBD8EE262AEC396D98BCCC6A9";
            $base_appsurl = "https://rsmargono.go.id/rsms-opendata/";
            $header_data = array(
                "Content-Type: application/json",
                "Accept: application/json",
                "X-API-KEY:" . $apikey
            );
            $ch = curl_init();
            $curlOpts = array(
                CURLOPT_URL => $base_appsurl . $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $header_data,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HEADER => 0,
            );
            curl_setopt_array($ch, $curlOpts);
            $answer = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($answer);
            return $result;
        }
    }

}