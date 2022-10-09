<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Ruangan_model
 *
 * @author UNICORN
 */
class Ruangan_model extends CI_Model
{

    function getListRuangan()
    {
        return $this->db->get("ruangan")->result();
    }

    function getRuangan($id_ruangan)
    {
        $this->db->where("id_ruangan", $id_ruangan);
        return $this->db->get("ruangan")->row();
    }

    function _update_ruangan($id_ruangan, $update)
    {
        $this->db->where("id_ruangan", $id_ruangan);
        $this->db->update('ruangan', $update);
        return true;
    }

    function _tambah_ruangan($save)
    {
        $this->db->insert("ruangan", $save);
        return true;
    }

    function _delete_ruangan($id_ruangan)
    {
        $this->db->where("id_ruangan", $id_ruangan);
        $this->db->delete('ruangan');
        return true;
    }
}
