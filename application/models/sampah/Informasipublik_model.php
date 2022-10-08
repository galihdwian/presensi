<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of informasipublik_model
 *
 * @author IMAM_SYAIFULLOH
 */
class Informasipublik_model extends CI_Model
{

    function get_slide()
    {
        $this->db->select("heading,caption,gambar,background");
        $this->db->from("ip_slide");
        $this->db->order_by("sort_slide", "ASC");
        return $this->db->get()->result_array();
    }

    function get_klasifikasi()
    {
        $this->db->select("nama_ppid,keterangan,url_alias,icon");
        $this->db->from("ip_klasifikasi");
        $this->db->order_by("sorting", "ASC");
        return $this->db->get()->result_array();
    }

    function get_showklasifikasi($url_alias)
    {
        $this->db->select("nama_ppid,url_alias,penjelasan");
        $this->db->from("ip_klasifikasi");
        $this->db->where("url_alias", $url_alias);
        return $this->db->get()->result_array();
    }

    function get_countdataklasifikasi($url_alias, $statusdip, $key = NULL)
    {
        $this->db->select("d.id_dip,
                            s.id_sub,
                            s.isi_informasi,
                            s.url_page,
                            s.file_download,
                            s.tipe_view", FALSE);
        $this->db->from("ip_dip d", FALSE);
        $this->db->join("ip_sub s", "s.id_sub=d.id_sub", FALSE);
        $this->db->join("ip_klasifikasi k", "k.id_ppid=s.id_klasifikasi", FALSE);
        $this->db->where("d.aktif_dip", "T");
        $this->db->where("d.id_parent", "N");
        $this->db->where("k.show_dip", "T");
        $this->db->where("k.url_alias", $url_alias);
        $this->db->where("d.tahun_dip", $statusdip);
        if ($key != NULL) {
            //$this->db->like("s.judul_informasi", $key);
            $this->db->where("s.judul_informasi LIKE '%$key%' OR s.isi_informasi LIKE '%$key%'");
        }
        $this->db->order_by("k.sorting", "ASC");
        $this->db->order_by("s.sorting_informasi", "ASC");
        return $this->db->get()->num_rows();
    }

    function get_paginationklasifikasi($per_page, $page, $url_alias, $statusdip, $key = NULL)
    {
        $this->db->select("d.id_dip,
                            s.heading_dip,
                            s.id_sub,
                            s.judul_informasi,
                            s.url_page,
                            s.file_download,
                            s.tipe_view,
                            s.media,
                            s.slug,s.isi_informasi", FALSE);
        $this->db->from("ip_dip d", FALSE);
        $this->db->join("ip_sub s", "s.id_sub=d.id_sub", FALSE);
        $this->db->join("ip_klasifikasi k", "k.id_ppid=s.id_klasifikasi", FALSE);
        $this->db->where("d.aktif_dip", "T");
        $this->db->where("d.id_parent", "N");
        $this->db->where("k.show_dip", "T");
        $this->db->where("k.url_alias", $url_alias);
        $this->db->where("d.tahun_dip", $statusdip);
        if ($key != NULL) {
            //$this->db->like("s.judul_informasi", $key);
            $this->db->where("s.judul_informasi LIKE '%$key%' OR s.isi_informasi LIKE '%$key%'");
        }
        $this->db->order_by("k.sorting", "ASC");
        $this->db->order_by("s.sorting_informasi", "ASC");
        $this->db->limit($per_page, $page);
        $data = array();
        foreach ($this->db->get()->result() as $row) {
            $sub_file = NULL;
            if ($statusdip == '2016') {
                $sub_file = $this->get_ipsubfile($row->id_sub);
            } else {
                $sub_file = $this->get_sub_file_trans($row->id_sub);
            }
            $data[] = array(
                'id_sub' => $row->id_sub,
                'heading_dip' => $row->heading_dip,
                'judul_informasi' => $row->judul_informasi,
                'url_page' => $row->url_page,
                'file_download' => $row->file_download,
                'tipe_view' => $row->tipe_view,
                'media' => $row->media,
                'slug' => $row->slug,
                'isi_informasi' => $row->isi_informasi,
                // recursive
                'dip_child' => $this->get_klasifikasi_child($row->id_dip),
                'sub_file' => $sub_file
            );
        }
        return $data;
    }

    function get_klasifikasi_child($id_parent)
    {
        $this->db->select("s.judul_informasi,
                            s.heading_dip,
                            s.media,
                            s.url_page,
                            s.file_download,
                            s.tipe_view,
                            s.id_sub,
                            s.slug,", FALSE);
        $this->db->from("ip_dip d", FALSE);
        $this->db->join("ip_sub s", "s.id_sub=d.id_sub", FALSE);
        $this->db->join("ip_klasifikasi k", "k.id_ppid=s.id_klasifikasi", FALSE);
        $this->db->where("d.aktif_dip", "T");
        $this->db->where("d.id_parent", $id_parent);
        $this->db->where("k.show_dip", "T");
        $this->db->order_by("k.sorting", "ASC");
        $this->db->order_by("s.sorting_informasi", "ASC");
        $data = array();
        foreach ($this->db->get()->result() as $row) {
            $data[] = array(
                'id_sub' => $row->id_sub,
                'heading_dip' => $row->heading_dip,
                'judul_informasi' => $row->judul_informasi,
                'media' => $row->media,
                'url_page' => $row->url_page,
                'file_download' => $row->file_download,
                'tipe_view' => $row->tipe_view,
                'slug' => $row->slug,
                'sub_file' => $this->get_ipsubfile($row->id_sub)
            );
        }
        return $data;
    }

    function get_countsearch($key, $url_alias)
    {
        $this->db->select("s.id_sub", FALSE);
        $this->db->from("ip_sub s, ip_klasifikasi k", FALSE);
        $this->db->where("s.id_klasifikasi", "k.id_ppid", FALSE);
        $this->db->where("k.url_alias", $url_alias);
        $this->db->where("s.heading_dip", "F");
        $this->db->like("s.judul_informasi", $key);
        return $this->db->count_all_results();
    }

    function get_paginationsearch($per_page, $page, $url_alias, $key)
    {
        $this->db->select("s.id_sub,s.judul_informasi,s.tipe_view,s.url_page,s.file_download", FALSE);
        $this->db->from("ip_sub s, ip_klasifikasi k", FALSE);
        $this->db->where("s.id_klasifikasi", "k.id_ppid", FALSE);
        $this->db->where("k.url_alias", $url_alias);
        $this->db->where("s.heading_dip", "F");
        $this->db->like("s.judul_informasi", $key);
        $this->db->order_by("s.isi_informasi", "ASC");
        $this->db->limit($per_page, $page);
        return $this->db->get()->result_array();
    }

    function get_file($id_sub)
    {
        $this->db->select("isi_informasi,file_download");
        $this->db->from("ip_sub");
        $this->db->where("id_sub", $id_sub);
        $this->db->where("tipe_view", "FD");
        return $this->db->get()->result_array();
    }

    function get_dipstatus()
    {
        $this->db->select("tahun_dip");
        $this->db->from("ip_dipstatus");
        $this->db->where("status_dip", "T");
        $this->db->order_by("tahun_dip", "DESC");
        $this->db->limit(1);
        $th = "";
        foreach ($this->db->get()->result() as $row) :
            $th = $row->tahun_dip;
        endforeach;
        unset($row);
        return $th;
    }

    function get_dip($statusdip, $id_klasifikasi = NULL)
    {
        $this->db->select("k.nama_ppid,
                            k.url_alias AS urlaliasklasifikasi,
                            d.id_dip,
                            s.id_sub,
                            s.judul_informasi,
                            s.isi_informasi,
                            s.penanggung_jawab,
                            s.waktu_pembuatan,
                            s.jangka_waktu,
                            s.bentuk_informasi,
                            s.media,
                            s.url_page,
                            s.heading_dip,
                            s.file_download,
                            s.tipe_view,
                            s.dasar_hukum,
                            s.akibat_dibuka,
                            s.akibat_ditutup,
                            s.batas_waktu,
                            s.klasifikasi_heading", FALSE);
        $this->db->from("ip_dip d", FALSE);
        $this->db->join("ip_sub s", "s.id_sub=d.id_sub", FALSE);
        $this->db->join("ip_klasifikasi k", "k.id_ppid=s.id_klasifikasi", FALSE);
        $this->db->where("d.tahun_dip", $statusdip);
        $this->db->where("d.aktif_dip", "T");
        $this->db->where("d.id_parent", "N");
        $this->db->where("k.show_dip", "T");
        $this->db->where("s.stsdisplay", 1);
        if ($id_klasifikasi != NULL)
            $this->db->where("s.id_klasifikasi", "$id_klasifikasi");
        $this->db->order_by("k.sorting", "ASC");
        $this->db->order_by("s.sorting_informasi", "ASC");
        $data = array();
        foreach ($this->db->get()->result() as $row) {
            $data[] = array(
                'id_sub' => $row->id_sub,
                'nama_ppid' => $row->nama_ppid,
                'urlaliasklasifikasi' => $row->urlaliasklasifikasi,
                'judul_informasi' => $row->judul_informasi,
                'isi_informasi' => $row->isi_informasi,
                'penanggung_jawab' => $row->penanggung_jawab,
                'bentuk_informasi' => $row->bentuk_informasi,
                'waktu_pembuatan' => $row->waktu_pembuatan,
                'jangka_waktu' => $row->jangka_waktu,
                'media' => $row->media,
                'url_page' => $row->url_page,
                'heading_dip' => $row->heading_dip,
                'file_download' => $row->file_download,
                'tipe_view' => $row->tipe_view,
                'dasar_hukum' => $row->dasar_hukum,
                'akibat_dibuka' => $row->akibat_dibuka,
                'akibat_ditutup' => $row->akibat_ditutup,
                'batas_waktu' => $row->batas_waktu,
                'klasifikasi_heading' => $row->klasifikasi_heading,
                // recursive
                'dip_child' => $this->get_dip_child($row->id_dip, $statusdip)
            );
        }
        return $data;
    }

    function get_dip_child($id_parent, $statusdip)
    {
        $this->db->select("k.nama_ppid,
                            d.id_parent,
                            s.id_sub,
                            s.judul_informasi,
                            s.isi_informasi,
                            s.penanggung_jawab,
                            s.waktu_pembuatan,
                            s.bentuk_informasi,
                            s.jangka_waktu,
                            s.media,
                            s.url_page,
                            s.file_download,
                            s.tipe_view,
                            s.dasar_hukum,
                            s.akibat_dibuka,
                            s.akibat_ditutup,
                            s.batas_waktu,
                            s.klasifikasi_heading", FALSE);
        $this->db->from("ip_dip d", FALSE);
        $this->db->join("ip_sub s", "s.id_sub=d.id_sub", FALSE);
        $this->db->join("ip_klasifikasi k", "k.id_ppid=s.id_klasifikasi", FALSE);
        $this->db->where("d.tahun_dip", $statusdip);
        $this->db->where("d.aktif_dip", "T");
        $this->db->where("d.id_parent", $id_parent);
        $this->db->where("k.show_dip", "T");
        $this->db->order_by("k.sorting", "ASC");
        $this->db->order_by("s.sorting_informasi", "ASC");
        $data = array();
        foreach ($this->db->get()->result() as $row) {
            $data[] = array(
                'id_sub' => $row->id_sub,
                'nama_ppid' => $row->nama_ppid,
                'judul_informasi' => $row->judul_informasi,
                'isi_informasi' => $row->isi_informasi,
                'penanggung_jawab' => $row->penanggung_jawab,
                'bentuk_informasi' => $row->bentuk_informasi,
                'waktu_pembuatan' => $row->waktu_pembuatan,
                'jangka_waktu' => $row->jangka_waktu,
                'media' => $row->media,
                'url_page' => $row->url_page,
                'file_download' => $row->file_download,
                'tipe_view' => $row->tipe_view,
                'dasar_hukum' => $row->dasar_hukum,
                'akibat_dibuka' => $row->akibat_dibuka,
                'akibat_ditutup' => $row->akibat_ditutup,
                'batas_waktu' => $row->batas_waktu,
                'klasifikasi_heading' => $row->klasifikasi_heading
            );
        }
        return $data;
    }

    function get_kategori()
    {
        $this->db->where('displaytag', 1);
        $this->db->order_by('ordertag');
        $result = $this->db->get("ip_tag");
        $data = array();
        foreach ($result->result() as $row) {
            $data[] = array(
                'id_tag' => $row->id_tag,
                'name_tag' => $row->name_tag,
                'tag_child' => $this->get_tagchild($row->id_tag),
                'slug' => $row->slug
            );
        }
        unset($row);
        return $data;
    }

    function get_tagchild($id_tag)
    {
        $this->db->select("COUNT(DISTINCT(id_tagcontent)) as jml", FALSE);
        $this->db->from("ip_tag_content");
        $this->db->where("id_tag", $id_tag);
        $jml = 0;
        foreach ($this->db->get()->result() as $row) :
            $jml = $row->jml;
        endforeach;
        unset($row);
        return $jml;
    }

    function get_paginationkategori($per_page, $page, $url_alias)
    {
        $this->db->select("*");
        $this->db->from("ip_tag_content");
        $this->db->where("id_tag", $url_alias);
        $this->db->order_by("display_name");
        $this->db->limit($per_page, $page);
        return $this->db->get()->result_array();
    }

    function get_idtag($slug)
    {
        $this->db->select("id_tag");
        $this->db->from("ip_tag");
        $this->db->where("slug", $slug);
        $id_tag = "";
        foreach ($this->db->get()->result() as $row) :
            $id_tag = $row->id_tag;
        endforeach;
        unset($row);
        return $id_tag;
    }

    function get_countsearchbykategori($key, $tag_kategori)
    {
        $this->db->select("*");
        $this->db->from("ip_tag_content");
        $this->db->where("id_tag", $tag_kategori);
        $this->db->like("display_name", $key);
        return $this->db->count_all_results();
    }

    function get_paginationsearchbykategori($per_page, $page, $tag_kategori, $key)
    {
        $this->db->select("*");
        $this->db->from("ip_tag_content");
        $this->db->where("id_tag", $tag_kategori);
        $this->db->like("display_name", $key);
        $this->db->order_by("display_name");
        $this->db->limit($per_page, $page);
        return $this->db->get()->result_array();
    }

    function get_search($key, $typereq = 'PAGING', $per_page = NULL, $page = NULL)
    {
        $key = str_replace("%", " ", $key);
        $exkey = explode(" ", $key);
        #GET FROM DIP
        $this->db->select("s.id_sub as id,s.judul_informasi as display_name, s.tipe_view as tipe, slug, 'DIP' as typefile,s.isi_informasi as description,NULL as file", FALSE);
        $this->db->from("ip_sub s");
        $this->db->join("ip_dip d", "s.id_sub=d.id_sub");
        $this->db->join("ip_dipstatus t", "d.tahun_dip=t.tahun_dip");
        $this->db->where("t.status_dip", "T");
        $this->db->where("d.aktif_dip", "T");
        $this->db->where("s.id_klasifikasi !=", "4");
        if (count($exkey) > 1) {
            $strand = NULL;
            $stror = NULL;
            for ($i = 0; $i < count($exkey); $i++) :
                if ($i == 0) {
                    $strand .= "s.judul_informasi LIKE '%$exkey[$i]%'";
                    $stror .= "s.isi_informasi LIKE '%$exkey[$i]%'";
                } else {
                    $strand .= " AND s.judul_informasi LIKE '%$exkey[$i]%'";
                    $stror .= " AND s.isi_informasi LIKE '%$exkey[$i]%'";
                }
            endfor;
            $this->db->where("(($strand)OR($stror))", NULL, FALSE);
        } else {
            $this->db->where("((s.judul_informasi LIKE '%$key%')OR s.isi_informasi LIKE '%$key%')", NULL, FALSE);
        }
        $subqueries[1] = '(' . $this->db->get_compiled_select() . ')';
        #GET FROM FILE
        $this->db->select("f.id_file as id,f.display_name as display_name, f.tipe as tipe, slug,'FILE' as typefile,NULL as description,NULL as file", FALSE);
        $this->db->from("ip_sub_file f");
        $this->db->where("f.fileindex", "T");
        if (count($exkey) > 1) {
            $strand = NULL;
            $stror = NULL;
            for ($i = 0; $i < count($exkey); $i++) :
                if ($i == 0) {
                    $strand .= "f.display_name LIKE '%$exkey[$i]%'";
                    $stror .= "f.nama_file LIKE '%$exkey[$i]%'";
                } else {
                    $strand .= " AND f.display_name LIKE '%$exkey[$i]%'";
                    $stror .= " AND f.nama_file LIKE '%$exkey[$i]%'";
                }
            endfor;
            $this->db->where("(($strand)OR($stror))", NULL, FALSE);
        } else {
            $this->db->where("((f.display_name LIKE '%$key%')OR f.nama_file LIKE '%$key%')", NULL, FALSE);
        }
        $subqueries[2] = '(' . $this->db->get_compiled_select() . ')';
        #GET FROM TAG
        $this->db->select("t.id_tagcontent as id,t.display_name as display_name,CONCAT(UCASE(LEFT(t.tipe, 1)),SUBSTRING(t.tipe, 2)) as tipe,t.slug,'TAG' as typefile,NULL as description,file", FALSE);
        $this->db->from("ip_tag_content t");
        if (count($exkey) > 1) {
            $strand = NULL;
            $stror = NULL;
            for ($i = 0; $i < count($exkey); $i++) :
                if ($i == 0) {
                    $strand .= "t.display_name LIKE '%$exkey[$i]%'";
                    $stror .= "t.file LIKE '%$exkey[$i]%'";
                } else {
                    $strand .= " AND t.display_name LIKE '%$exkey[$i]%'";
                    $stror .= " AND t.file LIKE '%$exkey[$i]%'";
                }
            endfor;
            $this->db->where("(($strand)OR($stror))", NULL, FALSE);
        } else {
            $this->db->where("((t.display_name LIKE '%$key%')OR t.file LIKE '%$key%')", NULL, FALSE);
        }
        $subqueries[3] = '(' . $this->db->get_compiled_select() . ')';
        $sql = implode(' UNION ', $subqueries) . ' ORDER BY `typefile`, `display_name`';
        if ($typereq == 'PAGING') {
            $offset = $per_page * $page;
            $sql .= " LIMIT $per_page OFFSET $offset";
            return $this->db->query($sql)->result_array();
        } else {
            return $this->db->query($sql)->num_rows();
        }
    }

    function get_resetsearch_count()
    {
        $this->db->select("s.id_sub", FALSE);
        $this->db->from("ip_sub s, ip_klasifikasi k", FALSE);
        $this->db->where("s.id_klasifikasi", "k.id_ppid", FALSE);
        $this->db->where("s.heading_dip", "F");
        return $this->db->count_all_results();
    }

    function get_resetsearch($per_page, $page)
    {
        $this->db->select("s.id_sub,s.judul_informasi,s.tipe_view,s.url_page,s.file_download", FALSE);
        $this->db->from("ip_sub s, ip_klasifikasi k", FALSE);
        $this->db->where("s.id_klasifikasi", "k.id_ppid", FALSE);
        $this->db->where("s.heading_dip", "F");
        $this->db->order_by("s.judul_informasi", "ASC");
        $this->db->limit($per_page, $page);
        return $this->db->get()->result_array();
    }

    function get_sub_byid($id_sub)
    {
        $this->db->select("s.*,k.nama_ppid", FALSE);
        $this->db->from("ip_sub s,ip_klasifikasi k", FALSE);
        $this->db->where("s.id_sub", $id_sub);
        $this->db->where("s.id_klasifikasi", "k.id_ppid", FALSE);
        return $this->db->get()->result_array();
    }

    function get_subfilebyid($id_sub)
    {
        $this->db->select("*");
        $this->db->from("ip_sub_file");
        $this->db->where("id_sub", $id_sub);
        $this->db->order_by("sorting_data");
        return $this->db->get()->result_array();
    }

    function get_dikecualikan($statusdip)
    {
        $this->db->select("k.nama_ppid,
                            d.id_dip,
                            s.judul_informasi,
                            s.penanggung_jawab,
                            s.waktu_pembuatan,
                            s.isi_informasi,
                            s.bentuk_informasi,
                            s.jangka_waktu,
                            s.dasar_hukum,
                            s.akibat_dibuka,
                            s.akibat_ditutup,
                            s.batas_waktu,
                            s.heading_dip,
                            s.klasifikasi_heading", FALSE);
        $this->db->from("ip_dip d", FALSE);
        $this->db->join("ip_sub s", "s.id_sub=d.id_sub", FALSE);
        $this->db->join("ip_klasifikasi k", "k.id_ppid=s.id_klasifikasi", FALSE);
        $this->db->where("d.tahun_dip", $statusdip);
        $this->db->where("d.aktif_dip", "T");
        $this->db->where("d.id_parent", "N");
        $this->db->where("k.show_dip", "T");
        $this->db->where("s.id_klasifikasi", "4");
        $this->db->order_by("k.sorting", "ASC");
        $this->db->order_by("s.sorting_informasi", "ASC");
        $data = array();
        foreach ($this->db->get()->result() as $row) {
            $data[] = array(
                'judul_informasi' => $row->judul_informasi,
                'jangka_waktu' => $row->jangka_waktu,
                'bentuk_informasi' => $row->bentuk_informasi,
                'penanggung_jawab' => $row->penanggung_jawab,
                'waktu_pembuatan' => $row->waktu_pembuatan,
                'isi_informasi' => $row->isi_informasi,
                'dasar_hukum' => $row->dasar_hukum,
                'akibat_dibuka' => $row->akibat_dibuka,
                'akibat_ditutup' => $row->akibat_ditutup,
                'batas_waktu' => $row->batas_waktu,
                'heading_dip' => $row->heading_dip,
                'klasifikasi_heading' => $row->klasifikasi_heading,
                // recursive
                'dip_child' => $this->get_dikecualikan_child($row->id_dip, $statusdip)
            );
        }
        return $data;
    }

    function get_dikecualikan_child($id_parent, $statusdip)
    {
        $this->db->select("s.isi_informasi,
                            s.judul_informasi,
                            s.penanggung_jawab,
                            s.waktu_pembuatan,
                            s.bentuk_informasi,
                            s.jangka_waktu,
                            s.dasar_hukum,
                            s.akibat_dibuka,
                            s.akibat_ditutup,
                            s.batas_waktu,
                            s.heading_dip,
                            s.klasifikasi_heading", FALSE);
        $this->db->from("ip_dip d", FALSE);
        $this->db->join("ip_sub s", "s.id_sub=d.id_sub", FALSE);
        $this->db->join("ip_klasifikasi k", "k.id_ppid=s.id_klasifikasi", FALSE);
        $this->db->where("d.tahun_dip", $statusdip);
        $this->db->where("d.aktif_dip", "T");
        $this->db->where("d.id_parent", $id_parent);
        $this->db->where("k.show_dip", "T");
        $this->db->order_by("k.sorting", "ASC");
        $this->db->order_by("s.sorting_informasi", "ASC");
        $data = array();
        foreach ($this->db->get()->result() as $row) {
            $data[] = array(
                'judul_informasi' => $row->judul_informasi,
                'bentuk_informasi' => $row->bentuk_informasi,
                'jangka_waktu' => $row->jangka_waktu,
                'penanggung_jawab' => $row->penanggung_jawab,
                'waktu_pembuatan' => $row->waktu_pembuatan,
                'isi_informasi' => $row->isi_informasi,
                'dasar_hukum' => $row->dasar_hukum,
                'akibat_dibuka' => $row->akibat_dibuka,
                'akibat_ditutup' => $row->akibat_ditutup,
                'batas_waktu' => $row->batas_waktu,
                'heading_dip' => $row->heading_dip,
                'klasifikasi_heading' => $row->klasifikasi_heading
            );
        }
        return $data;
    }

    function count_jmlinf()
    {
        $this->db->select("COUNT(s.id_sub) as jml, k.nama_ppid", FALSE);
        $this->db->from("ip_sub s, ip_klasifikasi k", FALSE);
        $this->db->where("s.id_klasifikasi", "k.id_ppid", FALSE);
        $this->db->group_by("s.id_klasifikasi");
        return $this->db->get()->result_array();
    }

    function get_ipsubfile($id_sub)
    {
        $this->db->select("id_file,nama_file,display_name,tipe,slug");
        $this->db->from("ip_sub_file");
        $this->db->where("id_sub", $id_sub);
        $this->db->order_by("sorting_data");
        return $this->db->get()->result_array();
    }

    function get_subfile($id_file = NULL, $slug = NULL)
    {
        //return $this->db->get_where('ip_sub_file', array('id_file' => $id_file))->result_array();
        $this->db->select("f.nama_file,f.display_name,f.tipe, LOWER(REPLACE(k.nama_ppid,' ','')) as dir,page,LEFT(f.id_sub,1) as idlocation,f.keterangan,f.slug", FALSE);
        $this->db->from("ip_sub_file f");
        $this->db->join("ip_sub s", "f.id_sub = s.id_sub", "LEFT");
        $this->db->join("ip_klasifikasi k", "s.id_klasifikasi = k.id_ppid", "LEFT");
        if ($slug == NULL && $id_file != NULL)
            $this->db->where("f.id_file", $id_file);
        if ($slug != NULL && $id_file == NULL)
            $this->db->where("f.slug", $slug);
        return $this->db->get()->row();
    }

    function get_file_content($id_file)
    {
        $this->db->select("f.nama_file,f.page,k.nama_ppid,f.tipe", FALSE);
        $this->db->from("ip_sub_file f, ip_sub s, ip_klasifikasi k", FALSE);
        $this->db->where("f.id_sub", "s.id_sub", FALSE);
        $this->db->where("s.id_klasifikasi", "k.id_ppid", FALSE);
        $this->db->where("f.id_file", $id_file);
        $this->db->order_by("f.sorting_data");
        return $this->db->get()->result_array();
    }

    function get_tagfile($id_tagcontent)
    {
        return $this->db->get_where("ip_tag_content", array("slug" => $id_tagcontent))->row();
    }

    function get_file_specific($id_file)
    {
        $this->db->where("id_file", $id_file);
        return $this->db->get('ip_sub_file')->row();
    }

    function get_detaildata_file($id)
    {
        $this->db->select('f.nama_file,f.display_name,f.tahun_file,f.page,LEFT(f.id_sub,1) as idsub');
        $this->db->where('f.id_file', $id);
        return $this->db->get('ip_sub_file f')->row();
    }

    function get_dir($id)
    {
        $this->db->select("LOWER(REPLACE(nama_ppid,' ','')) as dir");
        $this->db->where("id_ppid", $id);
        $row = $this->db->get('ip_klasifikasi')->row();
        if ($row) {
            return $row->dir;
        } else {
            return NULL;
        }
    }

    function get_sub_byslug($slug)
    {
        $this->db->select("s.*,k.nama_ppid", FALSE);
        $this->db->from("ip_klasifikasi k,ip_sub s", FALSE);
        $this->db->join("ip_dip d", "s.id_sub=d.id_sub");
        $this->db->join("ip_dipstatus t", "d.tahun_dip=t.tahun_dip AND t.status_dip='T'");
        $this->db->where("s.slug", $slug);
        $this->db->where("s.id_klasifikasi", "k.id_ppid", FALSE);
        return $this->db->get()->result_array();
    }

    function get_idsub_byslug($slug)
    {
        $this->db->select("s.id_sub");
        $this->db->from("ip_sub s");
        $this->db->join("ip_dip d", "s.id_sub=d.id_sub");
        $this->db->join("ip_dipstatus t", "d.tahun_dip=t.tahun_dip AND t.status_dip='T'");
        $this->db->where("s.slug", $slug);
        return $this->db->get()->row()->id_sub;
    }

    function get_all($table)
    {
        return $this->db->get($table)->result();
    }

    function count_slug($slug, $table)
    {
        return $this->db->get_where($table, array('slug' => $slug))->num_rows();
    }

    function update_data($table, $field, $id, $data)
    {
        $this->db->where($field, $id);
        $this->db->update($table, $data);
    }

    function get_slug_sub($id_sub)
    {
        $this->db->select('slug');
        $this->db->where('id_sub', $id_sub);
        return $this->db->get('ip_sub')->row()->slug;
    }

    function get_sub_file_trans($id_sub)
    {
        $this->db->select("f.*");
        $this->db->from("ip_sub_file_trans t, ip_sub_file f");
        $this->db->where("t.id_sub", $id_sub);
        $this->db->where("t.id_file", "f.id_file", FALSE);
        $this->db->order_by("f.display_name");
        return $this->db->get()->result_array();
    }

    public function get_tahun_dip_aktif()
    {
        $this->db->select('tahun_dip')
            ->from('ip_dipstatus')
            ->where('status_dip', 'T');
        $get_status_dip = $this->db->get()->row();
        $tahun_aktif = date('Y');
        if (!empty($get_status_dip->tahun_dip)) {
            $tahun_aktif = $get_status_dip->tahun_dip;
        }
        return $tahun_aktif;
    }
    public function get_rekap_permohonan($tahun_aktif)
    {
        $this->db->select('*')
            ->from('ip_rekapitulasi_permohonan_informasi')
            ->where('tahun', $tahun_aktif)
            ->order_by('bulan', 'ASC');
        return $this->db->get()->result();
    }
}
