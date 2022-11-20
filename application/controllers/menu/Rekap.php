<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author UNICORN
 */

class Rekap extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->is_logged_in();
    }

    private function is_logged_in()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('');
        }
    }

    function r_pertemuan_mahasiswa()
    {
        $data['titlepage'] = 'Rekap Pertemuan Mahasiswa';
        $data['page'] = 'r_pertemuan_mahasiswa';
        $this->load->view('dashboard_admin_layout', $data);
    }

    function r_presensi_mahasiswa()
    {
        $data['titlepage'] = 'Rekap Pertemuan Mahasiswa';
        $data['page'] = 'r_presensi_mahasiswa';
        $this->load->view('dashboard_admin_layout', $data);
    }

    function r_dosen()
    {
        $data['titlepage'] = 'Rekap Pertemuan Mahasiswa';
        $data['page'] = 'r_dosen';
        $this->load->view('dashboard_admin_layout', $data);
    }
}
