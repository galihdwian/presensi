<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Galih Dwi Aditya Nugraha
 * 
 * @property sk_komkordik_model $sk_komkordik_model
 */

class Sk_komkordik extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('sk_komkordik_model');
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
        $data['titlepage'] = 'Daftar SK';
        $data['page'] = 'sk_komkordik';
        $data['list_sk_komkordik'] = $this->sk_komkordik_model->getListSk();
        $this->load->view('admin/dashboard_admin_layout', $data);
    }

    function tambah_sk_komkordik()
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Tambah SK';
            $data['page'] = 'tambah_sk_komkordik';
            $this->load->view('admin/dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Tambah SK';
                $data['page'] = 'tambah_sk_komkordik';
                $data['error'] = validation_errors();
                $this->load->view('admin/dashboard_admin_layout', $data);
            } else {
                unset($data);
                $keterangan = $this->input->post('keterangan');

                $config['file_name'] =  preg_replace('/[^A-Za-z0-9\-]/', "", ('dokumen' . substr($keterangan, 0, 1)));
                $config['upload_path'] = './assets/sk/';
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
                        redirect('admin/sk_komkordik/tambah_sk_komkordik');
                    } else {
                        $hasil = $this->sk_komkordik_model->_tambah_sk($save);
                        if ($hasil == true) {
                            $this->session->set_flashdata('message', '<div class="alert alert-success">SK Berhasil ditambahkan</div>');
                            redirect('admin/sk_komkordik');
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger">SK Gagal ditambahkan</div>');
                            redirect('admin/sk_komkordik');
                        }
                    }
                } else {
                    $image = $this->upload->data();
                    $save['keterangan'] = $keterangan;
                    $save['dokumen'] = './assets/sk/' . $image['file_name'];

                    $this->sk_komkordik_model->_tambah_sk($save);
                    $this->session->set_flashdata('message', '<div class="alert alert-success">SK dan Dokumen Berhasil ditambahkan</div>');
                    redirect('admin/sk_komkordik');
                }
            }
        }
    }

    function delete_sk_komkordik($id)
    {
        if (!empty($id)) {
            $hasil = $this->sk_komkordik_model->getSk($id);
            print_r($hasil->dokumen);
            if (!empty($hasil->dokumen)) {
                $data = $this->sk_komkordik_model->_delete_sk($id);
                if ($data == true) {
                    $path = $hasil->dokumen;
                    chmod($path, 0777);
                    unlink($path);
                    $this->session->set_flashdata('message', '<div class="alert alert-success">SK Berhasil dihapus</div>');
                    redirect('admin/sk_komkordik');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">SK Gagal dihapus</div>');
                    redirect('admin/sk_komkordik');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Permintaan tidak Dapat Diproses Id Dokumen Tidak ditemukan</div>');
                redirect('admin/sk_komkordik');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Permintaan tidak Dapat Diproses</div>');
            redirect('admin/sk_komkordik');
        }
    }
}
