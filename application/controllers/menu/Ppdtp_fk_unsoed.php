<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Galih Dwi Aditya Nugraha
 * 
 * @property ppdtp_fk_unsoed_model $ppdtp_fk_unsoed_model
 */

class Ppdtp_fk_unsoed extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('ppdtp_fk_unsoed_model');
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
        $data['titlepage'] = 'Daftar PPDTP FK UNSOED';
        $data['page'] = 'ppdtp_fk_unsoed';
        $data['list_ppdtp_fk_unsoed'] = $this->ppdtp_fk_unsoed_model->getListPPDTP();
        $this->load->view('admin/dashboard_admin_layout', $data);
    }

    function tambah_ppdtp_fk_unsoed()
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Tambah PPDTP FK Unsoed';
            $data['page'] = 'tambah_ppdtp_fk_unsoed';
            $this->load->view('admin/dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Tambah PPDTP FK Unsoed';
                $data['page'] = 'tambah_ppdtp_fk_unsoed';
                $data['error'] = validation_errors();
                $this->load->view('admin/dashboard_admin_layout', $data);
            } else {
                unset($data);
                $keterangan = $this->input->post('keterangan');

                $config['file_name'] =  preg_replace('/[^A-Za-z0-9\-]/', "", ('dokumen' . substr($keterangan, 0, 1)));
                $config['upload_path'] = './assets/ppdtp/';
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
                        redirect('admin/ppdtp_fk_unsoed/tambah_ppdtp_fk_unsoed');
                    } else {
                        $hasil = $this->sk_komkordik_model->_tambah_sk($save);
                        if ($hasil == true) {
                            $this->session->set_flashdata('message', '<div class="alert alert-success"> Berhasil ditambahkan</div>');
                            redirect('admin/ppdtp_fk_unsoed');
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger"> Gagal ditambahkan</div>');
                            redirect('admin/ppdtp_fk_unsoed');
                        }
                    }
                } else {
                    $image = $this->upload->data();
                    $save['keterangan'] = $keterangan;
                    $save['dokumen'] = './assets/ppdtp/' . $image['file_name'];

                    $this->ppdtp_fk_unsoed_model->_tambah_ppdtp($save);
                    $this->session->set_flashdata('message', '<div class="alert alert-success">PPDTP dan Dokumen Berhasil ditambahkan</div>');
                    redirect('admin/ppdtp_fk_unsoed');
                }
            }
        }
    }

    function delete_ppdtp_fk_unsoed($id)
    {
        if (!empty($id)) {
            $hasil = $this->ppdtp_fk_unsoed_model->getPPDTP($id);
            print_r($hasil->dokumen);
            if (!empty($hasil->dokumen)) {
                $data = $this->ppdtp_fk_unsoed_model->_delete_ppdtp($id);
                if ($data == true) {
                    $path = $hasil->dokumen;
                    chmod($path, 0777);
                    unlink($path);
                    $this->session->set_flashdata('message', '<div class="alert alert-success"> Berhasil dihapus</div>');
                    redirect('admin/ppdtp_fk_unsoed');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger"> Gagal dihapus</div>');
                    redirect('admin/ppdtp_fk_unsoed');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Permintaan tidak Dapat Diproses Id Dokumen Tidak ditemukan</div>');
                redirect('admin/ppdtp_fk_unsoed');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Permintaan tidak Dapat Diproses</div>');
            redirect('admin/ppdtp_fk_unsoed');
        }
    }
}
