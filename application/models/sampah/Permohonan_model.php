<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Permohonan_model
 *
 * @author IMAM_SYAIFULLOH
 */
class Permohonan_model extends CI_Model {

    //put your code here

    function get_provinsi() {
        $this->db->select("lokasi_kode,lokasi_nama,lokasi_propinsi");
        $this->db->from("ip_master_lokasi");
        $this->db->where("lokasi_kabupatenkota", "0");
        $this->db->where("lokasi_kecamatan", "0");
        $this->db->where("lokasi_kelurahan", "0");
        $this->db->order_by("lokasi_nama");
        return $this->db->get()->result_array();
    }

    function get_kabupaten($lokasi_propinsi) {
        $this->db->select("lokasi_kode,lokasi_nama,lokasi_propinsi,lokasi_kabupatenkota");
        $this->db->from("ip_master_lokasi");
        $this->db->where("lokasi_propinsi", $lokasi_propinsi);
        $this->db->where("lokasi_kabupatenkota !=", "0");
        $this->db->where("lokasi_kecamatan", "0");
        $this->db->where("lokasi_kelurahan", "0");
        $this->db->order_by("lokasi_nama");
        return $this->db->get()->result_array();
    }

    function count_radomstring($randomstring) {
        $this->db->select("id_pemohon");
        $this->db->from("ip_pemohon");
        $this->db->like("id_pemohon", $randomstring);
        return $this->db->count_all_results();
    }

    function save($table, $save) {
        $this->db->insert($table, $save);
    }

    function get_Userpemohon($user, $password) {
        $user1 = $user;
        $pass1 = $password;
        $a = md5($pass1);
        $this->db->select("full_name,pwd,id_pemohon,active,foto");
        $this->db->from("ip_pemohon");
        $this->db->where("email", $user1);
        $data = array();
        foreach ($this->db->get()->result_array() as $row):
            if ($row['pwd'] == $a) {
                $data['full_name'] = $row['full_name'];
                $data['id_pemohon'] = $row['id_pemohon'];
                $data['active'] = $row['active'];
                $data['foto'] = $row['foto'];
                break;
            }
        endforeach;
        return $data;
    }

    function count_radomstring_ippermohonan($randomstring) {
        $this->db->select("id_permohonan");
        $this->db->from("ip_permohonan_online");
        $this->db->like("id_permohonan", $randomstring);
        return $this->db->count_all_results();
    }

    function get_permohonan_ol($id_user) {
        $this->db->select("id_permohonan,informasi_diminta,tgl_permohonan,tgl_dikonfirmasi,keputusan_permohonan");
        $this->db->from("ip_permohonan_online");
        $this->db->where("id_user", $id_user);
        $this->db->order_by("tgl_permohonan", "ASC");
        return $this->db->get()->result_array();
    }

    function get_detail_permohonan_ol($id_permohonan) {
        $this->db->select("p.id_permohonan,
	p.id_user,
	p.informasi_diminta,
	p.kandungan_isi,
	p.tujuan_permohoan,
	p.bentuk_inf,
	p.tgl_permohonan,
	p.tgl_dikonfirmasi,
	p.user_konfirm,
	p.keputusan_permohonan,
	p.alasan_penolakan,
	p.tgl_keputusan,
	p.user_keputusan,
	e.pesan_keputusan,
	e.jenis_keputusan,
	k.pesan_konfirmasi");
        $this->db->from("ip_permohonan_online p");
        $this->db->join("ip_permohonan_online_konfirmasi k", "p.id_permohonan=k.id_permohonan", "LEFT");
        $this->db->join("ip_permohonan_online_keputusan e", "p.id_permohonan=e.id_permohonan", "LEFT");
        $this->db->where("p.id_permohonan", $id_permohonan);
        return $this->db->get()->result_array();
    }

    function get_statistikdata($year) {
        $this->db->select("MONTH(tgl_permohonan) bulan,
                        COUNT(id_permohonan) jumlah,
                        SUM(CASE WHEN keputusan='DISETUJUI' THEN 1 ELSE 0 END) disetujui,
                        SUM(CASE WHEN keputusan='DITOLAK' THEN 1 ELSE 0 END) ditolak", FALSE);
        $this->db->from("ip_permohonan_intern");
        $this->db->where("YEAR(tgl_permohonan)", $year);
        $this->db->group_by("MONTH(tgl_permohonan)");
        return $this->db->get()->result_array();
    }

    function get_statistikdata_rekap($year) {
        $this->db->select("COUNT(id_permohonan) jumlah,
                        SUM(CASE WHEN keputusan='DISETUJUI' THEN 1 ELSE 0 END) disetujui,
                        SUM(CASE WHEN keputusan='DITOLAK' THEN 1 ELSE 0 END) ditolak", FALSE);
        $this->db->from("ip_permohonan_intern");
        $this->db->where("YEAR(tgl_permohonan)", $year);
        return $this->db->get()->result_array();
    }

    function count_keberatan() {
        $this->db->select("id_keberatan");
        $this->db->from("ip_permohonan_keberatan");
        $this->db->where("DATE(tanggal)", date('Y-m-d'));
        $this->db->count_all_results();
    }

    function get_keberatan($id_pemohon) {
        $this->db->select("k.id_keberatan,o.informasi_diminta,k.tanggal");
        $this->db->from("ip_permohonan_online o, ip_permohonan_keberatan k");
        $this->db->where("id_user", $id_pemohon);
        $this->db->where("o.id_permohonan", "k.id_permohonan", FALSE);
        return $this->db->get()->result_array();
    }

    function get_detail_keberatan($id_keberatan, $id_user) {
        $this->db->select("k.id_keberatan,o.informasi_diminta,o.tujuan_permohoan,p.full_name,p.alamat,p.pekerjaan,p.telp,k.id_permohonan,k.ditolak,k.tdk_disediakan,k.tdk_ditanggapi,k.tdk_sesuaipermintaan,k.tdk_dipenuhi,k.tdk_wajar,k.overtime,k.kasus,k.kuasa_nama,k.kuasa_telp,k.kuasa_alamat,k.tanggal,k.verifikasi,k.tanggal_tanggapan", FALSE);
        $this->db->from("ip_permohonan_online o,ip_permohonan_keberatan k, ip_pemohon p", FALSE);
        $this->db->where("k.id_keberatan", $id_keberatan);
        $this->db->where("o.id_user", $id_user);
        $this->db->where("o.id_permohonan", "k.id_permohonan", FALSE);
        $this->db->where("o.id_user", "p.id_pemohon", FALSE);
        return $this->db->get()->result_array();
    }

    function get_pemohon($id_pemohon) {
        $this->db->select("full_name,tanda_pengenal,nomor_identitas,jk,tempat_lahir,tgl_lahir,telp,pekerjaan,alamat,kode_pos,provinsi,kabupaten_kota,email");
        $this->db->from("ip_pemohon");
        $this->db->where("id_pemohon", $id_pemohon);
        $d = NULL;
        foreach ($this->db->get()->result_array() as $r) {
            $d[] = array(
                "full_name" => $r['full_name'],
                "tanda_pengenal" => $r['tanda_pengenal'],
                "nomor_identitas" => $r['nomor_identitas'],
                "jk" => $r['jk'],
                "tempat_lahir" => $r['tempat_lahir'],
                "tgl_lahir" => $r['tgl_lahir'],
                "telp" => $r['telp'],
                "pekerjaan" => $r['pekerjaan'],
                "alamat" => $r['alamat'],
                "kode_pos" => $r['kode_pos'],
                "provinsi" => $this->get_namapropinsi($r['provinsi']),
                "kabupaten_kota" => $this->get_namakabupaten($r['provinsi'], $r['kabupaten_kota']),
                "email" => $r['email']
            );
        }
        unset($r);
        return $d;
    }

    function get_namapropinsi($lokasi_propinsi) {
        $this->db->select('lokasi_nama as provinsi');
        $this->db->from("ip_master_lokasi");
        $this->db->where("lokasi_propinsi", $lokasi_propinsi);
        $this->db->where("lokasi_kabupatenkota", "0");
        $p = NULL;
        foreach ($this->db->get()->result_array()as $r) {
            $p = $r['provinsi'];
        }
        unset($r);
        return $p;
    }

    function get_namakabupaten($lokasi_propinsi, $lokasi_kabupatenkota) {
        $this->db->select('lokasi_nama as kabupaten');
        $this->db->from("ip_master_lokasi");
        $this->db->where("lokasi_propinsi", $lokasi_propinsi);
        $this->db->where("lokasi_kabupatenkota", $lokasi_kabupatenkota);
        $this->db->where("lokasi_kecamatan", "0");
        $k = NULL;
        foreach ($this->db->get()->result_array()as $r) {
            $k = $r['kabupaten'];
        }
        unset($r);
        return $k;
    }

    function count_userbyid($id_pemohon) {
        $this->db->from("ip_pemohon");
        $this->db->where("id_pemohon", $id_pemohon);
        $this->db->where("active !=", "T");
        return $this->db->count_all_results();
    }

    function set_activepemohon($realtext, $update) {
        $this->db->where('id_pemohon', $realtext);
        $this->db->update('ip_pemohon', $update);
    }

    function getPemohonByIdPermohonan($idPermohonan) {
        $this->db->select('p.*')
                ->from('ip_permohonan_online o')
                ->join('ip_pemohon p', 'o.id_user=p.id_pemohon')
                ->where('o.id_permohonan', $idPermohonan);
        $result = $this->db->get()->result_array();
        if (!empty($result)) {
            return $result[0];
        } else {
            return $result;
        }
    }

    function count_permohonan_tahunan($year) {
        $this->db->select('COUNT(id_permohonan) AS jumlahpermohonan')
                ->from('ip_permohonan_online')
                ->where('YEAR(tgl_permohonan)', $year);
        $row = $this->db->get()->row();
        if (!empty($row))
            return $row->jumlahpermohonan;
        else
            return 0;
    }

    function count_pemohon() {
        $this->db->select('COUNT(id_pemohon) AS jumlahpemohon')
                ->from('ip_pemohon');
        $row = $this->db->get()->row();
        if (!empty($row))
            return $row->jumlahpemohon;
        else
            return 0;
    }

    function count_permohonan() {
        $this->db->select('COUNT(id_permohonan) AS jumlah')
                ->from('ip_permohonan_online');
        $row = $this->db->get()->row();
        if (!empty($row))
            return $row->jumlah;
        else
            return 0;
    }

    function count_kode_akses_permohonan($kode_akses) {
        $this->db->select('COUNT(id_permohonan) AS jumlah')
                ->from('ip_permohonan_online')
                ->where('kode_akses', $kode_akses);
        $row = $this->db->get()->row();
        if (!empty($row))
            return $row->jumlah;
        else
            return 0;
    }

    function get_permohonan_by_kode_akses($kode_akses) {
        $this->db->select('o.*,p.*,b.nama_bentuk_informasi')
                ->from('ip_permohonan_online o')
                ->join('ip_pemohon p', 'o.id_user=p.id_pemohon')
                ->join('ip_permohonan_bentuk_informasi b', 'o.bentuk_inf=b.bentuk_inf', 'LEFT')
                ->where('o.kode_akses', $kode_akses);
        return $this->db->get()->row();
    }

    function count_keberatan_akumulasi() {
        $this->db->select('COUNT(id_keberatan) AS jumlah')
                ->from('ip_permohonan_keberatan');
        $row = $this->db->get()->row();
        if (!empty($row))
            return $row->jumlah;
        else
            return 0;
    }

    function count_kode_akses_keberatan($kode_akses) {
        $this->db->select('COUNT(id_keberatan) AS jumlah')
                ->from('ip_permohonan_keberatan')
                ->where('kode_akses', $kode_akses);
        $row = $this->db->get()->row();
        if (!empty($row))
            return $row->jumlah;
        else
            return 0;
    }

    function get_keberatan_by_kode_akses($kode_akses) {
        $this->db->select('o.*,p.*')
                ->from('ip_permohonan_keberatan o')
                ->join('ip_pemohon p', 'o.id_user=p.id_pemohon')
                ->where('o.kode_akses', $kode_akses);
        return $this->db->get()->row();
    }

    function get_pemohon_nomor_identitas_member($nomor_identitas) {
        $this->db->select('*')
                ->from('ip_pemohon')
                ->where('nomor_identitas', $nomor_identitas)
                ->where('tipe_pemohon', 'MEMBER');
        return $this->db->get()->result();;
    }

}

?>
