<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Gallery_model
 *
 * @author Galih Swi A N
 */

class Gallery_model extends CI_Model
{
    function getGallery($id)
    {
        $this->db->where('id', $id);
        return $this->db->get("gallery_tb")->row();
    }

    function getListGallery()
    {
        return $this->db->get("gallery_tb")->result();
    }

    function _tambah_gallery($save)
    {
        $this->db->insert("gallery_tb", $save);
        return true;
    }

    function _delete_gallery($id)
    {
        $this->db->delete('gallery_tb', array('id' => $id));
        return true;
    }
}
