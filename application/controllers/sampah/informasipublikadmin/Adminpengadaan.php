<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Adminpengadaan
 * @author Imam Syaifulloh <imam.syaifulloh12 at gmail.com>
 * @property adminpengadaan_model $adminpengadaan_model
 */
class Adminpengadaan extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $timezone = "Asia/Jakarta";
        date_default_timezone_set($timezone);
        $this->load->model('adminpengadaan_model');
        $this->load->helper('convert');
    }

    function index()
    {
        $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Pengadaan <i class="fa fa-angle-right"></i> List Informasi Pengadaan';
        $data['page'] = 'pengadaan';
        $data['list_tahun_pengadaan'] = $this->adminpengadaan_model->pengadaan_get_list_tahun();
        $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
    }

    function list_pengadaan($tahun_pengadaan = null)
    {
        $tahun_pengadaan = $tahun_pengadaan != null ? rawurldecode($tahun_pengadaan) : date('Y');
        $data['list_pengadaan'] = $this->MY_Model->get_where('pengadaan_tb', array('tahunpengadaan' => $tahun_pengadaan, 'deleted' => 'F'), 'result', null, null, array('tgl_upload' => 'DESC'));
        $data['list_dokumen_rs'] = $this->adminpengadaan_model->pengadaan_get_dokumen($tahun_pengadaan);
        $data['tahun_pengadaan'] = $tahun_pengadaan;
        $this->load->view('informasipublikadmin/pengadaan/pengadaan_list', $data);
    }

    function master_dokumen()
    {
        $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Pengadaan <i class="fa fa-angle-right"></i> Master Dokumen';
        $data['page'] = 'pengadaan_master_dokumen';
        $data['list_master_dokumen'] = $this->MY_Model->get_data_all('pengadaan_master_dokumen', array('tipedokumen' => 'ASC', 'urutan' => 'ASC'));
        $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
    }

    function master_dokumen_tambah_data()
    {
        $simpan_data = $this->input->post('simpan_data', true);
        if ($simpan_data == 'proses_simpan') {
            $this->_proses_simpan_master_dokumen();
        } else {
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Pengadaan <i class="fa fa-angle-right"></i> Master Dokumen <i class="fa fa-angle-right"></i> Tambah Data';
            $data['page'] = 'pengadaan_master_dokumen_tambah_data';
            $max_urutan = $this->MY_Model->get_max_value('pengadaan_master_dokumen', 'urutan');
            $data['urutan'] = ($max_urutan + 1);
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        }
    }

    private function _proses_simpan_master_dokumen()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('iddokumen', 'ID Dokumen', 'required|is_unique[pengadaan_master_dokumen.iddokumen]');
        $this->form_validation->set_rules('namadokumen', 'Nama Dokumen', 'required|is_unique[pengadaan_master_dokumen.namadokumen]');
        $this->form_validation->set_rules('urutan', 'Urutan Tampil', 'required|numeric');
        $this->form_validation->set_rules('tipedokumen', 'Tipe Dokumen', 'required');
        if ($this->form_validation->run() == false) {
            $data['error'] = '<div class="alert alert-danger">' . validation_errors('<p>', '</p>') . '</div>';
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Pengadaan <i class="fa fa-angle-right"></i> Master Dokumen <i class="fa fa-angle-right"></i> Tambah Data';
            $data['page'] = 'pengadaan_master_dokumen_tambah_data';
            $max_urutan = $this->MY_Model->get_max_value('pengadaan_master_dokumen', 'urutan');
            $data['urutan'] = ($max_urutan + 1);
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $table = 'pengadaan_master_dokumen';
            $iddokumen = $this->input->post('iddokumen', true);
            $namadokumen = $this->input->post('namadokumen', true);
            $urutan = $this->input->post('urutan', true);
            $lpsesufix = $this->input->post('lpsesufix', true);
            $lpseprefix = $this->input->post('lpseprefix', true);
            $tipedokumen = $this->input->post('tipedokumen', true);
            $get_urutan_lebih_besar = $this->MY_Model->get_where($table, array('urutan >=' => $urutan, 'tipedokumen' => $tipedokumen));
            if ($get_urutan_lebih_besar):
                foreach ($get_urutan_lebih_besar as $row) {
                    $urutan_lama = $row->urutan;
                    $iddokumen_lama = $row->iddokumen;
                    $set_update['urutan'] = ($urutan_lama + 1);
                    $this->MY_Model->update_data($table, $set_update, array('iddokumen' => $iddokumen_lama));
                }
            endif;
            $set['iddokumen'] = $iddokumen;
            $set['namadokumen'] = $namadokumen;
            $set['urutan'] = $urutan;
            $set['lpsesufix'] = $lpsesufix;
            $set['lpseprefix'] = $lpseprefix;
            $set['tipedokumen'] = $tipedokumen;
            $this->MY_Model->insert_data($table, $set);
            $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Proses simpan master dokumen berhasil.</p></div>');
            redirect('adminppid/pengadaan/master_dokumen');
        }
    }

    function master_dokumen_edit_data($id_dokumen = null)
    {
        if ($id_dokumen != null) {
            $id_dokumen = rawurldecode($id_dokumen);
            $get_dokumen = $this->MY_Model->get_where('pengadaan_master_dokumen', array('iddokumen' => $id_dokumen), 'row');
            if ($get_dokumen) {
                $simpan_data = $this->input->post('simpan_data', true);
                if ($simpan_data == 'proses_simpan') {
                    $this->_proses_update_master_dokumen($id_dokumen, $get_dokumen);
                } else {
                    $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Pengadaan <i class="fa fa-angle-right"></i> Master Dokumen <i class="fa fa-angle-right"></i> Edit Data';
                    $data['page'] = 'pengadaan_master_dokumen_edit_data';
                    $data['id_dokumen'] = $id_dokumen;
                    $data['get_dokumen'] = $get_dokumen;
                    $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
                }
            } else {
                $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Data master dokumen tidak ditemukan.</p></div>');
                redirect('adminppid/pengadaan/master_dokumen');
            }
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-danger"><p>Proses tidak dapat dilanjutkan.</p></div>');
            redirect('adminppid/pengadaan/master_dokumen');
        }
    }

    private function _proses_update_master_dokumen($id_dokumen, $get_dokumen)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('iddokumen', 'ID Dokumen', 'required');
        $this->form_validation->set_rules('namadokumen', 'Nama Dokumen', 'required|callback__validasi_namadokumen');
        $this->form_validation->set_rules('urutan', 'Urutan Tampil', 'required|numeric');
        $this->form_validation->set_rules('tipedokumen', 'Tipe Dokumen', 'required');
        if ($this->form_validation->run() == false) {
            $data['error'] = '<div class="alert alert-danger">' . validation_errors('<p>', '</p>') . '</div>';
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Pengadaan <i class="fa fa-angle-right"></i> Master Dokumen <i class="fa fa-angle-right"></i> Edit Data';
            $data['page'] = 'pengadaan_master_dokumen_edit_data';
            $data['id_dokumen'] = $id_dokumen;
            $data['get_dokumen'] = $get_dokumen;
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $table = 'pengadaan_master_dokumen';
            $iddokumen = $this->input->post('iddokumen', true);
            $namadokumen = $this->input->post('namadokumen', true);
            $urutan = $this->input->post('urutan', true);
            $urutan_lama = $this->input->post('urutan_lama', true);
            $lpsesufix = $this->input->post('lpsesufix', true);
            $lpseprefix = $this->input->post('lpseprefix', true);
            $tipedokumen = $this->input->post('tipedokumen', true);
            if ($urutan != $urutan_lama) {
                $get_urutan_lebih_besar = $this->MY_Model->get_where($table, array('urutan >=' => $urutan, 'tipedokumen' => $tipedokumen));
                if ($get_urutan_lebih_besar):
                    foreach ($get_urutan_lebih_besar as $row) {
                        $urutan_lama = $row->urutan;
                        $iddokumen_lama = $row->iddokumen;
                        $set_update['urutan'] = ($urutan_lama + 1);
                        $this->MY_Model->update_data($table, $set_update, array('iddokumen' => $iddokumen_lama));
                    }
                endif;
            }
            $set['namadokumen'] = $namadokumen;
            $set['urutan'] = $urutan;
            $set['lpsesufix'] = $lpsesufix;
            $set['lpseprefix'] = $lpseprefix;
            $set['tipedokumen'] = $tipedokumen;
            $this->MY_Model->update_data($table, $set, array('iddokumen' => $iddokumen));
            $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Proses update master dokumen berhasil.</p></div>');
            redirect('adminppid/pengadaan/master_dokumen');
        }
    }

    function _validasi_namadokumen()
    {
        $iddokumen = $this->input->post('iddokumen', true);
        $namadokumen = $this->input->post('namadokumen', true);
        $check_exist = $this->MY_Model->get_where('pengadaan_master_dokumen', array('namadokumen' => $namadokumen, 'iddokumen !=' => $iddokumen));
        if ($check_exist) {
            $this->form_validation->set_message('_validasi_namadokumen', '{field} sudah terdaftar di master dokumen.');
            return FALSE;
        } else {
            return true;
        }
    }

    function tambah_data($tahun_pengadaan = null)
    {
        $tahun_pengadaan = $tahun_pengadaan != null ? rawurldecode($tahun_pengadaan) : date('Y');
        $simpan_data = $this->input->post('simpan_data', true);
        if ($simpan_data == 'proses_simpan') {
            $this->_proses_simpan_pengadaan($tahun_pengadaan);
        } else {
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Pengadaan <i class="fa fa-angle-right"></i> Tambah Data';
            $data['page'] = 'pengadaan_tambah_data';
            $data['tahun_pengadaan'] = $tahun_pengadaan;
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        }
    }

    private function _proses_simpan_pengadaan($tahun_pengadaan)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_paket', 'Nama Paket Pengadaan', 'required|callback__validasi_namapaket');
        $this->form_validation->set_rules('tahunpengadaan', 'Tahun Pengadaan', 'required|numeric');
        $this->form_validation->set_rules('sumber_anggaran', 'Sumber Anggaran', 'required');
        $this->form_validation->set_rules('pagu_anggaran', 'Pagu Anggaran', 'required');
        $this->form_validation->set_rules('nilai_kontrak', 'Nilai Kontrak', 'required');
        $this->form_validation->set_rules('idtender', 'ID Tender LPSE', 'callback__validasi_id_tender');
        $this->form_validation->set_rules('jenis_pengadaan', 'Jenis Pengadaan', 'required');
        $this->form_validation->set_rules('penyedia', 'Penyedia', 'callback__validasi_penyedia');
        $this->form_validation->set_rules('tanggal_kontrak', 'Tanggal Kontrak', 'callback__validasi_tanggal_kontrak');
        $this->form_validation->set_rules('nomor_kontrak', 'Nomor Kontrak', 'callback__validasi_nomor_kontrak');
        if ($this->form_validation->run() == false) {
            $data['error'] = '<div class="alert alert-danger">' . validation_errors('<p>', '</p>') . '</div>';
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Pengadaan <i class="fa fa-angle-right"></i> Tambah Data';
            $data['page'] = 'pengadaan_tambah_data';
            $data['tahun_pengadaan'] = $tahun_pengadaan;
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $nama_paket = $this->input->post('nama_paket', true);
            $tahunpengadaan_post = $this->input->post('tahunpengadaan', true);
            $sumber_anggaran = $this->input->post('sumber_anggaran', true);
            $pagu_anggaran = $this->input->post('pagu_anggaran', true);
            $nilai_kontrak = $this->input->post('nilai_kontrak', true);
            $idtender = $this->input->post('idtender', true);
            $jenis_pengadaan = $this->input->post('jenis_pengadaan', true);
            $penyedia = $this->input->post('penyedia', true);
            $tanggal_kontrak = $this->input->post('tanggal_kontrak', true);
            $nomor_kontrak = $this->input->post('nomor_kontrak', true);
            $prefix_id_paket = 'P-' . date('ymd') . '-';
            $table = 'pengadaan_tb';
            $max_pengadaan = $this->MY_Model->get_max_field($table, 'id_paket', 10, array('tahunpengadaan' => $tahunpengadaan_post));
            $sufix_id_paket = str_pad(($max_pengadaan + 1), 3, '0', STR_PAD_LEFT);
            $id_paket = $prefix_id_paket . $sufix_id_paket;
            $set = array(
                'id_paket' => $id_paket,
                'nama_paket' => $nama_paket,
                'id_user' => $this->session->userdata('id_user'),
                'verivikasi' => 'T',
                'tgl_upload' => date('Y-m-d H:i:s'),
                'deleted' => 'F',
                'tahunpengadaan' => $tahunpengadaan_post,
                'pengumumanlpse' => ($idtender != '' ? 1 : 0),
                'idtender' => ($idtender != '' ? $idtender : null),
                'sumber_anggaran' => $sumber_anggaran,
                'pagu_anggaran' => str_replace('.', '', $pagu_anggaran),
                'nilai_kontrak' => str_replace('.', '', $nilai_kontrak),
                'jenis_pengadaan' => $jenis_pengadaan,
                'penyedia' => (!empty($penyedia) ? $penyedia : null),
                'tanggal_kontrak' => (!empty($tanggal_kontrak) ? tgl_sql($tanggal_kontrak) : null),
                'nomor_kontrak' => (!empty($nomor_kontrak) ? $nomor_kontrak : null)
            );
            $this->MY_Model->insert_data($table, $set);
            $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Proses simpan data pengadaan berhasil.</p></div>');
            redirect('adminppid/pengadaan/list_dokumen_pengadaan/' . strtolower($id_paket));
        }
    }

    function _validasi_id_tender($id_tender)
    {
        if (!empty($id_tender)) {
            $check_exist = $this->MY_Model->get_where('pengadaan_tb', array('idtender' => $id_tender));
            if ($check_exist) {
                $this->form_validation->set_message('_validasi_id_tender', '{field} sudah terdaftar di list pengadaan.');
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    function _validasi_namapaket()
    {
        $tahunpengadaan_post = $this->input->post('tahunpengadaan', true);
        $nama_paket = $this->input->post('nama_paket', true);
        $check_exist = $this->MY_Model->get_where('pengadaan_tb', array('nama_paket' => $nama_paket, 'tahunpengadaan' => $tahunpengadaan_post));
        if ($check_exist) {
            $this->form_validation->set_message('_validasi_namapaket', '{field} sudah terdaftar di list pengadaan.');
            return false;
        } else {
            return true;
        }
    }

    function _validasi_penyedia($penyedia)
    {
        $jenis_pengadaan = $this->input->post('jenis_pengadaan', true);
        if ($jenis_pengadaan == 'Tender' || $jenis_pengadaan == 'Tender Cepat') {
            return true;
        } else {
            if (!empty($penyedia)) {
                return true;
            } else {
                $this->form_validation->set_message('_validasi_penyedia', '{field} harus diisi, keculai jika memilih jenis pengadaan tender atau tender cepat.');
                return false;
            }
        }
    }

    function _validasi_tanggal_kontrak($tanggal_kontrak)
    {
        $jenis_pengadaan = $this->input->post('jenis_pengadaan', true);
        if ($jenis_pengadaan == 'Tender' || $jenis_pengadaan == 'Tender Cepat') {
            return true;
        } else {
            if (!empty($tanggal_kontrak)) {
                if (validate_date($tanggal_kontrak, 'ID') == true) {
                    return true;
                } else {
                    $this->form_validation->set_message('_validasi_tanggal_kontrak', '{field} harus dengan format yang sesuai (dd-mm-yyyy).');
                    return false;
                }
            } else {
                $this->form_validation->set_message('_validasi_tanggal_kontrak', '{field} harus diisi, keculai jika memilih jenis pengadaan tender atau tender cepat.');
                return false;
            }
        }
    }

    function _validasi_nomor_kontrak($nomor_kontrak)
    {
        $jenis_pengadaan = $this->input->post('jenis_pengadaan', true);
        if ($jenis_pengadaan == 'Tender' || $jenis_pengadaan == 'Tender Cepat') {
            return true;
        } else {
            if (!empty($nomor_kontrak)) {
                return true;
            } else {
                $this->form_validation->set_message('_validasi_nomor_kontrak', '{field} harus diisi, keculai jika memilih jenis pengadaan tender atau tender cepat.');
                return false;
            }
        }
    }

    function list_dokumen_pengadaan($id_paket = null)
    {
        if ($id_paket != null) {
            $get_detail_paket = $this->MY_Model->get_where('pengadaan_tb', array('id_paket' => $id_paket), 'row');
            if ($get_detail_paket) {
                $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Pengadaan <i class="fa fa-angle-right"></i> List Dokumen Pengadaan';
                $data['page'] = 'pengadaan_list_dokumen_pengadaan';
                $data['detail_pengadaan'] = $get_detail_paket;
                $data['list_dokumen'] = $this->adminpengadaan_model->pengadaan_get_list_dokumen($id_paket);
                $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
            } else {
                $this->session->set_flashdata('message_status', '<div class="alert alert-warnin"><p>Detail paket pengadaan tidak ditemukan.</p></div>');
                redirect('adminppid/pengadaan');
            }
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-danger"><p>Proses tidak dapat dilanjutkan.</p></div>');
            redirect('adminppid/pengadaan');
        }
    }

    function tambah_dokumen_pengadaan($id_paket = null)
    {
        if ($id_paket != null) {
            $get_detail_paket = $this->MY_Model->get_where('pengadaan_tb', array('id_paket' => $id_paket), 'row');
            if ($get_detail_paket) {
                $simpan_data = $this->input->post('simpan_data', true);
                if ($simpan_data == 'proses_simpan') {
                    $this->_proses_simpan_dokumen_pengadaan($id_paket, $get_detail_paket);
                } else {
                    $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Pengadaan <i class="fa fa-angle-right"></i> Tambah Dokumen Pengadaan';
                    $data['page'] = 'pengadaan_tambah_dokumen_pengadaan';
                    $data['detail_pengadaan'] = $get_detail_paket;
                    $data['list_jenis_dokumen'] = $this->MY_Model->get_where('pengadaan_master_dokumen', array('tipedokumen' => '01'), 'result', null, null, array('urutan' => 'ASC'));
                    $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
                }
            } else {
                $this->session->set_flashdata('message_status', '<div class="alert alert-warnin"><p>Detail paket pengadaan tidak ditemukan.</p></div>');
                redirect('adminppid/pengadaan');
            }
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-danger"><p>Proses tidak dapat dilanjutkan.</p></div>');
            redirect('adminppid/pengadaan');
        }
    }

    private function _proses_simpan_dokumen_pengadaan($id_paket, $get_detail_paket)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('iddokumen', 'Jenis Dokumen', 'required');
        $this->form_validation->set_rules('link_lpse', 'Link Ke LPSE Jawa Tengah', '', 'required');
        $link_lpse = $this->input->post('link_lpse', true);
        $direct_link = $this->input->post('direct_link', true);
        if ($link_lpse != '1' && empty($direct_link)) {
            $this->form_validation->set_rules('id_file', 'File', 'required|callback__validasi_filedokumen_pengadaan');
        } elseif ($link_lpse != '1' && !empty($direct_link)) {
            $this->form_validation->set_rules('direct_link', 'Link Langsung', 'required|valid_url');
        }
        if ($this->form_validation->run() == false) {
            $data['error'] = '<div class="alert alert-danger">' . validation_errors('<p>', '</p>') . '</div>';
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Pengadaan <i class="fa fa-angle-right"></i> Tambah Dokumen Pengadaan';
            $data['page'] = 'pengadaan_tambah_dokumen_pengadaan';
            $data['detail_pengadaan'] = $get_detail_paket;
            $data['list_jenis_dokumen'] = $this->MY_Model->get_where('pengadaan_master_dokumen', array('tipedokumen' => '01'), 'result', null, null, array('urutan' => 'ASC'));
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $iddokumen = $this->input->post('iddokumen', true);
            $id_paket = $this->input->post('id_paket', true);
            $id_file = $this->input->post('id_file', true);
            $link_lpse = $this->input->post('link_lpse', true);
            $keterangan = $this->input->post('keterangan', true);
            $prefix_id_paket = 'DP-';
            $table = 'pengadaan_dokumen_paket';
            $max_pengadaan = $this->MY_Model->get_max_field($table, 'idlistdokumen', 4);
            $sufix_id_paket = str_pad(($max_pengadaan + 1), 6, '0', STR_PAD_LEFT);
            $idlistdokumen = $prefix_id_paket . $sufix_id_paket;
            $set = array(
                'id_paket' => $id_paket,
                'iddokumen' => $iddokumen,
                'idlistdokumen' => $idlistdokumen,
                'id_file' => ($link_lpse == '1' ? null : $id_file),
                'keterangan' => ($keterangan != '' ? $keterangan : null),
                'date_set_dokumen' => date('Y-m-d H:i:s'),
                'user_set_dokumen' => $this->session->userdata('username'),
                'link_lpse' => (int) $link_lpse,
                'deleted' => 0,
                'direct_link' => $direct_link
            );
            $this->MY_Model->insert_data($table, $set);
            $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Proses simpan dokumen pengadaan berhasil.</p></div>');
            redirect('adminppid/pengadaan/list_dokumen_pengadaan/' . strtolower($id_paket));
        }
    }

    function _validasi_filedokumen_pengadaan()
    {
        $id_paket = $this->input->post('id_paket', true);
        $id_file = $this->input->post('id_file', true);
        if ($id_file != '0') {
            $check_exist = $this->MY_Model->get_where('pengadaan_dokumen_paket', array('id_paket' => $id_paket, 'id_file' => $id_file, 'deleted' => 0));
            if ($check_exist) {
                $this->form_validation->set_message('_validasi_filedokumen_pengadaan', '{field} sudah terdaftar di list dokumen pengadaan.');
                return FALSE;
            } else {
                return true;
            }
        } else {
            $this->form_validation->set_message('_validasi_filedokumen_pengadaan', '{field} harus diisi.');
            return FALSE;
        }
    }

    function delete_dokumen_pengadaan($id_paket = null, $id_dokumen = null, $id_file_dokumen = null)
    {
        if ($id_paket != null && $id_dokumen != null && $id_file_dokumen != null) {
            $id_paket = rawurldecode($id_paket);
            $id_dokumen = rawurldecode($id_dokumen);
            $id_file_dokumen = rawurldecode($id_file_dokumen);
            $table = 'pengadaan_dokumen_paket';
            $where = array(
                'id_paket' => $id_paket,
                'iddokumen' => $id_dokumen,
                'idlistdokumen' => $id_file_dokumen
            );
            $check_exist = $this->MY_Model->get_where($table, $where);
            if ($check_exist) {
                $set['deleted'] = 1;
                $this->MY_Model->update_data($table, $set, $where);
                $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Proses hapus dokumen pengadaan berhasil.</p></div>');
            } else {
                $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Dokumen tidak ditemukan.</p></div>');
            }
            redirect('adminppid/pengadaan/list_dokumen_pengadaan/' . $id_paket);
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-danger"><p>Proses tidak dapat dilanjutkan.</p></div>');
            if ($id_paket != null) {
                redirect('adminppid/pengadaan/list_dokumen_pengadaan/' . $id_paket);
            } else {
                redirect('adminppid/pengadaan/master_dokumen');
            }
        }
    }

    function pencarian_file()
    {
        $response['success'] = false;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('key', 'Kata Kunci Pencarian', 'required');
        if ($this->form_validation->run() == false) {
            $response['message'] = validation_errors(' ', '<br>');
        } else {
            $keyword = $this->input->post('key', true);
            $get_list_file_sub = $this->informasipublikadmin_model->get_list_filesub($keyword, array());
            if ($get_list_file_sub) {
                $response['success'] = true;
                $response['data'] = $get_list_file_sub;
            } else {
                $response['message'] = 'Tidak ditemukan file untuk dengan keyword ' . $keyword;
            }
        }
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
    }

    function delete_data_pengadaan($id_paket = null)
    {
        if ($id_paket != null) {
            $id_paket = rawurldecode($id_paket);
            $table = 'pengadaan_tb';
            $where = array('id_paket' => $id_paket);
            $get_data_pengadaan = $this->MY_Model->get_where($table, $where);
            if ($get_data_pengadaan) {
                $set['deleted'] = 'T';
                $this->MY_Model->update_data($table, $set, $where);
                $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Proses hapus data pengadaan berhasil.</p></div>');
            } else {
                $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Data pengadaan tidak ditemukan.</p></div>');
            }
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-danger"><p>Proses tidak dapat dilanjutkan.</p></div>');
        }
        redirect('adminppid/pengadaan');
    }

    function edit_data_pengadaan($id_paket = null)
    {
        if ($id_paket != null) {
            $id_paket = rawurldecode($id_paket);
            $table = 'pengadaan_tb';
            $where = array('id_paket' => $id_paket, 'deleted' => 'F');
            $get_data_pengadaan = $this->MY_Model->get_where($table, $where, 'row');
            $simpan_data = $this->input->post('simpan_data', true);
            if ($simpan_data == 'proses_simpan') {
                $this->_proses_update_pengadaan($get_data_pengadaan);
            } else {
                $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Pengadaan <i class="fa fa-angle-right"></i> Edit Data';
                $data['page'] = 'pengadaan_edit_data';
                $data['detail_pengadaan'] = $get_data_pengadaan;
                $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
            }
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-danger"><p>Proses tidak dapat dilanjutkan.</p></div>');
            redirect('adminppid/pengadaan');
        }
    }

    private function _proses_update_pengadaan($get_data_pengadaan)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_paket', 'ID Paket Pengadaan', 'required');
        //$this->form_validation->set_rules('nama_paket', 'Nama Paket Pengadaan', 'required|callback__validasi_update_namapaket');
        $this->form_validation->set_rules('nama_paket', 'Nama Paket Pengadaan', 'required');
        $this->form_validation->set_rules('tahunpengadaan', 'Tahun Pengadaan', 'required|numeric');
        $this->form_validation->set_rules('sumber_anggaran', 'Sumber Anggaran', 'required');
        $this->form_validation->set_rules('pagu_anggaran', 'Pagu Anggaran', 'required');
        $this->form_validation->set_rules('nilai_kontrak', 'Nilai Kontrak', 'required');
        $this->form_validation->set_rules('idtender', 'ID Tender LPSE', 'callback__validasi_id_tender');
        $this->form_validation->set_rules('jenis_pengadaan', 'Jenis Pengadaan', 'required');
        $this->form_validation->set_rules('penyedia', 'Penyedia', 'callback__validasi_penyedia');
        $this->form_validation->set_rules('tanggal_kontrak', 'Tanggal Kontrak', 'callback__validasi_tanggal_kontrak');
        $this->form_validation->set_rules('nomor_kontrak', 'Nomor Kontrak', 'callback__validasi_nomor_kontrak');
        if ($this->form_validation->run() == false) {
            $data['error'] = '<div class="alert alert-danger">' . validation_errors('<p>', '</p>') . '</div>';
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Pengadaan <i class="fa fa-angle-right"></i> Edit Data';
            $data['page'] = 'pengadaan_edit_data';
            $data['detail_pengadaan'] = $get_data_pengadaan;
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $id_paket = $this->input->post('id_paket', true);
            $nama_paket = $this->input->post('nama_paket', true);
            $tahunpengadaan_post = $this->input->post('tahunpengadaan', true);
            $sumber_anggaran = $this->input->post('sumber_anggaran', true);
            $pagu_anggaran = $this->input->post('pagu_anggaran', true);
            $nilai_kontrak = $this->input->post('nilai_kontrak', true);
            $idtender = $this->input->post('idtender', true);
            $jenis_pengadaan = $this->input->post('jenis_pengadaan', true);
            $penyedia = $this->input->post('penyedia', true);
            $tanggal_kontrak = $this->input->post('tanggal_kontrak', true);
            $nomor_kontrak = $this->input->post('nomor_kontrak', true);
            $table = 'pengadaan_tb';
            $where = array('id_paket' => $id_paket);
            $set = array(
                'nama_paket' => $nama_paket,
                'tahunpengadaan' => $tahunpengadaan_post,
                'pengumumanlpse' => ($idtender != '' ? 1 : 0),
                'idtender' => ($idtender != '' ? $idtender : null),
                'sumber_anggaran' => $sumber_anggaran,
                'pagu_anggaran' => str_replace('.', '', $pagu_anggaran),
                'nilai_kontrak' => str_replace('.', '', $nilai_kontrak),
                'jenis_pengadaan' => $jenis_pengadaan,
                'penyedia' => (!empty($penyedia) ? $penyedia : null),
                'tanggal_kontrak' => (!empty($tanggal_kontrak) ? tgl_sql($tanggal_kontrak) : null),
                'nomor_kontrak' => (!empty($nomor_kontrak) ? $nomor_kontrak : null)
            );
            $this->MY_Model->update_data($table, $set, $where);
            $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Proses update data pengadaan berhasil.</p></div>');
            redirect('adminppid/pengadaan/list_dokumen_pengadaan/' . strtolower($id_paket));
        }
    }

    function _validasi_update_namapaket()
    {
        $id_paket = $this->input->post('id_paket', true);
        $tahunpengadaan_post = $this->input->post('tahunpengadaan', true);
        $nama_paket = $this->input->post('nama_paket', true);
        $check_exist = $this->MY_Model->get_where('pengadaan_tb', array('nama_paket' => $nama_paket, 'tahunpengadaan' => $tahunpengadaan_post, 'id_paket !=' => $id_paket));
        if ($check_exist) {
            $this->form_validation->set_message('_validasi_update_namapaket', '{field} sudah terdaftar di list pengadaan.');
            return FALSE;
        } else {
            return true;
        }
    }

    function _validasi_update_idtender()
    {
        $id_paket = $this->input->post('id_paket', true);
        $idtender = $this->input->post('idtender', true);
        $check_exist = $this->MY_Model->get_where('pengadaan_tb', array('idtender' => $idtender, 'id_paket !=' => $id_paket));
        if ($check_exist) {
            $this->form_validation->set_message('_validasi_update_idtender', '{field} sudah terdaftar di list pengadaan.');
            return FALSE;
        } else {
            return true;
        }
    }

    function dokumen_rs_set($tahun_pengadaan = null, $id_dokumen = null)
    {
        $tahun_pengadaan = $tahun_pengadaan != null ? rawurldecode($tahun_pengadaan) : date('Y');
        $id_dokumen = $id_dokumen != null ? rawurlencode($id_dokumen) : null;
        $simpan_data = $this->input->post('simpan_data', true);
        if ($simpan_data == 'proses_simpan') {
            $this->_proses_set_dokumen_rs($tahun_pengadaan, $id_dokumen);
        } else {
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Pengadaan <i class="fa fa-angle-right"></i> RUP';
            $data['page'] = 'pengadaan_dokumen_rs_set';
            if ($id_dokumen != null) {
                $data['detail_dokumen'] = $this->adminpengadaan_model->pengadaan_get_dokumen($tahun_pengadaan, $id_dokumen);
            }
            $data['tahun_pengadaan'] = $tahun_pengadaan;
            $data['list_jenis_dokumen'] = $this->MY_Model->get_where('pengadaan_master_dokumen', array('tipedokumen' => '02'), 'result', null, null, array('urutan' => 'ASC'));
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        }
    }

    private function _proses_set_dokumen_rs($tahun_pengadaan, $id_dokumen)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('tahunpengadaan', 'Tahun Pengadaan', 'required');
        $this->form_validation->set_rules('id_file', 'File', 'required');
        $this->form_validation->set_rules('iddokumen', 'Jenis Dokumen', 'required');
        if ($this->form_validation->run() == false) {
            $data['error'] = '<div class="alert alert-danger">' . validation_errors('<p>', '</p>') . '</div>';
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Pengadaan <i class="fa fa-angle-right"></i> RUP';
            $data['page'] = 'pengadaan_dokumen_rs_set';
            if ($id_dokumen != null) {
                $data['detail_dokumen'] = $this->adminpengadaan_model->pengadaan_get_dokumen($tahun_pengadaan, $id_dokumen);
            }
            $data['tahun_pengadaan'] = $tahun_pengadaan;
            $data['list_jenis_dokumen'] = $this->MY_Model->get_where('pengadaan_master_dokumen', array('tipedokumen' => '02'), 'result', null, null, array('urutan' => 'ASC'));
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $tahun_pengadaan_post = $this->input->post('tahunpengadaan', true);
            $id_file = $this->input->post('id_file', true);
            $iddokumen_post = $this->input->post('iddokumen', true);
            $set = array(
                'tahunpengadaan' => $tahun_pengadaan_post,
                'id_file' => $id_file,
                'deleted' => 0,
                'datecreate' => date('Y-m-d H:i:s'),
                'usercreate' => $this->session->userdata('username'),
                'iddokumen' => $iddokumen_post
            );
            $check_exist_rup = $this->adminpengadaan_model->pengadaan_get_dokumen($tahun_pengadaan_post, $iddokumen_post);
            $table = 'pengadaan_dokumen_rs';
            if ($check_exist_rup) {
                $where['tahunpengadaan'] = $tahun_pengadaan_post;
                $where['iddokumen'] = $iddokumen_post;
                $this->MY_Model->update_data($table, $set, $where);
            } else {
                $this->MY_Model->insert_data($table, $set);
            }
            $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Proses set Rencana Umum Pengadaan Barang & Jasa berhasil.</p></div>');
            redirect('adminppid/pengadaan/');
        }
    }

//END OF class Adminpengadaan
}
