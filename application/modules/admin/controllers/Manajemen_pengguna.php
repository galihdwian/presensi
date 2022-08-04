<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Manajemen_pengguna
 * @author Imam Syaifulloh <imam.syaifulloh12 at gmail.com>
 * @property MY_Model $MY_Model
 * @property admin_model $admin_model
 * @property string $kodeperiode
 */
class Manajemen_pengguna extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
    }


    function index()
    {
        $this->_restrict_except_admin();
        $data['activemenu'] = 'Manajemen Pengguna';
        $data['activesubmenu'] = 'Pengaturan Pengguna';
        $data['titlepage'] = 'Admin E-Recruitment<small>Pengaturan Pengguna</small>';
        $data['loadcontent'] = 'admin/manajemen_pengguna/pengaturan_pengguna/index_pengaturan_pengguna.php';
        $data['list_user'] = $this->MY_Model->get_join(
            'user u',
            array(['userlevel l', 'u.hak_akses=l.id_level', 'INNER']),
            'u.username,u.nama_user,u.hak_akses,l.nama_level',
            array('u.nama_user' => 'ASC')
        );
        $this->_generate_admin_template($data);
    }

    function user_add()
    {
        $this->_restrict_except_admin();
        $data['activemenu'] = 'Manajemen Pengguna';
        $data['activesubmenu'] = 'Pengaturan Pengguna';
        $data['titlepage'] = 'Admin E-Recruitment<small>Tambah Pengguna</small>';
        $data['loadcontent'] = 'admin/manajemen_pengguna/pengaturan_pengguna/form_add_pengguna.php';
        if (!$this->input->post('submit')) {
            $data['list_hakakses'] = $this->MY_Model->get_all('userlevel', array('namahakakses' => 'ASC'));
            $data['list_formasi'] = $this->MY_Model->get_where_join('formasiperiode e', array('e.kodeperiode' => $this->curentperiode->kodeperiode), array(array('formasi f', 'e.kodeformasi=f.kodeformasi', 'INNER')), 'e.kodeformasi,f.formasi', array('f.kodeformasi' => 'ASC'));
            $this->_generate_admin_template($data);
        } else {
            //print_r($_POST);
            $this->form_validation->set_rules('hakakses', 'Hak Akses', 'required|callback__checkhakakses');
            $this->form_validation->set_rules('namauser', 'Nama User', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]');
            $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('confpassword', 'Konfirmasi Password', 'required|matches[password]');
            if ($this->form_validation->run($this) == FALSE) {
                $data['list_hakakses'] = $this->MY_Model->get_all('userlevel', array('namahakakses' => 'ASC'));
                $data['list_formasi'] = $this->MY_Model->get_where_join('formasiperiode e', array('e.kodeperiode' => $this->curentperiode->kodeperiode), array(array('formasi f', 'e.kodeformasi=f.kodeformasi', 'INNER')), 'e.kodeformasi,f.formasi', array('f.kodeformasi' => 'ASC'));
                $this->_generate_admin_template($data);
            } else {
                unset($data);
                $username = $this->input->post('username');
                $hakakses = $this->input->post('hakakses');
                $save['username'] = $username;
                $save['password'] = $this->_generate_hash($this->input->post('password'));
                $save['hakakses'] = $hakakses;
                $save['namauser'] = $this->input->post('namauser');
                $save['jk'] = $this->input->post('jk');
                $this->MY_Model->save('user', $save);
                unset($save);
                $list_formasi = $this->MY_Model->get_where_join('formasiperiode e', array('e.kodeperiode' => $this->curentperiode->kodeperiode), array(array('formasi f', 'e.kodeformasi=f.kodeformasi', 'INNER')), 'e.kodeformasi,f.formasi', array('f.kodeformasi' => 'ASC'));
                if ($hakakses == 'PN') {
                    foreach ($list_formasi as $row) :
                        if ($this->input->post('interview-' . $row->kodeformasi)) {
                            $save_permission['username'] = $username;
                            $save_permission['kodeformasi'] = $this->input->post('interview-' . $row->kodeformasi);
                            $this->MY_Model->save('userpermissioninterview', $save_permission);
                            unset($save_permission);
                        }
                    endforeach;
                } elseif ($hakakses == 'PS') {
                    foreach ($list_formasi as $row) :
                        if ($this->input->post('skill-' . $row->kodeformasi)) {
                            $save_permission['usename'] = $username;
                            $save_permission['kode_formasi'] = $this->input->post('skill-' . $row->kodeformasi);
                            $this->MY_Model->save('userpermisionskill', $save_permission);
                            unset($save_permission);
                        }
                    endforeach;
                } elseif ($hakakses == 'NS') {
                    foreach ($list_formasi as $row) :
                        if ($this->input->post('interview-' . $row->kodeformasi)) {
                            $save_permission['username'] = $username;
                            $save_permission['kodeformasi'] = $this->input->post('interview-' . $row->kodeformasi);
                            $this->MY_Model->save('userpermissioninterview', $save_permission);
                            unset($save_permission);
                        }
                        if ($this->input->post('skill-' . $row->kodeformasi)) {
                            $save_permission['usename'] = $username;
                            $save_permission['kode_formasi'] = $this->input->post('skill-' . $row->kodeformasi);
                            $this->MY_Model->save('userpermisionskill', $save_permission);
                            unset($save_permission);
                        }
                    endforeach;
                }
                $this->_set_flash('Berhasil menambahkan user dengan nama ' . $this->input->post('namauser'), 'admin/manajemen_pengguna', 'alert-success');
            }
        }
    }

    // function _checkhakakses($hakakses)
    // {
    //     if ($hakakses != 'PN' && $hakakses != 'PS' && $hakakses != 'NS') {
    //         return TRUE;
    //     } else {
    //         $status = FALSE;
    //         $list_formasi = $this->MY_Model->get_where_join('formasiperiode e', array('e.kodeperiode' => $this->curentperiode->kodeperiode), array(array('formasi f', 'e.kodeformasi=f.kodeformasi', 'INNER')), 'e.kodeformasi,f.formasi', array('f.kodeformasi' => 'ASC'));
    //         if ($hakakses == 'PN') {
    //             foreach ($list_formasi as $row) :
    //                 if ($this->input->post('interview-' . $row->kodeformasi)) {
    //                     $status = TRUE;
    //                     break;
    //                 }
    //             endforeach;
    //         } elseif ($hakakses == 'PS') {
    //             foreach ($list_formasi as $row) :
    //                 if ($this->input->post('skill-' . $row->kodeformasi)) {
    //                     $status = TRUE;
    //                     break;
    //                 }
    //             endforeach;
    //         } elseif ($hakakses == 'NS') {
    //             $status_skill = FALSE;
    //             $status_interview = FALSE;
    //             foreach ($list_formasi as $row) :
    //                 if ($this->input->post('skill-' . $row->kodeformasi)) {
    //                     $status_skill = TRUE;
    //                     break;
    //                 }
    //             endforeach;
    //             unset($row);
    //             foreach ($list_formasi as $row) :
    //                 if ($this->input->post('interview-' . $row->kodeformasi)) {
    //                     $status_interview = TRUE;
    //                     break;
    //                 }
    //             endforeach;
    //             if ($status_interview == TRUE && $status_skill == TRUE)
    //                 $status = TRUE;
    //         }
    //         if ($status == TRUE) {
    //             return TRUE;
    //         } else {
    //             $this->form_validation->set_message('_checkhakakses', 'User dengan hak akses ' . ($hakakses == 'NS' ? 'Pewawancara & Penilai Skill' : ($hakakses == 'PN' ? 'Pewawancara' : 'Penguji Skill')) . ' harus memilih formasi.');
    //             return FALSE;
    //         }
    //     }
    // }

    // function user_detail($cipher_username = null)
    // {
    //     $this->_restrict_except_admin();
    //     if (!empty($cipher_username)) {
    //         $username = aesdecryptstring($cipher_username);
    //         if ($username) {
    //             $data['activemenu'] = 'Manajemen Pengguna';
    //             $data['activesubmenu'] = 'Pengaturan Pengguna';
    //             $data['titlepage'] = 'Admin E-Recruitment<small>Detail Pengguna</small>';
    //             $data['loadcontent'] = 'admin/manajemen_pengguna/pengaturan_pengguna/detail_pengguna.php';
    //             $get_user = $this->MY_Model->get_where_singgle_join('user u', array('username' => urldecode($username)), array(array('userlevel l', 'u.hakakses=l.hakakses', 'INNER')), 'u.*,l.namahakakses');
    //             if ($get_user) {
    //                 $data['get_listwawancara'] = $this->MY_Model->get_where_join('userpermissioninterview i', array('i.username' => urldecode($username)), array(array('formasi f', 'i.kodeformasi=f.kodeformasi', 'INNER')), 'i.*,f.formasi', array('i.kodeformasi' => 'ASC'));
    //                 $data['get_listskill'] = $this->MY_Model->get_where_join('userpermisionskill s', array('s.usename' => urldecode($username)), array(array('formasi f', 's.kode_formasi=f.kodeformasi', 'INNER')), 's.*,f.formasi', array('s.kode_formasi' => 'ASC'));
    //                 $data['get_user'] = $get_user;
    //                 $this->_generate_admin_template($data);
    //             } else {
    //                 $this->_set_flash('Data tidak ditemukan.', 'admin/manajemen_pengguna');
    //             }
    //         } else {
    //             $this->_set_flash('Permintaan tidak valid.', 'admin/manajemen_pengguna');
    //         }
    //     } else {
    //         $this->_set_flash('Permintaan tidak valid.', 'admin/manajemen_pengguna');
    //     }
    // }

    // function user_edit($cipher_username = null)
    // {
    //     $this->_restrict_except_admin();
    //     if (!empty($cipher_username)) {
    //         $username = aesdecryptstring($cipher_username);
    //         if ($username) {
    //             $data['activemenu'] = 'Manajemen Pengguna';
    //             $data['activesubmenu'] = 'Pengaturan Pengguna';
    //             $data['titlepage'] = 'Admin SIMONA<small>Edit Pengguna</small>';
    //             $data['loadcontent'] = 'admin/manajemen_pengguna/pengaturan_pengguna/form_edit_pengguna.php';
    //             $get_user = $this->MY_Model->get_where_singgle_join('user u', array('username' => urldecode($username)), array(array('userlevel l', 'u.hakakses=l.hakakses', 'INNER')), 'u.*,l.namahakakses');
    //             if (!$this->input->post('submit')) {
    //                 if ($get_user) {
    //                     $data['list_hakakses'] = $this->MY_Model->get_all('userlevel', array('namahakakses' => 'ASC'));
    //                     $data['list_formasi'] = $this->MY_Model->get_where_join('formasiperiode e', array('e.kodeperiode' => $this->curentperiode->kodeperiode), array(array('formasi f', 'e.kodeformasi=f.kodeformasi', 'INNER')), 'e.kodeformasi,f.formasi', array('f.kodeformasi' => 'ASC'));
    //                     $data['get_listwawancara'] = $this->MY_Model->get_where_join('userpermissioninterview i', array('i.username' => urldecode($username)), array(array('formasi f', 'i.kodeformasi=f.kodeformasi', 'INNER')), 'i.*,f.formasi', array('i.kodeformasi' => 'ASC'));
    //                     $data['get_listskill'] = $this->MY_Model->get_where_join('userpermisionskill s', array('s.usename' => urldecode($username)), array(array('formasi f', 's.kode_formasi=f.kodeformasi', 'INNER')), 's.*,f.formasi', array('s.kode_formasi' => 'ASC'));
    //                     $data['get_user'] = $get_user;
    //                     $this->_generate_admin_template($data);
    //                 } else {
    //                     $this->_set_flash('Data tidak ditemukan.', 'admin/manajemen_pengguna');
    //                 }
    //             } else {
    //                 $this->form_validation->set_rules('hakakses', 'Hak Akses', 'required|callback__checkhakakses');
    //                 $this->form_validation->set_rules('namauser', 'Nama User', 'required');
    //                 $this->form_validation->set_rules('username', 'Username', 'required|callback__checkusername');
    //                 $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
    //                 if ($this->input->post('password')) {
    //                     $this->form_validation->set_rules('password', 'Password', 'required');
    //                     $this->form_validation->set_rules('confpassword', 'Konfirmasi Password', 'required|matches[password]');
    //                 }
    //                 if ($this->form_validation->run($this) == FALSE) {
    //                     $data['list_hakakses'] = $this->MY_Model->get_all('userlevel', array('namahakakses' => 'ASC'));
    //                     $data['list_formasi'] = $this->MY_Model->get_where_join('formasiperiode e', array('e.kodeperiode' => $this->curentperiode->kodeperiode), array(array('formasi f', 'e.kodeformasi=f.kodeformasi', 'INNER')), 'e.kodeformasi,f.formasi', array('f.kodeformasi' => 'ASC'));
    //                     $data['get_listwawancara'] = $this->MY_Model->get_where_join('userpermissioninterview i', array('i.username' => urldecode($username)), array(array('formasi f', 'i.kodeformasi=f.kodeformasi', 'INNER')), 'i.*,f.formasi', array('i.kodeformasi' => 'ASC'));
    //                     $data['get_listskill'] = $this->MY_Model->get_where_join('userpermisionskill s', array('s.usename' => urldecode($username)), array(array('formasi f', 's.kode_formasi=f.kodeformasi', 'INNER')), 's.*,f.formasi', array('s.kode_formasi' => 'ASC'));
    //                     $data['get_user'] = $get_user;
    //                     $this->_generate_admin_template($data);
    //                 } else {
    //                     unset($data);
    //                     $username = $this->input->post('username');
    //                     $hakakses = $this->input->post('hakakses');
    //                     if ($this->input->post('password')) {
    //                         $save['password'] = $this->_generate_hash($this->input->post('password'));
    //                     } else {
    //                         if ($hakakses == '0') {
    //                             $save['password'] = null;
    //                         }
    //                     }
    //                     $save['hakakses'] = $hakakses;
    //                     $save['namauser'] = $this->input->post('namauser');
    //                     $save['jk'] = $this->input->post('jk');
    //                     $this->MY_Model->update('user', $save, array('username' => $username));
    //                     $this->MY_Model->delete('userpermissioninterview', array('username' => $username));
    //                     $this->MY_Model->delete('userpermisionskill', array('usename' => $username));
    //                     unset($save);
    //                     $list_formasi = $this->MY_Model->get_where_join('formasiperiode e', array('e.kodeperiode' => $this->curentperiode->kodeperiode), array(array('formasi f', 'e.kodeformasi=f.kodeformasi', 'INNER')), 'e.kodeformasi,f.formasi', array('f.kodeformasi' => 'ASC'));
    //                     if ($hakakses == 'PN') {
    //                         foreach ($list_formasi as $row) :
    //                             if ($this->input->post('interview-' . $row->kodeformasi)) {
    //                                 $save_permission['username'] = $username;
    //                                 $save_permission['kodeformasi'] = $this->input->post('interview-' . $row->kodeformasi);
    //                                 $this->MY_Model->save('userpermissioninterview', $save_permission);
    //                                 unset($save_permission);
    //                             }
    //                         endforeach;
    //                     } elseif ($hakakses == 'PS') {
    //                         foreach ($list_formasi as $row) :
    //                             if ($this->input->post('skill-' . $row->kodeformasi)) {
    //                                 $save_permission['usename'] = $username;
    //                                 $save_permission['kode_formasi'] = $this->input->post('skill-' . $row->kodeformasi);
    //                                 $this->MY_Model->save('userpermisionskill', $save_permission);
    //                                 unset($save_permission);
    //                             }
    //                         endforeach;
    //                     } elseif ($hakakses == 'NS') {
    //                         foreach ($list_formasi as $row) :
    //                             if ($this->input->post('interview-' . $row->kodeformasi)) {
    //                                 $save_permission['username'] = $username;
    //                                 $save_permission['kodeformasi'] = $this->input->post('interview-' . $row->kodeformasi);
    //                                 $this->MY_Model->save('userpermissioninterview', $save_permission);
    //                                 unset($save_permission);
    //                             }
    //                             if ($this->input->post('skill-' . $row->kodeformasi)) {
    //                                 $save_permission['usename'] = $username;
    //                                 $save_permission['kode_formasi'] = $this->input->post('skill-' . $row->kodeformasi);
    //                                 $this->MY_Model->save('userpermisionskill', $save_permission);
    //                                 unset($save_permission);
    //                             }
    //                         endforeach;
    //                     }
    //                     $this->_set_flash('Berhasil menambahkan user dengan nama ' . $this->input->post('namauser'), 'admin/manajemen_pengguna', 'alert-success');
    //                 }
    //             }
    //         } else {
    //             $this->_set_flash('Permintaan tidak valid.', 'admin/manajemen_pengguna');
    //         }
    //     } else {
    //         $this->_set_flash('Permintaan tidak valid.', 'admin/manajemen_pengguna');
    //     }
    // }

    function _checkusername($username)
    {
        $get_user = $this->MY_Model->get_where_single('user', array('username' => $username));
        if ($get_user) {
            if ($get_user->username == $username) {
                return TRUE;
            } else {
                $this->form_validation->set_message('_checkusername', 'Username sudah terdaftar sebelumnya. Gunakan username lainnya.');
                return FALSE;
            }
        } else {
            $this->form_validation->set_message('_checkusername', 'Kolom isian {field} tidak valid.');
            return FALSE;
        }
    }

    function profil()
    {
        $username = $this->session->userdata('username');
        $data['activemenu'] = 'Manajemen Pengguna';
        $data['activesubmenu'] = 'Profil';
        $data['titlepage'] = 'Admin SIMONA<small>Profil Pengguna</small>';
        $data['loadcontent'] = 'admin/manajemen_pengguna/profil/index_profil.php';
        $get_user = $this->MY_Model->get_where_singgle_join('user u', array('username' => $username), array(array('user_level l', 'u.hak_akses=l.id_level', 'INNER')), 'u.*,l.nama_level');
        if ($get_user) {
            $data['get_user'] = $get_user;
            $this->_generate_admin_template($data);
        } else {
            $this->_set_flash('Data tidak ditemukan.', 'admin/manajemen_pengguna');
        }
    }

    function ubah_password()
    {
        $username = $this->session->userdata('username');
        $data['activemenu'] = 'Manajemen Pengguna';
        $data['activesubmenu'] = 'Ubah Password';
        $data['titlepage'] = 'Admin SIMONA<small>Ubah Password</small>';
        $data['loadcontent'] = 'admin/manajemen_pengguna/ubah_password/form_ubahpassword.php';
        $get_user = $this->MY_Model->get_where_singgle_join('user u', array('username' => $username), array(array('user_level l', 'u.hak_akses=l.id_level', 'INNER')), 'u.*,l.nama_level');
        if ($get_user) {
            if (!$this->input->post('submit')) {
                $data['get_user'] = $get_user;
                $this->_generate_admin_template($data);
            } else {
                print_r($_POST);
                $this->form_validation->set_rules('namauser', 'Nama User', 'required');
                $this->form_validation->set_rules('username', 'Username', 'required|callback__checkusername');
                $this->form_validation->set_rules('password', 'Password', 'required');
                $this->form_validation->set_rules('confpassword', 'Konfirmasi Password', 'required|matches[password]');
                if ($this->form_validation->run($this) == FALSE) {
                    $data['get_user'] = $get_user;
                    $this->_generate_admin_template($data);
                } else {
                    $save['password'] = $this->_generate_hash($this->input->post('password'));
                    $save['nama_user'] = $this->input->post('namauser');
                    $this->MY_Model->update('user', $save, array('username' => $username));
                    $this->_set_flash('Ubah password berhasil', 'admin/manajemen_pengguna/ubah_password', 'alert-success');
                }
            }
        } else {
            $this->_set_flash('Data tidak ditemukan.', 'admin/manajemen_pengguna/ubah_password');
        }
    }

    // public function user_wawancara($cipher_username = null)
    // {
    //     $this->_restrict_except_admin();
    //     if (!empty($cipher_username)) {
    //         $username = aesdecryptstring($cipher_username);
    //         if (!empty($username)) {
    //             $table = 'user';
    //             $where = ['username' => $username];
    //             $get_username = $this->MY_Model->get_where_single($table, $where);
    //             if (!empty($get_username)) {
    //                 $data['activemenu'] = 'Manajemen Pengguna';
    //                 $data['activesubmenu'] = 'Pengaturan Pengguna';
    //                 $data['titlepage'] = 'Admin E-Recruitment<small>Pengaturan Pengguna - Set Akses Wawancara</small>';
    //                 $data['loadcontent'] = 'admin/manajemen_pengguna/pengaturan_pengguna/pengaturan_pengguna_akses_wawancara.php';
    //                 $data['cipher_username'] = $cipher_username;
    //                 $data['detail_user'] = $get_username;
    //                 $data['listformasi'] = $this->admin_model->get_formasiperiode($this->kodeperiode);
    //                 $data['listpeserta'] = $this->admin_model->get_list_map_wawancara_user($this->kodeperiode, $username);
    //                 $this->_generate_admin_template($data);
    //             } else {
    //                 $this->_set_flash('Proses tidak dapat dilanjutkan, data user tidak ditemukan.', 'admin/manajemen_pengguna');
    //             }
    //         } else {
    //             $this->_set_flash('Proses tidak dapat dilanjutkan, tidak dapat membaca username yang diminta.', 'admin/manajemen_pengguna');
    //         }
    //     } else {
    //         $this->_set_flash('Proses tidak dapat dilanjutkan.', 'admin/manajemen_pengguna');
    //     }
    // }

    // public function formasi_wawancara($cipher_username = null, $cipher_formasi = null)
    // {
    //     $this->_restrict_except_admin();
    //     if (!empty($cipher_username)) {
    //         $username = aesdecryptstring($cipher_username);
    //         $formasi = aesdecryptstring($cipher_formasi);
    //         if (!empty($username)) {
    //             $table = 'user';
    //             $where = ['username' => $username];
    //             $get_username = $this->MY_Model->get_where_single($table, $where);
    //             if (!empty($get_username)) {
    //                 $submit_data = $this->input->post('submit', true);
    //                 if (empty($submit_data)) {
    //                     $this->_set_flash('Permintaan tidak valid, silahkan pilih formasi terlebih dahulu', 'admin/manajemen_pengguna/user_wawancara/' . $cipher_username);
    //                 } else {
    //                     $data['activemenu'] = 'Manajemen Pengguna';
    //                     $data['activesubmenu'] = 'Pengaturan Pengguna';
    //                     $data['titlepage'] = 'Admin E-Recruitment<small>Pengaturan Pengguna - Set Akses Wawancara</small>';
    //                     $data['loadcontent'] = 'admin/manajemen_pengguna/pengaturan_pengguna/pengaturan_pengguna_akses_wawancara_peserta.php';
    //                     $data['cipher_username'] = $cipher_username;
    //                     $data['detail_user'] = $get_username;
    //                     $listformasi = $this->admin_model->get_formasiperiode($this->kodeperiode);
    //                     $list_kodeformasi = array();
    //                     foreach ($listformasi as $row) :
    //                         if ($this->input->post($row->kodeformasi))
    //                             $list_kodeformasi[] = $row->kodeformasi;
    //                     endforeach;
    //                     $data['listpeserta'] = $this->admin_model->get_lolos_verifikasi_map_wawancara($this->kodeperiode, $list_kodeformasi, $username);
    //                     $data['list_kodeformasi'] = $list_kodeformasi;
    //                     $data['sidebar_collapse'] = true;
    //                     $this->_generate_admin_template($data);
    //                 }
    //             } else {
    //                 $this->_set_flash('Proses tidak dapat dilanjutkan, data user tidak ditemukan.', 'admin/manajemen_pengguna');
    //             }
    //         } else {
    //             $this->_set_flash('Proses tidak dapat dilanjutkan, tidak dapat membaca username yang diminta.', 'admin/manajemen_pengguna');
    //         }
    //     } else {
    //         $this->_set_flash('Proses tidak dapat dilanjutkan.', 'admin/manajemen_pengguna');
    //     }
    // }

    // public function set_peserta_wawancara($cipher_username = null)
    // {
    //     $this->_restrict_except_admin();
    //     if (!empty($cipher_username)) {
    //         $username = aesdecryptstring($cipher_username);
    //         if (!empty($username)) {
    //             $table = 'user';
    //             $where = ['username' => $username];
    //             $get_username = $this->MY_Model->get_where_single($table, $where);
    //             if (!empty($get_username)) {
    //                 $submit_data = $this->input->post('submit', true);
    //                 if (empty($submit_data)) {
    //                     $this->_set_flash('Permintaan tidak valid, silahkan pilih peserta terlebih dahulu', 'admin/manajemen_pengguna/user_wawancara/' . $cipher_username);
    //                 } else {
    //                     $list_peserta_terpilih = $this->input->post('pesertawawancara', true);
    //                     $get_unselect = $this->admin_model->get_map_wawancara_tidak_dapat_dihapus($list_peserta_terpilih, $username);
    //                     if (!empty($list_peserta_terpilih)) {
    //                         $insert_values = array();
    //                         foreach ($list_peserta_terpilih as $key => $value) {
    //                             $insert_values[] = "('{$value}','{$username}',0,0)";
    //                         }
    //                         $this->admin_model->inser_map_wawancara($insert_values);
    //                     }
    //                     if (!empty($get_unselect)) {
    //                         $nik = '';
    //                         foreach ($get_unselect as $row) {
    //                             $nik .= $row->nik . ', ';
    //                         }
    //                         $nik = rtrim($nik, ', ');
    //                         $this->_set_flash('Proses simpan peserta wawancara virtual berhasil. Namun ada beberapa peserta yang tidak dapat dihapus karena sudah dilakukan wawancara diantaranya NIK :<br>' . $nik, 'admin/manajemen_pengguna/user_wawancara/' . $cipher_username, 'alert-info');
    //                     } else {
    //                         $this->_set_flash('Proses simpan peserta wawancara virtual berhasil.', 'admin/manajemen_pengguna/user_wawancara/' . $cipher_username, 'alert-success');
    //                     }
    //                 }
    //             } else {
    //                 $this->_set_flash('Proses tidak dapat dilanjutkan, data user tidak ditemukan.', 'admin/manajemen_pengguna');
    //             }
    //         } else {
    //             $this->_set_flash('Proses tidak dapat dilanjutkan, tidak dapat membaca username yang diminta.', 'admin/manajemen_pengguna');
    //         }
    //     } else {
    //         $this->_set_flash('Proses tidak dapat dilanjutkan.', 'admin/manajemen_pengguna');
    //     }
    // }

    //END OF class Manajemen_pengguna
}
