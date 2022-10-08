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
        return $this->db->get("user_tb")->result();
    }

    function getListLevel()
    {
        return $this->db->get("level_tb")->result();
    }

    function getListStatus()
    {
        return $this->db->get("status_tb")->result();
    }

    function setAktivasi($id_user, $update)
    {
        $this->db->where("id_user", $id_user);
        $this->db->update('user_tb', $update);
        return true;
    }

    function _tambah_user($save)
    {
        $this->db->insert("user_tb", $save);
        return true;
    }
}
