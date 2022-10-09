<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author UNICORN
 * @property matkul_model $matkul_model
 * @property dosen_model $dosen_model
 * @property mahasiswa_model $mahasiswa_model
 * @property pertemuan_model $pertemuan_model
 * @property presensi_model $presensi_model
 */

class Presensi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model("matkul_model");
        $this->load->model("dosen_model");
        $this->load->model("mahasiswa_model");
        $this->load->model("pertemuan_model");
        $this->load->model("presensi_model");
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
        $data['titlepage'] = 'Presensi';
        $data['page'] = 'presensi';
        $data['list_presensi'] = $this->matkul_model->getListMatkul();
        $this->load->view('dashboard_admin_layout', $data);
    }

    function pertemuan_detail($id_matkul)
    {
        $data['titlepage'] = 'Detail Pertemuan';
        $data['page'] = 'detail_pertemuan';
        $data['list_detail_pertemuan'] = $this->pertemuan_model->getListPertemuanbymatkul($id_matkul);
        $this->load->view('dashboard_admin_layout', $data);
    }

    function absen_detail($id_pertemuan)
    {
        $data['titlepage'] = 'Detail Absen';
        $data['page'] = 'detail_absen';
        $data['list_detail_absen'] = $this->presensi_model->getListDetailAbsen($id_pertemuan);
        $this->load->view('dashboard_admin_layout', $data);
    }
}
