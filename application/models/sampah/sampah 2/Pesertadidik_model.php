<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Pesertadidik_model
 *
 * @author Galih Dwi A N
 */

class Pesertadidik_model extends CI_Model
{
    function getPesertadidik($id)
    {
        $this->db->where('id', $id);
        return $this->db->get("pesertadidik_tb")->row();
    }

    function getListPesertadidik($limit = null)
    {
        if ($limit != null) {
            $this->db->limit($limit);
        }
        $this->db->order_by("created_at", "DESC");
        return $this->db->get("pesertadidik_tb")->result();
    }

    function _tambah_pesertadidik($save)
    {
        $this->db->insert("pesertadidik_tb", $save);
        return true;
    }

    function _delete_pesertadidik($id)
    {
        $this->db->delete('pesertadidik_tb', array('id' => $id));
        return true;
    }
}
