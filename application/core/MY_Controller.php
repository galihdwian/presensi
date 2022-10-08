<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of MY_Controller
 * @author Imam Syaifulloh <imam.syaifulloh12 at gmail.com>
 *
 * @property MY_Model $MY_Model
 */
class MY_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $timezone = "Asia/Jakarta";
        date_default_timezone_set($timezone);
        $this->load->model('MY_Model');
    }

    /**
     * sendTelegramBot >> digunakan untuk melakukan pengiriman pesan notifikasi telegram
     * @param string $type
     * @param sring $namaPemohon
     * @return json $result
     */
    protected function sendTelegramBot($type = 'PERMOHONAN', $namaPemohon = null, $message = null)
    {
        $url = 'https://rsmargono.jatengprov.go.id/imamzbot_telegram/setMessage';
        $timeStamp = time();
        $key = 'jdu4sVjhCgVdqbehAM2haKneRY3wQmBm';
        $idApp = 'PPID';
        $plain = "$idApp&$key&$timeStamp";
        $words = sha1($plain);
        $message = !empty($message) ? $message : "*::PPID::*\n\nAda permohonan online masuk dari *$namaPemohon*, silahkan cek https://rsmargono.jatengprov.go.id/ppid/login";
        if ($type == 'PERMOHONAN') {
            $message = "*::PPID::*\n\nAda permohonan online masuk dari *$namaPemohon*, silahkan cek https://rsmargono.jatengprov.go.id/ppid/login";
        } elseif ($type == 'KEBERATAN') {
            $message = "*::PPID::*\n\nAda pengajuan keberatan online masuk dari *$namaPemohon*, silahkan cek https://rsmargono.jatengprov.go.id/ppid/login";
        } elseif ($type == 'PENDAFTARAN') {
            $message = "*::PPID::*\n\nAda pendaftaran akun PPID baru atas nama dari *$namaPemohon*, silahkan cek https://rsmargono.jatengprov.go.id/ppid/login";
        } elseif ($type == 'AKTIVASI') {
            $message = "*::PPID::*\n\n*$namaPemohon* telah berhasil melakukan aktivasi akun, silahkan cek https://rsmargono.jatengprov.go.id/ppid/login";
        }
        $data = array(
            'idApp' => $idApp,
            'timeStamp' => $timeStamp,
            'words' => $words,
            'plain' => $plain,
            'typeMessage' => 'GROUP',
            'message' => $message
        );
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type:application/x-www-form-urlencoded\r\n",
                'content' => http_build_query($data),
            ),
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return $result;
    }

    /**
     * digunakan untuk membuat siganture header saat proses bridging
     *
     * @param string $apikey
     * @param string $wsid
     * @param string $wssecret
     * @param string $tStamp
     * @return array
     */
    protected function _generate_header_sign($apikey, $wsid, $wssecret, $tStamp = NULL)
    {
        $tStamp = $tStamp == NULL ? time() : $tStamp;
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
        return $header_data;
    }

    /**
     * digunakan untuk melakukan sensor email
     *
     * @param string $email
     * @return string
     */
    protected function obfuscate_email($email)
    {
        $em   = explode("@", $email);
        $name = implode('@', array_slice($em, 0, count($em) - 1));
        $len  = floor(strlen($name) / 2);

        return substr($name, 0, $len) . str_repeat('*', $len) . "@" . end($em);
    }

    /**
     * digunakan untuk melakukan validasi apakah tangggal sesuai dengan format
     *
     * @param string $date
     * @param string $format
     * @return bool
     */
    protected function _validate_date_format($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    /**
     * digunakan untuk mengkonversi tanggal sesuai dengan format
     *
     * @param string $date_string
     * @param string $format
     * @return string
     */
    protected function convert_date_format($date_string, $format = 'Y-m-d H:i:s')
    {
        $date = date_create($date_string);
        return date_format($date, $format);
    }

    /**
     * digunakan untuk melakukan perhitungan selisih waktu dari dua tanggal
     *
     * @param string $awal
     * @param string $akhir
     * @return string
     */
    protected function selisih_waktu($awal = null, $akhir = null)
    {
        if ($awal != null && $akhir != null) {
            $str_awal = strtotime($awal); //waktu awal
            $str_akhir = strtotime($akhir); //waktu akhir
            $diff = $str_akhir - $str_awal;
            $jam = floor($diff / (60 * 60));
            $menit = $diff - $jam * (60 * 60);
            return $jam . ' jam, ' . floor($menit / 60) . ' menit';
        }
    }

    /**
     * _buat_captcha
     * Method to create capthca
     */
    protected function _buat_captcha()
    {
        $this->load->helper('captcha');
        $vals = array(
            'img_path' => './assets/captcha/',
            'img_url' => base_url() . 'assets/captcha/',
            'img_width' => 173,
            'img_height' => 40,
            'expiration' => 900,
            'word_length' => 6,
            'pool' => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        );
        $cap = create_captcha($vals);
        $data = array(
            'captcha_time' => $cap['time'],
            'word' => $cap['word']
        );
        $this->MY_Model->insert_data('captcha', $data);
        return $cap;
    }

    //END OF class MY_Controller
}

class Admin_Controller extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("informasipublikadmin_model");
        date_default_timezone_set("Asia/Jakarta");
        $this->load->helper('form');
        $this->load->model('MY_Model');
        $this->_is_logged_in();
        $this->_akses();
    }

    private function _is_logged_in()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('');
        }
    }

    private function _akses()
    {
        if ($this->session->userdata('hak_akses') == '3') {
            redirect('poliklinik');
        } elseif ($this->session->userdata('hak_akses') == '9' || $this->session->userdata('hak_akses') == '10' || $this->session->userdata('hak_akses') == '11') {
            redirect('adminpengadaan');
        }
    }
}
