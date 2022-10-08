<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Galih Dwi Aditya Nugraha
 * 
 * @property visidanmisi_model $visidanmisi_model
 */

class Visidanmisi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('visidanmisi_model');
        $this->is_logged_in();
    }

    private function is_logged_in()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('');
        }
    }


    function list_visi()
    {
        $data['titlepage'] = 'Visi';
        $data['page'] = 'visi';
        $data['list_visi'] = $this->visidanmisi_model->getListVisi();
        $this->load->view('admin/dashboard_admin_layout', $data);
    }

    function list_misi()
    {
        $data['titlepage'] = 'Misi';
        $data['page'] = 'misi';
        $data['list_misi'] = $this->visidanmisi_model->getListMisi();
        $this->load->view('admin/dashboard_admin_layout', $data);
    }

    function tambah_visi()
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Tambah Visi';
            $data['page'] = 'tambah_visi';
            $this->load->view('admin/dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('nama_visi', 'Nama Visi', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Tambah Visi';
                $data['page'] = 'tambah_visi';
                $data['error'] = validation_errors();
                $this->load->view('admin/dashboard_admin_layout', $data);
            } else {
                unset($data);
                $nama_visi = $this->input->post('nama_visi');

                $save['nama_visi'] = $nama_visi;

                $hasil = $this->visidanmisi_model->_tambah_visi($save);
                if ($hasil == true) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Visi Berhasil ditambahkan</div>');
                    redirect('admin/visi');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Visi Gagal ditambahkan</div>');
                    redirect('admin/visidanmisi/tambah_visi');
                }
                unset($save);
            }
        }
    }

    function tambah_misi()
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Tambah Misi';
            $data['page'] = 'tambah_misi';
            $this->load->view('admin/dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('nama_misi', 'Nama Misi', 'required|is_unique[user_tb.username]');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Tambah Misi';
                $data['page'] = 'tambah_misi';
                $data['error'] = validation_errors();
                $this->load->view('admin/dashboard_admin_layout', $data);
            } else {
                unset($data);
                $nama_misi = $this->input->post('nama_misi');

                $save['nama_misi'] = $nama_misi;

                $hasil = $this->visidanmisi_model->_tambah_misi($save);
                if ($hasil == true) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Misi Berhasil ditambahkan</div>');
                    redirect('admin/misi');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Misi Gagal ditambahkan</div>');
                    redirect('admin/visidanmisi/tambah_misi');
                }
                unset($save);
            }
        }
    }

    function edit_visi($id)
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Edit Visi';
            $data['page'] = 'edit_visi';
            $data['get_visi'] = $this->visidanmisi_model->getvisi($id);
            $this->load->view('admin/dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('nama_visi', 'Nama Visi', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Edit Visi';
                $data['page'] = 'edit_visi';
                $data['get_visi'] = $this->visidanmisi_model->getvisi($id);
                $data['error'] = validation_errors();
                $this->load->view('admin/dashboard_admin_layout', $data);
            } else {
                unset($data);
                $nama_visi = $this->input->post('nama_visi');

                $update['id'] = $id;
                $update['nama_visi'] = $nama_visi;

                $hasil = $this->visidanmisi_model->_update_visi($update);

                if ($hasil == true) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Visi Berhasil diupdate</div>');
                    redirect('admin/visi');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Visi Gagal diupdate</div>');
                    redirect('admin/visidanmisi/edit_visi');
                }
                unset($update);
            }
        }
    }

    function edit_misi($id)
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Edit Misi';
            $data['page'] = 'edit_misi';
            $data['get_misi'] = $this->visidanmisi_model->getmisi($id);
            $this->load->view('admin/dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('nama_misi', 'Nama misi', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Edit misi';
                $data['page'] = 'edit_misi';
                $data['get_misi'] = $this->visidanmisi_model->getmisi($id);
                $data['error'] = validation_errors();
                $this->load->view('admin/dashboard_admin_layout', $data);
            } else {
                unset($data);
                $nama_misi = $this->input->post('nama_misi');

                $update['id'] = $id;
                $update['nama_misi'] = $nama_misi;

                $hasil = $this->visidanmisi_model->_update_misi($update);

                if ($hasil == true) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Misi Berhasil diupdate</div>');
                    redirect('admin/misi');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Misi Gagal diupdate</div>');
                    redirect('admin/visidanmisi/edit_misi');
                }
                unset($update);
            }
        }
    }


    function delete_visi($id)
    {
        if (!empty($id)) {
            $data = $this->visidanmisi_model->_delete_visi($id);
            if ($data == true) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Visi Berhasil dihapus</div>');
                redirect('admin/visi');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Visi Gagal dihapus</div>');
                redirect('admin/visi');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Permintaan tidak Dapat Diproses</div>');
            redirect('admin/visi');
        }
    }

    function delete_misi($id)
    {
        if (!empty($id)) {
            $data = $this->visidanmisi_model->_delete_misi($id);
            if ($data == true) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Misi Berhasil dihapus</div>');
                redirect('admin/misi');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Misi Gagal dihapus</div>');
                redirect('admin/misi');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Permintaan tidak Dapat Diproses</div>');
            redirect('admin/misi');
        }
    }
}
