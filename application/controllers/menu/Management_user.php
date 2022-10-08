<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author UNICORN
 * 
 * @property user_model $user_model
 */

class Management_user extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model("user_model");
        $this->is_logged_in();
    }

    private function is_logged_in()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('');
        }
    }

    function index()
    {
        $data['titlepage'] = 'Management User';
        $data['page'] = 'management_user';
        $data['list_user'] = $this->user_model->getListUser();
        $this->load->view('dashboard_admin_layout', $data);
    }

    function status_aktivasi_user($id_admin, $status)
    {
        $update['aktivasi'] = $status;
        $hasil = $this->user_model->setAktivasi($id_admin, $update);
        if ($hasil == true) {
            if ($status == 1) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">User Berhasil diaktifkan</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">User Berhasil dinonaktifkan</div>');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Proses Gagal</div>');
        }

        redirect('management_user');
    }

    function tambah_user()
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Tambah User';
            $data['page'] = 'tambah_user';
            $this->load->view('dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[admin.usernm]');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password_confirmation', 'Konfirmasi Password', 'required|matches[password]');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Tambah User';
                $data['page'] = 'tambah_user';
                $data['error'] = validation_errors();
                $this->load->view('dashboard_admin_layout', $data);
            } else {
                unset($data);
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                $pwd = md5($password);
                $pwd2 = password_hash($pwd, PASSWORD_DEFAULT);

                $save['usernm'] = $username;
                $save['password'] = $pwd2;
                $save['aktivasi'] = 1;

                $hasil = $this->user_model->_tambah_user($save);
                if ($hasil == true) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">User Berhasil ditambahkah</div>');
                    redirect('management_user');
                } else {
                    print_r($hasil);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">User Gagal ditambahkah</div>');
                    redirect('user_tambah');
                }
                unset($save);
            }
        }
    }
}
