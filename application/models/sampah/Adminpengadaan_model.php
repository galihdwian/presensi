<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Adminpengadaan_model
 * @author Imam Syaifulloh <imam.syaifulloh12 at gmail.com>
 */
class Adminpengadaan_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function pengadaan_get_list_tahun() {
        $this->db->select('DISTINCT(tahunpengadaan) AS tahunpengadaan')
                ->from('pengadaan_tb')
                ->where('pengumumanlpse', 1)
                ->where('tahunpengadaan >=', 2020);
        $result = $this->db->get()->result();
        return $result;
    }

    function pengadaan_get_list_dokumen($id_paket) {
        $this->db->select('d.id_paket,d.iddokumen,d.id_file,d.keterangan,d.date_set_dokumen,d.user_set_dokumen,d.link_lpse,m.namadokumen,f.display_name,f.slug,m.lpsesufix,m.lpseprefix,d.idlistdokumen,d.direct_link')
                ->from('pengadaan_dokumen_paket d')
                ->join('pengadaan_master_dokumen m', 'd.iddokumen=m.iddokumen')
                ->join('ip_sub_file f', 'd.id_file=f.id_file', 'LEFT')
                ->where('d.id_paket', $id_paket)
                ->where('d.deleted', 0)
                ->order_by('m.urutan', 'ASC');
        $result = $this->db->get()->result();
        return $result;
    }

    function pengadaan_get_dokumen($tahun_pengadaan, $id_dokumen = null) {
        $this->db->select('r.tahunpengadaan,r.id_file,r.deleted,r.datecreate,r.usercreate,r.iddokumen,f.nama_file,f.display_name,f.slug,d.namadokumen')
                ->from('pengadaan_dokumen_rs r, ip_sub_file f,pengadaan_master_dokumen d')
                ->where('r.id_file=f.id_file', null, false)
                ->where('r.iddokumen=d.iddokumen', null, false)
                ->where('r.tahunpengadaan', $tahun_pengadaan)
                ->where('r.deleted', 0)
                ->order_by('d.urutan', 'ASC');
        if ($id_dokumen != null) {
            $this->db->where('r.iddokumen', $id_dokumen);
            $result = $this->db->get()->row();
        } else {
            $result = $this->db->get()->result();
        }
        return $result;
    }

    //END OF class Adminpengadaan_model
}
