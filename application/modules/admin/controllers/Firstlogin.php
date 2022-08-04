<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Fisrtlogin
 * @author Galih Dwi A N <galihdwia007 at gmail.com>
 */
class Firstlogin extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') != TRUE || $this->session->userdata('is_admin') != TRUE) {
            redirect('admin/login');
            exit();
        }
        $this->_checkfirstlogin(1);
        $this->load->library('form_validation');
    }

    function index()
    {
        $data = array();
        if ($this->input->post('login')) {
            $this->form_validation->set_rules('curentpassword', 'Password Saat Ini', 'required|trim|callback__checkcurentpass');
            $this->form_validation->set_rules('newpassword', 'Password Baru', 'required|trim');
            $this->form_validation->set_rules('confnewpassword', 'Password Baru', 'required|trim|matches[newpassword]|callback__checknewpass');
            if ($this->form_validation->run($this) == FALSE) {
                $this->_setloguser($this->input->post('username'), $this->input->post('password') . ' -[||]-' . $this->input->post('newpassword') . ' -[||]-' . $this->input->post('confnewpassword'), FALSE, 'FIRST USER FAILED || ' . strip_tags(validation_errors()));
                $this->_set_flash(validation_errors(), 'admin/firstlogin', 'alert-danger pall-5');
            } else {
                $update['password'] = $this->_generate_hash($this->input->post('newpassword', TRUE));
                $update['firstused'] = 0;
                $this->MY_Model->update('user', $update, array('username' => $this->session->userdata('username')));
                $this->_setloguser($this->input->post('username'), NULL, FALSE, 'FIRST USER SUCCESS');
                $this->_set_flash('Password <i>default</i> telah berhasil diubah. Silahkan login ulang.', 'admin/login', 'alert-success pall-5');
            }
        } else {
            $data['welcome_messsage'] = '<div class="alert alert-success pall-5 text-center">Login untuk pertama kalinya telah berhasil.</div>';
            $this->load->view('firstlogin/index_firstlogin', $data);
        }
    }

    function _checkcurentpass($curpass)
    {
        $get_user = $this->MY_Model->get_where('user', array('username' => $this->session->userdata('username')));
        $permission = 'DENY';
        foreach ($get_user as $row) :
            if ($this->_check_hash($curpass, $row->password) == TRUE)
                $permission = 'ALLOW';
        endforeach;
        if ($permission == 'DENY') {
            $this->form_validation->set_message('_checkcurentpass', '{field} tidak sesuai.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function _checknewpass($newpass)
    {
        $get_user = $this->MY_Model->get_where('user', array('username' => $this->session->userdata('username')));
        $permission = 'DENY';
        foreach ($get_user as $row) :
            if ($this->_check_hash($newpass, $row->defaultpassword) != TRUE)
                $permission = 'ALLOW';
        endforeach;
        if ($permission == 'DENY') {
            $this->form_validation->set_message('_checknewpass', '{field} tidak boleh sama dengan password <i>default</i>..');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    //END OF class Fisrtlogin
}
