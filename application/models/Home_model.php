<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of home_model
 *
 * @author Galih Dwi A N
 */
class Home_model extends CI_Model
{

    function get_slide()
    {
        $this->db->select('*');
        $this->db->from("ip_slide");
        $this->db->order_by("sort_slide", "ASC");
        return $this->db->get()->result_array();
    }
}
