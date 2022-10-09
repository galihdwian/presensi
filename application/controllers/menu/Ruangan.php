<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author UNICORN
 * @property ruangan_model $ruangan_model
 */

class Ruangan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model("ruangan_model");
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
        $data['titlepage'] = 'Ruangan';
        $data['page'] = 'ruangan';
        $data['list_ruangan'] = $this->ruangan_model->getListRuangan();
        $this->load->view('dashboard_admin_layout', $data);
    }


    function tambah_ruangan()
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Tambah Ruangan';
            $data['page'] = 'tambah_ruangan';
            $this->load->view('dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('nm_ruangan', 'Nama Ruangan', 'required|is_unique[ruangan.nm_ruangan]');
            $this->form_validation->set_rules('longitude', 'Longitude', 'required');
            $this->form_validation->set_rules('latitude', 'Latitude', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Tambah Ruangan';
                $data['page'] = 'tambah_ruangan';
                $data['error'] = validation_errors();
                $this->load->view('dashboard_admin_layout', $data);
            } else {
                unset($data);
                $nm_ruangan = $this->input->post('nm_ruangan');
                $longitude = $this->input->post('longitude');
                $latitude = $this->input->post('latitude');

                $save['nm_ruangan'] = $nm_ruangan;
                $save['longitude'] = $longitude;
                $save['latitude'] = $latitude;

                $hasil = $this->ruangan_model->_tambah_ruangan($save);
                if ($hasil == true) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Ruangan Berhasil ditambahkah</div>');
                    redirect('ruangan');
                } else {
                    print_r($hasil);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Ruangan Gagal ditambahkah</div>');
                    redirect('ruangan_tambah');
                }
                unset($save);
            }
        }
    }

    function edit_ruangan($id_ruangan)
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Edit Ruangan';
            $data['page'] = 'edit_ruangan';
            $data['get_ruangan'] = $this->ruangan_model->getRuangan($id_ruangan);
            $this->load->view('dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('nm_ruangan', 'Nama Ruangan', 'required');
            $this->form_validation->set_rules('longitude', 'Longitude', 'required');
            $this->form_validation->set_rules('latitude', 'Latitude', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Edit Ruangan';
                $data['page'] = 'edit_ruangan';
                $data['get_jurusan'] = $this->jurusan_model->getJurusan($id_ruangan);
                $data['error'] = validation_errors();
                $this->load->view('dashboard_admin_layout', $data);
            } else {
                unset($data);
                $nm_ruangan = $this->input->post('nm_ruangan');
                $longitude = $this->input->post('longitude');
                $latitude = $this->input->post('latitude');


                $update['nm_ruangan'] = $nm_ruangan;
                $update['longitude'] = $longitude;
                $update['latitude'] = $latitude;

                $hasil = $this->ruangan_model->_update_ruangan($id_ruangan, $update);
                if ($hasil == true) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Ruangan Berhasil diedit</div>');
                    redirect('ruangan');
                } else {
                    print_r($hasil);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Ruangan Gagal diedit</div>');
                    redirect('ruangan_edit');
                }
                unset($update);
            }
        }
    }

    function hapus_ruangan($id_ruangan)
    {
        $hasil = $this->ruangan_model->_delete_ruangan($id_ruangan);
        if ($hasil == true) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Ruangan Berhasil Dihapus</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Ruangan Berhasil Dihapus</div>');
        }
        redirect('ruangan');
    }
}
