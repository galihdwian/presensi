<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 * Description of Statistik_permohonan_informasi
 * @author Imam Syaifulloh <imam.syaifulloh12 at gmail.com>
 * @property adminpermohonan_model $adminpermohonan_model
 * @property string $table
 */


class Statistik_permohonan_informasi extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $timezone = "Asia/Jakarta";
        date_default_timezone_set($timezone);
        $this->load->model('adminpermohonan_model');
        $this->load->helper('convert');
        $this->table = 'ip_rekapitulasi_permohonan_informasi';
    }

    public function index()
    {
        $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Statistik Permohonan Informasi';
        $data['page'] = 'permohonan_informasi_statistik';
        $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
    }

    public function listdata()
    {
        $this->load->library('datatables');
        $result = $this->adminpermohonan_model->get_list_statistik_permohonan_datatables();
        $this->output
            ->set_content_type('application/json')
            ->set_output($result);
    }

    public function tambah()
    {
        $proses_simpan = $this->input->post('simpan_data');
        if (!$proses_simpan) {
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Tambah Statistik Permohonan Informasi';
            $data['page'] = 'permohonan_informasi_statistik_tambah';
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $this->_proses_simpan();
        }
    }

    private function _proses_simpan()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required|numeric');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|numeric|callback__validasi_bulan_tahun');
        $this->form_validation->set_rules('permohonan_medsos_diterima', 'Jumlah Permohonan Melalui Medsos yang Diterima', 'required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('permohonan_medsos_disetujui', 'Jumlah Permohonan Melalui Medsos yang Disetujui', 'required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('permohonan_langsung_diterima', 'Jumlah Permohonan Langsung yang Diterima', 'required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('permohonan_langsung_disetujui', 'Jumlah Permohonan Langsung yang Disetujui', 'required|numeric|greater_than_equal_to[0]');
        if ($this->form_validation->run() == false) {
            $data['error'] = '<div class="alert alert-danger"><p>' . validation_errors(' ', '<br>') . '</p></div>';
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Tambah Statistik Permohonan Informasi';
            $data['page'] = 'permohonan_informasi_statistik_tambah';
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $bulan = $this->input->post('bulan', true);
            $tahun = $this->input->post('tahun', true);
            $permohonan_medsos_diterima = $this->input->post('permohonan_medsos_diterima', true);
            $permohonan_medsos_disetujui = $this->input->post('permohonan_medsos_disetujui', true);
            $permohonan_langsung_diterima = $this->input->post('permohonan_langsung_diterima', true);
            $permohonan_langsung_disetujui = $this->input->post('permohonan_langsung_disetujui', true);
            $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);
            $set_data = [
                'id_rekapitulasi' => $tahun . "-" . $bulan,
                'tahun' => $tahun,
                'bulan' => $bulan,
                'permohonan_medsos_diterima' => $permohonan_medsos_diterima,
                'permohonan_medsos_disetujui' => $permohonan_medsos_disetujui,
                'permohonan_langsung_diterima' => $permohonan_langsung_diterima,
                'permohonan_langsung_disetujui' => $permohonan_langsung_disetujui,
                'date_update' => date('Y-m-d H:i:s'),
                'user_update' => $this->session->userdata('username'),
            ];
            $this->MY_Model->insert_data($this->table, $set_data);
            $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Proses simpan rekapitulasi permohonan informasi berhasil.</p></div>');
            redirect('adminpermohonan/statistik');
        }
    }

    public function _validasi_bulan_tahun()
    {
        $bulan = $this->input->post('bulan', true);
        $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);
        $tahun = $this->input->post('tahun', true);
        $id_rekapitulasi = $tahun . "-" . $bulan;
        $get_statistik = $this->MY_Model->get_where($this->table, ['id_rekapitulasi' => $id_rekapitulasi]);
        if ($get_statistik) {
            $this->form_validation->set_message('_validasi_bulan_tahun', 'Bulan dan Tahun permohonan informasi sudah ada, silahkan gunakan fasilitas edit.');
            return false;
        } else {
            return true;
        }
    }

    public function edit($id_rekapitulasi)
    {
        $get_statistik = $this->MY_Model->get_where($this->table, ['id_rekapitulasi' => $id_rekapitulasi], 'row');
        if ($get_statistik) {
            $proses_simpan = $this->input->post('simpan_data');
            if (!$proses_simpan) {
                $data['id_rekapitulasi'] = $get_statistik->id_rekapitulasi;
                $data['tahun'] = $get_statistik->tahun;
                $data['bulan'] = $get_statistik->bulan;
                $data['permohonan_medsos_diterima'] = $get_statistik->permohonan_medsos_diterima;
                $data['permohonan_medsos_disetujui'] = $get_statistik->permohonan_medsos_disetujui;
                $data['permohonan_langsung_diterima'] = $get_statistik->permohonan_langsung_diterima;
                $data['permohonan_langsung_disetujui'] = $get_statistik->permohonan_langsung_disetujui;
                $data['date_update'] = $get_statistik->date_update;
                $data['user_update'] = $get_statistik->user_update;
                $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Edit Statistik Permohonan Informasi';
                $data['page'] = 'permohonan_informasi_statistik_edit';
                $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
            } else {
                $this->_proses_update($get_statistik);
            }
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-danger"><p>Data rekapitulasi permohonan informasi tidak ditemukan.</p></div>');
            redirect('adminpermohonan/statistik');
        }
    }

    private function _proses_update($get_statistik)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_rekapitulasi', 'ID', 'required');
        $this->form_validation->set_rules('permohonan_medsos_diterima', 'Jumlah Permohonan Melalui Medsos yang Diterima', 'required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('permohonan_medsos_disetujui', 'Jumlah Permohonan Melalui Medsos yang Disetujui', 'required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('permohonan_langsung_diterima', 'Jumlah Permohonan Langsung yang Diterima', 'required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('permohonan_langsung_disetujui', 'Jumlah Permohonan Langsung yang Disetujui', 'required|numeric|greater_than_equal_to[0]');
        if ($this->form_validation->run() == false) {
            $data['error'] = '<div class="alert alert-danger"><p>' . validation_errors(' ', '<br>') . '</p></div>';
            $data['id_rekapitulasi'] = $get_statistik->id_rekapitulasi;
            $data['tahun'] = $get_statistik->tahun;
            $data['bulan'] = $get_statistik->bulan;
            $data['permohonan_medsos_diterima'] = $get_statistik->permohonan_medsos_diterima;
            $data['permohonan_medsos_disetujui'] = $get_statistik->permohonan_medsos_disetujui;
            $data['permohonan_langsung_diterima'] = $get_statistik->permohonan_langsung_diterima;
            $data['permohonan_langsung_disetujui'] = $get_statistik->permohonan_langsung_disetujui;
            $data['date_update'] = $get_statistik->date_update;
            $data['user_update'] = $get_statistik->user_update;
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Edit Statistik Permohonan Informasi';
            $data['page'] = 'permohonan_informasi_statistik_edit';
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $id_rekapitulasi = $this->input->post('id_rekapitulasi', true);
            $permohonan_medsos_diterima = $this->input->post('permohonan_medsos_diterima', true);
            $permohonan_medsos_disetujui = $this->input->post('permohonan_medsos_disetujui', true);
            $permohonan_langsung_diterima = $this->input->post('permohonan_langsung_diterima', true);
            $permohonan_langsung_disetujui = $this->input->post('permohonan_langsung_disetujui', true);
            if ($id_rekapitulasi === $get_statistik->id_rekapitulasi) {
                $set_data = [
                    'permohonan_medsos_diterima' => $permohonan_medsos_diterima,
                    'permohonan_medsos_disetujui' => $permohonan_medsos_disetujui,
                    'permohonan_langsung_diterima' => $permohonan_langsung_diterima,
                    'permohonan_langsung_disetujui' => $permohonan_langsung_disetujui,
                    'date_update' => date('Y-m-d H:i:s'),
                    'user_update' => $this->session->userdata('username'),
                ];
                $this->MY_Model->update_data($this->table, $set_data, ['id_rekapitulasi' => $id_rekapitulasi]);
                $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Proses update rekapitulasi permohonan informasi berhasil.</p></div>');
                redirect('adminpermohonan/statistik');
            } else {
                $this->session->set_flashdata('message_status', '<div class="alert alert-danger"><p>Proses update rekapitulasi statistik permohonan informasi gagal. ID tidak valid.</p></div>');
                redirect('adminpermohonan/statistik');
            }
        }
    }
    //END OF CONTROLLER Statistik_permohonan_informasi
}
