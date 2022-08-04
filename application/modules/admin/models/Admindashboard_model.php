<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admindasboard_model
 *
 * @author Galih Dwi A N 
 */
class Admindashboard_model extends CI_Model
{

    //put your code here
    function changepassword($update, $username)
    {
        $this->db->where('username', $username);
        $this->db->update('user', $update);
    }

    function getuser()
    {
        $this->db->select("user.*,user_level.nama_level");
        $this->db->from("user");
        $this->db->join("user_level", "user.hak_akses = user_level.hak_akses");
        $this->db->order_by("user.nama_user");
        return $this->db->get()->result_array();
    }

    function getlevel()
    {
        return $this->db->get("user_level")->result_array();
    }

    function save($save)
    {
        $this->db->insert("user", $save);
    }
}
