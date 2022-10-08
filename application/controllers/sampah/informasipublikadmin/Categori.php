<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Categori
 * @author Imam Syaifulloh <imam.syaifulloh12 at gmail.com>
 * @property informasipublikadmin_model $informasipublikadmin_model
 */
class Categori extends Admin_Controller
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
        $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Informasi Publik <i class="fa fa-angle-right"></i> Kategori';
        $data['page'] = 'categori';
        $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
    }

    function categoridata()
    {
        $data['ip_tag'] = $this->MY_Model->get_data_all('ip_tag', array('ordertag' => 'ASC'));
        $this->load->view('informasipublikadmin/categori/categori_data', $data);
    }

    function categoriadd()
    {
        $data['md_title'] = "Tambah Kategori";
        $data['max_oerdertag'] = $this->MY_Model->get_max_value('ip_tag', 'ordertag');
        $this->load->view('informasipublikadmin/categori/categori_add', $data);
    }

    function categorisave()
    {
        $btnsimpan = $this->input->post('btnsimpan', true);
        if ($btnsimpan == 'simpandata') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id_tag', 'Id Kategori', 'required|is_unique[ip_tag.id_tag]');
            $this->form_validation->set_rules('name_tag', 'Nama Kategori', 'required|is_unique[ip_tag.name_tag]');
            $this->form_validation->set_rules('ordertag', 'Nomor Urut', 'required');
            $this->form_validation->set_rules('displaytag', 'Status Display', 'required');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata("message_status", '<div class="alert alert-danger">' . validation_errors('<p>', '</p>') . '</div>');
            } else {
                $id_tag = $this->input->post('id_tag', true);
                $name_tag = $this->input->post('name_tag', true);
                $ordertag = $this->input->post('ordertag', true);
                $displaytag = $this->input->post('displaytag', true);
                $set = array(
                    'id_tag' => $id_tag,
                    'name_tag' => $name_tag,
                    'ordertag' => $ordertag,
                    'displaytag' => $displaytag
                );
                $ar = $this->MY_Model->insert_data('ip_tag', $set);
                if ($ar > 0) {
                    $this->session->set_flashdata("message_status", '<div class="alert alert-success">Proses simpan berhasil.</div>');
                } else {
                    $this->session->set_flashdata("message_status", '<div class="alert alert-danger">Proses simpan gagal.</div>');
                }
            }
        } else {
            $this->session->set_flashdata("message_status", '<div class="alert alert-danger">Proses tidak dapat dilakukan.</div>');
        }
        redirect('adminppid/categori');
    }

    function categoriedit($id_tag = null)
    {
        if ($id_tag != null) {
            $id_tag = rawurldecode($id_tag);
            $data['md_title'] = "Edit Kategori";
            $data['get_kategori'] = $this->MY_Model->get_where('ip_tag', array('id_tag' => $id_tag), 'row');
            $this->load->view('informasipublikadmin/categori/categori_edit', $data);
        } else {
            show_404();
        }
    }

    function categoriupdate()
    {
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        $btnsimpan = $this->input->post('btnsimpan', true);
        if ($btnsimpan == 'simpandata') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id_tag', 'Id Kategori', 'required');
            $this->form_validation->set_rules('name_tag', 'Nama Kategori', 'required|callback__validasi_nametag_categori');
            $this->form_validation->set_rules('ordertag', 'Nomor Urut', 'required');
            $this->form_validation->set_rules('displaytag', 'Status Display', 'required');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata("message_status", '<div class="alert alert-danger">' . validation_errors('<p>', '</p>') . '</div>');
            } else {
                $id_tag = $this->input->post('id_tag', true);
                $name_tag = $this->input->post('name_tag', true);
                $ordertag = $this->input->post('ordertag', true);
                $displaytag = $this->input->post('displaytag', true);
                $set = array(
                    'name_tag' => $name_tag,
                    'ordertag' => $ordertag,
                    'displaytag' => (int) $displaytag
                );
                $ar = $this->MY_Model->update_data('ip_tag', $set, array('id_tag' => $id_tag));
                if ($ar > 0) {
                    $this->session->set_flashdata("message_status", '<div class="alert alert-success">Proses update berhasil.</div>');
                } else {
                    $this->session->set_flashdata("message_status", '<div class="alert alert-danger">Proses update gagal.</div>');
                }
            }
        } else {
            $this->session->set_flashdata("message_status", '<div class="alert alert-danger">Proses tidak dapat dilakukan.</div>');
        }
        redirect('adminppid/categori');
    }

    function _validasi_nametag_categori()
    {
        $id_tag = $this->input->post('id_tag', true);
        $name_tag = $this->input->post('name_tag', true);
        $check_nametag = $this->MY_Model->get_where('ip_tag', array('name_tag' => $name_tag, 'id_tag !=' => $id_tag));
        if ($check_nametag) {
            $this->form_validation->set_message('_validasi_nametag_categori', '{field} sudah ada di daftar informasi publik, mohon cek nama kategori.');
            return false;
        } else {
            return true;
        }
    }

    function list_file_categori($id_tag = null)
    {
        if ($id_tag != null) {
            $id_tag = rawurldecode($id_tag);
            $get_detail_tag = $this->MY_Model->get_where('ip_tag', array('id_tag' => $id_tag), 'row');
            if ($get_detail_tag) {
                $data['detail_kategori'] = $get_detail_tag;
                $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Informasi Publik <i class="fa fa-angle-right"></i> Kategori <i class="fa fa-angle-right"></i> List File';
                $data['page'] = 'categori_list_file';
                $data['list_file'] = $this->MY_Model->get_where('ip_tag_content', array('id_tag' => $id_tag), 'result', null, null, array('display_name' => 'ASC'));
                $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
            } else {
                $this->session->set_flashdata("message_status", '<div class="alert alert-danger">Data kategori tidak ditemukan.</div>');
                redirect('adminppid/categori');
            }
        } else {
            $this->session->set_flashdata("message_status", '<div class="alert alert-danger">Proses tidak dapat dilakukan.</div>');
            redirect('adminppid/categori');
        }
    }

    function categori_cari_file()
    {
        $response['success'] = false;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('key', 'Kata Kunci Pencarian', 'required');
        $this->form_validation->set_rules('id', 'Id Kategori', 'required');
        $this->form_validation->set_rules('type', 'Tipe Data', 'required');
        if ($this->form_validation->run() == false) {
            $response['message'] = validation_errors(' ', '<br>');
        } else {
            $keyword = $this->input->post('key', true);
            $id_tag = $this->input->post('id', true);
            $typedata = $this->input->post('type', true);
            $get_detail_tag = $this->MY_Model->get_where('ip_tag', array('id_tag' => $id_tag), 'row');
            if ($get_detail_tag) {
                $result_file = array();
                $list_file_kategori = $this->informasipublikadmin_model->search_file_kategori($id_tag, $keyword, $typedata);
                if ($typedata == 'file') {
                    $file_in_kategori = array();
                    if ($list_file_kategori) {
                        foreach ($list_file_kategori as $row) :
                            $file_in_kategori[] = $row['namafile'];
                        endforeach;
                    }
                    $list_file_sub = $this->informasipublikadmin_model->search_file_sub_not_exist_tag($keyword, $file_in_kategori);
                    $result_file = array_merge($list_file_kategori, $list_file_sub);
                } else {
                    $result_file = $list_file_kategori;
                }
                if (count($result_file) > 0) {
                    $response['success'] = true;
                    $response['urutan'] = $this->MY_Model->get_max_value('ip_tag_content', 'sorting_data', array('id_tag' => $id_tag)) + 1;
                    $response['data'] = $result_file;
                } else {
                    $response['message'] = 'Tidak ditemukan file dengan keyword ' . $keyword;
                }
            } else {
                $response['message'] = 'Data kategori tidak ditemukan.';
            }
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    function categori_pilih_file()
    {
        $response['success'] = false;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('file', 'Id File', 'required|callback__cekfile');
        $this->form_validation->set_rules('id', 'Id Kategori', 'required');
        $this->form_validation->set_rules('type', 'Tipe Data', 'required');
        $this->form_validation->set_rules('urut', 'Nomor Urut', 'required');
        $this->form_validation->set_rules('displayname', 'Display Name', 'required');
        if ($this->form_validation->run() == false) {
            $response['message'] = validation_errors(' ', '<br>');
            $id_file = $this->input->post_get('file', true);
            $get_file = null;
            $display_name = '';
            $slug_file = '';
            if (substr($id_file, 0, 4) == 'IPTC') {
                $get_file = $this->MY_Model->get_where('ip_tag_content', array('id_tagcontent' => $id_file), 'row');
                $display_name = $get_file->display_name;
                $slug_file = $get_file->slug;
            } else {
                $get_file = $this->MY_Model->get_where('ip_sub_file', array('id_file' => $id_file), 'row');
                $display_name = $get_file->display_name;
                $slug_file = $get_file->slug;
            }
            $response['data']['display_name'] = $display_name;
            $response['data']['slug'] = $slug_file;
        } else {
            $id_tag = $this->input->post_get('id', true);
            $type = $this->input->post_get('type', true);
            $id_file = $this->input->post_get('file', true);
            $displayname = $this->input->post_get('displayname', true);
            $urut = $this->input->post_get('urut', true);
            $slug = $this->input->post('slug', true);
            $get_file = null;
            $nama_file = '';
            $slug_file = '';
            if (substr($id_file, 0, 4) == 'IPTC') {
                $get_file = $this->MY_Model->get_where('ip_tag_content', array('id_tagcontent' => $id_file), 'row');
                $nama_file = $get_file->file;
                $slug_file = $get_file->slug;
            } else {
                $get_file = $this->MY_Model->get_where('ip_sub_file', array('id_file' => $id_file), 'row');
                $nama_file = $get_file->nama_file;
                $slug_file = $get_file->slug;
            }
            $prefix_id_tagcontent = 'IPTC-' . date('ymd') . '-';
            $get_max_id_tagcontent = $this->MY_Model->get_max_field('ip_tag_content', 'id_tagcontent', 13, array('LEFT(id_tagcontent,12)' => $prefix_id_tagcontent));
            $suffix_id = str_pad((($get_max_id_tagcontent != null ? $get_max_id_tagcontent : 0) + 1), 3, '0', STR_PAD_LEFT);
            $set = array(
                'id_tagcontent' => $prefix_id_tagcontent . $suffix_id,
                'id_tag' => $id_tag,
                'tipe' => $type,
                'file' => ($type == 'file' ? $nama_file : null),
                'display_name' => $displayname,
                'page' => 1,
                'slug' => ($slug == '' ? $slug_file : $slug),
                'sorting_data' => $urut
            );
            $ar = $this->MY_Model->insert_data('ip_tag_content', $set);
            if ($ar > 0) {
                $response['success'] = true;
                $response['message'] = 'Proses simpan file berhasil';
                $response['listfiles'] = $this->MY_Model->get_where('ip_tag_content', array('id_tag' => $id_tag), 'result', null, null, array('display_name' => 'ASC'));
            } else {
                $response['message'] = 'Proses simpan file gagal';
            }
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    function _cekfile()
    {
        $id_tag = $this->input->post_get('id', true);
        $type = $this->input->post_get('type', true);
        $id_file = $this->input->post_get('file', true);
        $displayname = $this->input->post_get('displayname', true);
        $slug = $this->input->post('slug', true);
        $check_display_name = $this->MY_Model->get_where('ip_tag_content', array('id_tag' => $id_tag, 'display_name' => $displayname));
        if ($check_display_name) {
            $this->form_validation->set_message('_cekfile', 'Display name sudah ada di kategori.');
            return false;
        } else {
            if (substr($id_file, 0, 4) == 'IPTC' || substr($id_file, 0, 3) == 'ISF') {
                if (substr($id_file, 0, 4) == 'IPTC') {
                    $get_file = $this->MY_Model->get_where('ip_tag_content', array('id_tagcontent' => $id_file), 'row');
                } else {
                    $get_file = $this->MY_Model->get_where('ip_sub_file', array('id_file' => $id_file), 'row');
                }
                if (!empty($get_file)) {
                    $nama_file = '';
                    $slug_file = '';
                    if (substr($id_file, 0, 4) == 'IPTC') {
                        $nama_file = $get_file->file;
                        $slug_file = $get_file->slug;
                    } else {
                        $nama_file = $get_file->nama_file;
                        $slug_file = $get_file->slug;
                    }
                    if ($type == 'file' && $nama_file == '') {
                        $this->form_validation->set_message('_cekfile', 'File tidak dapat dipilih dengan type file.');
                        return false;
                    } else {
                        $slug_cek = $slug == '' ? $slug_file : $slug;
                        $check_slug = $this->MY_Model->get_where('ip_tag_content', array('id_tag' => $id_tag, 'slug' => $slug_cek));
                        if ($check_slug) {
                            $this->form_validation->set_message('_cekfile', 'Slug sudah ada di kategori.');
                            return false;
                        } else {
                            if ($type == 'file') {
                                $check_file = $this->MY_Model->get_where('ip_tag_content', array('id_tag' => $id_tag, 'file' => $nama_file));
                                if ($check_file) {
                                    $this->form_validation->set_message('_cekfile', 'File sudah ada di kategori.');
                                    return false;
                                } else {
                                    return true;
                                }
                            } else {
                                return true;
                            }
                        }
                    }
                } else {
                    $this->form_validation->set_message('_cekfile', 'File tidak ditemukan.');
                    return false;
                }
            } else {
                $this->form_validation->set_message('_cekfile', 'ID File tidak valid.');
                return false;
            }
        }
    }

    function categori_delete_file($id_tagcontent = null)
    {
        if ($id_tagcontent != null) {
            $id_tagcontent = rawurldecode($id_tagcontent);
            $get_detail_tag_content = $this->MY_Model->get_where('ip_tag_content', array('id_tagcontent' => $id_tagcontent), 'row');
            if ($get_detail_tag_content) {
                $id_tag = $get_detail_tag_content->id_tag;
                $nama_file = $get_detail_tag_content->file;
                $this->MY_Model->delete_data('ip_tag_content', array('id_tagcontent' => $id_tagcontent));
                $check_file_tag = $this->MY_Model->get_where('ip_tag_content', array('id_tag !=' => $id_tag, 'file' => $nama_file));
                if (empty($check_file_tag)) {
                    $check_file_sub = $this->MY_Model->get_where('ip_sub_file', array('nama_file' => $nama_file));
                    if (empty($check_file_sub)) {
                        $file_exist = file_exists('assets/file/' . $nama_file);
                        if ($file_exist) {
                            unlink('assets/file/' . $nama_file);
                        }
                    }
                }
                $this->session->set_flashdata("message_status", '<div class="alert alert-success">Proses hapus file berhasil.</div>');
                redirect('adminppid/list_file_categori/' . rawurlencode($id_tag));
            } else {
                $this->session->set_flashdata("message_status", '<div class="alert alert-danger">Detail file tidak ditemukan.</div>');
                redirect('adminppid/categori');
            }
        } else {
            $this->session->set_flashdata("message_status", '<div class="alert alert-danger">Proses tidak dapat dilakukan.</div>');
            redirect('adminppid/categori');
        }
    }

    function list_file_categori_upload($id_tag = null)
    {
        if ($id_tag != null) {
            $id_tag = rawurldecode($id_tag);
            $get_detail_tag = $this->MY_Model->get_where('ip_tag', array('id_tag' => $id_tag), 'row');
            if ($get_detail_tag) {
                $simpan_data = $this->input->post('simpan_data', true);
                if ($simpan_data == 'prosessimpanfile') {
                    $this->_proses_upload_file($id_tag, $get_detail_tag);
                } else {
                    $data['urutan'] = $this->MY_Model->get_max_value('ip_tag_content', 'sorting_data', array('id_tag' => $id_tag)) + 1;
                    $data['detail_kategori'] = $get_detail_tag;
                    $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Informasi Publik <i class="fa fa-angle-right"></i> Kategori <i class="fa fa-angle-right"></i> Upload File';
                    $data['page'] = 'categori_list_file_upload';
                    $data['list_file'] = $this->MY_Model->get_where('ip_tag_content', array('id_tag' => $id_tag), 'result', null, null, array('display_name' => 'ASC'));
                    $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
                }
            } else {
                $this->session->set_flashdata("message_status", '<div class="alert alert-danger">Data kategori tidak ditemukan.</div>');
                redirect('adminppid/categori');
            }
        } else {
            $this->session->set_flashdata("message_status", '<div class="alert alert-danger">Proses tidak dapat dilakukan.</div>');
            redirect('adminppid/categori');
        }
    }

    function _proses_upload_file($id_tag, $get_detail_tag)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_tag', 'Id Tag', 'required');
        $this->form_validation->set_rules('tipe', 'Tipe File', 'required');
        $this->form_validation->set_rules('display_name', 'Display Name', 'required|callback__validasidisplaynamecategori');
        $this->form_validation->set_rules('slug', 'Slug', 'callback__validasislugcategori');
        $this->form_validation->set_rules('link', 'Link', 'callback__validasilinkcategori');
        $this->form_validation->set_rules('sorting_data', 'Urutan', 'required');
        if ($this->form_validation->run() == false) {
            $data['urutan'] = $this->MY_Model->get_max_value('ip_tag_content', 'sorting_data', array('id_tag' => $id_tag)) + 1;
            $data['error'] = '<div class="alert alert-danger">' . validation_errors('<p>', '</p>') . '</div>';
            $data['detail_kategori'] = $get_detail_tag;
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Informasi Publik <i class="fa fa-angle-right"></i> Kategori <i class="fa fa-angle-right"></i> Upload File';
            $data['page'] = 'categori_list_file_upload';
            $data['list_file'] = $this->MY_Model->get_where('ip_tag_content', array('id_tag' => $id_tag), 'result', null, null, array('display_name' => 'ASC'));
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $id_tag = $this->input->post('id_tag', true);
            $tipe = $this->input->post('tipe', true);
            $link = $this->input->post('link', true);
            $slug = $this->input->post('slug', true);
            $display_name = $this->input->post('display_name', true);
            $sorting_data = $this->input->post('sorting_data', true);
            $nama_file = null;
            $error['status'] = false;
            if ($tipe == 'file') {
                $config['upload_path'] = './assets/file/';
                $config['max_size'] = 25600;
                $config['file_name'] = $slug;
                $config['allowed_types'] = 'pdf';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('nama_file')) {
                    $error['status'] = true;
                    $error['message'] = $this->upload->display_errors();
                } else {
                    $nama_file = $this->upload->data('file_name');
                    $check_file_name_tag = $this->MY_Model->get_where('ip_tag_content', array('file' => $nama_file));
                    if ($check_file_name_tag) {
                        $error['status'] = true;
                        $error['message'] = 'Nama File Sudah Terdaftar di kategori, ubah slug untuk merubah nama file.';
                    } else {
                        $check_file_name_tag = $this->MY_Model->get_where('ip_sub_file', array('nama_file' => $nama_file));
                        if ($check_file_name_tag) {
                            $error['status'] = true;
                            $error['message'] = 'Nama File Sudah Terdaftar di sub file dip, ubah slug untuk merubah nama file.';
                        }
                    }
                }
            }
            if ($error['status'] == false) {
                $prefix_id_tagcontent = 'IPTC-' . date('ymd') . '-';
                $get_max_id_tagcontent = $this->MY_Model->get_max_field('ip_tag_content', 'id_tagcontent', 13, array('LEFT(id_tagcontent,12)' => $prefix_id_tagcontent));
                $suffix_id = str_pad((($get_max_id_tagcontent != null ? $get_max_id_tagcontent : 0) + 1), 3, '0', STR_PAD_LEFT);
                $set = array(
                    'id_tagcontent' => $prefix_id_tagcontent . $suffix_id,
                    'id_tag' => $id_tag,
                    'tipe' => $tipe,
                    'file' => $nama_file,
                    'display_name' => $display_name,
                    'page' => 1,
                    'slug' => ($tipe == 'file' ? $slug : $link),
                    'sorting_data' => $sorting_data
                );
                $ar = $this->MY_Model->insert_data('ip_tag_content', $set);
                if ($ar > 0) {
                    $this->session->set_flashdata("message_status", '<div class="alert alert-success">Proses simpan berhasil.</div>');
                    redirect('adminppid/list_file_categori/' . rawurlencode($id_tag));
                } else {
                    $this->session->set_flashdata("message_status", '<div class="alert alert-danger">Proses simpan gagal.</div>');
                    redirect('adminppid/list_file_categori/' . rawurlencode($id_tag));
                }
            } else {
                $data['urutan'] = $this->MY_Model->get_max_value('ip_tag_content', 'sorting_data', array('id_tag' => $id_tag)) + 1;
                $data['error'] = '<div class="alert alert-danger">' . (!empty($error['message']) ? $error['message'] : 'Tidak dapat menyimpan file') . '</div>';
                $data['detail_kategori'] = $get_detail_tag;
                $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Informasi Publik <i class="fa fa-angle-right"></i> Kategori <i class="fa fa-angle-right"></i> Upload File';
                $data['page'] = 'categori_list_file_upload';
                $data['list_file'] = $this->MY_Model->get_where('ip_tag_content', array('id_tag' => $id_tag), 'result', null, null, array('display_name' => 'ASC'));
                $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
            }
        }
    }

    function _validasidisplaynamecategori()
    {
        $id_tag = $this->input->post('id_tag', true);
        $tipe = $this->input->post('tipe', true);
        $display_name = $this->input->post('display_name', true);
        $check_exist = $this->MY_Model->get_where('ip_tag_content', array('id_tag' => $id_tag, 'display_name' => $display_name));
        if ($check_exist) {
            $this->form_validation->set_message('_validasidisplaynamecategori', 'Display name sudah terdaftar di kategori.');
            return false;
        } else {
            if (strtoupper($display_name) == $display_name || strtolower($display_name) == $display_name) {
                $this->form_validation->set_message('_validasidisplaynamecategori', 'Display harus terdiri dari kombinasi huruf kapital dan huruf kecil.');
                return false;
            } else {
                return true;
            }
        }
    }

    function _validasislugcategori($slug)
    {
        $display_name = $this->input->post('display_name', true);
        if (strpos($slug, ' ') == false) {
            if ($slug == '') {
                $this->form_validation->set_message('_validasislugcategori', '{field} harus diisi.');
                return false;
            } else {
                $check_exist = $this->MY_Model->get_where('ip_tag_content', array('slug' => $slug, 'display_name' => $display_name));
                if ($check_exist) {
                    $this->form_validation->set_message('_validasislugcategori', '{field} sudah terdaftar di kategori.');
                    return false;
                } else {
                    $check_exist_sub_file = $this->MY_Model->get_where('ip_sub_file', array('slug' => $slug));
                    if ($check_exist_sub_file) {
                        $this->form_validation->set_message('_validasislugcategori', '{field} sudah terdaftar di sub file dip.');
                        return false;
                    } else {
                        return true;
                    }
                }
            }
        } else {
            $this->form_validation->set_message('_validasislugcategori', 'Format {field} tidak boleh ada spasi.');
            return false;
        }
    }

    function _validasilinkcategori()
    {
        $id_tag = $this->input->post('id_tag', true);
        $tipe = $this->input->post('tipe', true);
        $link = $this->input->post('link', true);
        $display_name = $this->input->post('display_name', true);
        if ($tipe == 'link') {
            if ($link == '') {
                $this->form_validation->set_message('_validasilinkcategori', '{field} harus diisi.');
                return false;
            } else {
                $check_exist = $this->MY_Model->get_where('ip_tag_content', array('slug' => $link, 'display_name' => $display_name));
                if ($check_exist) {
                    $this->form_validation->set_message('_validasilinkcategori', '{field} sudah terdaftar di kategori.');
                    return false;
                } else {
                    return true;
                }
            }
        } else {
            return true;
        }
    }

    function categori_edit_file($id_tagcontent = null)
    {
        if ($id_tagcontent != null) {
            $id_tagcontent = rawurldecode($id_tagcontent);
            $get_detail_tag_content = $this->MY_Model->get_where('ip_tag_content', array('id_tagcontent' => $id_tagcontent), 'row');
            if ($get_detail_tag_content) {
                $id_tag = $get_detail_tag_content->id_tag;
                $get_detail_tag = $this->MY_Model->get_where('ip_tag', array('id_tag' => $id_tag), 'row');
                if ($get_detail_tag) {
                    $simpan_data = $this->input->post('simpan_data', true);
                    if ($simpan_data == 'prosessimpanfile') {
                        $this->_proses_update_data($get_detail_tag, $get_detail_tag_content, $id_tag);
                    } else {
                        $data['detail_kategori'] = $get_detail_tag;
                        $data['detail_tag_content'] = $get_detail_tag_content;
                        $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Informasi Publik <i class="fa fa-angle-right"></i> Kategori <i class="fa fa-angle-right"></i> Edit File';
                        $data['page'] = 'categori_list_file_edit';
                        $data['list_file'] = $this->MY_Model->get_where('ip_tag_content', array('id_tag' => $id_tag), 'result', null, null, array('display_name' => 'ASC'));
                        $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
                    }
                } else {
                    $this->session->set_flashdata("message_status", '<div class="alert alert-danger">Data kategori tidak ditemukan.</div>');
                    redirect('adminppid/categori');
                }
            } else {
                $this->session->set_flashdata("message_status", '<div class="alert alert-danger">Data file tidak ditemukan.</div>');
                redirect('adminppid/categori');
            }
        } else {
            $this->session->set_flashdata("message_status", '<div class="alert alert-danger">Proses tidak dapat dilakukan.</div>');
            redirect('adminppid/categori');
        }
    }

    function _proses_update_data($get_detail_tag, $get_detail_tag_content, $id_tag)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_tag', 'Id Tag', 'required');
        $this->form_validation->set_rules('id_tagcontent', 'Id Tag Content', 'required');
        $this->form_validation->set_rules('tipe', 'Tipe File', 'required');
        $this->form_validation->set_rules('display_name', 'Display Name', 'required|callback__validasidisplaynamecategori_update');
        $this->form_validation->set_rules('slug', 'Slug', 'callback__validasislugcategori_update');
        $this->form_validation->set_rules('link', 'Link', 'callback__validasilinkcategori_update');
        $this->form_validation->set_rules('sorting_data', 'Urutan', 'required');
        if ($this->form_validation->run() == false) {
            $data['urutan'] = $this->MY_Model->get_max_value('ip_tag_content', 'sorting_data', array('id_tag' => $id_tag)) + 1;
            $data['error'] = '<div class="alert alert-danger">' . validation_errors('<p>', '</p>') . '</div>';
            $data['detail_kategori'] = $get_detail_tag;
            $data['titlepage'] = 'PPID RSMS Dashboard <i class="fa fa-angle-right"></i> Informasi Publik <i class="fa fa-angle-right"></i> Kategori <i class="fa fa-angle-right"></i> Upload File';
            $data['page'] = 'categori_list_file_upload';
            $data['list_file'] = $this->MY_Model->get_where('ip_tag_content', array('id_tag' => $id_tag), 'result', null, null, array('display_name' => 'ASC'));
            $this->load->view('informasipublikadmin/informasipublikadmin_layout', $data);
        } else {
            $id_tagcontent = $this->input->post('id_tagcontent', true);
            $id_tag = $this->input->post('id_tag', true);
            $tipe = $this->input->post('tipe', true);
            $link = $this->input->post('link', true);
            $slug = $this->input->post('slug', true);
            $display_name = $this->input->post('display_name', true);
            $sorting_data = $this->input->post('sorting_data', true);
            $set = array(
                'id_tag' => $id_tag,
                'tipe' => $tipe,
                'display_name' => $display_name,
                'page' => 1,
                'slug' => ($tipe == 'file' ? $slug : $link),
                'sorting_data' => $sorting_data
            );
            $ar = $this->MY_Model->update_data('ip_tag_content', $set, array('id_tagcontent' => $id_tagcontent));
            if ($ar > 0) {
                $this->session->set_flashdata("message_status", '<div class="alert alert-success">Proses simpan berhasil.</div>');
                redirect('adminppid/list_file_categori/' . rawurlencode($id_tag));
            } else {
                $this->session->set_flashdata("message_status", '<div class="alert alert-danger">Proses simpan gagal.</div>');
                redirect('adminppid/list_file_categori/' . rawurlencode($id_tag));
            }
        }
    }

    function _validasidisplaynamecategori_update()
    {
        $id_tag = $this->input->post('id_tag', true);
        $id_tagcontent = $this->input->post('id_tagcontent', true);
        $tipe = $this->input->post('tipe', true);
        $display_name = $this->input->post('display_name', true);
        $check_exist = $this->MY_Model->get_where('ip_tag_content', array('id_tag' => $id_tag, 'display_name' => $display_name, 'id_tagcontent !=' => $id_tagcontent));
        if ($check_exist) {
            $this->form_validation->set_message('_validasidisplaynamecategori_update', 'Display name sudah terdaftar di kategori.');
            return false;
        } else {
            return true;
        }
    }

    function _validasislugcategori_update()
    {
        $id_tag = $this->input->post('id_tag', true);
        $id_tagcontent = $this->input->post('id_tagcontent', true);
        $tipe = $this->input->post('tipe', true);
        $slug = $this->input->post('slug', true);
        $display_name = $this->input->post('display_name', true);
        if ($tipe == 'file') {
            if ($slug == '') {
                $this->form_validation->set_message('_validasislugcategori_update', '{field} harus diisi.');
                return false;
            } else {
                $check_exist = $this->MY_Model->get_where('ip_tag_content', array('slug' => $slug, 'display_name' => $display_name, 'id_tagcontent !=' => $id_tagcontent));
                if ($check_exist) {
                    $this->form_validation->set_message('_validasislugcategori_update', '{field} sudah terdaftar di kategori.');
                    return false;
                } else {
                    $check_exist_sub_file = $this->MY_Model->get_where('ip_sub_file', array('slug' => $slug));
                    if ($check_exist_sub_file) {
                        $this->form_validation->set_message('_validasislugcategori_update', '{field} sudah terdaftar di sub file dip.');
                        return false;
                    } else {
                        return true;
                    }
                }
            }
        } else {
            return true;
        }
    }

    function _validasilinkcategori_update()
    {
        $id_tag = $this->input->post('id_tag', true);
        $id_tagcontent = $this->input->post('id_tagcontent', true);
        $tipe = $this->input->post('tipe', true);
        $link = $this->input->post('link', true);
        $display_name = $this->input->post('display_name', true);
        if ($tipe == 'link') {
            if ($link == '') {
                $this->form_validation->set_message('_validasilinkcategori_update', '{field} harus diisi.');
                return false;
            } else {
                $check_exist = $this->MY_Model->get_where('ip_tag_content', array('slug' => $link, 'display_name' => $display_name, 'id_tagcontent !=' => $id_tagcontent));
                if ($check_exist) {
                    $this->form_validation->set_message('_validasilinkcategori_update', '{field} sudah terdaftar di kategori.');
                    return false;
                } else {
                    return true;
                }
            }
        } else {
            return true;
        }
    }

    //END OF class Categori
}
