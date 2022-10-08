<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Galih Dwi Aditya Nugraha
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
        $this->load->view('admin/dashboard_admin_layout', $data);
    }

    function status_aktivasi_user($id_user, $status)
    {
        $update['aktivasi'] = $status;
        $hasil = $this->user_model->setAktivasi($id_user, $update);
        if ($hasil == true) {
            if ($status == 'Y') {
                $this->session->set_flashdata('message', '<div class="alert alert-success">User Berhasil diaktifkan</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">User Berhasil dinonaktifkan</div>');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Proses Gagal</div>');
        }

        redirect('admin/management_user');
    }

    function tambah_user()
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Tambah User';
            $data['page'] = 'tambah_user';
            $data['list_level'] = $this->user_model->getListLevel();
            $data['list_status'] = $this->user_model->getListStatus();
            $this->load->view('admin/dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user_tb.username]');
            $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password_confirmation', 'Konfirmasi Password', 'required|matches[password]');
            $this->form_validation->set_rules('id_level', 'Level', 'required');
            $this->form_validation->set_rules('id_status', 'Status', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Tambah User';
                $data['page'] = 'tambah_user';
                $data['list_level'] = $this->user_model->getListLevel();
                $data['list_status'] = $this->user_model->getListStatus();
                $data['error'] = validation_errors();
                $this->load->view('admin/dashboard_admin_layout', $data);
            } else {
                unset($data);
                $username = $this->input->post('username');
                $nama_lengkap = $this->input->post('nama_lengkap');
                $password = $this->input->post('password');
                $id_level = $this->input->post('id_level');
                $id_status = $this->input->post('id_status');

                $pwd = md5($password);
                $pwd2 = password_hash($pwd, PASSWORD_DEFAULT);

                $save['username'] = $username;
                $save['nama_lengkap'] = $nama_lengkap;
                $save['password'] = $pwd2;
                $save['level_user'] = $id_level;
                $save['status_user'] = $id_status;
                $save['aktivasi'] = 'N';

                $hasil = $this->user_model->_tambah_user($save);
                if ($hasil == true) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">User Berhasil ditambahkah</div>');
                    redirect('admin/management_user');
                } else {
                    print_r($hasil);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">User Gagal ditambahkah</div>');
                    redirect('admin/management_user/tambah');
                }
                unset($save);
            }
        }
    }
}
