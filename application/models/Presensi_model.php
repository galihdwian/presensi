<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Presensi_model
 *
 * @author UNICORN
 */
class Presensi_model extends CI_Model
{

    function getListDetailAbsen($id_pertemuan)
    {
        $this->db->select("*");
        $this->db->from("presensi a");
        $this->db->join("mahasiswa b", "a.id_mhs=b.id_mhs", "LEFT");
        $this->db->where("a.id_pertemuan", $id_pertemuan);
        return $this->db->get()->result();
    }
}
