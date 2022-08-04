<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Login
 * @author Galih Dwi A N <galihdwia007 at gmail.com>
 */
class Login extends Public_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    function index()
    {
        $data = array();
        $this->load->view('login/indexlogin', $data);
    }

    function auth()
    {
        if (isset($_POST['login'])) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username', 'Username', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
            if ($this->form_validation->run($this) == FALSE) {
                $this->_setloguser($this->input->post('username'), $this->input->post('password'), FALSE, strip_tags(validation_errors()));
                $this->_set_flash(validation_errors(), 'admin/login', 'alert-danger pall-5');
            } else {
                $hasil = $this->_check_login($this->input->post('username'), $this->input->post('password'));
                if ($hasil['status'] == 'success') {
                    $sessiondata = array(
                        'username' => $hasil['username'],
                        'hak_akses' => $hasil['hak_akses'],
                        'nama_user' => $hasil['nama_user'],
                        'logged_in' => TRUE,
                        'is_admin' => TRUE,
                        'avatar' => $hasil['avatar']
                    );
                    $this->MY_Model->update('user', array('last_login' => date('Y-m-d H:i:s')),  array('username' => $hasil['username']));
                    $this->session->set_userdata($sessiondata);
                    if ($hasil['hak_akses'] == 'SU') {
                        redirect('admin/dashboard');
                    } elseif ($hasil['hak_akses'] == 'AD') {
                        redirect('admin/dashboard');
                    } elseif ($hasil['hak_akses'] == 'US') {
                        redirect('admin/dashboard');
                    }
                } else {
                    $this->_setloguser($this->input->post('username'), $this->input->post('password'), FALSE, 'Username / Password Salah');
                    $this->_set_flash('Username / Password Salah', 'admin/login', 'alert-danger pall-5');
                }
            }
        } else {
            show_404();
        }
    }

    function logout()
    {
        $user_data = $this->session->userdata();
        foreach ($user_data as $key => $value) {
            if ($key != '__ci_last_regenerate' && $key != '__ci_vars')
                $this->session->unset_userdata($key);
        }
        $this->session->sess_destroy();
        $this->_set_flash('Berhasil Log Out', 'admin/login/', 'alert-success pall-5');
    }

    function _check_login($username = NULL, $password = NULL)
    {
        $data = array();
        $data['status'] = 'failed';
        if ($username != NULL & $password != NULL) {
            $hasil = $this->MY_Model->get_where('user', array('username' => $username));
            if ($hasil) :
                foreach ($hasil as $row) :
                    if ($this->_check_hash($password, $row->password) == TRUE) {
                        $data['status'] = 'success';
                        $data['username'] = $row->username;
                        $data['nama_user'] = $row->nama_user;
                        $data['hak_akses'] = $row->hak_akses;
                        $data['avatar'] = 'assets/images/avatar/' . ($row->imgprofil == NULL ? ($row->jk == 'L' ? 'avatar-male.png' : 'avatar-female.png') : $row->imgprofil);
                        $this->_setloguser($username, $row->password, TRUE, 'success');
                    }
                endforeach;
            endif;
        }
        return $data;
    }

    //END OF class Login
}
