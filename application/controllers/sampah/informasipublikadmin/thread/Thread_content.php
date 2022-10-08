<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Informasi_donasi
 * @author Imam Syaifulloh <imam.syaifulloh12 at gmail.com>
 * @property informasipublikadmin_model $informasipublikadmin_model
 */
class Thread_content extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $timezone = "Asia/Jakarta";
        date_default_timezone_set($timezone);
        $this->load->model('informasipublikadmin_model');
    }

    function content($slug = null)
    {
        if ($slug != null) {
            $judulTopik = '';
            $headingContent = '';
            $getThreadContent = $this->informasipublikadmin_model->getThreadContent($slug);
            if (!empty($getThreadContent)) {
                $idMedia = $getThreadContent['idmedia'];
                $headingContent = $getThreadContent['headingcontent'];
                $idTopik = $getThreadContent['idtopik'];
                if (!empty($idMedia)) {
                    $getMedia = $this->informasipublikadmin_model->getThreadMedia($idMedia);
                    $data['threadMedia'] = $getMedia;
                }
                if (!empty($idTopik)) {
                    $getThreadMain = $this->informasipublikadmin_model->getThreadMain($idTopik);
                    $data['threadMain'] = $getThreadMain;
                    if (!empty($getThreadMain)) {
                        $judulTopik = $getThreadMain['judultopik'];
                    }
                }
                $data['threadContent'] = $getThreadContent;
                $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> ' . $judulTopik . ' <i class="fa fa-angle-right"></i> ' . $headingContent;
                $data['page'] = 'thread_content';
                $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
            } else {
                $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Halaman yang diminta tidak ditemukan, silahkan cek kembali URL yang dituju.</p></div>');
                redirect('adminppid');
            }
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Halaman yang diminta tidak ditemukan, silahkan cek kembali URL yang dituju.</p></div>');
            redirect('adminppid');
        }
    }

    function tambah_media($slug = null, $typeFile = null, $error = null)
    {
        if ($slug != null && $typeFile != null) {
            $this->loadFormTambahData($slug, $typeFile);
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Halaman yang diminta tidak ditemukan, silahkan cek kembali URL yang dituju.</p></div>');
            redirect('adminppid/');
        }
    }

    private function loadFormTambahData($slug, $typeFile, $error = null)
    {
        if ($error != null) {
            $data['error'] = $error;
        }
        $judulTopik = '';
        $headingContent = '';
        $getThreadContent = $this->informasipublikadmin_model->getThreadContent($slug);
        if (!empty($getThreadContent)) {
            $idMedia = $getThreadContent['idmedia'];
            $headingContent = $getThreadContent['headingcontent'];
            $idTopik = $getThreadContent['idtopik'];
            if (!empty($idMedia)) {
                $getMedia = $this->informasipublikadmin_model->getThreadMedia($idMedia);
                $data['threadMedia'] = $getMedia;
            }
            if (!empty($idTopik)) {
                $getThreadMain = $this->informasipublikadmin_model->getThreadMain($idTopik);
                $data['threadMain'] = $getThreadMain;
                if (!empty($getThreadMain)) {
                    $judulTopik = $getThreadMain['judultopik'];
                }
            }
        }
        $data['threadContent'] = $getThreadContent;
        $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> ' . $judulTopik . ' <i class="fa fa-angle-right"></i> ' . $headingContent . ' <i class="fa fa-angle-right"></i> Tambah Media';
        $data['page'] = 'thread_tambah_media';
        $data['typeFile'] = $typeFile;
        $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
    }

    function simpan_media($slug = null, $typeFile = null)
    {
        if ($slug != null && $typeFile != null) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('typeFile', 'Type Media', 'required');
            $this->form_validation->set_rules('idContent', 'Id Content', 'required');
            $this->form_validation->set_rules('idTopik', 'Id Topik', 'required');
            $this->form_validation->set_rules('slugMain', 'Slug Main', 'required');
            $this->form_validation->set_rules('judulnarasi', 'Judul Narasi', 'trim');
            $this->form_validation->set_rules('narasi', 'Narasi', 'trim');
            $postTypeFile = $this->input->post('typeFile', true);
            if ($postTypeFile == 'fileppid' || $postTypeFile == 'fileppidtag') {
                $this->form_validation->set_rules('idFilePpid', 'File PPID', 'trim');
            } elseif ($postTypeFile == 'youtube') {
                $this->form_validation->set_rules('url', 'Url Youtube', 'trim|valid_url|prep_url');
                $this->form_validation->set_rules('judulmedia', 'Judul Media', 'required');
            }
            if ($this->form_validation->run() == false) {
                $error = '<div class="alert alert-danger">' . validation_errors(' ', '<br>') . '</div>';
                $this->loadFormTambahData($slug, $typeFile, $error);
            } else {
                $prosesSimpan['status'] = false;
                $prosesSimpan['message'] = 'Proses simpan gagal.';
                $idContent = $this->input->post('idContent', true);
                $idTopik = $this->input->post('idTopik', true);
                $slugMain = $this->input->post('slugMain', true);
                $judulnarasi = $this->input->post('judulnarasi', true);
                $narasi = $this->input->post('narasi');
                if ($postTypeFile == 'fileppid' || $postTypeFile == 'fileppidtag') {
                    $idFilePpid = $this->input->post('idFilePpid', true);
                    $prosesSimpan = $this->_simpanMediaPpid($idContent, $idFilePpid, $postTypeFile, $judulnarasi, $narasi);
                } elseif ($postTypeFile == 'youtube') {
                    $url = $this->input->post('url', true);
                    $judulMedia = $this->input->post('judulmedia', true);
                    $prosesSimpan = $this->_simpanMediaUrl($idContent, $url, $postTypeFile, $judulMedia, $judulnarasi, $narasi);
                }
                if ($prosesSimpan['status'] == false) {
                    $error = '<div class="alert alert-danger">' . $prosesSimpan['message'] . '</div>';
                    $this->loadFormTambahData($slug, $typeFile, $error);
                } else {
                    $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Proses simpan media berhasil.</p></div>');
                    redirect('adminppid/' . $slugMain . '/' . $slug);
                }
            }
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Halaman yang diminta tidak ditemukan, silahkan cek kembali URL yang dituju.</p></div>');
            redirect('adminppid/');
        }
    }

    private function _simpanMediaPpid($idContent, $idFilePpid, $typeFile, $judulnarasi, $narasi)
    {
        $return['status'] = false;
        $getThreadContent = $this->informasipublikadmin_model->getThreadContent(null, $idContent);
        $idMedia = $getThreadContent['idmedia'];
        if (empty($idMedia)) {
            $idMedia = $this->_generateIdMedia();
            $setContent['idmedia'] = $idMedia;
            $whereContent['idcontent'] = $idContent;
            $this->MY_Model->update_data('thread_content', $setContent, $whereContent);
        }
        if ($typeFile == 'fileppid') {
            $getFile = $this->MY_Model->get_where('ip_sub_file', array('id_file' => $idFilePpid), 'row');
        } elseif ($typeFile == 'fileppidtag') {
            $getFile = $this->MY_Model->get_where('ip_tag_content', array('id_tagcontent' => $idFilePpid), 'row');
        }
        if (!empty($getFile)) {
            $idFile = $this->_generateIdFileMedia($idMedia);
            $urutan = $this->informasipublikadmin_model->getMaxUrutanMedia($idMedia);
            $namaFile = $getFile->display_name;
            $set['idmedia'] = $idMedia;
            $set['namafile'] = $namaFile;
            if ($typeFile == 'fileppid') {
                $set['typefile'] = 'fileppid';
                $set['id_sub_file'] = $idFilePpid;
            } elseif ($typeFile == 'fileppidtag') {
                $set['typefile'] = 'fileppidtag';
                $set['id_tagcontent'] = $idFilePpid;
            }
            $set['datecreate'] = date('Y-m-d H:i:s');
            $set['urutan'] = $urutan;
            $set['idfile'] = $idFile;
            $set['userupload'] = $this->session->userdata('username');
            $set['judulnarasi'] = $judulnarasi;
            $set['narasi'] = $narasi;
            $this->MY_Model->insert_data('thread_media', $set);
            $return['status'] = true;
        } else {
            $return['message'] = 'Proses simpan gagal, File PPID Tidak Ditemukan';
        }
        return $return;
    }

    private function _simpanMediaUrl($idContent, $url, $typeFile, $judulMedia, $judulnarasi, $narasi)
    {
        $return['status'] = false;
        $getThreadContent = $this->informasipublikadmin_model->getThreadContent(null, $idContent);
        $idMedia = $getThreadContent['idmedia'];
        $getExistMedia = $this->informasipublikadmin_model->getExistMedia($typeFile, $url, $idMedia);
        if (!empty($getExistMedia)) {
            $return['message'] = 'Media telah tersimpan sebelumnya.';
        } else {
            if (empty($idMedia)) {
                $idMedia = $this->_generateIdMedia();
                $setContent['idmedia'] = $idMedia;
                $whereContent['idcontent'] = $idContent;
                $this->MY_Model->update_data('thread_content', $setContent, $whereContent);
            }
            $idFile = $this->_generateIdFileMedia($idMedia);
            $urutan = $this->informasipublikadmin_model->getMaxUrutanMedia($idMedia);
            $set['idmedia'] = $idMedia;
            $set['namafile'] = $url;
            $set['typefile'] = $typeFile;
            $set['datecreate'] = date('Y-m-d H:i:s');
            $set['urutan'] = $urutan;
            $set['idfile'] = $idFile;
            $set['userupload'] = $this->session->userdata('username');
            $set['judulmedia'] = $judulMedia;
            $set['judulnarasi'] = $judulnarasi;
            $set['narasi'] = $narasi;
            $this->MY_Model->insert_data('thread_media', $set);
            $return['status'] = true;
        }

        return $return;
    }

    private function _generateIdMedia()
    {
        $prefix = 'THREADMEDIA-';
        $getMaxId = $this->informasipublikadmin_model->getMaxIdMedia();
        $suffix = str_pad($getMaxId, 5, '0', STR_PAD_LEFT);
        $idMedia = $prefix . $suffix;
        return $idMedia;
    }

    private function _generateIdFileMedia($idmedia)
    {
        $prefix = 'MEDIA-';
        $getMaxId = $this->informasipublikadmin_model->getMaxIdFileMedia($idmedia);
        $suffix = str_pad($getMaxId, 5, '0', STR_PAD_LEFT);
        $idMedia = $prefix . $suffix;
        return $idMedia;
    }

    function pencarian_file_ppid()
    {
        $response['success'] = false;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('key', 'Kata Kunci Pencarian', 'required');
        $this->form_validation->set_rules('id', 'Id Content', 'required');
        $this->form_validation->set_rules('tipedata', 'Tipe Data', 'required');
        if ($this->form_validation->run() == false) {
            $response['message'] = validation_errors(' ', '<br>');
        } else {
            $keyWord = $this->input->post('key', true);
            $idContent = $this->input->post('id', true);
            $tipedata = $this->input->post('tipedata', true);
            $getThreadContent = $this->informasipublikadmin_model->getThreadContent(null, $idContent);
            $idMedia = $getThreadContent['idmedia'];
            $threadMedia = $this->informasipublikadmin_model->getThreadMedia($idMedia);
            if ($tipedata == 'dip') {
                $idSubFileIn = array();
                if ($threadMedia) {
                    foreach ($threadMedia as $rowMedia) :
                        if ($rowMedia['typefile'] == 'fileppid') {
                            $idSubFileIn[] = $rowMedia['id_sub_file'];
                        }
                    endforeach;
                }
                $getListFile = $this->informasipublikadmin_model->get_list_filesub($keyWord, $idSubFileIn);
            } elseif ($tipedata == 'tag') {
                $idSubFileIn = array();
                if ($threadMedia) {
                    foreach ($threadMedia as $rowMedia) :
                        if ($rowMedia['typefile'] == 'fileppidtag') {
                            $idSubFileIn[] = $rowMedia['id_tagcontent'];
                        }
                    endforeach;
                }
                $getListFile = $this->informasipublikadmin_model->getListFileTagContent($keyWord, $idSubFileIn);
            }
            if (!empty($getListFile)) {
                $response['success'] = true;
                $response['data'] = $getListFile;
            } else {
                $response['message'] = 'Tidak ditemukan file untuk dengan keyword ' . $keyWord;
            }
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    function hapus_media($slug = null, $idMedia = null, $idFile = null)
    {
        if ($slug != null && $idMedia != null && $idFile != null) {
            $getThreadContent = $this->informasipublikadmin_model->getThreadContent($slug);
            if ($idMedia == $getThreadContent['idmedia']) {
                $getMedia = $this->informasipublikadmin_model->getThreadMedia($idMedia, $idFile);
                if ($getMedia) {
                    $table = 'thread_media';
                    $where = array(
                        'idmedia' => $idMedia,
                        'idfile' => $idFile
                    );
                    $this->MY_Model->delete_data($table, $where);
                    $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>File / Media berhasil dihapus.</p></div>');
                } else {
                    $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Media tidak ditemukan.</p></div>');
                }
            } else {
                $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>ID Media tidak sesuai.</p></div>');
            }
            redirect('adminppid/siaga-covid-19/' . $slug);
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Halaman yang diminta tidak ditemukan, silahkan cek kembali URL yang dituju.</p></div>');
            redirect('adminppid/');
        }
    }

    function down_urutan($slug = null, $idMedia = null, $idFile = null)
    {
        if ($slug != null && $idMedia != null && $idFile != null) {
            $getThreadContent = $this->informasipublikadmin_model->getThreadContent($slug);
            if ($idMedia == $getThreadContent['idmedia']) {
                $getMedia = $this->informasipublikadmin_model->getThreadMedia($idMedia, $idFile)[0];
                if ($getMedia) {
                    $urutan = $getMedia['urutan'];
                    $getMaxMinUrutan = $this->informasipublikadmin_model->getMaxMinUrutanMedia($idMedia);
                    if ($getMaxMinUrutan) {
                        $min = $getMaxMinUrutan['minurutan'];
                        $max = $getMaxMinUrutan['maxurutan'];
                        if ($urutan < $max) {
                            $table = 'thread_media';
                            $where['idmedia'] = $idMedia;
                            $newUrutan = $urutan + 1;
                            $getCurentMediaUrutan = $this->informasipublikadmin_model->getCurentMediaUrutan($idMedia, $newUrutan);
                            if ($getCurentMediaUrutan) {
                                $set['urutan'] = $urutan;
                                $where['idfile'] = $getCurentMediaUrutan['idfile'];
                                $this->MY_Model->update_data($table, $set, $where);
                            }
                            $set['urutan'] = $newUrutan;
                            $where['idfile'] = $idFile;
                            $this->MY_Model->update_data($table, $set, $where);
                            $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>File / Media berhasil diturunkan urutan.</p></div>');
                        } else {
                            $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Tidak ada perubahan urutan.</p></div>');
                        }
                    } else {
                        $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Proses ubah urutan gagal.</p></div>');
                    }
                } else {
                    $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Media tidak ditemukan.</p></div>');
                }
            } else {
                $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>ID Media tidak sesuai.</p></div>');
            }
            redirect('adminppid/siaga-covid-19/' . $slug);
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Halaman yang diminta tidak ditemukan, silahkan cek kembali URL yang dituju.</p></div>');
            redirect('adminppid/');
        }
    }

    function up_urutan($slug = null, $idMedia = null, $idFile = null)
    {
        if ($slug != null && $idMedia != null && $idFile != null) {
            $getThreadContent = $this->informasipublikadmin_model->getThreadContent($slug);
            if ($idMedia == $getThreadContent['idmedia']) {
                $getMedia = $this->informasipublikadmin_model->getThreadMedia($idMedia, $idFile)[0];
                if ($getMedia) {
                    $urutan = $getMedia['urutan'];
                    $getMaxMinUrutan = $this->informasipublikadmin_model->getMaxMinUrutanMedia($idMedia);
                    if ($getMaxMinUrutan) {
                        $min = $getMaxMinUrutan['minurutan'];
                        $max = $getMaxMinUrutan['maxurutan'];
                        if ($urutan > $min) {
                            $table = 'thread_media';
                            $where['idmedia'] = $idMedia;
                            $newUrutan = $urutan - 1;
                            $getCurentMediaUrutan = $this->informasipublikadmin_model->getCurentMediaUrutan($idMedia, $newUrutan);
                            if ($getCurentMediaUrutan) {
                                $set['urutan'] = $urutan;
                                $where['idfile'] = $getCurentMediaUrutan['idfile'];
                                $this->MY_Model->update_data($table, $set, $where);
                            }
                            $set['urutan'] = $newUrutan;
                            $where['idfile'] = $idFile;
                            $this->MY_Model->update_data($table, $set, $where);
                            $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Mengurutkan File / Media berhasil.</p></div>');
                        } else {
                            $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Tidak ada perubahan urutan.</p></div>');
                        }
                    } else {
                        $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Proses ubah urutan gagal.</p></div>');
                    }
                } else {
                    $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Media tidak ditemukan.</p></div>');
                }
            } else {
                $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>ID Media tidak sesuai.</p></div>');
            }
            redirect('adminppid/siaga-covid-19/' . $slug);
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Halaman yang diminta tidak ditemukan, silahkan cek kembali URL yang dituju.</p></div>');
            redirect('adminppid/');
        }
    }

    function edit_media($slug = null, $idMedia = null, $idFile = null)
    {
        if ($slug != null && $idMedia != null && $idFile != null) {
            $getThreadContent = $this->informasipublikadmin_model->getThreadContent($slug);
            if ($idMedia == $getThreadContent['idmedia']) {
                $getMedia = $this->informasipublikadmin_model->getThreadMedia($idMedia, $idFile);
                if ($getMedia) {
                    $id_topik = $getThreadContent['idtopik'];
                    $getThreadMain = $this->informasipublikadmin_model->getThreadMain($id_topik);
                    $judulTopik = $getThreadMain['judultopik'];
                    $headingContent = $getThreadContent['headingcontent'];
                    $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> ' . $judulTopik . ' <i class="fa fa-angle-right"></i> ' . $headingContent . ' <i class="fa fa-angle-right"></i> Edit Media';
                    $data['page'] = 'thread_edit_media';
                    $data['threadMedia'] = $getMedia[0];
                    $data['threadMain'] = $getThreadMain;
                    $data['threadContent'] = $getThreadContent;
                    $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
                } else {
                    $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Media tidak ditemukan.</p></div>');
                    redirect('adminppid/siaga-covid-19/' . $slug);
                }
            } else {
                $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>ID Media tidak sesuai.</p></div>');
                redirect('adminppid/siaga-covid-19/' . $slug);
            }
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Halaman yang diminta tidak ditemukan, silahkan cek kembali URL yang dituju.</p></div>');
            redirect('adminppid/');
        }
    }

    function update_media($slugContent = null, $idMedia = null, $idFile = null)
    {
        if ($slugContent != null && $idMedia != null && $idFile != null) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('typeFile', 'Type Media', 'required');
            $this->form_validation->set_rules('idContent', 'ID CONTENT', 'required');
            $this->form_validation->set_rules('idTopik', 'ID TOPIK', 'required');
            $this->form_validation->set_rules('slugMain', 'SLUG MAIN', 'required');
            $this->form_validation->set_rules('judulnarasi', 'Judul Narasi', 'trim');
            $this->form_validation->set_rules('narasi', 'Narasi', 'trim');
            $this->form_validation->set_rules('idmedia', 'ID MEDIA', 'required');
            $this->form_validation->set_rules('idfile', 'ID FILE', 'required');
            $postTypeFile = $this->input->post('typeFile', true);
            if ($postTypeFile == 'fileppid' || $postTypeFile == 'fileppidtag') {
                $this->form_validation->set_rules('idFilePpid', 'File PPID', 'trim');
            } elseif ($postTypeFile == 'youtube') {
                $this->form_validation->set_rules('url', 'Url Youtube', 'trim|valid_url|prep_url');
                $this->form_validation->set_rules('judulmedia', 'Judul Media', 'required');
            }
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>' . validation_errors() . '</p></div>');
                redirect('adminppid/siaga-covid-19/edit_media/' . $slugContent . '/' . $idMedia . '/' . $idFile);
            } else {
                $post_idContent = $this->input->post('idContent', true);
                $post_idTopik = $this->input->post('idTopik', true);
                $post_slugMain = $this->input->post('slugMain', true);
                $post_idmedia = $this->input->post('idmedia', true);
                $post_idfile = $this->input->post('idfile', true);
                $post_judulnarasi = $this->input->post('judulnarasi', true);
                $post_narasi = $this->input->post('narasi');
                $getMedia = $this->informasipublikadmin_model->getThreadMedia($post_idmedia, $post_idfile);
                if ($getMedia) {
                    $set['judulnarasi'] = $post_judulnarasi;
                    $set['narasi'] = $post_narasi;
                    $set['userupdate'] = $this->session->userdata('username');
                    $set['dateupdate'] = date('Y-m-d H:i:s');
                    if ($postTypeFile == 'youtube') {
                        $set['namafile'] = $this->input->post('url', true);
                        $set['judulmedia'] = $this->input->post('judulmedia', true);
                    }
                    $this->informasipublikadmin_model->update_thread_media($post_idmedia, $post_idfile, $set);
                    $this->session->set_flashdata('message_status', '<div class="alert alert-success"><p>Media berhasil diupdate.</p></div>');
                    redirect('adminppid/siaga-covid-19/edit_media/' . $slugContent . '/' . $idMedia . '/' . $idFile);
                } else {
                    $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Media tidak ditemukan.</p></div>');
                    redirect('adminppid/siaga-covid-19/edit_media/' . $slugContent . '/' . $idMedia . '/' . $idFile);
                }
            }
        } else {
            $this->session->set_flashdata('message_status', '<div class="alert alert-warning"><p>Halaman yang diminta tidak ditemukan, silahkan cek kembali URL yang dituju.</p></div>');
            redirect('adminppid/');
        }
    }

    //END OF class Informasi_donasi
}
