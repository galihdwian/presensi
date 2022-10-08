<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 * Description of Thread_main_content
 * @author Imam Syaifulloh <imam.syaifulloh12 at gmail.com>
 * @property informasipublikadmin_model $informasipublikadmin_model
 */


class Thread_main_content extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $timezone = "Asia/Jakarta";
        date_default_timezone_set($timezone);
    }

    private function _get_thread_main($slug_main)
    {
        if ($slug_main != null) {
            $thread_main = $this->MY_Model->get_where('thread_main', ['slug' => $slug_main], 'row');
            if ($thread_main) {
                return $thread_main;
            } else {
                $this->session->set_flashdata(
                    'message_status',
                    '<div class="alert alert-warning"><p>Halaman yang diminta tidak dapat ditampilkan karena thread main tidak ditemukan, silahkan cek kembali URL yang dituju.</p></div>'
                );
                redirect('adminppid');
            }
        } else {
            $this->session->set_flashdata(
                'message_status',
                '<div class="alert alert-warning"><p>Halaman yang diminta tidak ditemukan, silahkan cek kembali URL yang dituju.</p></div>'
            );
            redirect('adminppid');
        }
    }

    public function main_content($slug_main = null)
    {
        $thread_main = $this->_get_thread_main($slug_main);
        $idtopik = $thread_main->idtopik;
        $judul_topik = $thread_main->judultopik;
        $list_thread_content = $this->MY_Model->get_where('thread_content', ['idtopik' => $idtopik, 'directlink' => 0, 'statusaktif' => 1], 'result', null, null, ['urutan' => 'ASC']);
        $data['list_thread_content'] = $list_thread_content;
        $data['thread_main'] = $thread_main;
        $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> ' . $judul_topik;
        $data['page'] = 'thread_main_content';
        $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
    }

    public function hapus_content($slug_main = null, $idcontent = null)
    {
        $thread_main = $this->_get_thread_main($slug_main);
        if (!empty($idcontent)) {
            $idtopik = $thread_main->idtopik;
            $set['statusaktif'] = 0;
            $this->MY_Model->update_data('thread_content', $set, ['idtopik' => $idtopik, 'idcontent' => $idcontent]);
            $this->session->set_flashdata(
                'message_status',
                '<div class="alert alert-success"><p>Proses hapus content berhasil.</p></div>'
            );
            redirect("adminppid/{$thread_main->slug}");
        } else {
            $this->session->set_flashdata(
                'message_status',
                '<div class="alert alert-warning"><p>Tidak dapat menghapus content karena id content tidak dikirimkan, silahkan cek kembali URL yang dituju.</p></div>'
            );
            redirect('adminppid');
        }
    }

    public function tambah_content($slug_main = null)
    {
        $thread_main = $this->_get_thread_main($slug_main);
        $simpan = $this->input->post('simpan', true);
        if (strcasecmp($simpan, 'simpan') == 0) {
            $this->_proses_simpan_content($thread_main);
        } else {
            $judul_topik = $thread_main->judultopik;
            $data['thread_main'] = $thread_main;
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> ' . $judul_topik . ' <i class="fa fa-angle-right"></i> Tambah Content';
            $data['page'] = 'thread_main_content_tambah';
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        }
    }

    private function _proses_simpan_content($thread_main)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('idtopik', 'idtopik', 'required');
        $this->form_validation->set_rules('headingcontent', 'Heading Content', 'trim|callback__validate_headingcontent');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim');
        $this->form_validation->set_rules('slug', 'Slug Content', 'required|is_unique[thread_content.slug]');
        $this->form_validation->set_rules('isicontent', 'Isi Content', 'required');
        if ($this->form_validation->run() == false) {
            $judul_topik = $thread_main->judultopik;
            $data['error'] = '<div class="alert alert-danger">' . validation_errors(' ', '<br>') . '</div>';
            $data['thread_main'] = $thread_main;
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> ' . $judul_topik . ' <i class="fa fa-angle-right"></i> Tambah Content';
            $data['page'] = 'thread_main_content_tambah';
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $idtopik = $this->input->post('idtopik', true);
            $headingcontent = $this->input->post('headingcontent', true);
            $slug = $this->input->post('slug', true);
            $isicontent = $this->input->post('isicontent', true);
            $mediatype = $this->input->post('mediatype', true);
            $mediaposition = $this->input->post('mediaposition', true);
            $contentlinkdisplay = $this->input->post('contentlinkdisplay', true);
            $table = 'thread_content';
            #GENERATE ID CONTENT
            $prefix_id = 'THREADCONTENT-';
            $get_max_id = $this->MY_Model->get_max_field($table, 'idcontent', 15);
            $sufix_id = $get_max_id == null ? '000001' : str_pad(($get_max_id + 1), 6, '0', STR_PAD_LEFT);
            $idcontent = $prefix_id . $sufix_id;
            #GET MAX URUTAN
            $max_urutan = $this->MY_Model->get_max_value($table, 'urutan', ['idtopik' => $idtopik, 'directlink' => 0]);
            $set = [
                'idtopik' => $idtopik,
                'idcontent' => $idcontent,
                'headingcontent' => $headingcontent,
                'isicontent' => $isicontent,
                'meditype' => $mediatype,
                'mediaposition' => $mediaposition,
                'urutan' => $max_urutan + 1,
                'slug' => $slug,
                'contentlinkdisplay' => $contentlinkdisplay,
                'directlink' => 0,
                'statusaktif' => 1,
            ];
            $this->MY_Model->insert_data($table, $set);
            $this->session->set_flashdata(
                'message_status',
                '<div class="alert alert-success"><p>Proses tambah content berhasil.</p></div>'
            );
            redirect("adminppid/{$thread_main->slug}/{$slug}");
        }
    }

    public function _validate_headingcontent($headingcontent)
    {
        if (empty($headingcontent)) {
            $keterangan = $this->input->post('keterangan', true);
            if (empty($keterangan)) {
                $this->form_validation->set_message('_validate_headingcontent', 'Keterangan harus diisi jika heading content tidak diisi.');
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    public function edit_content($slug_main = null, $idcontent = null)
    {
        $thread_main = $this->_get_thread_main($slug_main);
        if (!empty($idcontent)) {
            $idtopik = $thread_main->idtopik;
            $thread_content = $this->MY_Model->get_where('thread_content', ['idtopik' => $idtopik, 'idcontent' => $idcontent], 'row');
            if ($thread_content) {
                $simpan = $this->input->post('simpan', true);
                if (strcasecmp($simpan, 'simpan') == 0) {
                    $this->_proses_update_content($thread_main, $thread_content);
                } else {
                    $judul_topik = $thread_main->judultopik;
                    $data['thread_main'] = $thread_main;
                    $data['thread_content'] = $thread_content;
                    $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> ' . $judul_topik . ' <i class="fa fa-angle-right"></i> Edit Content';
                    $data['page'] = 'thread_main_content_edit';
                    $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
                }
            } else {
                $this->session->set_flashdata(
                    'message_status',
                    '<div class="alert alert-warning"><p>Tidak dapat menampilkan halaman edit content karena content tidak ditemnukan, silahkan cek kembali URL yang dituju.</p></div>'
                );
                redirect('adminppid');
            }
        } else {
            $this->session->set_flashdata(
                'message_status',
                '<div class="alert alert-warning"><p>Tidak dapat menampilkan halaman edit content karena id content tidak dikirimkan, silahkan cek kembali URL yang dituju.</p></div>'
            );
            redirect('adminppid');
        }
    }

    private function _proses_update_content($thread_main, $thread_content)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('idtopik', 'idtopik', 'required');
        $this->form_validation->set_rules('idcontent', 'idcontent', 'required');
        $this->form_validation->set_rules('headingcontent', 'Heading Content', 'required');
        $this->form_validation->set_rules('slug', 'Slug Content', 'required|callback__validate_slug');
        $this->form_validation->set_rules('isicontent', 'Isi Content', 'required');
        if ($this->form_validation->run() == false) {
            $judul_topik = $thread_main->judultopik;
            $data['error'] = '<div class="alert alert-danger">' . validation_errors(' ', '<br>') . '</div>';
            $data['thread_main'] = $thread_main;
            $data['thread_content'] = $thread_content;
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> ' . $judul_topik . ' <i class="fa fa-angle-right"></i> Edit Content';
            $data['page'] = 'thread_main_content_edit';
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $idtopik = $this->input->post('idtopik', true);
            $idcontent = $this->input->post('idcontent', true);
            $headingcontent = $this->input->post('headingcontent', true);
            $slug = $this->input->post('slug', true);
            $isicontent = $this->input->post('isicontent', true);
            $mediatype = $this->input->post('mediatype', true);
            $mediaposition = $this->input->post('mediaposition', true);
            $contentlinkdisplay = $this->input->post('contentlinkdisplay', true);
            $table = 'thread_content';
            $set = [
                'idtopik' => $idtopik,
                'idcontent' => $idcontent,
                'headingcontent' => $headingcontent,
                'isicontent' => $isicontent,
                'meditype' => $mediatype,
                'mediaposition' => $mediaposition,
                'slug' => $slug,
                'contentlinkdisplay' => $contentlinkdisplay,
                'directlink' => 0,
            ];
            $this->MY_Model->update_data($table, $set, ['idtopik' => $idtopik, 'idcontent' => $idcontent]);
            $this->session->set_flashdata(
                'message_status',
                '<div class="alert alert-success"><p>Proses update content berhasil.</p></div>'
            );
            redirect("adminppid/{$thread_main->slug}/{$slug}");
        }
    }

    public function _validate_slug($slug)
    {
        $get_content = $this->MY_Model->get_where('thread_content', ['slug' => $slug], 'row');
        if ($get_content) {
            $idcontent = $this->input->post('idcontent', true);
            if ($get_content->idcontent != $idcontent) {
                $this->form_validation->set_message('_validate_slug', '{field} sudah terdaftar');
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    function up_urutan($slug_main = null, $idcontent = null)
    {
        $thread_main = $this->_get_thread_main($slug_main);
        if ($idcontent != null) {
            $idtopik = $thread_main->idtopik;
            $table = 'thread_content';
            $where = [
                'idtopik' => $idtopik,
                'idcontent' => $idcontent,
            ];
            $thread_content = $this->MY_Model->get_where($table, $where, 'row');
            if ($thread_content) {
                $urutan = $thread_content->urutan;
                $where_urutan = [
                    'idtopik' => $idtopik,
                    'directlink' => 0,
                ];
                $max_urutan = $this->MY_Model->get_max_value($table, 'urutan', $where_urutan);
                $min_urutan = $this->MY_Model->get_min_value($table, 'urutan', $where_urutan);
                if ($urutan > $min_urutan) {
                    $new_urutan = $urutan - 1;
                    $get_curent_media_urutan = $this->MY_Model->get_where($table, ['idtopik' => $idtopik, 'directlink' => 0, 'urutan' => $new_urutan], 'row');
                    if ($get_curent_media_urutan) {
                        $set['urutan'] = $urutan;
                        $this->MY_Model->update_data($table, $set, ['idtopik' => $idtopik, 'idcontent' => $get_curent_media_urutan->idcontent]);
                    }
                    $set['urutan'] = $new_urutan;
                    $this->MY_Model->update_data($table, $set, $where);
                    $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Content berhasil diurutkan.</p></div>');
                } else {
                    $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Tidak ada perubahan urutan.</p></div>');
                }
            } else {
                $this->session->set_flashdata(
                    'message_status',
                    '<div class="alert alert-warning"><p>Halaman yang diminta tidak dapat ditampilkan karena content tidak ditemukan, silahkan cek kembali URL yang dituju.</p></div>'
                );
            }
            redirect("adminppid/{$slug_main}");
        } else {
            $this->session->set_flashdata(
                'message_status',
                '<div class="alert alert-warning"><p>Halaman yang diminta tidak dapat ditampilkan karena idcontent tidak dikirimkan, silahkan cek kembali URL yang dituju.</p></div>'
            );
            redirect("adminppid/{$slug_main}");
        }
    }

    function down_urutan($slug_main = null, $idcontent = null)
    {
        $thread_main = $this->_get_thread_main($slug_main);
        if ($idcontent != null) {
            $idtopik = $thread_main->idtopik;
            $table = 'thread_content';
            $where = [
                'idtopik' => $idtopik,
                'idcontent' => $idcontent,
            ];
            $thread_content = $this->MY_Model->get_where($table, $where, 'row');
            if ($thread_content) {
                $urutan = $thread_content->urutan;
                $where_urutan = [
                    'idtopik' => $idtopik,
                    'directlink' => 0,
                ];
                $max_urutan = $this->MY_Model->get_max_value($table, 'urutan', $where_urutan);
                $min_urutan = $this->MY_Model->get_min_value($table, 'urutan', $where_urutan);
                if ($urutan < $max_urutan) {
                    $new_urutan = $urutan + 1;
                    $get_curent_media_urutan = $this->MY_Model->get_where($table, ['idtopik' => $idtopik, 'directlink' => 0, 'urutan' => $new_urutan], 'row');
                    if ($get_curent_media_urutan) {
                        $set['urutan'] = $urutan;
                        $this->MY_Model->update_data($table, $set, ['idtopik' => $idtopik, 'idcontent' => $get_curent_media_urutan->idcontent]);
                    }
                    $set['urutan'] = $new_urutan;
                    $this->MY_Model->update_data($table, $set, $where);
                    $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Content berhasil diurutkan.</p></div>');
                } else {
                    $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Tidak ada perubahan urutan.</p></div>');
                }
            } else {
                $this->session->set_flashdata(
                    'message_status',
                    '<div class="alert alert-warning"><p>Halaman yang diminta tidak dapat ditampilkan karena content tidak ditemukan, silahkan cek kembali URL yang dituju.</p></div>'
                );
            }
            redirect("adminppid/{$slug_main}");
        } else {
            $this->session->set_flashdata(
                'message_status',
                '<div class="alert alert-warning"><p>Halaman yang diminta tidak dapat ditampilkan karena idcontent tidak dikirimkan, silahkan cek kembali URL yang dituju.</p></div>'
            );
            redirect("adminppid/{$slug_main}");
        }
    }

    //END OF CONTROLLER Thread_main_content
}
