<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Periode_model
 *
 * @author UNICORN
 */
class Periode_model extends CI_Model
{

    function getListPeriode()
    {
        return $this->db->get("periode")->result();
    }

    function getPeriode($id_periode)
    {
        $this->db->where("id_periode", $id_periode);
        return $this->db->get("periode")->row();
    }

    function setAktivasi($id_periode, $update)
    {
        $this->db->where("id_periode", $id_periode);
        $this->db->update('periode', $update);
        return true;
    }

    function _update_periode($id_periode, $update)
    {
        $this->db->where("id_periode", $id_periode);
        $this->db->update('periode', $update);
        return true;
    }

    function _tambah_periode($save)
    {
        $this->db->insert("periode", $save);
        return true;
    }
}
