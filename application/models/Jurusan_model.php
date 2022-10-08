<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Jurusan_model
 *
 * @author UNICORN
 */
class Jurusan_model extends CI_Model
{

    function getListJurusan()
    {
        return $this->db->get("jurusan")->result();
    }

    function getJurusan($id_jurusan)
    {
        $this->db->where("id_jurusan", $id_jurusan);
        return $this->db->get("jurusan")->row();
    }

    function _tambah_jurusan($save)
    {
        $this->db->insert("jurusan", $save);
        return true;
    }

    function _update_jurusan($id_jurusan, $update)
    {
        $this->db->where("id_jurusan", $id_jurusan);
        $this->db->update('jurusan', $update);
        return true;
    }

    function _delete_jurusan($id_jurusan)
    {
        $this->db->where("id_jurusan", $id_jurusan);
        $this->db->delete('jurusan');
        return true;
    }
}
