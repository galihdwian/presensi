<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author IMAM_SYAIFULLOH
 */
class Profil_model extends CI_Model {

    function get_struktur_pegawai($id_parent = '0',$tipe) {
        $this->db->select("id_str,str_alias,nama_struktur,id_pegawai,id_parent,eselon");
        $this->db->from("str_master");
        $this->db->where("id_parent", $id_parent);
        $this->db->where("tipe", $tipe);
        $this->db->order_by("id_str", "ASC");
        $result = $this->db->get();
        $data = array();
        foreach ($result->result() as $row):
            $data[] = array(
                'id_struktur' => $row->id_str,
                'str_alias' => $row->str_alias,
                'nama_struktur' => $row->nama_struktur,
                'eselon' => $row->eselon,
                // recursive                
                'pegawai' => $this->get_detail_pegawai($row->id_pegawai),
                'childstruktur' => $this->get_struktur_pegawai($row->id_str,$tipe)
            );
        endforeach;
        unset($result, $row);
        return $data;
    }

    function get_detail_pegawai($id_pegawai) {
        $this->db->select("*");
        $this->db->from("str_pegawai");
        $this->db->where("id_pegawai", $id_pegawai);
        $res = $this->db->get();
        $datap = array();
        foreach ($res->result() as $rowp):
            $datap[] = array(                
                'id_pegawai' => $rowp->id_pegawai,
                'nama_pegawai' => $rowp->nama_pegawai,
                'foto' => $rowp->foto,
                'foto_profil' => $rowp->foto_profil,
                'str_display' => $rowp->str_display
            );
        endforeach;
        unset($res, $rowp);
        return $datap;
    }
    
    function get_detilpejabat($id_pejabat){
        $this->db->select("*");
        $this->db->from("str_pegawai");
        $this->db->where("id_pegawai",$id_pejabat);
        return $this->db->get()->result_array();
    }
    
     function get_pejabat_struktural($id_parent = "0") {
        $this->db->select("m.str_alias,m.nama_struktur,m.id_str,m.eselon,p.nama_pegawai,p.id_pegawai,p.foto_profil",FALSE);
        $this->db->from("str_master m",FALSE);
        $this->db->join("str_pegawai p", "m.id_pegawai=p.id_pegawai","LEFT");
        $this->db->where("m.id_parent", $id_parent);
        $this->db->where("m.tipe", "R");
        $this->db->order_by("m.id_str", "ASC");
        $result = $this->db->get();
        $data = array();
        foreach ($result->result() as $row):
            $data[] = array(
                'str_alias' => $row->str_alias,
                'nama_struktur' => $row->nama_struktur,
                'eselon' => $row->eselon,            
                'nama_pegawai' => $row->nama_pegawai,
                'id_pegawai' => $row->id_pegawai,
                'foto_profil' => $row->foto_profil,
                'childstruktur' => $this->get_pejabat_struktural($row->id_str)
            );
        endforeach;
        unset($result, $row);
        return $data;
    }
    
    function get_struktur_ppid(){
        $this->db->select('s.str_alias,s.nama_struktur,s.id_pegawai,p.nama_pegawai,p.foto_profil,s.eselon');
        $this->db->from('str_master s');
        $this->db->join('str_pegawai p','s.id_pegawai=p.id_pegawai','LEFT');
        $this->db->where('s.tipe','P');
        $this->db->order_by('s.sortjabatan');
        return $this->db->get()->result();
    }

}

?>
