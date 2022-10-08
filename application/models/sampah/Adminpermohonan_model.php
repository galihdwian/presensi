<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Adminpermohonan_model
 * @author CAHSIM
 */
class Adminpermohonan_model extends CI_Model
{

    function get_user_list()
    {
        $this->db->select("*");
        $this->db->order_by("full_name");
        return $this->db->get("ip_pemohon")->result_array();
    }

    function get_user_detail($key)
    {
        $this->db->where("id_pemohon", $key);
        return $this->db->get("ip_pemohon")->result_array();
    }

    function get_lokasi($id_pemohon, $lokasi)
    {
        $this->db->select("l.lokasi_nama");
        $this->db->from("ip_pemohon p");
        $this->db->join("ip_master_lokasi l", "p.provinsi=l.lokasi_propinsi", "LEFT");
        $this->db->where("p.id_pemohon", $id_pemohon);
        if ($lokasi == 'PROV') {
            $this->db->where("l.lokasi_kabupatenkota", "0");
        } elseif ($lokasi == "KAB") {
            $this->db->where("l.lokasi_kabupatenkota", "p.kabupaten_kota", FALSE);
            $this->db->where("l.lokasi_kecamatan", "0");
        }
        $row = $this->db->get()->row();
        if ($row)
            return $row->lokasi_nama;
        else
            return null;
    }

    function get_permohonan_list()
    {
        $this->db->select("o.id_permohonan,o.informasi_diminta, o.tgl_permohonan,o.tgl_dikonfirmasi,o.keputusan_permohonan,p.full_name");
        $this->db->from("ip_permohonan_online o, ip_pemohon p");
        $this->db->where("o.id_user", "p.id_pemohon", FALSE);
        $this->db->order_by("o.tgl_permohonan", "DESC");
        return $this->db->get()->result_array();
    }

    function get_permohonan_detail($id_permohonan)
    {
        $this->db->select("o.*,p.full_name,p.id_pemohon");
        $this->db->from("ip_permohonan_online o, ip_pemohon p");
        $this->db->where("o.id_user", "p.id_pemohon", FALSE);
        $this->db->where("o.id_permohonan", $id_permohonan);
        return $this->db->get()->row();
    }

    function get_permohonan_konfirmasi($id_permohonan)
    {
        return $this->db->get_where('ip_permohonan_online_konfirmasi', array('id_permohonan' => $id_permohonan))->row();
    }

    function save_permohonan_konfirmasi($save)
    {
        $this->db->insert('ip_permohonan_online_konfirmasi', $save);
    }

    function update_permohonan($id_permohonan, $update)
    {
        $this->db->where("id_permohonan", $id_permohonan);
        $this->db->update('ip_permohonan_online', $update);
    }

    function get_pemohon_email_by_laporan($id_permohonan)
    {
        $this->db->select("p.email");
        $this->db->from("ip_permohonan_online o, ip_pemohon p");
        $this->db->where("o.id_user", "p.id_pemohon", FALSE);
        $this->db->where("o.id_permohonan", $id_permohonan);
        return $this->db->get()->row()->email;
    }

    function save_permohonan_keputusan($save)
    {
        $this->db->insert('ip_permohonan_online_keputusan', $save);
    }

    function get_permohonan_keputusan($id_permohonan)
    {
        return $this->db->get_where('ip_permohonan_online_keputusan', array('id_permohonan' => $id_permohonan))->row();
    }

    function get_keberatan_list()
    {
        $this->db->select("k.id_keberatan,p.full_name,o.informasi_diminta,k.tanggal,k.verifikasi");
        $this->db->from("ip_permohonan_keberatan k, ip_permohonan_online o, ip_pemohon p");
        $this->db->where("k.id_permohonan", "o.id_permohonan", FALSE);
        $this->db->where("o.id_user", "p.id_pemohon", FALSE);
        $this->db->order_by("tanggal", "DESC");
        return $this->db->get()->result_array();
    }

    function get_keberatan_detail($id_keberatan)
    {
        $this->db->select("k.*,p.full_name,o.informasi_diminta");
        $this->db->from("ip_permohonan_keberatan k, ip_permohonan_online o, ip_pemohon p");
        $this->db->where("k.id_permohonan", "o.id_permohonan", FALSE);
        $this->db->where("o.id_user", "p.id_pemohon", FALSE);
        $this->db->where("k.id_keberatan", $id_keberatan);
        $this->db->order_by("tanggal", "DESC");
        return $this->db->get()->row();
    }

    function save_keberatan_tanggapan($save)
    {
        $this->db->insert('ip_permohonan_keberatan_tanggapan', $save);
    }

    function update_keberatan($id_keberatan, $update)
    {
        $this->db->where("id_keberatan", $id_keberatan);
        $this->db->update('ip_permohonan_keberatan', $update);
    }

    function get_pemohon_email_keberatan($id_keberatan)
    {
        $this->db->select("p.email");
        $this->db->from("ip_permohonan_keberatan k, ip_permohonan_online o, ip_pemohon p");
        $this->db->where("k.id_permohonan", "o.id_permohonan", FALSE);
        $this->db->where("o.id_user", "p.id_pemohon", FALSE);
        $this->db->where("k.id_keberatan", $id_keberatan);
        return $this->db->get()->row()->email;
    }

    function get_keberatan_tanggapan($id_keberatan)
    {
        return $this->db->get_where('ip_permohonan_keberatan_tanggapan', array('id_keberatan' => $id_keberatan))->row();
    }

    function get_list_statistik_permohonan_datatables()
    {
        $this->datatables->select("id_rekapitulasi,tahun,bulan,permohonan_medsos_diterima,permohonan_medsos_disetujui,"
            . "permohonan_langsung_diterima,permohonan_langsung_disetujui,date_update")
            ->from('ip_rekapitulasi_permohonan_informasi')
            ->add_column(
                'view',
                '<a href="' . site_url('adminpermohonan/statistik/edit/$1') . '" class="btn btn-warning btn-sm mr-5">Edit</a>',
                'id_rekapitulasi'
            );
        return $this->datatables->generate();
    }
}
