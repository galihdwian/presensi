<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Galih Dwi Aditya Nugraha
 */

/**
 * @property login_model $login_model
 */
class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model("login_model");
    }

    function index()
    {
        $this->load->helper('form');
        if (!$_POST) {
            $data['menu'] = '';
            $data['page'] = 'loginpage';
            $this->load->view('layout', $data);
        } else {
            $this->autenticate();
        }
    }

    function autenticate()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|callback__check_login');
        if ($this->form_validation->run() == FALSE) {
            $data['menu'] = '';
            $data['page'] = 'loginpage';
            $this->load->view('layout', $data);
        } else {
            redirect('dashboard');
        }
    }

    function _check_login($password)
    {
        $user = $this->input->post('username', true);
        $getUser = $this->login_model->getUser($user);
        if ($getUser->num_rows() > 0) {
            $this->load->helper('encrypthash');
            $password = $this->input->post('password', true);
            $password_chiper = md5($password);
            foreach ($getUser->result() as $getUserRows) :
                if ($getUserRows->aktivasi != 1) {
                    $this->form_validation->set_message('_check_login', 'Akun Belum Aktif/Tidak Aktif');
                    return FALSE;
                } else {
                    $check_password = ehash_check($password_chiper, $getUserRows->password);
                    if ($check_password == true) {
                        $newdata = array(
                            'username' => $getUserRows->usernm,
                            'id_user' => $getUserRows->id_admin,
                            'aktivasi' => $getUserRows->aktivasi,
                            'logged_in' => TRUE,
                        );
                        $this->session->set_userdata($newdata);
                        return TRUE;
                    } else {
                        $this->form_validation->set_message('_check_login', 'Username atau Password salah');
                        return FALSE;
                    }
                }
            endforeach;
        } else {
            $this->form_validation->set_message('_check_login', 'Username atau Password salah');
            return FALSE;
        }
    }

    function logout()
    {
        $this->session->set_userdata(array('logged_in' => FALSE));
        $this->session->sess_destroy();
        redirect('login');
    }
}
