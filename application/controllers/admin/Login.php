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
            $this->load->view('publik/layout', $data);
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
            $this->load->view('publik/layout', $data);
        } else {
            redirect('admin');
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
                $check_password = ehash_check($password_chiper, $getUserRows->password);
                if ($check_password == true) {
                    if ($getUserRows->aktivasi != 'Y') {
                        $this->form_validation->set_message('_check_login', 'User Anda Sudah Tidak Aktif Silahkan Hubungi Admin.');
                        return FALSE;
                    } else {
                        if ($getUserRows->level_user <= '2') {
                            $newdata = array(
                                'username' => $getUserRows->username,
                                'nama_user' => $getUserRows->nama_lengkap,
                                'hak_akses' => $getUserRows->level_user,
                                'id_user' => $getUserRows->id_user,
                                'logged_in' => TRUE,
                                'is_admin' => TRUE
                            );
                            $this->session->set_userdata($newdata);
                            $this->login_model->lastLogin(date('Y-m-d H:i:s'), $getUserRows->id_user);
                            return TRUE;
                        } else {
                            return FALSE;
                        }
                    }
                } else {
                    $this->form_validation->set_message('_check_login', 'Username atau Password salah');
                    return FALSE;
                }
            endforeach;
        } else {
            $this->form_validation->set_message('_check_login', 'Username atau Password salah');
            return FALSE;
        }
    }

    function logout()
    {
        if (!$this->session->userdata('is_admin')) {
            $this->session->set_userdata(array('logged_in' => FALSE));
            $this->session->sess_destroy();
            redirect('admin/login');
        } else {
            $this->session->set_userdata(array('is_admin' => FALSE));
            $this->session->sess_destroy();
            redirect('admin/login');
        }
    }
}
