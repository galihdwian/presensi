<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Ppdtp_fk_unsoed_model
 *
 * @author Galih Swi A N
 */

class Ppdtp_fk_unsoed_model extends CI_Model
{

    function getPPDTP($id)
    {
        $this->db->where('id', $id);
        return $this->db->get("ppdtp_tb")->row();
    }

    function getListPPDTP()
    {
        return $this->db->get("ppdtp_tb")->result();
    }

    function _tambah_ppdtp($save)
    {
        $this->db->insert("ppdtp_tb", $save);
        return true;
    }

    function _delete_ppdtp($id)
    {
        $this->db->delete('ppdtp_tb', array('id' => $id));
        return true;
    }
}
