<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author UNICORN
 * @property matkul_model $matkul_model
 * @property dosen_model $dosen_model
 * @property mahasiswa_model $mahasiswa_model
 */

class Matkul extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model("matkul_model");
        $this->load->model("dosen_model");
        $this->load->model("mahasiswa_model");
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
        $data['titlepage'] = 'Mata Kuliah';
        $data['page'] = 'matkul';
        $data['list_matkul'] = $this->matkul_model->getListMatkul();
        $this->load->view('dashboard_admin_layout', $data);
    }


    function tambah_matkul()
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Tambah Mata Kuliah';
            $data['page'] = 'tambah_matkul';
            $data['get_list_dosen'] = $this->dosen_model->getListDosen();
            $this->load->view('dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('kode_matkul', 'Kode Mata Kuliah', 'required');
            $this->form_validation->set_rules('nm_matkul', 'Nama Mata Kuliah', 'required');
            $this->form_validation->set_rules('id_dsn', 'Nama Dosen', 'required');
            $this->form_validation->set_rules('sks', 'SKS', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Tambah Mata Kuliah';
                $data['page'] = 'tambah_matkul';
                $data['get_list_dosen'] = $this->dosen_model->getListDosen();
                $data['error'] = validation_errors();
                $this->load->view('dashboard_admin_layout', $data);
            } else {
                unset($data);
                $kode_matkul = $this->input->post('kode_matkul');
                $nm_matkul = $this->input->post('nm_matkul');
                $id_dsn = $this->input->post('id_dsn');
                $sks = $this->input->post('sks');

                $save['kode_matkul'] = $kode_matkul;
                $save['nm_matkul'] = $nm_matkul;
                $save['id_dsn'] = $id_dsn;
                $save['sks'] = $sks;

                $hasil = $this->matkul_model->_tambah_matkul($save);
                if ($hasil == true) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Mata Kuliah Berhasil ditambahkah</div>');
                    redirect('matkul');
                } else {
                    print_r($hasil);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Mata Kuliah Gagal ditambahkah</div>');
                    redirect('matkul_tambah');
                }
                unset($save);
            }
        }
    }

    function edit_matkul($id_matkul)
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Edit Matkul';
            $data['page'] = 'edit_matkul';
            $data['get_matkul'] = $this->matkul_model->getMatkul($id_matkul);
            $data['get_list_dosen'] = $this->dosen_model->getListDosen();
            $this->load->view('dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('kode_matkul', 'Kode Mata Kuliah', 'required');
            $this->form_validation->set_rules('nm_matkul', 'Nama Mata Kuliah', 'required');
            $this->form_validation->set_rules('id_dsn', 'Nama Dosen', 'required');
            $this->form_validation->set_rules('sks', 'SKS', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Edit Matkul';
                $data['page'] = 'edit_matkul';
                $data['get_matkul'] = $this->matkul_model->getMatkul($id_matkul);
                $data['get_list_dosen'] = $this->dosen_model->getListDosen();
                $data['error'] = validation_errors();
                $this->load->view('dashboard_admin_layout', $data);
            } else {
                unset($data);
                $kode_matkul = $this->input->post('kode_matkul');
                $nm_matkul = $this->input->post('nm_matkul');
                $id_dsn = $this->input->post('id_dsn');
                $sks = $this->input->post('sks');

                $update['kode_matkul'] = $kode_matkul;
                $update['nm_matkul'] = $nm_matkul;
                $update['id_dsn'] = $id_dsn;
                $update['sks'] = $sks;

                $hasil = $this->matkul_model->_update_matkul($id_matkul, $update);
                if ($hasil == true) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Mata Kuliah Berhasil diupdate</div>');
                    redirect('matkul');
                } else {
                    print_r($hasil);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Mata Kuliah Gagal diupdate</div>');
                    redirect('matkul_edit');
                }
                unset($update);
            }
        }
    }

    function hapus_matkul($id_matkul)
    {
        $hasil = $this->matkul_model->_delete_matkul($id_matkul);
        if ($hasil == true) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Mata kuliah Berhasil dihapus</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Mata kuliah Gagal dihapus</div>');
        }

        redirect('matkul');
    }

    function detail_matkul($id_matkul)
    {
        $data['titlepage'] = 'Detail Mata Kuliah';
        $data['page'] = 'detail_matkul';
        $data['detail_matkul'] = $this->matkul_model->getMatkul($id_matkul);
        $data['list_detail_matkul'] = $this->matkul_model->getListDetailMatkul($id_matkul);
        $this->load->view('dashboard_admin_layout', $data);
    }

    function detail_matkul_tambah($id_matkul)
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Tambah Detail Mata Kuliah';
            $data['page'] = 'tambah_detail_matkul';
            $data['get_list_mahasiswa'] = $this->mahasiswa_model->getListMahasiswa();
            $data['id_matkul'] = $id_matkul;
            $this->load->view('dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('id_mhs', 'Nama Mahasiswa', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Tambah Detail Mata Kuliah';
                $data['page'] = 'tambah_detail_matkul';
                $data['get_list_mahasiswa'] = $this->mahasiswa_model->getListMahasiswa();
                $data['id_matkul'] = $id_matkul;
                $data['error'] = validation_errors();
                $this->load->view('dashboard_admin_layout', $data);
            } else {
                unset($data);
                $id_mhs = $this->input->post('id_mhs');

                $save['id_matkul'] = $id_matkul;
                $save['id_mahasiswa'] = $id_mhs;

                $hasil = $this->matkul_model->_tambah_detail_matkul($save);
                if ($hasil == true) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Detail Mata Kuliah Berhasil ditambahkah</div>');
                    redirect('matkul_detail/' . $id_matkul);
                } else {
                    print_r($hasil);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Detail Mata Kuliah Gagal ditambahkah</div>');
                    redirect('matkul_detail_tambah/' . $id_matkul);
                }
                unset($save);
            }
        }
    }


    function detail_matkul_hapus($id_matkul, $id_mahasiswa)
    {
        $hasil = $this->matkul_model->_delete_matkul_detail($id_matkul, $id_mahasiswa);
        if ($hasil == true) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Mahasiswa Berhasil dihapus</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"Mahasiswa Gagal dihapus</div>');
        }

        redirect('matkul_detail/' . $id_matkul);
    }
}
