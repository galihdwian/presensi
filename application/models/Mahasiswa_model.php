<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Mahasiswa_model
 *
 * @author UNICORN
 */
class Mahasiswa_model extends CI_Model
{

    function getListMahasiswa()
    {
        $this->db->select("*");
        $this->db->from("mahasiswa a");
        $this->db->join("jurusan b", "a.kode_jurusan=b.kode_jurusan", "LEFT");
        return $this->db->get()->result();
    }

    function getMahasiswa($id_jurusan)
    {
        $this->db->where("id_mhs", $id_jurusan);
        return $this->db->get("mahasiswa")->row();
    }

    function setAktivasi($id_mhs, $update)
    {
        $this->db->where("id_mhs", $id_mhs);
        $this->db->update('mahasiswa', $update);
        return true;
    }

    function _update_mahasiswa($id_mhs, $update)
    {
        $this->db->where("id_mhs", $id_mhs);
        $this->db->update('mahasiswa', $update);
        return true;
    }

    function _tambah_mahasiswa($save)
    {
        $this->db->insert("mahasiswa", $save);
        return true;
    }
}
