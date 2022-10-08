<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Galih Dwi Aditya Nugraha
 * 
 * @property strukturorganisasi_model $strukturorganisasi_model
 */

class Strukturorganisasi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('strukturorganisasi_model');
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
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Struktur Organisasi';
            $data['page'] = 'struktur_organisasi';
            $data['getstrukturorganisasi'] = $this->strukturorganisasi_model->getstrukturorganisasi();
            $this->load->view('admin/dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('judul', 'Judul', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Struktur Organisasi';
                $data['page'] = 'struktur_organisasi';
                $data['error'] = validation_errors();
                $data['getstrukturorganisasi'] = $this->strukturorganisasi_model->getstrukturorganisasi();
                $this->load->view('admin/dashboard_admin_layout', $data);
            } else {
                unset($data);
                $id = $this->input->post('id');
                $judul = $this->input->post('judul');
                $gambar = $this->input->post('gambar');

                $config['file_name'] =  preg_replace('/[^A-Za-z0-9\-]/', "", ('gambar' . $id));
                $config['upload_path'] = './assets/images/struktur_organisasi/';
                $config['allowed_types'] = 'jpg|png';
                $config['overwrite'] = FALSE;
                $config['max_size'] = '1028';
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('foto')) {
                    $update['id'] = $id;
                    $update['judul'] = $judul;
                    $update['gambar'] = $gambar;
                    $fail = $this->upload->display_errors();
                    if (
                        preg_replace('/[^A-Za-z0-9\-]/', "", $fail) == preg_replace('/[^A-Za-z0-9\-]/', "", "pBerkas yang Anda mencoba untuk mengunggah lebih besar dari ukuran yang diizinkan.p") ||
                        preg_replace('/[^A-Za-z0-9\-]/', "", $fail) == preg_replace('/[^A-Za-z0-9\-]/', "", "pJenis berkas yang Anda coba untuk mengunggah tidak diperbolehkan.p") ||
                        preg_replace('/[^A-Za-z0-9\-]/', "", $fail) == preg_replace('/[^A-Za-z0-9\-]/', "", "pMasalah terjadi ketika mencoba untuk memindahkan berkas terunggah ke tujuan akhir.p")
                    ) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger">' . $fail . '</div>');
                        redirect('admin/strukturorganisasi');
                    } else {
                        $hasil = $this->strukturorganisasi_model->_update_getstrukturorganisasi($update);
                        if ($hasil == true) {
                            $this->session->set_flashdata('message', '<div class="alert alert-success">Judul Berhasil diperbaharui</div>');
                            redirect('admin/strukturorganisasi');
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger">Judul Gagal diperbaharui</div>');
                            redirect('admin/strukturorganisasi');
                        }
                    }
                } else {
                    $image = $this->upload->data();
                    $path =  $gambar;
                    chmod($path, 0777);
                    unlink($path);
                    $update['id'] = $id;
                    $update['judul'] = $judul;
                    $update['gambar'] = './assets/images/struktur_organisasi/' . $image['file_name'];
                    $this->strukturorganisasi_model->_update_getstrukturorganisasi($update);
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Judul dan gambar Berhasil diperbaharui</div>');
                    redirect('admin/strukturorganisasi');
                }
            }
        }
    }
}
