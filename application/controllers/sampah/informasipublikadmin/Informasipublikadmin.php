<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author IMAM_SYAIFULLOH
 */

/**
 * @property informasipublikadmin_model $informasipublikadmin_model
 * @property MY_Model $MY_Model
 */
class Informasipublikadmin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("informasipublikadmin_model");
        date_default_timezone_set("Asia/Jakarta");
        $this->load->helper('form');
        $this->load->model('MY_Model');
        $this->is_logged_in();
        $this->akses();
    }

    private function is_logged_in() {
        if (!$this->session->userdata('logged_in')) {
            redirect('');
        }
    }

    private function akses() {
        if ($this->session->userdata('hak_akses') == '3') {
            redirect('poliklinik');
        } elseif ($this->session->userdata('hak_akses') == '9' || $this->session->userdata('hak_akses') == '10' || $this->session->userdata('hak_akses') == '11') {
            redirect('adminpengadaan');
        }
    }

    function index() {
        $data['titlepage'] = 'PPID RSMS Dashboard';
        $data['page'] = 'index';
        $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
    }

    function dipstatus() {
        $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> DIP <i class="fa fa-angle-right"></i> Status';
        $data['page'] = 'dipstatus';
        $data['get_maxtahundip'] = $this->informasipublikadmin_model->get_maxtahundip();
        $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
    }

    function dipstatusdata() {
        echo '<table class="table table-bordered table-striped table-responsive table-hover">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>No</th>';
        echo '<th>Tahun DIP</th>';
        echo '<th>Status</th>';
        echo '<th>aksi</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        $no = 1;
        foreach ($this->informasipublikadmin_model->get_dipstatus() as $rowlp):
            echo '<tr>';
            echo '<td class="fit">' . $no . '</td>';
            echo '<td>' . $rowlp['tahun_dip'] . '</td>';
            $statusdip = $rowlp['status_dip'] == 'T' ? "Aktif" : "Nonaktif";
            echo '<td>' . $statusdip . '</td>';
            echo '<td class="fit"><button class="btn btn-primary btn-xs" onclick="showmodal(' . $rowlp['tahun_dip'] . ')">Detail</button></td>';
            echo '</tr>';
            $no++;
        endforeach;
        unset($rowlp);
        echo '</tbody></table>';
    }

    function dipstatusdetail($tahun_dip = NULL) {
        if ($tahun_dip == NULL) {
            show_404();
        } else {
            $data['md_title'] = 'Detail Status DIP';
            $data['dipstatusdetail'] = $this->informasipublikadmin_model->get_dipstatusdetail($tahun_dip);
            $this->load->view('informasipublikadmin/dip/status/status_modalcontent', $data);
        }
    }

    function dipstatusupdate() {
        if ($_POST) {
            $save['status_dip'] = $this->input->post('status');
            $this->informasipublikadmin_model->update_dipstatus($save, $this->input->post('tahun_dip'));
        }
    }

    

    

    function generate_id($nilaiawal, $jmlchar) {
        $jml = strlen($nilaiawal);
        $char = "";
        for ($i = 1; $i < $jmlchar; $i++):
            $char = $char . "0";
        endfor;
        return $char . ($nilaiawal + 1);
    }

    function klasifikasi() {
        $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Informasi Publik <i class="fa fa-angle-right"></i> Klasifikasi';
        $data['page'] = 'klasifikasi';
        $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
    }

    function klasifikasidata() {
        $data['get_klasifikasi'] = $this->informasipublikadmin_model->get_alldata("ip_klasifikasi");
        $this->load->view('informasipublikadmin/klasifikasi/klasifikasi_data', $data);
    }

    function klasifikasidetail($id_ppid = NULL) {
        if ($id_ppid != NULL) {
            $data['md_title'] = "Detail & Edit Klasifikasi";
            $data['get_klasifikasi'] = $this->informasipublikadmin_model->get_klasifikasidetail($id_ppid);
            $this->load->view('informasipublikadmin/klasifikasi/klasifikasi_modal', $data);
        }
    }

    function klasifikasisave() {
        if ($_POST) {
            $update['nama_ppid'] = $this->input->post('nama_ppid');
            $update['judul_dip'] = $this->input->post('judul_dip');
            $update['keterangan'] = $this->input->post('keterangan');
            $update['penjelasan'] = $this->input->post('penjelasan');
            $update['show_dip'] = $this->input->post('show_dip');
            $this->informasipublikadmin_model->update_data('ip_klasifikasi', 'id_ppid', $this->input->post('id_ppid'), $update);
            $this->session->set_flashdata("message_status", '<div class="alert alert-success">Data Berhasil Disimpan.</div>');
            redirect('adminppid/klasifikasi');
        } else {
            show_404();
        }
    }

    function groupfile() {
        $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Informasi Publik <i class="fa fa-angle-right"></i> Group File DIP';
        $data['page'] = 'groupfile';
        $data['get_aliasgroupfile'] = $this->informasipublikadmin_model->get_aliasgroupfile();
        $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
    }

    function groupfile_add() {
        if (!$_POST) {
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Informasi Publik <i class="fa fa-angle-right"></i> Group File DIP <i class="fa fa-angle-right"></i> Tambah Data';
            $data['page'] = 'groupfile_add';
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('tahun_file', 'Tahun File/URL', 'required');
            $this->form_validation->set_rules('sorting_data', 'Sorting Data', 'required');
            $this->form_validation->set_rules('alias_group', 'Nama Group', 'required');
            $this->form_validation->set_rules('tipe', 'Tipe Data', 'required|callback_checktipe');
            if ($this->form_validation->run() == FALSE) {
                $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Informasi Publik <i class="fa fa-angle-right"></i> Group File DIP <i class="fa fa-angle-right"></i> Tambah Data';
                $data['page'] = 'groupfile_add';
                $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
            } else {
                if ($this->input->post('tipe') == 'File') {
                    if (isset($_FILES['nama_file'])) {
                        $config['upload_path'] = './assets/file/ip_sub_file/';
                        $config['allowed_types'] = 'gif|jpg|png|pdf';
                        $config['max_size'] = 20000;
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('nama_file')) {
                            $data['error'] = $this->upload->display_errors('<div class="alert alert-danger"><p>', '</p></div>');
                            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Informasi Publik <i class="fa fa-angle-right"></i> Group File DIP <i class="fa fa-angle-right"></i> Tambah Data';
                            $data['page'] = 'groupfile_add';
                            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
                        } else {
                            $save['nama_file'] = $this->upload->data('file_name');
                            //print_r($save);
                        }
                    }
                } elseif ($this->input->post('tipe') == 'Url') {
                    $save['url'] = $this->input->post('url');
                }
                $this->load->helper('string');
                $randomstring = random_string('alnum', 9);
                $count_id = $this->informasipublikadmin_model->count_idsubfile(date('ymd'));
                if ($count_id == 0) {
                    $save['id_file'] = 'ISF-' . $randomstring . '-' . date('ymd') . '-0001';
                } else {
                    $x = "-";
                    for ($i = 0; $i < (4 - strlen($count_id)); $i++) {
                        $x = $x . '0';
                    }
                    $save['id_file'] = 'ISF-' . $randomstring . '-' . date('ymd') . '-' . $x . ($count_id + 1);
                }
                $save['tahun_file'] = $this->input->post('tahun_file');
                $save['sorting_data'] = $this->input->post('sorting_data');
                $save['alias_group'] = $this->input->post('alias_group');
                $save['tipe'] = $this->input->post('tipe');
                $this->informasipublikadmin_model->save_data('ip_sub_file', $save);
                $this->session->set_flashdata('message_status', '<div class="alert alert-success">Penuimanan data berhasil.</div>');
                redirect('adminppid/groupfile');
            }
        }
    }

    function checktipe($tipe) {
        if ($tipe == 'Url') {
            if ($this->input->post('url') == NULL) {
                $this->form_validation->set_message('callback_checktipe', 'The URL field is required.');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

}

?>
