<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Dashboard
 * @author Galih Dwi A N <galihdwia007 at gmail.com>
 * @property admin_model $admin_model
 *
 * @property admindashboard_model $admindashboard_model
 */
class Dashboard extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('admindashboard_model');
    }

    function index()
    {

        $data['titlepage'] = 'Dashboard <small>Admin SIMONA</small>';
        $data['loadcontent'] = 'admin/admindashboard/indexpage.php';
        $this->_generate_admin_template($data);
    }

    // function manajemenuser()
    // {
    //     if ($this->session->userdata('hakakses') != 'SU') {
    //         $this->session->set_flashdata('flash_message', '<div class="alert alert-danger" role="alert">Akses ditolak.</div>');
    //         redirect('admin/dashboard');
    //     } else {
    //         if (!isset($_POST['submit'])) {
    //             $data['getuser'] = $this->admindashboard_model->getuser();
    //             $data['getlevel'] = $this->admindashboard_model->getlevel();
    //             $data['page'] = 'manajemenuser';
    //             $this->load->view('admin/template', $data);
    //         } else {
    //             $this->load->library('form_validation');
    //             $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]');
    //             $this->form_validation->set_rules('namauser', 'Nama User', 'required');
    //             $this->form_validation->set_rules('password', 'Password', 'required');
    //             $this->form_validation->set_rules('password_conf', 'Konfirmasi Password', 'required|matches[password]');
    //             $this->form_validation->set_rules('level', 'Level', 'required');
    //             if ($this->form_validation->run($this) == FALSE) {
    //                 $data['message'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
    //                 $data['getuser'] = $this->admindashboard_model->getuser();
    //                 $data['getlevel'] = $this->admindashboard_model->getlevel();
    //                 $data['page'] = 'manajemenuser';
    //                 $this->load->view('admin/template', $data);
    //             } else {
    //                 $this->load->module('globalprocess');
    //                 $save['username'] = $this->input->post('username');
    //                 $save['namauser'] = $this->input->post('namauser');
    //                 $save['password'] = $this->globalprocess->_generate_hash($this->input->post('password'));
    //                 $save['hakakses'] = $this->input->post('level');
    //                 $this->admindashboard_model->save($save);
    //                 $this->session->set_flashdata('flashmessage', '<div class="alert alert-success" role="alert">Data berhasil disimpan.</div>');
    //                 redirect('admin/dashboard/manajemenuser');
    //             }
    //         }
    //     }
    // }

    //END OF class Dashboard
}
