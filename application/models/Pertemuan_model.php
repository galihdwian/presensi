<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Pertemuan_model
 *
 * @author UNICORN
 */
class Pertemuan_model extends CI_Model
{

    function getListPertemuan()
    {
        $this->db->select("*");
        $this->db->from("pertemuan a");
        $this->db->join("dosen b", "a.id_dsn=b.id_dsn", "LEFT");
        $this->db->join("matkul c", "a.id_matkul=c.id_matkul", "LEFT");
        $this->db->join("ruangan d", "a.id_ruangan=d.id_ruangan", "LEFT");
        $this->db->join("periode e", "a.id_periode=e.id_periode", "LEFT");
        $this->db->order_by("e.id_periode", "DESC");
        return $this->db->get()->result();
    }

    function getPertemuan($id_pertemuan)
    {
        $this->db->where("id_pertemuan", $id_pertemuan);
        return $this->db->get("pertemuan")->row();
    }

    function _update_pertemuan($id_pertemuan, $update)
    {
        $this->db->where("id_pertemuan", $id_pertemuan);
        $this->db->update('pertemuan', $update);
        return true;
    }

    function _tambah_pertemuan($save)
    {
        $this->db->insert("pertemuan", $save);
        return true;
    }

    function _delete_pertemuan($id_pertemuan)
    {
        $this->db->where("id_pertemuan", $id_pertemuan);
        $this->db->delete('pertemuan');
        return true;
    }

    //detail pertebuan by id matkul
    function getListPertemuanbymatkul($id_matkul)
    {
        $this->db->select("*");
        $this->db->from("pertemuan a");
        $this->db->join("dosen b", "a.id_dsn=b.id_dsn", "LEFT");
        $this->db->join("matkul c", "a.id_matkul=c.id_matkul", "LEFT");
        $this->db->join("ruangan d", "a.id_ruangan=d.id_ruangan", "LEFT");
        $this->db->join("periode e", "a.id_periode=e.id_periode", "LEFT");
        $this->db->where("a.id_matkul", $id_matkul);
        $this->db->order_by("e.id_periode", "DESC");
        return $this->db->get()->result();
    }
}
