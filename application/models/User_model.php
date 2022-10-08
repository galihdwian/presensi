<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of User_model
 *
 * @author Galih Swi A N
 */
class User_model extends CI_Model
{

    function getListUser()
    {
        return $this->db->get("admin")->result();
    }

    function setAktivasi($id_user, $update)
    {
        $this->db->where("id_admin", $id_user);
        $this->db->update('admin', $update);
        return true;
    }

    function _tambah_user($save)
    {
        $this->db->insert("admin", $save);
        return true;
    }
}
