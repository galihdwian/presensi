<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Visidanmisi_model
 *
 * @author Galih Swi A N
 */
class visidanmisi_model extends CI_Model
{

    function getvisi($id)
    {
        $this->db->select('*');
        $this->db->from("visi_tb");
        $this->db->where('id_visi', $id);
        return $this->db->get()->row();
    }

    function getmisi($id)
    {
        $this->db->select('*');
        $this->db->from("misi_tb");
        $this->db->where('id_misi', $id);
        return $this->db->get()->row();
    }

    function getListVisi()
    {
        return $this->db->get("visi_tb")->result();
    }

    function getListMisi()
    {
        return $this->db->get("misi_tb")->result();
    }

    function _tambah_visi($save)
    {
        $this->db->insert("visi_tb", $save);
        return true;
    }

    function _tambah_misi($save)
    {
        $this->db->insert("misi_tb", $save);
        return true;
    }

    function _delete_visi($id)
    {
        $this->db->delete('visi_tb', array('id_visi' => $id));
        return true;
    }

    function _delete_misi($id)
    {
        $this->db->delete('misi_tb', array('id_misi' => $id));
        return true;
    }

    function _update_visi($update)
    {
        extract($update);
        $this->db->where('id_visi', $id);
        $this->db->update('visi_tb', array('nama_visi' => $nama_visi));
        return true;
    }

    function _update_misi($update)
    {
        extract($update);
        $this->db->where('id_misi', $id);
        $this->db->update('misi_tb', array('nama_misi' => $nama_misi));
        return true;
    }
}
