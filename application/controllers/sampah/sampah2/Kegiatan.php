<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Galih Dwi Aditya Nugraha
 * 
 * @property kegiatan_model $kegiatan_model
 */

class Kegiatan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('kegiatan_model');
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
        $data['titlepage'] = 'Daftar Kegiatan';
        $data['page'] = 'kegiatan';
        $data['list_kegiatan'] = $this->kegiatan_model->getListKegiatan();
        $this->load->view('admin/dashboard_admin_layout', $data);
    }


    function tambah_kegiatan()
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Tambah Kegiatan';
            $data['page'] = 'tambah_kegiatan';
            $this->load->view('admin/dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('judul', 'Judul', 'required');
            $this->form_validation->set_rules('isi', 'Isi Kegiatan', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Tambah Kegiatan';
                $data['page'] = 'tambah_kegiatan';
                $data['error'] = validation_errors();
                $this->load->view('admin/dashboard_admin_layout', $data);
            } else {
                unset($data);
                $judul = $this->input->post('judul');
                $isi = $this->input->post('isi');

                $config['file_name'] =  preg_replace('/[^A-Za-z0-9\-]/', "", ('gambar' . substr($judul, 0, 1)));
                $config['upload_path'] = './assets/images/kegiatan/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['overwrite'] = FALSE;
                $config['max_size'] = '1028';
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('foto')) {
                    $save['judul'] = $judul;
                    $save['isi'] = $isi;
                    $save['created_at'] = date('Y-m-d H:i:s');
                    $save['author'] = $this->session->userdata('username');
                    $save['status'] = '1';

                    $fail = $this->upload->display_errors();
                    if (
                        preg_replace('/[^A-Za-z0-9\-]/', "", $fail) == preg_replace('/[^A-Za-z0-9\-]/', "", "pBerkas yang Anda mencoba untuk mengunggah lebih besar dari ukuran yang diizinkan.p") ||
                        preg_replace('/[^A-Za-z0-9\-]/', "", $fail) == preg_replace('/[^A-Za-z0-9\-]/', "", "pJenis berkas yang Anda coba untuk mengunggah tidak diperbolehkan.p") ||
                        preg_replace('/[^A-Za-z0-9\-]/', "", $fail) == preg_replace('/[^A-Za-z0-9\-]/', "", "pMasalah terjadi ketika mencoba untuk memindahkan berkas terunggah ke tujuan akhir.p")
                    ) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger">' . $fail . '</div>');
                        redirect('admin/kegiatan/tambah_kegiatan');
                    } else {
                        $hasil = $this->kegiatan_model->_tambah_kegiatan($save);
                        if ($hasil == true) {
                            $this->session->set_flashdata('message', '<div class="alert alert-success">Kegiatan Berhasil ditambahkan</div>');
                            redirect('admin/kegiatan');
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger">Kegiatan Gagal ditambahkan</div>');
                            redirect('admin/kegiatan');
                        }
                    }
                } else {
                    $image = $this->upload->data();
                    $save['judul'] = $judul;
                    $save['isi'] = $isi;
                    $save['foto'] = './assets/images/kegiatan/' . $image['file_name'];
                    $save['created_at'] = date('Y-m-d H:i:s');
                    $save['author'] = $this->session->userdata('username');
                    $save['status'] = '1';

                    $this->kegiatan_model->_tambah_kegiatan($save);
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Kegiatan dan Foto Berhasil ditambahkan</div>');
                    redirect('admin/kegiatan');
                }
            }
        }
    }


    function edit_kegiatan($id)
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Edit Kegiatan';
            $data['page'] = 'edit_kegiatan';
            $data['get_kegiatan'] = $this->kegiatan_model->getKegiatan($id);
            $this->load->view('admin/dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('judul', 'Judul', 'required');
            $this->form_validation->set_rules('isi', 'Isi Kegiatan', 'required');
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Edit Kegiatan';
                $data['page'] = 'edit_kegiatan';
                $data['error'] = validation_errors();
                $this->load->view('admin/dashboard_admin_layout', $data);
            } else {
                unset($data);
                $judul = $this->input->post('judul');
                $isi = $this->input->post('isi');
                $tanggal = $this->input->post('tanggal');
                $foto = $this->kegiatan_model->getKegiatan($id);

                $config['file_name'] =  preg_replace('/[^A-Za-z0-9\-]/', "", ('gambar' . substr($judul, 0, 1)));
                $config['upload_path'] = './assets/images/kegiatan/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['overwrite'] = FALSE;
                $config['max_size'] = '1028';
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('foto')) {
                    $update['id'] = $id;
                    $update['judul'] = $judul;
                    $update['isi'] = $isi;
                    $update['created_at'] = $tanggal;
                    $update['updated_at'] = date('Y-m-d H:i:s');
                    $update['author'] = $this->session->userdata('username');
                    $update['status'] = '1';

                    $fail = $this->upload->display_errors();
                    if (
                        preg_replace('/[^A-Za-z0-9\-]/', "", $fail) == preg_replace('/[^A-Za-z0-9\-]/', "", "pBerkas yang Anda mencoba untuk mengunggah lebih besar dari ukuran yang diizinkan.p") ||
                        preg_replace('/[^A-Za-z0-9\-]/', "", $fail) == preg_replace('/[^A-Za-z0-9\-]/', "", "pJenis berkas yang Anda coba untuk mengunggah tidak diperbolehkan.p") ||
                        preg_replace('/[^A-Za-z0-9\-]/', "", $fail) == preg_replace('/[^A-Za-z0-9\-]/', "", "pMasalah terjadi ketika mencoba untuk memindahkan berkas terunggah ke tujuan akhir.p")
                    ) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger">' . $fail . '</div>');
                        redirect('admin/kegiatan/edit_kegiatan/' . $id);
                    } else {
                        $hasil = $this->kegiatan_model->_update_kegiatan($update);
                        if ($hasil == true) {
                            $this->session->set_flashdata('message', '<div class="alert alert-success">Kegiatan Berhasil diupdate</div>');
                            redirect('admin/kegiatan');
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger">Kegiatan Gagal diupdate</div>');
                            redirect('admin/kegiatan');
                        }
                    }
                } else {
                    $image = $this->upload->data();
                    $update['id'] = $id;
                    $update['judul'] = $judul;
                    $update['isi'] = $isi;
                    $update['foto'] = './assets/images/kegiatan/' . $image['file_name'];
                    $update['created_at'] = $tanggal;
                    $update['updated_at'] = date('Y-m-d H:i:s');
                    $update['author'] = $this->session->userdata('username');
                    $path = $foto->foto;
                    chmod($path, 0777);
                    unlink($path);
                    $this->kegiatan_model->_update_kegiatan($update, 'update_foto');
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Kegiatan dan Foto Berhasil diupdate</div>');
                    redirect('admin/kegiatan');
                }
            }
        }
    }


    function delete_kegiatan($id)
    {
        if (!empty($id)) {
            $hasil = $this->kegiatan_model->getKegiatan($id);
            print_r($hasil->foto);
            if (!empty($hasil->foto)) {
                $data = $this->kegiatan_model->_delete_kegiatan($id);
                if ($data == true) {
                    $path = $hasil->foto;
                    chmod($path, 0777);
                    unlink($path);
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Kegiatan Berhasil dihapus</div>');
                    redirect('admin/kegiatan');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Kegiatan Gagal dihapus</div>');
                    redirect('admin/kegiatan');
                }
            } else {
                $data = $this->kegiatan_model->_delete_kegiatan($id);
                $this->session->set_flashdata('message', '<div class="alert alert-warning">Id Foto Tidak ditemukan data sudah berhasil dihapus</div>');
                redirect('admin/kegiatan');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Permintaan tidak Dapat Diproses</div>');
            redirect('admin/kegiatan');
        }
    }

    function tambahan($id)
    {
        $data['titlepage'] = 'Tambahan Lampiran Kegiatan';
        $data['page'] = 'tambahan_kegiatan';
        $data['id'] = $id;
        $data['list_kegiatan_tambahan'] = $this->kegiatan_model->getListKegiatanLampiran($id);
        $this->load->view('admin/dashboard_admin_layout', $data);
    }

    function tambah_kegiatan_lampiran($id)
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Tambah Lampiran Kegiatan';
            $data['page'] = 'tambah_kegiatan_lampiran';
            $data['id'] = $id;
            $this->load->view('admin/dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('isi', 'Isi Kegiatan', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Tambah Lampiran Kegiatan';
                $data['page'] = 'tambah_kegiatan_lampiran';
                $data['id'] = $id;
                $data['error'] = validation_errors();
                $this->load->view('admin/dashboard_admin_layout', $data);
            } else {
                unset($data);
                $isi = $this->input->post('isi');

                $config['file_name'] =  preg_replace('/[^A-Za-z0-9\-]/', "", ('gambar' . substr($isi, 0, 1)));
                $config['upload_path'] = './assets/images/kegiatan/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['overwrite'] = FALSE;
                $config['max_size'] = '1028';
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('foto')) {
                    $save['isi'] = $isi;
                    $save['id_kegiatan'] = $id;

                    $fail = $this->upload->display_errors();
                    if (
                        preg_replace('/[^A-Za-z0-9\-]/', "", $fail) == preg_replace('/[^A-Za-z0-9\-]/', "", "pBerkas yang Anda mencoba untuk mengunggah lebih besar dari ukuran yang diizinkan.p") ||
                        preg_replace('/[^A-Za-z0-9\-]/', "", $fail) == preg_replace('/[^A-Za-z0-9\-]/', "", "pJenis berkas yang Anda coba untuk mengunggah tidak diperbolehkan.p") ||
                        preg_replace('/[^A-Za-z0-9\-]/', "", $fail) == preg_replace('/[^A-Za-z0-9\-]/', "", "pMasalah terjadi ketika mencoba untuk memindahkan berkas terunggah ke tujuan akhir.p")
                    ) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger">' . $fail . '</div>');
                        redirect('admin/kegiatan/tambah_kegiatan_lampiran/' . $id);
                    } else {
                        $hasil = $this->kegiatan_model->_tambah_kegiatan_lampiran($save);
                        if ($hasil == true) {
                            $this->session->set_flashdata('message', '<div class="alert alert-success">Kegiatan Berhasil ditambahkan</div>');
                            redirect('admin/kegiatan/tambahan/' . $id);
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger">Kegiatan Gagal ditambahkan</div>');
                            redirect('admin/kegiatan/tambahan/' . $id);
                        }
                    }
                } else {
                    $image = $this->upload->data();
                    $save['isi'] = $isi;
                    $save['id_kegiatan'] = $id;
                    $save['foto'] = './assets/images/kegiatan/' . $image['file_name'];

                    $this->kegiatan_model->_tambah_kegiatan_lampiran($save);
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Kegiatan dan Foto Berhasil ditambahkan</div>');
                    redirect('admin/kegiatan/tambahan/' . $id);
                }
            }
        }
    }

    function delete_kegiatan_lampiran($id, $id_kegiatan) //terdiri dari id lampiran kegiatan dan id kegiatan
    {
        if (!empty($id)) {
            $hasil = $this->kegiatan_model->getKegiatanLampiran($id);
            print_r($hasil->foto);
            if (!empty($hasil->foto)) {
                $data = $this->kegiatan_model->_delete_kegiatan_lampiran($id);
                if ($data == true) {
                    $path = $hasil->foto;
                    chmod($path, 0777);
                    unlink($path);
                    $this->session->set_flashdata('message', '<div class="alert alert-success"> Lampiran Berhasil dihapus</div>');
                    redirect('admin/kegiatan/tambahan/' . $id_kegiatan);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger"> Lampiran Gagal dihapus</div>');
                    redirect('admin/kegiatan/tambahan/' . $id_kegiatan);
                }
            } else {
                $data = $this->kegiatan_model->_delete_kegiatan($id);
                $this->session->set_flashdata('message', '<div class="alert alert-warning">Id Foto Tidak ditemukan data sudah berhasil dihapus</div>');
                redirect('admin/kegiatan/tambahan/' . $id_kegiatan);
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Permintaan tidak Dapat Diproses</div>');
            redirect('admin/kegiatan/tambahan/' . $id_kegiatan);
        }
    }

    function edit_kegiatan_lampiran($id, $id_kegiatan) //terdiri dari id lampiran kegiatan dan id kegiatan
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Edit Kegiatan Lampiran';
            $data['page'] = 'edit_kegiatan_lampiran';
            $data['id_kegiatan'] =  $id_kegiatan;
            $data['get_kegiatan_lampiran'] = $this->kegiatan_model->getKegiatanLampiran($id);
            $this->load->view('admin/dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('isi', 'Isi Kegiatan', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Edit Kegiatan Lampiran';
                $data['page'] = 'edit_kegiatan_lampiran';
                $data['id_kegiatan'] =  $id_kegiatan;
                $data['get_kegiatan_lampiran'] = $this->kegiatan_model->getKegiatanLampiran($id);
                $data['error'] = validation_errors();
                $this->load->view('admin/dashboard_admin_layout', $data);
            } else {
                unset($data);
                $isi = $this->input->post('isi');
                $foto = $this->kegiatan_model->getKegiatanLampiran($id);

                $config['file_name'] =  preg_replace('/[^A-Za-z0-9\-]/', "", ('gambar' . substr($isi, 0, 1)));
                $config['upload_path'] = './assets/images/kegiatan/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['overwrite'] = FALSE;
                $config['max_size'] = '1028';
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('foto')) {
                    $update['id'] = $id;
                    $update['id_kegiatan'] = $id_kegiatan;
                    $update['isi'] = $isi;

                    $fail = $this->upload->display_errors();
                    if (
                        preg_replace('/[^A-Za-z0-9\-]/', "", $fail) == preg_replace('/[^A-Za-z0-9\-]/', "", "pBerkas yang Anda mencoba untuk mengunggah lebih besar dari ukuran yang diizinkan.p") ||
                        preg_replace('/[^A-Za-z0-9\-]/', "", $fail) == preg_replace('/[^A-Za-z0-9\-]/', "", "pJenis berkas yang Anda coba untuk mengunggah tidak diperbolehkan.p") ||
                        preg_replace('/[^A-Za-z0-9\-]/', "", $fail) == preg_replace('/[^A-Za-z0-9\-]/', "", "pMasalah terjadi ketika mencoba untuk memindahkan berkas terunggah ke tujuan akhir.p")
                    ) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger">' . $fail . '</div>');
                        redirect('admin/kegiatan/edit_kegiatan_lampiran/' . $id . '/' . $id_kegiatan);
                    } else {
                        $hasil = $this->kegiatan_model->_update_kegiatan_lampiran($update);
                        if ($hasil == true) {
                            $this->session->set_flashdata('message', '<div class="alert alert-success"> Berhasil diupdate</div>');
                            redirect('admin/kegiatan/tambahan/' . $id_kegiatan);
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger"> Gagal diupdate</div>');
                            redirect('admin/kegiatan/tambahan/' . $id_kegiatan);
                        }
                    }
                } else {
                    $image = $this->upload->data();
                    $update['id'] = $id;
                    $update['id_kegiatan'] = $id_kegiatan;
                    $update['isi'] = $isi;
                    $update['foto'] = './assets/images/kegiatan/' . $image['file_name'];
                    $path = $foto->foto;
                    chmod($path, 0777);
                    unlink($path);
                    $this->kegiatan_model->_update_kegiatan_lampiran($update, 'update_foto');
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Kegiatan Lampiran dan Foto Berhasil diupdate</div>');
                    redirect('admin/kegiatan/tambahan/' . $id_kegiatan);
                }
            }
        }
    }
}
