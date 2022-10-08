<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Matkul_model
 *
 * @author UNICORN
 */
class Matkul_model extends CI_Model
{

    function getListDosen()
    {
        return $this->db->get("dosen")->result();
    }

    function getDosen($id_dsn)
    {
        $this->db->where("id_dsn", $id_dsn);
        return $this->db->get("dosen")->row();
    }

    function setAktivasi($id_dsn, $update)
    {
        $this->db->where("id_dsn", $id_dsn);
        $this->db->update('dosen', $update);
        return true;
    }

    function _update_dosen($id_dsn, $update)
    {
        $this->db->where("id_dsn", $id_dsn);
        $this->db->update('dosen', $update);
        return true;
    }

    function _tambah_dosen($save)
    {
        $this->db->insert("dosen", $save);
        return true;
    }
}
