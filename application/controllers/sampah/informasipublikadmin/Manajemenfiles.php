<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Manajemenfiles
 * @author Imam Syaifulloh <imam.syaifulloh12 at gmail.com>
 * @property informasipublikadmin_model $informasipublikadmin_model
 */
class Manajemenfiles extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $timezone = "Asia/Jakarta";
        date_default_timezone_set($timezone);
        $this->load->model('informasipublikadmin_model');
    }

    function index()
    {
        $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Manajemen Files';
        $data['page'] = 'manajemenfiles';
        $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
    }

    function pencarian_files()
    {
        $response['success'] = false;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('key', 'Keyword', 'required');
        if ($this->form_validation->run() == false) {
            $data['message'] = validation_errors(' ', '<br>');
        } else {
            $keyword = $this->input->post('key', true);
            $get_list = $this->informasipublikadmin_model->get_file_sub_dan_tag($keyword, [], false);
            if ($get_list) {
                $response['success'] = true;
                $response['list_file'] = $get_list;
            } else {
                $response['message'] = 'Tidak ditemukan file untuk dengan keyword ' . $keyword;
            }
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    function edit_files($id_file = null, $type_file = null)
    {
        if ($id_file != null && $type_file != null) {
            #mendapatkan file sesuai dengan id
            $get_file = null;
            if ($type_file == 'ip_sub_file') {
                $get_file = $this->MY_Model->get_where('ip_sub_file', ['id_file' => $id_file], 'row');
            } else {
                $get_file = $this->MY_Model->get_where('ip_tag_content', ['id_tagcontent' => $id_file], 'row');
            }
            if ($get_file) {
                #membaca data file
                $data_file['type_file'] = $type_file;
                $data_file['id'] = $id_file;
                $data_file['display_name'] = $get_file->display_name;
                $data_file['slug'] = $get_file->slug;
                $data_file['tipe'] = $get_file->tipe;
                if ($type_file == 'ip_sub_file') {
                    $data_file['tahun'] = $get_file->tahun_file;
                    $data_file['keterangan'] = $get_file->keterangan;
                    $data_file['fileindex'] = $get_file->fileindex;
                    $data_file['nama_file'] = $get_file->nama_file;
                } else {
                    $data_file['tahun'] = null;
                    $data_file['keterangan'] = null;
                    $data_file['fileindex'] = null;
                    $data_file['nama_file'] = $get_file->file;
                }
                #cek apakah ada proses simpan data
                $simpan_data = $this->input->post('simpan_data', true);
                if ($simpan_data == '') {
                    #jika tidak ada proses simpan data tampilkan form
                    $data['get_file'] = $data_file;
                    $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Manajemen Files <i class="fa fa-angle-right"></i> Edit';
                    $data['page'] = 'manajemenfiles_edit';
                    $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
                } else {
                    #jika ada proses simpan data maka lakukan proses untuk update file
                    $this->_proses_update_file($data_file);
                }
            } else {
                $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Data tidak ditemukan.</p></div>');
                redirect('adminppid/manajemenfiles');
            }
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Permintaan tidak dapat diproses.</p></div>');
            redirect('adminppid/manajemenfiles');
        }
    }

    function _proses_update_file($data_file)
    {
        #proses validasi
        $type_file = $data_file['type_file'];
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_file', 'ID File', 'required');
        $this->form_validation->set_rules('display_name', 'Nama File yang Ditampilkan', 'required');
        $this->form_validation->set_rules('slug', 'Slug File', 'required|callback__validasi_slug');
        $this->form_validation->set_rules('tipe', 'Tipe File', 'required');
        if ($type_file == 'ip_sub_file') {
            $this->form_validation->set_rules('tahun_file', 'Tahun Pembuatan File', 'required|numeric');
        }
        if ($this->form_validation->run() == false) {
            #jika validasi gagal
            $data['error'] = '<div class="alert alert-danger">' . validation_errors('<p>', '<./p>') . '</div>';
            $data['get_file'] = $data_file;
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Manajemen Files <i class="fa fa-angle-right"></i> Edit';
            $data['page'] = 'manajemenfiles_edit';
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            #jika validasi berhasil maka membaca post data
            $id_file = $this->input->post('id_file', true);
            $slug = $this->input->post('slug', true);
            $display_name = $this->input->post('display_name');
            $tipe = $this->input->post('tipe', true);
            if ($type_file == 'ip_sub_file') {
                $tahun_file = $this->input->post('tahun_file', true);
                $keterangan = $this->input->post('keterangan', true);
                $fileindex = $this->input->post('fileindex', true);
            }
            $data_error = '';
            $upload_filename = '';
            if ($_FILES['nama_file']['error'] == 0) {
                #jika ada file yang diupload
                $config['upload_path'] = './assets/file/';
                $config['max_size'] = 25600;
                // $config['file_name'] = $slug;
                $config['file_name'] = $data_file['nama_file'];
                $config['overwrite'] = true;
                if ($tipe == 'File') {
                    $config['allowed_types'] = 'pdf';
                } else {
                    $config['allowed_types'] = 'jpg|jpeg|png';
                }
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('nama_file')) {
                    #jika proses upload error maka set data error
                    $data_error = '<div class="alert alert-danger"><p>' . $this->upload->display_errors() . '</p></div>';
                } else {
                    #jika proses upload berhasil
                    $upload_filename = $this->upload->data('file_name');
                }
            }
            if ($data_error != '') {
                #jika nilai data error kosong maka tampilkan form edit file beserta pesan error
                $data['error'] = $data_error;
                $data['get_file'] = $data_file;
                $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Manajemen Files <i class="fa fa-angle-right"></i> Edit';
                $data['page'] = 'manajemenfiles_edit';
                // $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
            } else {
                #jika nilai data error berhasil maka lakukan proses update file
                $ar = 0;
                if ($type_file == 'ip_sub_file') {
                    #proses update file dip
                    $set = [
                        'display_name' => $display_name,
                        'tahun_file' => $tahun_file,
                        'slug' => $slug,
                        'fileindex' => $fileindex,
                        'keterangan' => strlen($keterangan) == 0 ? null : $keterangan,
                        'userupdate' => $this->session->userdata('username'),
                        'dateupdate' => date('Y-m-d H:i:s'),
                    ];
                    if ($upload_filename != '') {
                        $set['nama_file'] = $upload_filename;
                        $set['tipe'] = $tipe;
                    }
                    $ar = $this->MY_Model->update_data('ip_sub_file', $set, ['id_file' => $id_file]);
                } else {
                    #proses update file kategori
                    $set = [
                        'display_name' => $display_name,
                        'slug' => $slug,
                        'userupdate' => $this->session->userdata('username'),
                        'dateupdate' => date('Y-m-d H:i:s'),
                    ];
                    if ($upload_filename != '') {
                        $set['file'] = $upload_filename;
                        $set['tipe'] = strtolower($tipe);
                    }
                    $ar = $this->MY_Model->update_data('ip_tag_content', $set, ['id_tagcontent' => $id_file]);
                }
                if ($ar > 0) {
                    #jika proses simpan berhasil maka tampilkan informasi berhasil
                    $this->session->set_flashdata("message_status", '<div class="alert alert-success">Proses simpan file berhasil.</div>');
                    redirect('adminppid/manajemenfiles_edit/' . $id_file . '/' . $type_file);
                } else {
                    #jika proses simpan gagal maka tampilkan pesan gagal
                    $data['error'] = '<div class="alert alert-danger"><p>Proses simpan file gagal.</p></div>';
                    $data['get_file'] = $data_file;
                    $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Manajemen Files <i class="fa fa-angle-right"></i> Edit';
                    $data['page'] = 'manajemenfiles_edit';
                    $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
                }
            }
        }
    }

    function _validasi_slug()
    {
        $id_file = $this->input->post('id_file', true);
        $slug = $this->input->post('slug', true);
        $type_file = $this->input->post('type_file', true);
        if ($type_file == 'ip_sub_file') {
            $where = ['slug' => $slug, 'id_file !=' => $id_file];
            $check_data = $this->MY_Model->get_where('ip_sub_file', $where);
        } else {
            $where = ['slug' => $slug, 'id_tagcontent !=' => $id_file];
            $check_data = $this->MY_Model->get_where('ip_tag_content', $where);
        }
        if ($check_data) {
            $this->form_validation->set_message('_validasi_slug', '{field} harus berisi nilai unik.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    //END OF class Manajemenfiles
}
