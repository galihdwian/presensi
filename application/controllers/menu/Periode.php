<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author UNICORN
 * @property periode_model $periode_model
 */

class Periode extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model("periode_model");
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
        $data['titlepage'] = 'Periode';
        $data['page'] = 'periode';
        $data['list_periode'] = $this->periode_model->getListPeriode();
        $this->load->view('dashboard_admin_layout', $data);
    }

    function status_aktivasi_periode($id_periode, $status)
    {
        $update['status'] = $status;
        $hasil = $this->periode_model->setAktivasi($id_periode, $update);
        if ($hasil == true) {
            if ($status == 1) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Periode Berhasil diaktifkan</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Periode Berhasil dinonaktifkan</div>');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Proses Gagal</div>');
        }

        redirect('periode');
    }

    function tambah_periode()
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Tambah Periode';
            $data['page'] = 'tambah_periode';
            $this->load->view('dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('tahun_periode', 'Tahun Periode', 'required');
            $this->form_validation->set_rules('semester', 'Semester', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Tambah Periode';
                $data['page'] = 'tambah_periode';
                $data['error'] = validation_errors();
                $this->load->view('dashboard_admin_layout', $data);
            } else {
                unset($data);
                $tahun_periode = $this->input->post('tahun_periode');
                $semester = $this->input->post('semester');


                $save['tahun_periode'] = $tahun_periode;
                $save['semester'] = $semester;
                $save['status'] = 0;

                $hasil = $this->periode_model->_tambah_periode($save);
                if ($hasil == true) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Periode Berhasil ditambahkah</div>');
                    redirect('periode');
                } else {
                    print_r($hasil);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Periode Gagal ditambahkah</div>');
                    redirect('periode_tambah');
                }
                unset($save);
            }
        }
    }

    function edit_periode($id_periode)
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Edit Periode';
            $data['page'] = 'edit_periode';
            $data['get_periode'] = $this->periode_model->getPeriode($id_periode);
            $this->load->view('dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('tahun_periode', 'Tahun Periode', 'required');
            $this->form_validation->set_rules('semester', 'Semester', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Edit Periode';
                $data['page'] = 'edit_periode';
                $data['get_dosen'] = $this->periode_model->getPeriode($id_periode);
                $data['error'] = validation_errors();
                $this->load->view('dashboard_admin_layout', $data);
            } else {
                unset($data);
                $tahun_periode = $this->input->post('tahun_periode');
                $semester = $this->input->post('semester');

                $update['tahun_periode'] = $tahun_periode;
                $update['semester'] = $semester;

                $hasil = $this->periode_model->_update_periode($id_periode, $update);
                if ($hasil == true) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Periode Berhasil diupdate</div>');
                    redirect('periode');
                } else {
                    print_r($hasil);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Periode Gagal diupdate</div>');
                    redirect('periode_edit');
                }
                unset($update);
            }
        }
    }
}
