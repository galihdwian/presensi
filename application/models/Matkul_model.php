<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Matkul_model
 *
 * @author UNICORN
 */
class Matkul_model extends CI_Model
{

    function getListMatkul()
    {
        $this->db->select("*");
        $this->db->from("matkul a");
        $this->db->join("dosen b", "a.id_dsn=b.id_dsn", "LEFT");

        return $this->db->get()->result();
    }

    function getMatkul($id_matkul)
    {
        $this->db->select("*");
        $this->db->from("matkul a");
        $this->db->join("dosen b", "a.id_dsn=b.id_dsn", "LEFT");
        $this->db->where("a.id_matkul", $id_matkul);
        return $this->db->get()->row();
    }

    function _update_matkul($id_matkul, $update)
    {
        $this->db->where("id_matkul", $id_matkul);
        $this->db->update('matkul', $update);
        return true;
    }

    function _delete_matkul($id_matkul)
    {
        $this->db->where("id_matkul", $id_matkul);
        $this->db->delete("matkul");
        return true;
    }

    function _tambah_matkul($save)
    {
        $this->db->insert("matkul", $save);
        return true;
    }

    function getListDetailMatkul($id_matkul)
    {
        $this->db->select("*");
        $this->db->from("matkul_detail a");
        $this->db->join("matkul b", "a.id_matkul=b.id_matkul", "LEFT");
        $this->db->join("dosen c", "b.id_dsn=c.id_dsn", "LEFT");
        $this->db->join("mahasiswa d", "d.id_mhs=a.id_mahasiswa", "LEFT");
        $this->db->where("a.id_matkul", $id_matkul);

        return $this->db->get()->result();
    }

    function _tambah_detail_matkul($save)
    {
        $this->db->insert("matkul_detail", $save);
        return true;
    }

    function _delete_matkul_detail($id_matkul, $id_mahasiswa)
    {
        $this->db->where("id_matkul", $id_matkul);
        $this->db->where("id_mahasiswa", $id_mahasiswa);
        $this->db->delete("matkul_detail");
        return true;
    }
}
