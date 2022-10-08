<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Strukturorganisasi_model
 *
 * @author Galih Swi A N
 */
class Strukturorganisasi_model extends CI_Model
{

    function getstrukturorganisasi()
    {
        $this->db->select('*');
        $this->db->from("struktur_organisasi_tb");
        return $this->db->get()->row();
    }

    function _update_getstrukturorganisasi($update)
    {
        extract($update);
        $this->db->where('id', $id);
        $this->db->update('struktur_organisasi_tb', array('judul' => $judul, 'gambar' => $gambar));
        return true;
    }
}
