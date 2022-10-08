<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Galih Dwi Aditya Nugraha
 * 
 * @property gallery_model $gallery_model
 */

class Gallery extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('gallery_model');
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
        $data['titlepage'] = 'Daftar Gallery';
        $data['page'] = 'gallery';
        $data['list_gallery'] = $this->gallery_model->getListGallery();
        $this->load->view('admin/dashboard_admin_layout', $data);
    }

    function tambah_gallery()
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Tambah Gallery';
            $data['page'] = 'tambah_gallery';
            $this->load->view('admin/dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Tambah Gallery';
                $data['page'] = 'tambah_gallery';
                $data['error'] = validation_errors();
                $this->load->view('admin/dashboard_admin_layout', $data);
            } else {
                unset($data);
                $keterangan = $this->input->post('keterangan');

                $config['file_name'] =  preg_replace('/[^A-Za-z0-9\-]/', "", ('foto' . substr($keterangan, 0, 1)));
                $config['upload_path'] = './assets/images/gallery/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['overwrite'] = FALSE;
                $config['max_size'] = '1028';
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('foto')) {
                    $save['keterangan'] = $keterangan;

                    $fail = $this->upload->display_errors();
                    if (
                        preg_replace('/[^A-Za-z0-9\-]/', "", $fail) == preg_replace('/[^A-Za-z0-9\-]/', "", "pBerkas yang Anda mencoba untuk mengunggah lebih besar dari ukuran yang diizinkan.p") ||
                        preg_replace('/[^A-Za-z0-9\-]/', "", $fail) == preg_replace('/[^A-Za-z0-9\-]/', "", "pJenis berkas yang Anda coba untuk mengunggah tidak diperbolehkan.p") ||
                        preg_replace('/[^A-Za-z0-9\-]/', "", $fail) == preg_replace('/[^A-Za-z0-9\-]/', "", "pMasalah terjadi ketika mencoba untuk memindahkan berkas terunggah ke tujuan akhir.p")
                    ) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger">' . $fail . '</div>');
                        redirect('admin/gallery/tambah_gallery');
                    } else {
                        $hasil = $this->gallery_model->_tambah_gallery($save);
                        if ($hasil == true) {
                            $this->session->set_flashdata('message', '<div class="alert alert-success">Gallery Berhasil ditambahkan</div>');
                            redirect('admin/gallery');
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger">Gallery Gagal ditambahkan</div>');
                            redirect('admin/gallery');
                        }
                    }
                } else {
                    $image = $this->upload->data();
                    $save['keterangan'] = $keterangan;
                    $save['foto'] = './assets/images/gallery/' . $image['file_name'];

                    $this->gallery_model->_tambah_gallery($save);
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Gallery dan Foto Berhasil ditambahkan</div>');
                    redirect('admin/gallery');
                }
            }
        }
    }

    function delete_gallery($id)
    {
        if (!empty($id)) {
            $hasil = $this->gallery_model->getGallery($id);
            print_r($hasil->foto);
            if (!empty($hasil->foto)) {
                $data = $this->gallery_model->_delete_gallery($id);
                if ($data == true) {
                    $path = $hasil->foto;
                    chmod($path, 0777);
                    unlink($path);
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Gallery Berhasil dihapus</div>');
                    redirect('admin/gallery');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Gallery Gagal dihapus</div>');
                    redirect('admin/gallery');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Permintaan tidak Dapat Diproses Id Foto Tidak ditemukan</div>');
                redirect('admin/gallery');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Permintaan tidak Dapat Diproses</div>');
            redirect('admin/gallery');
        }
    }
}
