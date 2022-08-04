<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of MY_Controller
 *
 * @author Galih Dwi A N <galihdwia007 at gmail.com>
 * @property model $MY_Model Base Model
 */
class MY_Controller extends MX_Controller
{

    //put your code here
    function __construct()
    {
        parent::__construct();
        $timezone = "Asia/Jakarta";
        date_default_timezone_set($timezone);
        $this->load->model('MY_Model');
        $this->load->helper('convert');
        $this->load->helper('defaultencrypt');
    }

    /**
     * _set_flash
     * Method to set flash data & redirect to specific page
     * @param	string	$text  parameter to set message default ERROR
     * @param string $redirect Url redirect page default login, ex.login
     * @param string $type type style messahe default alert-danger ex.alert-danger
     * @param string $title Title of flash message default message
     */
    function _set_flash($text = 'ERROR', $redirect = 'login', $type = 'alert-danger', $title = 'message')
    {
        $this->session->set_flashdata($title, '<div class="alert ' . $type . '">' . $text . '</div>');
        redirect($redirect);
    }

    /**
     * _generate_hash
     * Method to generate hash from string
     * @param	string	$pass  input password user or plain text.
     */
    function _generate_hash($pass = NULL)
    {
        if ($pass != NULL) {
            $this->load->helper('encrypthash');
            return ehash_make($pass);
        } else {
            return NULL;
        }
    }


    /**
     * _check_hash
     * Method to check hash and user password
     * @param	string	$password  input password user or plain password.
     * @param	string	$hashpass  hash password
     */
    function _check_hash($password = NULL, $hashpass = NULL)
    {
        if ($password == NULL || $hashpass == NULL) {
            return FALSE;
        } else {
            $this->load->helper('encrypthash');
            return ehash_check($password, $hashpass);
        }
    }

    /**
     * _generate_uuid
     * Method to gemerate UUID V4
     */
    function _generate_uuid()
    {
        $this->load->library('uuid');
        return $this->uuid->v4();
    }

    /**
     * _init_encryption
     * method untuk inisialisasi enkripsi
     */
    function _init_encryption()
    {
        $this->load->library('encryption');
        $this->encryption->initialize(
            array(
                'driver' => 'mcrypt',
                'cipher' => 'aes-256',
                'mode' => 'cbc',
                'key' => 'S4hvLPaYFrmTzLSBs47A9oDaW34ZWBsH'
            )
        );
    }

    /**
     * _encryptvar
     * method untuk encode variabel
     * @param string $str variable yang akan diennkripsi
     */
    function _encryptvar($str = NULL)
    {
        if ($str != NULL) {
            $this->_init_encryption();
            $enc_str = $this->encryption->encrypt($str);
            return safe_b64encode($enc_str);
        } else {
            return NULL;
        }
    }

    /**
     * _decryptvar
     * method untuk decode variabel
     * @param string $enc_str variable yang akan di decode
     */
    function _decryptvar($enc_str = NULL)
    {
        if ($enc_str != NULL) {
            $this->_init_encryption();
            $str = $this->encryption->decrypt(safe_b64decode($enc_str));
            return $str;
        } else {
            return NULL;
        }
    }

    /**
     * _setloguser
     * method untuk menyimpan log login
     * @param string $username variabel username
     * @param string $password variabel password
     * @param booelan $status status login true or false
     * @param string $ket variabel keterangan
     */
    function _setloguser($username = NULL, $password = NULL, $status = FALSE, $ket = NULL, $typeuser = 'USER')
    {
        $save['username'] = $username;
        $save['waktulogin'] = date('Y-m-d H:i:s');
        $save['idlog'] = $this->_generate_uuid();
        $save['ipaddress'] = $this->input->ip_address();
        $save['statuslog'] = ($status == TRUE ? 'T' : ($status == FALSE ? 'F' : ''));
        $save['password'] = $password;
        $save['ket'] = $ket;
        if ($typeuser == 'USER')
            $this->MY_Model->save('loginlog', $save);
        if ($typeuser == 'PESERTA')
            $this->MY_Model->save('loginlog_peserta', $save);
    }

    function _checkfirstlogin($fistloginpage = 0)
    {
        $get_user = $this->MY_Model->get_where_single('user', array('username' => $this->session->userdata('username')));
        if ($get_user->firstused == 1) {
            if ($fistloginpage == 0) {
                redirect('admin/firstlogin');
                exit();
            }
        } else {
            if ($fistloginpage != 0) {
                redirect('admin');
                exit();
            }
        }
    }



    //END CLASS 
}

class Public_Controller extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * _getlink
     * Method to generate link on public template
     * @param	string	$str_link  param to set in left of menu link <li><a href=#">HOME</a></li> 
     */
    function _getlink($str_link = NULL)
    {
        $str_link .= '<li><a href="' . site_url() . '">HOME</a></li>';
        $str_link .= '<li><a href="' . site_url() . '">JADWAL ONCALL</a></li>';
        $str_link .= '<li><a href="' . site_url() . '">JADWAL MOD</a></li>';
        $str_link .= '<li><a href="' . site_url() . '">JADWAL CLOSING</a></li>';
        $str_link .= '<li><a href="' . site_url() . '">ONSITE ABIYASA</a></li>';
        // $now = strtotime(date('Y-m-d H:i:s'));
        // if ($now >= strtotime($this->curentperiode->pendaftaranstart) && $now <= strtotime($this->curentperiode->pendaftaranend)) {
        //     $str_link .= '<li><a href="' . site_url('main/registrasi') . '">PENDAFTARAN</a></li>';
        // }
        // if ($now >= strtotime($this->curentperiode->tanggalawal) && $now <= strtotime($this->curentperiode->tanggalakhir)) {
        //     $str_link .= '<li><a href="' . site_url('main/login') . '">LOGIN</a></li>';
        // }
        // $str_link .= '<li><a href="' . site_url('main/pengumuman') . '">INFORMASI & PENGUMUMAN</a></li>';
        // $str_link .= '<li><a href="' . site_url('main/pusatbantuan') . '">BANTUAN</a></li>';
        return $data['str_link'] = $str_link;
    }
}

class Admin_Controller extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') != TRUE || $this->session->userdata('is_admin') != TRUE) {
            redirect('admin/login');
        }
        $this->_checkfirstlogin();
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->load->model('admin_model');
    }

    /**
     * _generate_template
     * Method to generate view for user template
     * @param	array	$data  parameter to set into template
     */
    function _generate_admin_template($data)
    {
        if (empty($data['activemenu']))
            $data['activemenu'] = 'Dashboard';
        if (empty($data['activesubmenu']))
            $data['activesubmenu'] = NULL;
        // $data['detailuser'] = $this->MY_Model->get_where_single('pesertabiodata', array('nik' => $this->session->userdata('nik')));
        // $data['namaperiode'] = $this->curentperiode->namaperiode;
        $this->load->view('admin/template', $data);
    }

    /**
     * _restrict_except_admin
     * Method to manage access to page special for admin
     */
    function _restrict_except_admin()
    {
        if ($this->session->userdata('hakakses') != 'SU') {
            $this->_set_flash('Akses ditolak', 'admin/dashboard');
            exit();
        }
    }


    //END CLASS 
}
