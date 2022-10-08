<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Login_model
 *
 * @author UNICORN
 */
class Login_model extends CI_Model
{

    //put your code here
    function getUser($user)
    {
        return $this->db->get_where('user_tb', array('username' => $user));
    }

    function lastLogin($lastlog, $id)
    {
        $data = array(
            'last_login' => $lastlog
        );
        $this->db->where('id_user', $id);
        $this->db->update('user_tb', $data);
    }
}
