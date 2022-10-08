<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Galih Dwi Aditya Nugraha
 * 
 * @property pesertadidik_model $pesertadidik_model
 */

class Pesertadidik extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('pesertadidik_model');
        $this->load->helper('convert_helper');
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
        $data['titlepage'] = 'Daftar Peserta Didik';
        $data['page'] = 'pesertadidik';
        $data['list_pesertadidik'] = $this->pesertadidik_model->getListPesertadidik();
        $this->load->view('admin/dashboard_admin_layout', $data);
    }


    function tambah_pesertadidik()
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Tambah Peserta Didik';
            $data['page'] = 'tambah_pesertadidik';
            $this->load->view('admin/dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Tambah Peserta Didik';
                $data['page'] = 'tambah_kegiatan';
                $data['error'] = validation_errors();
                $this->load->view('admin/dashboard_admin_layout', $data);
            } else {
                unset($data);
                $keterangan = $this->input->post('keterangan');

                $config['file_name'] =  preg_replace('/[^A-Za-z0-9\-]/', "", ('dokumen' . substr($keterangan, 0, 1)));
                $config['upload_path'] = './assets/pesertadidik/';
                $config['allowed_types'] = 'pdf';
                $config['overwrite'] = FALSE;
                $config['max_size'] = '2056';
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('dokumen')) {
                    $save['keterangan'] = $keterangan;

                    $fail = $this->upload->display_errors();
                    if (
                        preg_replace('/[^A-Za-z0-9\-]/', "", $fail) == preg_replace('/[^A-Za-z0-9\-]/', "", "pBerkas yang Anda mencoba untuk mengunggah lebih besar dari ukuran yang diizinkan.p") ||
                        preg_replace('/[^A-Za-z0-9\-]/', "", $fail) == preg_replace('/[^A-Za-z0-9\-]/', "", "pJenis berkas yang Anda coba untuk mengunggah tidak diperbolehkan.p") ||
                        preg_replace('/[^A-Za-z0-9\-]/', "", $fail) == preg_replace('/[^A-Za-z0-9\-]/', "", "pMasalah terjadi ketika mencoba untuk memindahkan berkas terunggah ke tujuan akhir.p")
                    ) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger">' . $fail . '</div>');
                        redirect('admin/pesertadidik/tambah_pesertadidik');
                    } else {
                        $hasil = $this->pesertadidik_model->_tambah_pesertadidik($save);
                        if ($hasil == true) {
                            $this->session->set_flashdata('message', '<div class="alert alert-success">Peserta Didik Berhasil ditambahkan</div>');
                            redirect('admin/pesertadidik');
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger">Peserta Didik Gagal ditambahkan</div>');
                            redirect('admin/pesertadidik');
                        }
                    }
                } else {
                    $image = $this->upload->data();
                    $save['keterangan'] = $keterangan;
                    $save['dokumen'] = './assets/pesertadidik/' . $image['file_name'];

                    $this->pesertadidik_model->_tambah_pesertadidik($save);
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Peserta Didik dan Dokumen Berhasil ditambahkan</div>');
                    redirect('admin/pesertadidik');
                }
            }
        }
    }


    function delete_pesertadidik($id)
    {
        if (!empty($id)) {
            $hasil = $this->pesertadidik_model->getPesertadidik($id);
            print_r($hasil->dokumen);
            if (!empty($hasil->dokumen)) {
                $data = $this->pesertadidik_model->_delete_pesertadidik($id);
                if ($data == true) {
                    $path = $hasil->dokumen;
                    chmod($path, 0777);
                    unlink($path);
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Peserta Didik Berhasil dihapus</div>');
                    redirect('admin/pesertadidik');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Peserta Didik Gagal dihapus</div>');
                    redirect('admin/pesertadidik');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Permintaan tidak Dapat Diproses Id Dokumen Tidak ditemukan</div>');
                redirect('admin/pesertadidik');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Permintaan tidak Dapat Diproses</div>');
            redirect('admin/pesertadidik');
        }
    }
}
