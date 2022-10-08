<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Donasi
 * @author Imam Syaifulloh <imam.syaifulloh12 at gmail.com>
 * @property donasi_model $donasi_model
 * @property string $table;
 * @property string $table_master_satuan
 */

class Donasi extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $timezone = "Asia/Jakarta";
        date_default_timezone_set($timezone);
        $this->load->model('donasi_model');
        $this->load->helper('convert');
        $this->table = 'donasi';
        $this->table_master_satuan = 'donasi_mst_satuan';
    }

    public function index()
    {
        $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Donasi';
        $data['page'] = 'donasi';
        $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
    }

    public function listdata()
    {
        $this->load->library('datatables');
        $result = $this->donasi_model->get_list_donasi_datatables();
        $this->output
            ->set_content_type('application/json')
            ->set_output($result);
    }

    public function tambah()
    {
        $proses_simpan = $this->input->post('simpan_data');
        if (!$proses_simpan) {
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Donasi <i class="fa fa-angle-right"></i> TambahMaster Satuan';
            $data['page'] = 'donasi-tambah';
            $data['list_satuan'] = $this->MY_Model->get_data_all($this->table_master_satuan);
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $this->_proses_simpan();
        }
    }

    private function _proses_simpan()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('tanggal_donasi', 'Tanggal Donasi', 'required|callback__check_tanggal');
        $this->form_validation->set_rules('nama_item', 'Nama Item', 'required');
        $this->form_validation->set_rules('pengirim_donasi', 'Pengirim Donasi', 'required');
        $this->form_validation->set_rules('id_donasi_mst_satuan', 'Satuan', 'required|callback__check_satuan');
        $this->form_validation->set_rules('qty', 'Qty', 'required|callback__validate_qty');
        $this->form_validation->set_rules('keterangan', 'Distribusi', 'required');
        if ($this->form_validation->run() == false) {
            $data['error'] = '<div class="alert alert-danger"><p>' . validation_errors(' ', '<br>') . '</p></div>';
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Donasi <i class="fa fa-angle-right"></i> TambahMaster Satuan';
            $data['page'] = 'donasi-tambah';
            $data['list_satuan'] = $this->MY_Model->get_data_all($this->table_master_satuan);
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $tanggal_donasi = $this->input->post('tanggal_donasi', true);
            $tanggal_donasi = date_sql($tanggal_donasi);
            $nama_item = $this->input->post('nama_item', true);
            $pengirim_donasi = $this->input->post('pengirim_donasi', true);
            $id_donasi_mst_satuan = $this->input->post('id_donasi_mst_satuan', true);
            $qty = $this->input->post('qty', true);
            $keterangan = $this->input->post('keterangan', true);
            $set_data = [
                'tanggal_donasi' => $tanggal_donasi,
                'nama_item' => $nama_item,
                'qty' => $qty,
                'pengirim_donasi' => $pengirim_donasi,
                'id_donasi_mst_satuan' => $id_donasi_mst_satuan,
                'keterangan' => $keterangan,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('username'),
            ];
            $this->MY_Model->insert_data($this->table, $set_data);
            $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Proses simpan donasi berhasil.</p></div>');
            redirect('adminppid/donasi');
        }
    }

    public function _check_tanggal($tanggal_donasi)
    {
        if (validate_date($tanggal_donasi)) {
            return true;
        } else {
            $this->form_validation->set_message('_check_tanggal', '{field} tidak valid.');
            return false;
        }
    }

    public function _check_satuan($id_donasi_mst_satuan)
    {
        $get_satuan = $this->MY_Model->get_where($this->table_master_satuan, ['id' => $id_donasi_mst_satuan]);
        if ($get_satuan) {
            return true;
        } else {
            $this->form_validation->set_message('_check_tanggal', '{field} tidak terdaftar.');
            return false;
        }
    }

    public function edit($id)
    {
        $get_donasi = $this->MY_Model->get_where($this->table, ['id' => $id], 'row');
        if ($get_donasi) {
            if (!empty($get_donasi->deleted_at)) {
                $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Tidak dapat melakukan edit data untuk donasi sudah dihapus.</p></div>');
                redirect('adminppid/donasi');
            } else {
                $proses_simpan = $this->input->post('simpan_data');
                if (!$proses_simpan) {
                    $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Donasi <i class="fa fa-angle-right"></i> Edit Master Satuan';
                    $data['page'] = 'donasi-edit';
                    $data['id'] = $id;
                    $data['tanggal_donasi'] = tgl_indo($get_donasi->tanggal_donasi);
                    $data['nama_item'] = $get_donasi->nama_item;
                    $data['qty'] = $get_donasi->qty;
                    $data['pengirim_donasi'] = $get_donasi->pengirim_donasi;
                    $data['keterangan'] = $get_donasi->keterangan;
                    $data['id_donasi_mst_satuan'] = $get_donasi->id_donasi_mst_satuan;
                    $data['keterangan'] = $get_donasi->keterangan;
                    $data['list_satuan'] = $this->MY_Model->get_data_all($this->table_master_satuan);
                    $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
                } else {
                    $this->_proses_edit($get_donasi);
                }
            }
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-danger"><p>Data master satuan tidak ditemukan.</p></div>');
            redirect('adminppid/donasi');
        }
    }

    public function _proses_edit($get_donasi)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'ID Donasi', 'required');
        $this->form_validation->set_rules('tanggal_donasi', 'Tanggal Donasi', 'required|callback__check_tanggal');
        $this->form_validation->set_rules('nama_item', 'Nama Item', 'required');
        $this->form_validation->set_rules('pengirim_donasi', 'Pengirim Donasi', 'required');
        $this->form_validation->set_rules('id_donasi_mst_satuan', 'Satuan', 'required|callback__check_satuan');
        $this->form_validation->set_rules('qty', 'Qty', 'required|callback__validate_qty');
        $this->form_validation->set_rules('keterangan', 'Distribusi', 'required');
        if ($this->form_validation->run() == false) {
            $data['error'] = '<div class="alert alert-danger"><p>' . validation_errors(' ', '<br>') . '</p></div>';
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Donasi <i class="fa fa-angle-right"></i> Edit Master Satuan';
            $data['page'] = 'donasi-edit';
            $data['id'] = $get_donasi->id;
            $data['tanggal_donasi'] = tgl_indo($get_donasi->tanggal_donasi);
            $data['nama_item'] = $get_donasi->nama_item;
            $data['qty'] = $get_donasi->qty;
            $data['pengirim_donasi'] = $get_donasi->pengirim_donasi;
            $data['keterangan'] = $get_donasi->keterangan;
            $data['id_donasi_mst_satuan'] = $get_donasi->id_donasi_mst_satuan;
            $data['list_satuan'] = $this->MY_Model->get_data_all($this->table_master_satuan);
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $id = $this->input->post('id', true);
            if ($id === $get_donasi->id) {
                $tanggal_donasi = $this->input->post('tanggal_donasi', true);
                $tanggal_donasi = date_sql($tanggal_donasi);
                $nama_item = $this->input->post('nama_item', true);
                $pengirim_donasi = $this->input->post('pengirim_donasi', true);
                $id_donasi_mst_satuan = $this->input->post('id_donasi_mst_satuan', true);
                $qty = $this->input->post('qty', true);
                $keterangan = $this->input->post('keterangan', true);
                $set_data = [
                    'tanggal_donasi' => $tanggal_donasi,
                    'nama_item' => $nama_item,
                    'qty' => $qty,
                    'pengirim_donasi' => $pengirim_donasi,
                    'id_donasi_mst_satuan' => $id_donasi_mst_satuan,
                    'keterangan' => $keterangan,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => $this->session->userdata('username'),
                ];
                $this->MY_Model->update_data($this->table, $set_data, ['id' => $get_donasi->id]);
                $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Proses update donasi berhasil.</p></div>');
            } else {
                $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Proses update donasi gagal, id donasi tidak valid.</p></div>');
            }
            redirect('adminppid/donasi');
        }
    }

    public function hapus($id)
    {
        $get_donasi = $this->MY_Model->get_where($this->table, ['id' => $id], 'row');
        if ($get_donasi) {
            if (!empty($get_donasi->deleted_at)) {
                $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Proses hapus donasi gagal, donasi sudah dihapus sebelumnya.</p></div>');
            } else {
                $set_data = [
                    'deleted_at' => date('Y-m-d H:i:s'),
                    'deleted_by' => $this->session->userdata('username'),
                ];
                $this->MY_Model->update_data($this->table, $set_data, ['id' => $get_donasi->id]);
                $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Proses hapus donasi berhasil.</p></div>');
            }
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-danger"><p>Data master satuan tidak ditemukan.</p></div>');
        }
        redirect('adminppid/donasi');
    }

    public function _validate_qty($qty)
    {
        if (preg_match("/(^\d+|^\d+[.]\d+)+$/", $qty)) {
            return true;
        } else {
            $this->form_validation->set_message('_validate_qty', '{field} tidak valid!');
            return false;
        }
    }
    //END OF CONTROLLER Donasi
}
