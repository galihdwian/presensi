<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author UNICORN
 * @property dosen_model $dosen_model
 */

class Dosen extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model("dosen_model");
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
        $data['titlepage'] = 'Dosen';
        $data['page'] = 'dosen';
        $data['list_dosen'] = $this->dosen_model->getListDosen();
        $this->load->view('dashboard_admin_layout', $data);
    }

    function status_aktivasi_dosen($id_dsn, $status)
    {
        $update['stts_dsn'] = $status;
        $hasil = $this->dosen_model->setAktivasi($id_dsn, $update);
        if ($hasil == true) {
            if ($status == 1) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Dosen Berhasil diaktifkan</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Dosen Berhasil dinonaktifkan</div>');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Proses Gagal</div>');
        }

        redirect('dosen');
    }

    function tambah_dosen()
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Tambah Dosen';
            $data['page'] = 'tambah_dosen';
            $this->load->view('dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('nip', 'NIP', 'required|is_unique[dosen.stts_dsn]');
            $this->form_validation->set_rules('nama_dsn', 'Nama Dosen', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password_confirmation', 'Konfirmasi Password', 'required|matches[password]');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Tambah Dosen';
                $data['page'] = 'tambah_dosen';
                $data['error'] = validation_errors();
                $this->load->view('dashboard_admin_layout', $data);
            } else {
                unset($data);
                $nip = $this->input->post('nip');
                $nama_dsn = $this->input->post('nama_dsn');
                $password = $this->input->post('password');

                $pwd = md5($password);
                $pwd2 = password_hash($pwd, PASSWORD_DEFAULT);

                $save['nip'] = $nip;
                $save['nama_dsn'] = $nama_dsn;
                $save['password'] = $pwd2;
                $save['stts_dsn'] = 1;

                $hasil = $this->dosen_model->_tambah_dosen($save);
                if ($hasil == true) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Dosen Berhasil ditambahkah</div>');
                    redirect('dosen');
                } else {
                    print_r($hasil);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Dosen Gagal ditambahkah</div>');
                    redirect('dosen_tambah');
                }
                unset($save);
            }
        }
    }

    function edit_dosen($id_dsn)
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Edit Dosen';
            $data['page'] = 'edit_dosen';
            $data['get_dosen'] = $this->dosen_model->getDosen($id_dsn);
            $this->load->view('dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('nip', 'NIP', 'required');
            $this->form_validation->set_rules('nama_dsn', 'Nama Dosen', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Tambah Dosen';
                $data['page'] = 'tambah_dosen';
                $data['get_dosen'] = $this->dosen_model->getDosen($id_dsn);
                $data['error'] = validation_errors();
                $this->load->view('dashboard_admin_layout', $data);
            } else {
                unset($data);
                $nip = $this->input->post('nip');
                $nama_dsn = $this->input->post('nama_dsn');

                $update['nip'] = $nip;
                $update['nama_dsn'] = $nama_dsn;

                $hasil = $this->dosen_model->_update_dosen($id_dsn, $update);
                if ($hasil == true) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Dosen Berhasil diupdate</div>');
                    redirect('dosen');
                } else {
                    print_r($hasil);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Dosen Gagal diupdate</div>');
                    redirect('dosen_edit');
                }
                unset($update);
            }
        }
    }
}
