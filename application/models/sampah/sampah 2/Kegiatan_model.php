<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Kegiatan_model
 *
 * @author Galih Swi A N
 */

class Kegiatan_model extends CI_Model
{
    function getKegiatan($id)
    {
        $this->db->where('id', $id);
        return $this->db->get("kegiatan_tb")->row();
    }

    function getKegiatanLampiranbyidkegiatan($id)
    {
        $this->db->where('id_kegiatan', $id);
        return $this->db->get("lampiran_kegiatan_tb")->result();
    }

    function getKegiatanLampiran($id)
    {
        $this->db->where('id', $id);
        return $this->db->get("lampiran_kegiatan_tb")->row();
    }

    function getListKegiatan($limit = null)
    {
        if ($limit != null) {
            $this->db->limit($limit);
        }
        $this->db->order_by("created_at", "DESC");
        return $this->db->get("kegiatan_tb")->result();
    }

    function jumlah_data()
    {
        return $this->db->get('kegiatan_tb')->num_rows();
    }

    function getListKegiatandata($number, $offset)
    {
        $this->db->order_by('created_at', 'DESC');
        return $query = $this->db->get('kegiatan_tb', $number, $offset)->result();
    }

    function getListKegiatanLampiran($id)
    {
        $this->db->where("id_kegiatan", $id);
        return $this->db->get("lampiran_kegiatan_tb")->result();
    }

    function _tambah_kegiatan($save)
    {
        $this->db->insert("kegiatan_tb", $save);
        return true;
    }
    function _tambah_kegiatan_lampiran($save)
    {
        $this->db->insert("lampiran_kegiatan_tb", $save);
        return true;
    }

    function _delete_kegiatan($id)
    {
        $this->db->delete('kegiatan_tb', array('id' => $id));
        return true;
    }

    function _delete_kegiatan_lampiran($id)
    {
        $this->db->delete('lampiran_kegiatan_tb', array('id' => $id));
        return true;
    }

    function _update_kegiatan($update, $aksi = null)
    {
        if ($aksi != null) {
            extract($update);
            $this->db->where('id', $id);
            $this->db->update('kegiatan_tb', array('judul' => $judul, 'isi' => $isi, 'foto' => $foto, 'created_at' => $created_at, 'updated_at' => $updated_at, 'author' => $author));
            return true;
        } else {
            extract($update);
            $this->db->where('id', $id);
            $this->db->update('kegiatan_tb', array('judul' => $judul, 'isi' => $isi, 'created_at' => $created_at, 'updated_at' => $updated_at, 'author' => $author));
            return true;
        }
    }

    function _update_kegiatan_lampiran($update, $aksi = null)
    {
        if ($aksi != null) {
            extract($update);
            $this->db->where('id', $id);
            $this->db->update('lampiran_kegiatan_tb', array('id_kegiatan' => $id_kegiatan, 'isi' => $isi, 'foto' => $foto));
            return true;
        } else {
            extract($update);
            $this->db->where('id', $id);
            $this->db->update('lampiran_kegiatan_tb', array('id_kegiatan' => $id_kegiatan, 'isi' => $isi));
            return true;
        }
    }
}
