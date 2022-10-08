<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Master_satuan
 * @author Imam Syaifulloh <imam.syaifulloh12 at gmail.com>
 * @property donasi_model $donasi_model
 * @property string $table
 */

class Master_satuan extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $timezone = "Asia/Jakarta";
        date_default_timezone_set($timezone);
        $this->load->model('donasi_model');
        $this->table = 'donasi_mst_satuan';
    }

    public function index()
    {
        $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Donasi <i class="fa fa-angle-right"></i> Master Satuan';
        $data['page'] = 'donasi-master-satuan';
        $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
    }

    public function listdata()
    {
        $this->load->library('datatables');
        $result = $this->donasi_model->get_list_master_donasi_datatables();
        $this->output
            ->set_content_type('application/json')
            ->set_output($result);
    }

    public function tambah()
    {
        $proses_simpan = $this->input->post('simpan_data');
        if (!$proses_simpan) {
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Donasi <i class="fa fa-angle-right"></i> TambahMaster Satuan';
            $data['page'] = 'donasi-master-satuan-tambah';
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $this->_proses_simpan();
        }
    }

    private function _proses_simpan()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_satuan', 'Nama Satuan', 'required|is_unique[donasi_mst_satuan.nama_satuan]');
        if ($this->form_validation->run() == false) {
            $data['error'] = '<div class="alert alert-danger"><p>' . validation_errors(' ', '<br>') . '</p></div>';
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Donasi <i class="fa fa-angle-right"></i> Tambah Master Satuan';
            $data['page'] = 'donasi-master-satuan-tambah';
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $nama_satuan = $this->input->post('nama_satuan', true);
            $set_data = [
                'nama_satuan' => strtoupper($nama_satuan),
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('username'),
            ];
            $this->MY_Model->insert_data($this->table, $set_data);
            $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Proses simpan master satuan donasi berhasil.</p></div>');
            redirect('adminppid/donasi/master-satuan');
        }
    }

    public function edit($id)
    {
        $get_satuan = $this->MY_Model->get_where($this->table, ['id' => $id], 'row');
        if ($get_satuan) {
            $proses_simpan = $this->input->post('simpan_data');
            if (!$proses_simpan) {
                $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Donasi <i class="fa fa-angle-right"></i> Edit Master Satuan';
                $data['page'] = 'donasi-master-satuan-edit';
                $data['id'] = $id;
                $data['nama_satuan'] = $get_satuan->nama_satuan;
                $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
            } else {
                $this->_proses_edit($get_satuan);
            }
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-danger"><p>Data master satuan tidak ditemukan.</p></div>');
            redirect('adminppid/donasi/master-satuan');
        }
    }

    private function _proses_edit($get_satuan)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_satuan', 'Nama Satuan', 'required|is_unique[donasi_mst_satuan.nama_satuan]');
        $this->form_validation->set_rules('id', 'ID Satuan', 'required');
        if ($this->form_validation->run() == false) {
            $data['error'] = '<div class="alert alert-danger"><p>' . validation_errors(' ', '<br>') . '</p></div>';
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Donasi <i class="fa fa-angle-right"></i> Edit Master Satuan';
            $data['page'] = 'donasi-master-satuan-edit';
            $data['id'] = $get_satuan->id;
            $data['nama_satuan'] = $get_satuan->nama_satuan;
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $id = $this->input->post('id', true);
            if ($id === $get_satuan->id) {
                $nama_satuan = $this->input->post('nama_satuan', true);
                $set_data = [
                    'nama_satuan' => strtoupper($nama_satuan),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => $this->session->userdata('username'),
                ];
                $this->MY_Model->update_data($this->table, $set_data, ['id' => $get_satuan->id]);
                $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Proses update master satuan donasi berhasil.</p></div>');
            } else {
                $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Proses update master satuan donasi gagal, id master satuan tidak valid.</p></div>');
            }
            redirect('adminppid/donasi/master-satuan');
        }
    }
    //END OF CONTROLLER Master_satuan
}
