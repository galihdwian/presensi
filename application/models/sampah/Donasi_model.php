<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Donasi_model
 * @author Imam Syaifulloh <imam.syaifulloh12 at gmail.com>
 * @property CI_DB_query_builder $db
 * @property CI_DB_forge $dbforge
 * @property CI_Config $config
 * @property MY_Loader $load
 * @property CI_Session $session
 * @property Index $index
 */

class Donasi_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_list_master_donasi_datatables()
    {
        $this->datatables->select("id,nama_satuan,created_at,created_by,updated_at,updated_by")
            ->from('donasi_mst_satuan')
            ->add_column(
                'view',
                '<a href="' . site_url('adminppid/donasi/master-satuan/edit/$1') . '" class="btn btn-warning btn-sm mr-5">Edit</a>',
                'id'
            );
        return $this->datatables->generate();
    }

    function get_list_donasi_datatables()
    {
        $this->datatables->select("donasi.id,donasi.tanggal_donasi,donasi.nama_item,donasi.qty,donasi.pengirim_donasi,donasi.keterangan,donasi.deleted_at,donasi_mst_satuan.nama_satuan")
            ->from('donasi')
            ->join('donasi_mst_satuan', 'donasi.id_donasi_mst_satuan=donasi_mst_satuan.id')
            ->add_column(
                'view',
                '<a href="' . site_url('adminppid/donasi/hapus/$1') . '" onclick="return confirm(\'Apakah yakin menghapus donasi?\');" class="btn btn-danger btn-sm mr-5">Hapus</a>' .
                    '<a href="' . site_url('adminppid/donasi/edit/$1') . '" class="btn btn-warning btn-sm mr-5">Edit</a>',
                'id'
            );
        return $this->datatables->generate();
    }
    //END OF MODEL Donasi_model
}
