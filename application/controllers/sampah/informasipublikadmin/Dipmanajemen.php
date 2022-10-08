<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Dipmanajemenadd
 * @author Imam Syaifulloh <imam.syaifulloh12 at gmail.com>
 * @property informasipublikadmin_model $informasipublikadmin_model
 */
class Dipmanajemen extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $timezone = "Asia/Jakarta";
        date_default_timezone_set($timezone);
        $this->load->model('informasipublikadmin_model');
    }

    function index($tahun_dip = null)
    {
        $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Manajemen';
        $data['page'] = 'dipmanajemen';
        $data['list_tahun_dip'] = $this->MY_Model->get_data_all('ip_dipstatus', array('tahun_dip' => 'ASC'));
        $data['selected'] = $tahun_dip;
        $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
    }

    function data($tahun_dip = null)
    {
        if ($tahun_dip == null) {
            $get_dip_aktif = $this->MY_Model->get_where('ip_dipstatus', array('status_dip' => 'T'), 'row');
            $tahun_dip = $get_dip_aktif->tahun_dip;
        }
        $data['title'] = 'Daftar Informasi Publik (DIP) PPID Pelaksana RSUD Prof. Dr. Margono Soekarjo Tahun ' . $tahun_dip;
        $data['dip'] = $this->informasipublikadmin_model->get_dip($tahun_dip);
        $this->load->view('informasipublikadmin/dip/manajemen/manajemen_dip', $data);
    }

    function add($tahun_dip = null)
    {
        $simpan_data = $this->input->post('simpan_data', true);
        if ($simpan_data == '') {
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Manajemen <i class="fa fa-angle-right"></i> Tambah Data';
            $data['page'] = 'dipmanajemenadd';
            $data['get_klasifikasi'] = $this->informasipublikadmin_model->get_klasifikasi();
            $data['get_tipeview'] = $this->informasipublikadmin_model->get_table('ip_view');
            if ($tahun_dip != null) {
                $data['selected_tahun_dip'] = $tahun_dip;
            } else {
                $data['get_thdip'] = $this->informasipublikadmin_model->get_thdip();
            }
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $this->_dipmanajemensave($tahun_dip);
        }
    }

    function _dipmanajemensave($tahun_dip = null)
    {
        $simpan_data = $this->input->post('simpan_data', true);
        if ($simpan_data == 'proses_simpan') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id_klasifikasi', 'Klasifikasi', 'required');
            $this->form_validation->set_rules('judul_informasi', 'Judul Informasi', 'required|callback__validasi_judul_informasi_publik');
            $this->form_validation->set_rules('heading_dip', 'Heading DIP', 'required');
            $this->form_validation->set_rules('aktif_dip', 'Aktif DIP', 'required');
            $this->form_validation->set_rules('tahun_dip', 'Tahun DIP', 'required');
            $heading_dip = $this->input->post('heading_dip');
            $id_klasifikasi = $this->input->post('id_klasifikasi');
            if ($id_klasifikasi != '4') {
                if ($heading_dip != 'T') {
                    $this->form_validation->set_rules('isi_informasi', 'Ringkasan Isi Informasi', 'required');
                    $this->form_validation->set_rules('penanggung_jawab', 'Penanggung Jawab', 'required');
                    $this->form_validation->set_rules('waktu_pembuatan', 'Waktu Pembuatan', 'required');
                    $this->form_validation->set_rules('bentuk_informasi', 'Bentuk Informasi', 'required');
                    $this->form_validation->set_rules('jangka_waktu', 'Jangka Waktu Penyimpanan', 'required');
                    $this->form_validation->set_rules('tipe_view', 'Tipe View', 'required');
                    //$this->form_validation->set_rules('media', 'Media Yg Memuat Informasi', 'required');
                }
            } else {
                $this->form_validation->set_rules('isi_informasi', 'Ringkasan Isi Informasi', 'required');
                $this->form_validation->set_rules('dasar_hukum', 'Dasar Hukum', 'required');
                $this->form_validation->set_rules('batas_waktu', 'Batas Waktu Pengecualian', 'required');
                $this->form_validation->set_rules('akibat_dibuka', 'Akibat Dibuka', 'required');
                $this->form_validation->set_rules('akibat_ditutup', 'Akibat Ditutup', 'required');
            }
            if ($this->form_validation->run() == false) {
                $data['error'] = '<div class="alert alert-danger"><p>' . validation_errors(' ', '<br>') . '</p></div>';
                $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Manajemen <i class="fa fa-angle-right"></i> Tambah Data';
                $data['page'] = 'dipmanajemenadd';
                $data['get_klasifikasi'] = $this->informasipublikadmin_model->get_klasifikasi();
                $data['get_tipeview'] = $this->informasipublikadmin_model->get_table('ip_view');
                $data['get_tag'] = $this->informasipublikadmin_model->get_table('ip_tag');
                if ($tahun_dip != null) {
                    $data['selected_tahun_dip'] = $tahun_dip;
                } else {
                    $data['get_thdip'] = $this->informasipublikadmin_model->get_thdip();
                }
                $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
            } else {
                $judul_informasi = $this->input->post('judul_informasi');
                $heading_dip = $this->input->post('heading_dip');
                $aktif_dip = $this->input->post('aktif_dip');
                $tahun_dip = $this->input->post('tahun_dip');
                $display_detail = $this->input->post('display_detail');
                if ($id_klasifikasi != '4') {
                    if ($heading_dip != 'T') {
                        $isi_informasi = $this->input->post('isi_informasi');
                        $penanggung_jawab = $this->input->post('penanggung_jawab');
                        $waktu_pembuatan = $this->input->post('waktu_pembuatan');
                        $bentuk_informasi = $this->input->post('bentuk_informasi');
                        $jangka_waktu = $this->input->post('jangka_waktu');
                        $tipe_view = $this->input->post('tipe_view');
                        $media = $this->input->post('media');
                    }
                } else {
                    $isi_informasi = $this->input->post('isi_informasi');
                    $dasar_hukum = $this->input->post('dasar_hukum');
                    $batas_waktu = $this->input->post('batas_waktu');
                    $akibat_dibuka = $this->input->post('akibat_dibuka');
                    $akibat_ditutup = $this->input->post('akibat_ditutup');
                    $tipe_view = 'FD';
                }
                $prefix_id_sub = $id_klasifikasi . '_' . $tahun_dip . '_';
                $max_id = $this->informasipublikadmin_model->get_max_id_sub($prefix_id_sub);
                $id_sub = $prefix_id_sub . ($max_id + 1);
                $this->load->helper('text');
                $this->load->helper('url');
                $slug = url_title(convert_accented_characters($judul_informasi), 'dash', true);
                $set = array(
                    'id_sub' => $id_sub,
                    'id_klasifikasi' => $id_klasifikasi,
                    'sorting_informasi' => ($max_id + 1),
                    'heading_dip' => $heading_dip,
                    'judul_informasi' => $judul_informasi,
                    'isi_informasi' => (!empty($isi_informasi) ? $isi_informasi : null),
                    'penanggung_jawab' => (!empty($penanggung_jawab) ? $penanggung_jawab : null),
                    'waktu_pembuatan' => (!empty($waktu_pembuatan) ? $waktu_pembuatan : null),
                    'bentuk_informasi' => (!empty($bentuk_informasi) ? $bentuk_informasi : null),
                    'jangka_waktu' => (!empty($jangka_waktu) ? $jangka_waktu : null),
                    'media' => (!empty($media) ? $media : null),
                    'user_upoad' => $this->session->userdata('username'),
                    'tipe_view' => (!empty($tipe_view) ? $tipe_view : null),
                    'date_upload' => date('Y-m-d H:i:s'),
                    'dasar_hukum' => (!empty($dasar_hukum) ? $dasar_hukum : null),
                    'akibat_dibuka' => (!empty($akibat_dibuka) ? $akibat_dibuka : null),
                    'akibat_ditutup' => (!empty($akibat_ditutup) ? $akibat_ditutup : null),
                    'batas_waktu' => (!empty($batas_waktu) ? $batas_waktu : null),
                    'slug' => $slug,
                    'stsdisplay' => ($aktif_dip == 'T' ? 1 : 0),
                    'display_detail' => (!empty($display_detail) ? $display_detail : null)
                );
                $ar = $this->MY_Model->insert_data('ip_sub', $set);
                if ($ar != 0) {
                    $prefix_id_dip = $tahun_dip . '-' . $id_klasifikasi . '-';
                    $max_id_dip = $this->informasipublikadmin_model->get_max_id_dip($prefix_id_dip);
                    $id_dip = $prefix_id_dip . ($max_id_dip + 1);
                    $set_dip = array(
                        'id_dip' => $id_dip,
                        'tahun_dip' => $tahun_dip,
                        'id_sub' => $id_sub,
                        'id_parent' => 'N',
                        'aktif_dip' => $aktif_dip
                    );
                    $ar_dip = $this->MY_Model->insert_data('ip_dip', $set_dip);
                    if ($ar_dip != 0) {
                        $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Proses simpan daftar informasi publik berhasil.</p></div>');
                        redirect('adminppid/dipmanajemen/' . $tahun_dip);
                    } else {
                        $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Proses simpan daftar informasi publik gagal.</p></div>');
                        redirect('adminppid/dipmanajemen/' . $tahun_dip);
                    }
                } else {
                    $data['error'] = '<div class="alert alert-danger"><p>Proses Simpan Content DIP Gagal</p></div>';
                    $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Manajemen <i class="fa fa-angle-right"></i> Tambah Data';
                    $data['page'] = 'dipmanajemenadd';
                    $data['get_klasifikasi'] = $this->informasipublikadmin_model->get_klasifikasi();
                    $data['get_tipeview'] = $this->informasipublikadmin_model->get_table('ip_view');
                    $data['get_tag'] = $this->informasipublikadmin_model->get_table('ip_tag');
                    if ($tahun_dip != null) {
                        $data['selected_tahun_dip'] = $tahun_dip;
                    } else {
                        $data['get_thdip'] = $this->informasipublikadmin_model->get_thdip();
                    }
                    $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
                }
            }
        } else {
            $this->session->set_flashdata("message_status", '<div class="alert alert-success">Proses tidak dapat dilanjutkan.</div>');
            redirect('adminppid/dipmanajemenadd/' . $tahun_dip);
        }
    }

    function _validasi_judul_informasi_publik()
    {
        $id_sub = $this->input->post('id_sub');
        if ($id_sub == '') {
            $judul_informasi = $this->input->post('judul_informasi');
            $id_klasifikasi = $this->input->post('id_klasifikasi');
            $tahun_dip = $this->input->post('tahun_dip');
            $check_judul_informasi = $this->informasipublikadmin_model->check_judul_informasi_exist($judul_informasi, $id_klasifikasi, $tahun_dip);
            if ($check_judul_informasi != 0) {
                $this->form_validation->set_message('_validasi_judul_informasi_publik', '{field} sudah ada di daftar informasi publik, mohon cek klasifikasi informasi publik, judul informasi, dan tahun daftar informasi publik.');
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    function addchild($id_sub = null)
    {
        if ($id_sub == null) {
            show_404();
        } else {
            $simpan_data = $this->input->post('simpan_data', true);
            if ($simpan_data == '') {
                $data['id_sub'] = $id_sub;
                $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Manajemen <i class="fa fa-angle-right"></i> Tambah Sub Data';
                $data['page'] = 'dipmanajemenaddchild';
                $data['get_klasifikasi'] = $this->informasipublikadmin_model->get_klasifikasi();
                $data['get_thdip'] = $this->informasipublikadmin_model->get_thdip();
                $data['get_tipeview'] = $this->informasipublikadmin_model->get_table('ip_view');
                $data['get_parentdata'] = $this->informasipublikadmin_model->get_dip_asparent($id_sub);
                $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
            } else {
                $this->_savechild($id_sub);
            }
        }
    }

    function _savechild($id_sub = null)
    {
        $simpan_data = $this->input->post('simpan_data', true);
        if ($simpan_data == 'proses_simpan') {
            if ($id_sub == null) {
                show_404();
            } else {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('judul_informasi', 'Judul Informasi', 'required|callback__validasi_judul_informasi_publik');
                $this->form_validation->set_rules('isi_informasi', 'Ringkasan Isi Informasi', 'required');
                $this->form_validation->set_rules('penanggung_jawab', 'Penanggung Jawab', 'required');
                $this->form_validation->set_rules('waktu_pembuatan', 'Waktu Pembuatan', 'required');
                $this->form_validation->set_rules('bentuk_informasi', 'Bentuk Informasi', 'required');
                $this->form_validation->set_rules('jangka_waktu', 'Jangka Waktu Penyimpanan', 'required');
                //$this->form_validation->set_rules('media', 'Media Yg Memuat Informasi', 'required');
                $this->form_validation->set_rules('tipe_view', 'Tipe View', 'required');
                $this->form_validation->set_rules('aktif_dip', 'Aktif DIP', 'required');
                $this->form_validation->set_rules('tahun_dip', 'Tahun DIP', 'required');
                if ($this->form_validation->run() == false) {
                    $data['error'] = '<div class="alert alert-danger"><p>' . validation_errors(' ', '<br>') . '</p></div>';
                    $data['id_sub'] = $id_sub;
                    $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Manajemen <i class="fa fa-angle-right"></i> Tambah Sub Data';
                    $data['page'] = 'dipmanajemenaddchild';
                    $data['get_klasifikasi'] = $this->informasipublikadmin_model->get_klasifikasi();
                    $data['get_thdip'] = $this->informasipublikadmin_model->get_thdip();
                    $data['get_tipeview'] = $this->informasipublikadmin_model->get_table('ip_view');
                    $data['get_parentdata'] = $this->informasipublikadmin_model->get_dip_asparent($id_sub);
                    $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
                } else {
                    $id_parent = $this->input->post('id_parent');
                    $id_klasifikasi = $this->input->post('id_klasifikasi');
                    $judul_informasi = $this->input->post('judul_informasi');
                    $isi_informasi = $this->input->post('isi_informasi');
                    $penanggung_jawab = $this->input->post('penanggung_jawab');
                    $waktu_pembuatan = $this->input->post('waktu_pembuatan');
                    $bentuk_informasi = $this->input->post('bentuk_informasi');
                    $jangka_waktu = $this->input->post('jangka_waktu');
                    $media = $this->input->post('media');
                    $display_detail = $this->input->post('display_detail');
                    $tipe_view = $this->input->post('tipe_view');
                    $aktif_dip = $this->input->post('aktif_dip');
                    $tahun_dip = $this->input->post('tahun_dip');
                    $prefix_id_sub = $id_klasifikasi . '_' . $tahun_dip . '_';
                    $max_id = $this->informasipublikadmin_model->get_max_id_sub($prefix_id_sub);
                    $id_sub = $prefix_id_sub . ($max_id + 1);
                    $this->load->helper('text');
                    $this->load->helper('url');
                    $slug = url_title(convert_accented_characters($judul_informasi), 'dash', true);
                    $set = array(
                        'id_sub' => $id_sub,
                        'id_klasifikasi' => $id_klasifikasi,
                        'sorting_informasi' => ($max_id + 1),
                        'heading_dip' => 'F',
                        'judul_informasi' => $judul_informasi,
                        'isi_informasi' => (!empty($isi_informasi) ? $isi_informasi : null),
                        'penanggung_jawab' => (!empty($penanggung_jawab) ? $penanggung_jawab : null),
                        'waktu_pembuatan' => (!empty($waktu_pembuatan) ? $waktu_pembuatan : null),
                        'bentuk_informasi' => (!empty($bentuk_informasi) ? $bentuk_informasi : null),
                        'jangka_waktu' => (!empty($jangka_waktu) ? $jangka_waktu : null),
                        'media' => (!empty($media) ? $media : null),
                        'user_upoad' => $this->session->userdata('username'),
                        'tipe_view' => (!empty($tipe_view) ? $tipe_view : null),
                        'date_upload' => date('Y-m-d H:i:s'),
                        'slug' => $slug,
                        'stsdisplay' => ($aktif_dip == 'T' ? 1 : 0),
                        'display_detail' => (!empty($display_detail) ? $display_detail : null)
                    );
                    $ar = $this->MY_Model->insert_data('ip_sub', $set);
                    if ($ar != 0) {
                        $prefix_id_dip = $tahun_dip . '-' . $id_klasifikasi . '-';
                        $max_id_dip = $this->informasipublikadmin_model->get_max_id_dip($prefix_id_dip);
                        $id_dip = $prefix_id_dip . ($max_id_dip + 1);
                        $set_dip = array(
                            'id_dip' => $id_dip,
                            'tahun_dip' => $tahun_dip,
                            'id_sub' => $id_sub,
                            'id_parent' => $id_parent,
                            'aktif_dip' => $aktif_dip
                        );
                        $ar_dip = $this->MY_Model->insert_data('ip_dip', $set_dip);
                        if ($ar_dip != 0) {
                            $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Proses simpan daftar informasi publik berhasil.</p></div>');
                            redirect('adminppid/dipmanajemen/' . $tahun_dip);
                        } else {
                            $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Proses simpan daftar informasi publik gagal.</p></div>');
                            redirect('adminppid/dipmanajemen/' . $tahun_dip);
                        }
                    } else {
                        $data['error'] = '<div class="alert alert-danger"><p>Proses Simpan Content DIP Gagal</p></div>';
                        $data['id_sub'] = $id_sub;
                        $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Manajemen <i class="fa fa-angle-right"></i> Tambah Sub Data';
                        $data['page'] = 'dipmanajemenaddchild';
                        $data['get_klasifikasi'] = $this->informasipublikadmin_model->get_klasifikasi();
                        $data['get_thdip'] = $this->informasipublikadmin_model->get_thdip();
                        $data['get_tipeview'] = $this->informasipublikadmin_model->get_table('ip_view');
                        $data['get_parentdata'] = $this->informasipublikadmin_model->get_dip_asparent($id_sub);
                        $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
                    }
                }
            }
        }
    }

    function deletedip($id_sub = null)
    {
        if ($id_sub != null) {
            $where = array('id_sub' => $id_sub);
            $check_sub = $this->MY_Model->get_where('ip_sub', $where, 'row');
            if ($check_sub) {
                $check_dip = $this->MY_Model->get_where('ip_dip', $where, 'row');
                if ($check_dip) {
                    $tahun_dip = $check_dip->tahun_dip;
                    $this->MY_Model->update_data('ip_dip', array('aktif_dip' => 'F'), $where);
                } else {
                    $tahun_dip = substr($id_sub, 2, 4);
                }
                $this->MY_Model->update_data('ip_sub', array('stsdisplay' => 0), $where);
                $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Proses Hapus DIP Berhasil.</p></div>');
                redirect('adminppid/dipmanajemen/' . $tahun_dip);
            } else {
                $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Data tidak ditemukan.</p></div>');
                redirect('adminppid/dipmanajemen/');
            }
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-danger"><p>Proses tidak dapat dilanjutkan.</p></div>');
            redirect('adminppid/dipmanajemen/');
        }
    }

    function editdip($id_sub = null)
    {
        if ($id_sub != null) {
            $where = array('id_sub' => $id_sub);
            $check_sub = $this->MY_Model->get_where('ip_sub', $where, 'row');
            $check_dip = $this->MY_Model->get_where('ip_dip', $where, 'row');
            if (!empty($check_sub) && !empty($check_dip)) {
                $simpan_data = $this->input->post('simpan_data', true);
                if ($simpan_data == '') {
                    $data['get_sub'] = $check_sub;
                    $data['get_dip'] = $check_dip;
                    $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Manajemen <i class="fa fa-angle-right"></i> Edit Data';
                    $data['page'] = 'dipmanajemenedit';
                    $data['get_klasifikasi'] = $this->informasipublikadmin_model->get_klasifikasi();
                    $data['get_thdip'] = $this->informasipublikadmin_model->get_thdip();
                    $data['get_tipeview'] = $this->informasipublikadmin_model->get_table('ip_view');
                    $data['get_parentdata'] = $this->informasipublikadmin_model->get_parent_child($id_sub);
                    $data['count_child'] = $this->informasipublikadmin_model->count_child_by_idsub($id_sub);
                    $data['list_parent'] = $this->informasipublikadmin_model->get_list_parent($check_dip->tahun_dip, $check_sub->id_klasifikasi);
                    $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
                } else {
                    $this->_proses_update($id_sub, $check_sub, $check_dip);
                }
            } else {
                $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Data tidak ditemukan.</p></div>');
                redirect('adminppid/dipmanajemen/');
            }
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-danger"><p>Proses tidak dapat dilanjutkan.</p></div>');
            redirect('adminppid/dipmanajemen/');
        }
    }

    function _proses_update($id_sub, $check_sub, $check_dip)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_klasifikasi', 'Klasifikasi', 'required|callback__validasi_idklasifikasi');
        $this->form_validation->set_rules('judul_informasi', 'Judul Informasi', 'required|callback__validasi_judul_informasi_publik');
        $this->form_validation->set_rules('heading_dip', 'Heading DIP', 'required|callback__validasi_headingdip');
        $this->form_validation->set_rules('aktif_dip', 'Aktif DIP', 'required');
        $this->form_validation->set_rules('tahun_dip', 'Tahun DIP', 'required');
        $this->form_validation->set_rules('sorting_informasi', 'Sorting Informasi', 'required');
        $heading_dip = $this->input->post('heading_dip');
        $id_klasifikasi = $this->input->post('id_klasifikasi');
        if ($id_klasifikasi != '4') {
            if ($heading_dip != 'T') {
                $this->form_validation->set_rules('isi_informasi', 'Ringkasan Isi Informasi', 'required');
                $this->form_validation->set_rules('penanggung_jawab', 'Penanggung Jawab', 'required');
                $this->form_validation->set_rules('waktu_pembuatan', 'Waktu Pembuatan', 'required');
                $this->form_validation->set_rules('bentuk_informasi', 'Bentuk Informasi', 'required');
                $this->form_validation->set_rules('jangka_waktu', 'Jangka Waktu Penyimpanan', 'required');
                $this->form_validation->set_rules('tipe_view', 'Tipe View', 'required');
                //$this->form_validation->set_rules('media', 'Media Yg Memuat Informasi', 'required');
            }
        } else {
            $this->form_validation->set_rules('isi_informasi', 'Ringkasan Isi Informasi', 'required');
            $this->form_validation->set_rules('dasar_hukum', 'Dasar Hukum', 'required');
            $this->form_validation->set_rules('batas_waktu', 'Batas Waktu Pengecualian', 'required');
            $this->form_validation->set_rules('akibat_dibuka', 'Akibat Dibuka', 'required');
            $this->form_validation->set_rules('akibat_ditutup', 'Akibat Ditutup', 'required');
        }
        if ($this->form_validation->run() == false) {
            $data['error'] = '<div class="alert alert-danger"><p>' . validation_errors(' ', '<br>') . '</p></div>';
            $data['get_sub'] = $check_sub;
            $data['get_dip'] = $check_dip;
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Manajemen <i class="fa fa-angle-right"></i> Edit Data';
            $data['page'] = 'dipmanajemenedit';
            $data['get_klasifikasi'] = $this->informasipublikadmin_model->get_klasifikasi();
            $data['get_thdip'] = $this->informasipublikadmin_model->get_thdip();
            $data['get_tipeview'] = $this->informasipublikadmin_model->get_table('ip_view');
            $data['get_parentdata'] = $this->informasipublikadmin_model->get_parent_child($id_sub);
            $data['count_child'] = $this->informasipublikadmin_model->count_child_by_idsub($id_sub);
            $data['list_parent'] = $this->informasipublikadmin_model->get_list_parent($check_dip->tahun_dip, $check_sub->id_klasifikasi);
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $judul_informasi = $this->input->post('judul_informasi');
            $heading_dip = $this->input->post('heading_dip');
            $aktif_dip = $this->input->post('aktif_dip');
            $tahun_dip = $this->input->post('tahun_dip');
            $display_detail = $this->input->post('display_detail');
            $sorting_informasi = $this->input->post('sorting_informasi');
            if ($id_klasifikasi != '4') {
                if ($heading_dip != 'T') {
                    $isi_informasi = $this->input->post('isi_informasi');
                    $penanggung_jawab = $this->input->post('penanggung_jawab');
                    $waktu_pembuatan = $this->input->post('waktu_pembuatan');
                    $bentuk_informasi = $this->input->post('bentuk_informasi');
                    $jangka_waktu = $this->input->post('jangka_waktu');
                    $tipe_view = $this->input->post('tipe_view');
                    $media = $this->input->post('media');
                }
            } else {
                $isi_informasi = $this->input->post('isi_informasi');
                $dasar_hukum = $this->input->post('dasar_hukum');
                $batas_waktu = $this->input->post('batas_waktu');
                $akibat_dibuka = $this->input->post('akibat_dibuka');
                $akibat_ditutup = $this->input->post('akibat_ditutup');
                $tipe_view = 'FD';
            }

            $set = array(
                'id_klasifikasi' => $id_klasifikasi,
                'sorting_informasi' => $sorting_informasi,
                'heading_dip' => $heading_dip,
                'judul_informasi' => $judul_informasi,
                'isi_informasi' => (!empty($isi_informasi) ? $isi_informasi : null),
                'penanggung_jawab' => (!empty($penanggung_jawab) ? $penanggung_jawab : null),
                'waktu_pembuatan' => (!empty($waktu_pembuatan) ? $waktu_pembuatan : null),
                'bentuk_informasi' => (!empty($bentuk_informasi) ? $bentuk_informasi : null),
                'jangka_waktu' => (!empty($jangka_waktu) ? $jangka_waktu : null),
                'media' => (!empty($media) ? $media : null),
                'user_update' => $this->session->userdata('username'),
                'tipe_view' => (!empty($tipe_view) ? $tipe_view : null),
                'date_update' => date('Y-m-d H:i:s'),
                'dasar_hukum' => (!empty($dasar_hukum) ? $dasar_hukum : null),
                'akibat_dibuka' => (!empty($akibat_dibuka) ? $akibat_dibuka : null),
                'akibat_ditutup' => (!empty($akibat_ditutup) ? $akibat_ditutup : null),
                'batas_waktu' => (!empty($batas_waktu) ? $batas_waktu : null),
                'stsdisplay' => ($aktif_dip == 'T' ? 1 : 0),
                'display_detail' => (!empty($display_detail) ? $display_detail : null)
            );
            $ar = $this->MY_Model->update_data('ip_sub', $set, array('id_sub' => $id_sub));
            if ($ar != 0) {
                $id_klasifikasi_original = $this->input->post('id_klasifikasi_original', true);
                if ($check_sub->heading_dip == 'T' && $id_klasifikasi_original != $id_klasifikasi) {
                    $this->informasipublikadmin_model->set_idklasifkasi_child_same_parent($id_sub, $id_klasifikasi);
                }
                $id_parent = $this->input->post('id_parent');
                $id_parent_dip_original = $this->input->post('id_parent_dip_original');
                if ($id_parent != $id_parent_dip_original) {
                    $this->MY_Model->update_data('ip_dip', array('id_parent' => $id_parent), array('id_sub' => $id_sub));
                }
                $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Proses update daftar informasi publik berhasil.</p></div>');
                redirect('adminppid/dipmanajemen/' . $tahun_dip);
            } else {
                $data['error'] = '<div class="alert alert-danger"><p>Proses Simpan Content DIP Gagal</p></div>';
                $data['get_sub'] = $check_sub;
                $data['get_dip'] = $check_dip;
                $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Manajemen <i class="fa fa-angle-right"></i> Edit Data';
                $data['page'] = 'dipmanajemenedit';
                $data['get_klasifikasi'] = $this->informasipublikadmin_model->get_klasifikasi();
                $data['get_thdip'] = $this->informasipublikadmin_model->get_thdip();
                $data['get_tipeview'] = $this->informasipublikadmin_model->get_table('ip_view');
                $data['get_parentdata'] = $this->informasipublikadmin_model->get_parent_child($id_sub);
                $data['count_child'] = $this->informasipublikadmin_model->count_child_by_idsub($id_sub);
                $data['list_parent'] = $this->informasipublikadmin_model->get_list_parent($check_dip->tahun_dip, $check_sub->id_klasifikasi);
                $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
            }
        }
    }

    function _validasi_headingdip()
    {
        $id_sub = $this->input->post('id_sub', true);
        $get_sub = $this->MY_Model->get_where('ip_sub', array('id_sub' => $id_sub));
        if ($get_sub->id_klasifikasi == '1') {
            $heading_dip = $this->input->post('heading_dip', true);
            $count_child = $this->informasipublikadmin_model->count_child_by_idsub($id_sub);
            if ($count_child > 0 && $heading_dip != 'T') {
                $this->form_validation->set_message('_validasi_headingdip', 'Tidak dapat diset sebagai bukan heading karena masih mempunyai sub data.');
                return false;
            } else {
                $id_klasifikasi = $this->input->post('id_klasifikasi', true);
                if ($id_klasifikasi == '1' || $id_klasifikasi == '3') {
                    return true;
                } else {
                    $this->form_validation->set_message('_validasi_headingdip', 'Hanya dapat dipindah ke klasifikasi berkala atau setiap saat.');
                    return false;
                }
            }
        } else {
            return true;
        }
    }

    function _validasi_idklasifikasi()
    {
        $id_klasifikasi = $this->input->post('id_klasifikasi', true);
        $id_klasifikasi_original = $this->input->post('id_klasifikasi_original', true);
        if ($id_klasifikasi_original == '1' || $id_klasifikasi_original == '3') {
            if ($id_klasifikasi == '1' || $id_klasifikasi == '3') {
                return true;
            } else {
                $this->form_validation->set_message('_validasi_idklasifikasi', 'Hanya dapat diubah ke klasifikasi berkala atau setiap saat.');
                return false;
            }
        } else {
            if ($id_klasifikasi_original == '2') {
                if ($id_klasifikasi == '2') {
                    return true;
                } else {
                    $this->form_validation->set_message('_validasi_idklasifikasi', 'Hanya dapat diubah ke klasifikasi serta merta.');
                    return false;
                }
            } else {
                if ($id_klasifikasi == '4') {
                    return true;
                } else {
                    $this->form_validation->set_message('_validasi_idklasifikasi', 'Hanya dapat diubah ke klasifikasi dikecualikan.');
                    return false;
                }
            }
        }
    }

    function filesdip($id_sub)
    {
        if ($id_sub != null) {
            $where = array('id_sub' => $id_sub);
            $check_sub = $this->MY_Model->get_where('ip_sub', $where, 'row');
            if (!empty($check_sub)) {
                $data['get_sub'] = $check_sub;
                $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Manajemen <i class="fa fa-angle-right"></i> File';
                $data['page'] = 'dipmanajemenfiles';
                $data['list_files'] = $this->informasipublikadmin_model->get_list_files($id_sub);
                $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
            } else {
                $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Data tidak ditemukan.</p></div>');
                redirect('adminppid/dipmanajemen/');
            }
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-danger"><p>Proses tidak dapat dilanjutkan.</p></div>');
            redirect('adminppid/dipmanajemen/');
        }
    }

    function pencarianfiles()
    {
        $response['success'] = false;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('key', 'Kata Kunci Pencarian', 'required');
        $this->form_validation->set_rules('id', 'Id Dip', 'required');
        if ($this->form_validation->run() == false) {
            $response['message'] = validation_errors(' ', '<br>');
        } else {
            $keyword = $this->input->post('key', true);
            $id_sub = $this->input->post('id', true);

            $existing_trans_file = $this->MY_Model->get_where('ip_sub_file_trans', array('id_sub' => $id_sub));
            $id_file_in = array();
            if ($existing_trans_file) {
                foreach ($existing_trans_file as $row_trans) :
                    $id_file_in[] = $row_trans->id_file;
                endforeach;
            }
            $get_list_file_sub = $this->informasipublikadmin_model->get_list_filesub($keyword, $id_file_in);
            if ($get_list_file_sub) {
                $response['success'] = true;
                $response['urutan'] = $this->MY_Model->get_max_value('ip_sub_file_trans', 'sort_display', array('id_sub' => $id_sub)) + 1;
                $response['data'] = $get_list_file_sub;
            } else {
                $response['message'] = 'Tidak ditemukan file untuk dengan keyword ' . $keyword;
            }
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    function simpan_files_terpilih()
    {
        $response['success'] = false;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('file', 'File', 'required');
        $this->form_validation->set_rules('id', 'Id Dip', 'required');
        $this->form_validation->set_rules('urut', 'Urutan Tampil File', 'required');
        if ($this->form_validation->run() == false) {
            $response['message'] = validation_errors(' ', '<br>');
        } else {
            $id_file = $this->input->post('file', true);
            $id_sub = $this->input->post('id', true);
            $sort_display = $this->input->post('urut', true);
            $check_existing = $this->MY_Model->get_where('ip_sub_file_trans', array('id_sub' => $id_sub, 'id_file' => $id_file));
            if ($check_existing) {
                $response['message'] = 'File sudah dipilih sebelumnya.';
            } else {
                $set = array(
                    'id_sub' => $id_sub,
                    'id_file' => $id_file,
                    'sort_display' => $sort_display
                );
                $this->MY_Model->insert_data('ip_sub_file_trans', $set);
                $response['success'] = true;
                $response['listfiles'] = $this->informasipublikadmin_model->get_list_files($id_sub);
            }
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    function upload_file($id_sub)
    {
        if ($id_sub != null) {
            $where = array('id_sub' => $id_sub);
            $check_sub = $this->MY_Model->get_where('ip_sub', $where, 'row');
            if (!empty($check_sub)) {
                $simpan_data = $this->input->post('simpan_data', true);
                if ($simpan_data == '') {
                    $data['get_sub'] = $check_sub;
                    $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Manajemen <i class="fa fa-angle-right"></i> File <i class="fa fa-angle-right"></i> Upload';
                    $data['page'] = 'dipmanajemenuploadfiles';
                    $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
                } else {
                    $this->_proses_upload_file($id_sub, $check_sub);
                }
            } else {
                $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Data tidak ditemukan.</p></div>');
                redirect('adminppid/dipmanajemen/');
            }
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-danger"><p>Proses tidak dapat dilanjutkan.</p></div>');
            redirect('adminppid/dipmanajemen/');
        }
    }

    function _proses_upload_file($id_sub, $check_sub)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('display_name', 'Nama File yang Ditampilkan', 'required|callback__validasiDisplayName');
        $this->form_validation->set_rules('slug', 'Slug File', 'required|max_length[80]|is_unique[ip_sub_file.slug]|callback__validasiSlug');
        $this->form_validation->set_rules('tipe', 'Tipe File', 'required');
        $this->form_validation->set_rules('tahun_file', 'Tahun Pembuatan File', 'required|numeric');
        if ($this->form_validation->run() == false) {
            $data['error'] = '<div class="alert alert-danger"><p>' . validation_errors(' ', '<br>') . '</p></div>';
            $data['get_sub'] = $check_sub;
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Manajemen <i class="fa fa-angle-right"></i> File <i class="fa fa-angle-right"></i> Upload';
            $data['page'] = 'dipmanajemenuploadfiles';
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $tipe = $this->input->post('tipe', true);
            $slug = trim($this->input->post('slug', true));
            $display_name = trim($this->input->post('display_name', true));
            $tahun_file = $this->input->post('tahun_file', true);
            $keterangan = $this->input->post('keterangan', true);
            $config['upload_path'] = './assets/file/';
            $config['max_size'] = 25600;
            $config['file_name'] = $slug;
            if ($tipe == 'File') {
                $config['allowed_types'] = 'pdf';
            } else {
                $config['allowed_types'] = 'jpg|jpeg|png';
            }
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('nama_file')) {
                $data['error'] = '<div class="alert alert-danger"><p>' . $this->upload->display_errors() . '</p></div>';
                $data['get_sub'] = $check_sub;
                $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Manajemen <i class="fa fa-angle-right"></i> File <i class="fa fa-angle-right"></i> Upload';
                $data['page'] = 'dipmanajemenuploadfiles';
                $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
            } else {
                $prefix_id = 'ISF-' . date('ymd') . '-';
                $get_max_id = $this->MY_Model->get_max_field('ip_sub_file', 'id_file', 12, array('LEFT(id_file,11)' => $prefix_id));
                $sufix_id = $get_max_id == null ? '001' : str_pad(($get_max_id + 1), 3, '0', STR_PAD_LEFT);
                $id_file = $prefix_id . $sufix_id;
                $set = array(
                    'id_file' => $id_file,
                    'nama_file' => $this->upload->data('file_name'),
                    'display_name' => $display_name,
                    'tahun_file' => $tahun_file,
                    'tipe' => $tipe,
                    'slug' => $slug,
                    'fileindex' => 'T',
                    'keterangan' => strlen($keterangan) == 0 ? null : $keterangan,
                    'userupload' => $this->session->userdata('username'),
                    'dateupload' => date('Y-m-d H:i:s')
                );
                $ar = $this->MY_Model->insert_data('ip_sub_file', $set);
                if ($ar > 0) {
                    $sort_display = $this->MY_Model->get_max_value('ip_sub_file_trans', 'sort_display', array('id_sub' => $id_sub)) + 1;
                    $set_trans = array(
                        'id_sub' => $id_sub,
                        'id_file' => $id_file,
                        'sort_display' => $sort_display
                    );
                    $ar = $this->MY_Model->insert_data('ip_sub_file_trans', $set_trans);
                    if ($ar > 0) {
                        $this->session->set_flashdata("message_status", '<div class="alert alert-success">Proses simpan file berhasil.</div>');
                    } else {
                        $this->session->set_flashdata("message_status", '<div class="alert alert-warning">Proses simpan file dip.</div>');
                    }
                    redirect('adminppid/dipmanajemenfiles/' . $id_sub);
                } else {
                    $data['error'] = '<div class="alert alert-danger"><p>Proses simpan file gagal.</p></div>';
                    $data['get_sub'] = $check_sub;
                    $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Manajemen <i class="fa fa-angle-right"></i> File <i class="fa fa-angle-right"></i> Upload';
                    $data['page'] = 'dipmanajemenuploadfiles';
                    $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
                }
            }
        }
    }

    function _validasiDisplayName($displayName)
    {
        if (strtoupper($displayName) == $displayName) {
            $this->form_validation->set_message('_validasiDisplayName', 'Format {field} tidak boleh huruf kapital keseluruhan.');
            return false;
        } else {
            if (strtolower($displayName) == $displayName) {
                $this->form_validation->set_message('_validasiDisplayName', 'Format {field} tidak boleh huruf kecil keseluruhan.');
                return false;
            } else {
                return true;
            }
        }
    }

    function _validasiSlug($slug)
    {
        if (strpos($slug, ' ') !== false) {
            $this->form_validation->set_message('_validasiSlug', 'Format {field} tidak boleh ada spasi.');
            return false;
        } else {
            return true;
        }
    }

    function edit_files($id_sub = null, $id_file = null)
    {
        if ($id_sub != null) {
            if ($id_file != null) {
                $check_sub = $this->MY_Model->get_where('ip_sub', array('id_sub' => $id_sub), 'row');
                $get_detail_file_trans = $this->informasipublikadmin_model->get_detail_file_trans($id_sub, $id_file);
                if ($get_detail_file_trans && $check_sub) {
                    $simpan_data = $this->input->post('simpan_data', true);
                    if ($simpan_data == '') {
                        $data['check_sub'] = $check_sub;
                        $data['file_trans'] = $get_detail_file_trans;
                        $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Manajemen <i class="fa fa-angle-right"></i> File <i class="fa fa-angle-right"></i> Edit';
                        $data['page'] = 'dipmanajemenfilesedit';
                        $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
                    } else {
                        $this->_proses_update_file_trans($id_sub, $id_file, $check_sub, $get_detail_file_trans);
                    }
                } else {
                    $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Proses hapus gagal. Data tidak ditemukan.</p></div>');
                    redirect('adminppid/dipmanajemenfiles/' . $id_sub);
                }
            } else {
                $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Proses tidak dapat dilanjutkan.</p></div>');
                redirect('adminppid/dipmanajemenfiles/' . $id_sub);
            }
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Proses tidak dapat dilanjutkan.</p></div>');
            redirect('adminppid/dipmanajemen/');
        }
    }

    function _proses_update_file_trans($id_sub, $id_file, $check_sub, $get_detail_file_trans)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_sub', 'Id Sub DIP', 'required');
        $this->form_validation->set_rules('id_file', 'Id File', 'required');
        $this->form_validation->set_rules('display_name', 'Nama File yang Ditampilkan', 'required');
        $this->form_validation->set_rules('nama_file', 'Nama File', 'required');
        $this->form_validation->set_rules('sort_display', 'Urutan', 'required|numeric');
        if ($this->form_validation->run() == false) {
            $data['error'] = '<div class="alert-alert-warning">' . validation_errors('<p>', '</p>') . '</div>';
            $data['check_sub'] = $check_sub;
            $data['file_trans'] = $get_detail_file_trans;
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Manajemen <i class="fa fa-angle-right"></i> File <i class="fa fa-angle-right"></i> Edit';
            $data['page'] = 'dipmanajemenfilesedit';
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $sort_display = $this->input->post('sort_display', true);
            $display_name = trim($this->input->post('display_name', true));
            $table = 'ip_sub_file_trans';
            $where = array('id_sub' => $id_sub, 'sort_display >=' => $sort_display, 'id_file !=' => $id_file);
            $orderby = array('sort_display' => 'ASC');
            $get_file_trans = $this->MY_Model->get_where($table, $where, 'result', null, null, $orderby);
            $where_update = array('id_sub' => $id_sub, 'id_file' => $id_file);
            $set['sort_display'] = $sort_display;
            $ar = $this->MY_Model->update_data($table, $set, $where_update);
            if ($get_file_trans) {
                $curent_sort = $sort_display;
                foreach ($get_file_trans as $row) :
                    unset($set);
                    $curent_sort++;
                    $where_update['id_file'] = $row->id_file;
                    $set['sort_display'] = $curent_sort;
                    $this->MY_Model->update_data($table, $set, $where_update);
                endforeach;
            }
            $table_file = 'ip_sub_file';
            $where_file['id_file'] = $id_file;
            $set_file['display_name'] = $display_name;
            $this->MY_Model->update_data($table_file, $set_file, $where_file);
            $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Proses update berhasil.</p></div>');
            redirect('adminppid/dipmanajemenfiles/' . $id_sub);
        }
    }

    function delete_files($id_sub = null, $id_file = null)
    {
        if ($id_sub != null) {
            if ($id_file != null) {
                $check_sub = $this->MY_Model->get_where('ip_sub', array('id_sub' => $id_sub), 'row');
                $get_detail_file_trans = $this->informasipublikadmin_model->get_detail_file_trans($id_sub, $id_file);
                if ($get_detail_file_trans && $check_sub) {
                    $table = 'ip_sub_file_trans';
                    $where = array('id_sub' => $id_sub, 'id_file' => $id_file);
                    $ar = $this->MY_Model->delete_data($table, $where);
                    if ($ar != 0) {
                        $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Proses hapus berhasil.</p></div>');
                    } else {
                        $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Proses hapus gagal.</p></div>');
                    }
                } else {
                    $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Proses hapus gagal. Data tidak ditemukan.</p></div>');
                }
            } else {
                $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Proses tidak dapat dilanjutkan.</p></div>');
            }
            redirect('adminppid/dipmanajemenfiles/' . $id_sub);
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Proses tidak dapat dilanjutkan.</p></div>');
            redirect('adminppid/dipmanajemen/');
        }
    }

    //END OF class Dipmanajemenadd
}
