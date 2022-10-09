<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author UNICORN
 * @property pertemuan_model $pertemuan_model
 * @property dosen_model $dosen_model
 * @property matkul_model $matkul_model
 */

class Pertemuan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model("pertemuan_model");
        $this->load->model("dosen_model");
        $this->load->model("matkul_model");
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
        $data['titlepage'] = 'Pertemuan';
        $data['page'] = 'pertemuan';
        $data['list_pertemuan'] = $this->pertemuan_model->getListPertemuan();
        $this->load->view('dashboard_admin_layout', $data);
    }


    function tambah_Pertemuan()
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Tambah Pertemuan';
            $data['page'] = 'tambah_pertemuan';
            $data['get_list_dosen'] = $this->dosen_model->getListDosen();
            $data['get_list_matkul'] = $this->matkul_model->getListMatkul();
            $this->load->view('dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('id_dsn', 'Nama Dosen Pengampu', 'required');
            $this->form_validation->set_rules('id_matkul', 'Nama Mata Kuliah', 'required');
            $this->form_validation->set_rules('pertemuanke', 'Pertemuan Ke', 'required');
            $this->form_validation->set_rules('waktu_mulai', 'Waktu Mulai', 'required');
            $this->form_validation->set_rules('waktu_selesai', 'Waktu Selesai', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Tambah Pertemuan';
                $data['page'] = 'tambah_pertemuan';
                $data['get_list_dosen'] = $this->dosen_model->getListDosen();
                $data['get_list_matkul'] = $this->matkul_model->getListMatkul();
                $data['error'] = validation_errors();
                $this->load->view('dashboard_admin_layout', $data);
            } else {
                unset($data);
                $id_dsn = $this->input->post('id_dsn');
                $id_matkul = $this->input->post('id_matkul');
                $pertemuanke = $this->input->post('pertemuanke');
                $waktu_mulai = $this->input->post('waktu_mulai');
                $waktu_selesai = $this->input->post('waktu_selesai');
                $pkok_bahasan = $this->input->post('pkok_bahasan');
                $sub_pkokbhasan = $this->input->post('sub_pkokbhasan');

                $save['id_dsn'] = $id_dsn;
                $save['id_matkul'] = $id_matkul;
                $save['pertemuanke'] = $pertemuanke;
                $save['waktu_mulai'] = $waktu_mulai;
                $save['waktu_selesai'] = $waktu_selesai;
                $save['pkok_bahasan'] = $pkok_bahasan;
                $save['sub_pkokbhasan'] = $sub_pkokbhasan;

                $hasil = $this->pertemuan_model->_tambah_Pertemuan($save);
                if ($hasil == true) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Pertemuan Berhasil ditambahkah</div>');
                    redirect('pertemuan');
                } else {
                    print_r($hasil);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Pertemuan Gagal ditambahkah</div>');
                    redirect('pertemuan_tambah');
                }
                unset($save);
            }
        }
    }

    function edit_pertemuan($id_pertemuan)
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Edit Pertemuan';
            $data['page'] = 'edit_pertemuan';
            $data['get_list_dosen'] = $this->dosen_model->getListDosen();
            $data['get_list_matkul'] = $this->matkul_model->getListMatkul();
            $data['get_pertemuan'] = $this->pertemuan_model->getPertemuan($id_pertemuan);
            $this->load->view('dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('id_dsn', 'Nama Dosen Pengampu', 'required');
            $this->form_validation->set_rules('id_matkul', 'Nama Mata Kuliah', 'required');
            $this->form_validation->set_rules('pertemuanke', 'Pertemuan Ke', 'required');
            $this->form_validation->set_rules('waktu_mulai', 'Waktu Mulai', 'required');
            $this->form_validation->set_rules('waktu_selesai', 'Waktu Selesai', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Edit Pertemuan';
                $data['page'] = 'edit_pertemuan';
                $data['get_list_dosen'] = $this->dosen_model->getListDosen();
                $data['get_list_matkul'] = $this->matkul_model->getListMatkul();
                $data['get_pertemuan'] = $this->pertemuan_model->getPertemuan($id_pertemuan);
                $data['error'] = validation_errors();
                $this->load->view('dashboard_admin_layout', $data);
            } else {
                unset($data);
                $id_dsn = $this->input->post('id_dsn');
                $id_matkul = $this->input->post('id_matkul');
                $pertemuanke = $this->input->post('pertemuanke');
                $waktu_mulai = $this->input->post('waktu_mulai');
                $waktu_selesai = $this->input->post('waktu_selesai');
                $pkok_bahasan = $this->input->post('pkok_bahasan');
                $sub_pkokbhasan = $this->input->post('sub_pkokbhasan');

                $update['id_dsn'] = $id_dsn;
                $update['id_matkul'] = $id_matkul;
                $update['pertemuanke'] = $pertemuanke;
                $update['waktu_mulai'] = $waktu_mulai;
                $update['waktu_selesai'] = $waktu_selesai;
                $update['pkok_bahasan'] = $pkok_bahasan;
                $update['sub_pkokbhasan'] = $sub_pkokbhasan;

                $hasil = $this->pertemuan_model->_update_pertemuan($id_pertemuan, $update);
                if ($hasil == true) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Pertemuan Berhasil diedit</div>');
                    redirect('pertemuan');
                } else {
                    print_r($hasil);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Pertemuan Gagal diedit</div>');
                    redirect('pertemuan_edit');
                }
                unset($update);
            }
        }
    }

    function hapus_pertemuan($id_pertemuan)
    {
        $hasil = $this->pertemuan_model->_delete_pertemuan($id_pertemuan);
        if ($hasil == true) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Pertemuan Berhasil Dihapus</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Pertemuan Berhasil Dihapus</div>');
        }
        redirect('pertemuan');
    }
}
