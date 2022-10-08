<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Sk_komkordik_model
 *
 * @author Galih Swi A N
 */

class Sk_komkordik_model extends CI_Model
{
    function getSk($id)
    {
        $this->db->where('id', $id);
        return $this->db->get("sk_tb")->row();
    }

    function getListSk()
    {
        return $this->db->get("sk_tb")->result();
    }

    function _tambah_sk($save)
    {
        $this->db->insert("sk_tb", $save);
        return true;
    }

    function _delete_sk($id)
    {
        $this->db->delete('sk_tb', array('id' => $id));
        return true;
    }
}
