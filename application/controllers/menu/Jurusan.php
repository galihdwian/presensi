<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author UNICORN
 * @property jurusan_model $jurusan_model
 */

class Jurusan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model("jurusan_model");
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
        $data['titlepage'] = 'Jurusan';
        $data['page'] = 'jurusan';
        $data['list_jurusan'] = $this->jurusan_model->getListJurusan();
        $this->load->view('dashboard_admin_layout', $data);
    }


    function tambah_jurusan()
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Tambah Jurusan';
            $data['page'] = 'tambah_jurusan';
            $this->load->view('dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('kode_jurusan', 'Kode Jurusan', 'required|is_unique[jurusan.kode_jurusan]');
            $this->form_validation->set_rules('nama_jurusan', 'Nama Jurusan', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Tambah Jurusan';
                $data['page'] = 'tambah_jurusan';
                $data['error'] = validation_errors();
                $this->load->view('dashboard_admin_layout', $data);
            } else {
                unset($data);
                $kode_jurusan = $this->input->post('kode_jurusan');
                $nama_jurusan = $this->input->post('nama_jurusan');

                $save['kode_jurusan'] = $kode_jurusan;
                $save['nama_jurusan'] = $nama_jurusan;

                $hasil = $this->jurusan_model->_tambah_jurusan($save);
                if ($hasil == true) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Jurusan Berhasil ditambahkah</div>');
                    redirect('jurusan');
                } else {
                    print_r($hasil);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Jurusan Gagal ditambahkah</div>');
                    redirect('jurusan_tambah');
                }
                unset($save);
            }
        }
    }

    function edit_jurusan($id_jurusan)
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Edit Jurusan';
            $data['page'] = 'edit_jurusan';
            $data['get_jurusan'] = $this->jurusan_model->getJurusan($id_jurusan);
            $this->load->view('dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('kode_jurusan', 'Kode Jurusan', 'required');
            $this->form_validation->set_rules('nama_jurusan', 'Nama Jurusan', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Edit Jurusan';
                $data['page'] = 'edit_jurusan';
                $data['get_jurusan'] = $this->jurusan_model->getJurusan($id_jurusan);
                $data['error'] = validation_errors();
                $this->load->view('dashboard_admin_layout', $data);
            } else {
                unset($data);
                $kode_jurusan = $this->input->post('kode_jurusan');
                $nama_jurusan = $this->input->post('nama_jurusan');

                $update['kode_jurusan'] = $kode_jurusan;
                $update['nama_jurusan'] = $nama_jurusan;

                $hasil = $this->jurusan_model->_update_jurusan($id_jurusan, $update);
                if ($hasil == true) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Jurusan Berhasil diedit</div>');
                    redirect('jurusan');
                } else {
                    print_r($hasil);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Jurusan Gagal diedit</div>');
                    redirect('jurusan_edit');
                }
                unset($update);
            }
        }
    }

    function hapus_jurusan($id_jurusan)
    {
        $hasil = $this->jurusan_model->_delete_jurusan($id_jurusan);
        if ($hasil == true) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Jurusan Berhasil Dihapus</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Jurusan Berhasil Dihapus</div>');
        }
        redirect('jurusan');
    }
}
