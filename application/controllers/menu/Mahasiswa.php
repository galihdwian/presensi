<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author UNICORN
 * 
 * @property mahasiswa_model $mahasiswa_model
 * @property jurusan_model $jurusan_model
 */

class Mahasiswa extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model("mahasiswa_model");
        $this->load->model("jurusan_model");
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
        $data['titlepage'] = 'Mahasiswa';
        $data['page'] = 'mahasiswa';
        $data['list_mahasiswa'] = $this->mahasiswa_model->getListMahasiswa();
        $this->load->view('dashboard_admin_layout', $data);
    }

    function status_aktivasi_mahasiswa($id_mhs, $status)
    {
        $update['stts_mhs'] = $status;
        $hasil = $this->mahasiswa_model->setAktivasi($id_mhs, $update);
        if ($hasil == true) {
            if ($status == 1) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Mahasiswa Berhasil diaktifkan</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Mahasiswa Berhasil dinonaktifkan</div>');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Proses Gagal</div>');
        }

        redirect('mahasiswa');
    }

    function tambah_mahasiswa()
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Tambah Mahasiswa';
            $data['page'] = 'tambah_mahasiswa';
            $data['get_list_jurusan'] = $this->jurusan_model->getListJurusan();
            $this->load->view('dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('nim', 'NIM', 'required|is_unique[mahasiswa.nim]');
            $this->form_validation->set_rules('nama_mhs', 'Nama Mahasiswa', 'required');
            $this->form_validation->set_rules('kode_jurusan', 'Jurusan', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password_confirmation', 'Konfirmasi Password', 'required|matches[password]');
            $this->form_validation->set_rules('jns_kelamin', 'Jenis Kelamin', 'required');
            $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');

            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Tambah Mahasiswa';
                $data['page'] = 'tambah_mahasiswa';
                $data['get_list_jurusan'] = $this->jurusan_model->getListJurusan();
                $data['error'] = validation_errors();
                $this->load->view('dashboard_admin_layout', $data);
            } else {
                unset($data);
                $nim = $this->input->post('nim');
                $nama_mhs = $this->input->post('nama_mhs');
                $kode_jurusan = $this->input->post('kode_jurusan');
                $password = $this->input->post('password');
                $jns_kelamin = $this->input->post('jns_kelamin');
                $tgl_lahir = $this->input->post('tgl_lahir');
                $alamat = $this->input->post('alamat');

                $pwd = md5($password);
                $pwd2 = password_hash($pwd, PASSWORD_DEFAULT);

                $save['nim'] = $nim;
                $save['nama_mhs'] = $nama_mhs;
                $save['kode_jurusan'] = $kode_jurusan;
                $save['password'] = $pwd2;
                $save['jns_kelamin'] = $jns_kelamin;
                $save['tgl_lahir'] = $tgl_lahir;
                $save['alamat'] = $alamat;
                $save['stts_mhs'] = 1;

                $hasil = $this->mahasiswa_model->_tambah_mahasiswa($save);
                if ($hasil == true) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Mahasiswa Berhasil ditambahkah</div>');
                    redirect('mahasiswa');
                } else {
                    print_r($hasil);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Mahasiswa Gagal ditambahkah</div>');
                    redirect('mahasiswa_tambah');
                }
                unset($save);
            }
        }
    }

    function edit_mahasiswa($id_mhs)
    {
        if (!$this->input->post('submit')) {
            $data['titlepage'] = 'Edit Mahasiswa';
            $data['page'] = 'edit_mahasiswa';
            $data['get_list_jurusan'] = $this->jurusan_model->getListJurusan();
            $data['get_mahasiswa'] = $this->mahasiswa_model->getMahasiswa($id_mhs);
            $this->load->view('dashboard_admin_layout', $data);
        } else {
            $this->form_validation->set_rules('nim', 'NIM', 'required');
            $this->form_validation->set_rules('nama_mhs', 'Nama Mahasiswa', 'required');
            $this->form_validation->set_rules('kode_jurusan', 'Jurusan', 'required');
            $this->form_validation->set_rules('jns_kelamin', 'Jenis Kelamin', 'required');
            $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            if ($this->form_validation->run($this) == FALSE) {
                $data['titlepage'] = 'Edit Mahasiswa';
                $data['page'] = 'edit_mahasiswa';
                $data['get_list_jurusan'] = $this->jurusan_model->getListJurusan();
                $data['get_mahasiswa'] = $this->mahasiswa_model->getMahasiswa($id_mhs);
                $data['error'] = validation_errors();
                $this->load->view('dashboard_admin_layout', $data);
            } else {
                unset($data);
                $nim = $this->input->post('nim');
                $nama_mhs = $this->input->post('nama_mhs');
                $kode_jurusan = $this->input->post('kode_jurusan');
                $jns_kelamin = $this->input->post('jns_kelamin');
                $tgl_lahir = $this->input->post('tgl_lahir');
                $alamat = $this->input->post('alamat');

                $update['nim'] = $nim;
                $update['nama_mhs'] = $nama_mhs;
                $update['kode_jurusan'] = $kode_jurusan;
                $update['jns_kelamin'] = $jns_kelamin;
                $update['tgl_lahir'] = $tgl_lahir;
                $update['alamat'] = $alamat;

                $hasil = $this->mahasiswa_model->_update_mahasiswa($id_mhs, $update);
                if ($hasil == true) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Mahasiswa Berhasil diupdate</div>');
                    redirect('mahasiswa');
                } else {
                    print_r($hasil);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Mahasiswa Gagal diupdate</div>');
                    redirect('mahasiswa_edit');
                }
                unset($update);
            }
        }
    }
}
