<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of informasipublikadmin_model
 *
 * @author Imam Syaifulloh
 */
class Informasipublikadmin_model extends CI_Model
{

    function get_dipstatus()
    {
        $this->db->from("ip_dipstatus");
        $this->db->order_by('tahun_dip');
        return $this->db->get()->result_array();
    }

    function get_maxtahundip()
    {
        $this->db->select("tahun_dip");
        $this->db->from("ip_dipstatus");
        $this->db->order_by("tahun_dip", "DESC");
        $this->db->limit("1");
        $th = "";
        foreach ($this->db->get()->result_array() as $row) :
            $th = $row['tahun_dip'];
        endforeach;
        unset($row);
        return $th;
    }

    function get_dipstatusdetail($tahun_dip)
    {
        $this->db->from("ip_dipstatus");
        $this->db->where("tahun_dip", $tahun_dip);
        $this->db->order_by('tahun_dip');
        return $this->db->get()->result_array();
    }

    function update_dipstatus($save, $tahun_dip)
    {
        $this->db->where("tahun_dip", $tahun_dip);
        $this->db->update("ip_dipstatus", $save);
    }

    function get_dip($tahun_dip = null, $id_parent = 'N')
    {
        $this->db->select("k.nama_ppid,d.id_dip,s.id_sub,s.judul_informasi,s.isi_informasi,s.penanggung_jawab,s.waktu_pembuatan,
                            s.jangka_waktu,s.bentuk_informasi,s.media,s.url_page,s.heading_dip,s.file_download,s.tipe_view,d.tahun_dip,
                            s.dasar_hukum,s.akibat_dibuka,s.akibat_ditutup,s.batas_waktu", FALSE);
        $this->db->from("ip_dip d", FALSE);
        $this->db->join("ip_sub s", "s.id_sub=d.id_sub", FALSE);
        $this->db->join("ip_dipstatus t", "d.tahun_dip=t.tahun_dip", FALSE);
        $this->db->join("ip_klasifikasi k", "k.id_ppid=s.id_klasifikasi", FALSE);
        $this->db->where("d.aktif_dip", "T");
        $this->db->where("d.id_parent", $id_parent);
        $this->db->where("k.show_dip", "T");
        if ($tahun_dip == null) {
            $this->db->where("t.status_dip", "T");
        } else {
            $this->db->where("t.tahun_dip", $tahun_dip);
        }
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
                'heading_dip' => $row->heading_dip,
                'file_download' => $row->file_download,
                'tipe_view' => $row->tipe_view,
                'tahun_dip' => $row->tahun_dip,
                'dasar_hukum' => $row->dasar_hukum,
                'akibat_dibuka' => $row->akibat_dibuka,
                'akibat_ditutup' => $row->akibat_ditutup,
                'batas_waktu' => $row->batas_waktu,
                // recursive
                'dip_child' => $this->get_dip($tahun_dip, $row->id_dip)
            );
        }
        return $data;
    }

    function get_klasifikasi()
    {
        $this->db->select("id_ppid,nama_ppid");
        $this->db->from("ip_klasifikasi");
        $this->db->order_by("sorting", "ASC");
        return $this->db->get()->result_array();
    }

    function get_thdip()
    {
        $this->db->select("tahun_dip");
        $this->db->from("ip_dipstatus");
        $this->db->order_by("tahun_dip", "ASC");
        return $this->db->get()->result_array();
    }

    function get_table($table)
    {
        return $this->db->get($table)->result_array();
    }

    function count_parentdip()
    {
        $this->db->from("ip_dip");
        $this->db->where("id_parent", "N");
        return $this->db->count_all_results();
    }

    function save_data($table, $set)
    {
        $this->db->insert($table, $set);
    }

    function get_dip_asparent($id_sub)
    {
        $this->db->select("s.id_sub,s.judul_informasi,k.id_ppid,k.nama_ppid,d.id_dip,d.tahun_dip");
        $this->db->from("ip_sub s");
        $this->db->join("ip_klasifikasi k", "k.id_ppid=s.id_klasifikasi");
        $this->db->join("ip_dip d", "d.id_sub=s.id_sub");
        $this->db->where("s.id_sub", $id_sub);
        return $this->db->get()->row();
    }

    function count_child($id_parent)
    {
        $this->db->from("ip_dip");
        $this->db->where("id_parent", $id_parent);
        return $this->db->count_all_results();
    }

    function delete_data($table, $key, $value)
    {
        $this->db->where($key, $value);
        $this->db->delete($table);
    }

    function get_alldata($table)
    {
        return $this->db->get($table)->result_array();
    }

    function get_klasifikasidetail($id_ppid)
    {
        $this->db->from("ip_klasifikasi");
        $this->db->where("id_ppid", $id_ppid);
        return $this->db->get()->result_array();
    }

    function update_data($table, $key, $value, $set)
    {
        $this->db->where($key, $value);
        $this->db->update($table, $set);
    }

    function count_iddip($id_dip)
    {
        $this->db->from("ip_dip");
        $this->db->where("LEFT(id_dip,8)", $id_dip, FALSE);
        return $this->db->count_all_results();
    }

    function get_sortingheading()
    {
        $this->db->select("max(s.sorting_informasi) as maxsort", FALSE);
        $this->db->from("ip_sub s", FALSE);
        $this->db->join("ip_dip d", "s.id_sub=d.id_sub", FALSE);
        $this->db->where("d.id_parent", "N");
        $maxsort = 0;
        foreach ($this->db->get()->result_array() as $row) :
            $maxsort = $row['maxsort'];
        endforeach;
        return ($maxsort);
    }

    function get_sortingchild()
    {
        $this->db->select("max(s.sorting_informasi) as maxsort", FALSE);
        $this->db->from("ip_sub s", FALSE);
        $this->db->join("ip_dip d", "s.id_sub=d.id_sub", FALSE);
        $this->db->where("d.id_parent !=", "N");
        $maxsort = 0;
        foreach ($this->db->get()->result_array() as $row) :
            $maxsort = $row['maxsort'];
        endforeach;
        return ($maxsort);
    }

    function get_aliasgroupfile()
    {
        $this->db->select("DISTINCT(alias_group)");
        $this->db->from("ip_sub_file");
        $this->db->order_by("alias_group");
        return $this->db->get()->result_array();
    }

    function count_idsubfile($match)
    {
        $this->db->select('id_file');
        $this->db->from('ip_sub_file');
        $this->db->like('id_file', $match);
        return $this->db->count_all_results();
    }

    function count_insertbydate($date)
    {
        $this->db->select("id_sub");
        $this->db->from("ip_sub");
        $this->db->where("date_upload", $date);
        return $this->db->count_all_results();
    }

    function get_max_id_sub($prefix_id_sub)
    {
        $this->db->select('MAX(CAST(SUBSTRING(id_sub, 8, LENGTH(id_sub)) AS UNSIGNED)) AS MAXVALUES')
            ->from('ip_sub')
            ->like('id_sub', $prefix_id_sub);
        $row = $this->db->get()->row();
        $max_value = !empty($row->MAXVALUES) ? ($row->MAXVALUES != null ? $row->MAXVALUES : 0) : 0;
        return $max_value;
    }

    function get_max_id_dip($prefix_id_dip)
    {
        $this->db->select('MAX(CAST(SUBSTRING(id_dip, 8, LENGTH(id_dip)) AS UNSIGNED)) AS MAXVALUES')
            ->from('ip_dip')
            ->like('id_dip', $prefix_id_dip);
        $row = $this->db->get()->row();
        $max_value = !empty($row->MAXVALUES) ? ($row->MAXVALUES != null ? $row->MAXVALUES : 0) : 0;
        return $max_value;
    }

    function check_judul_informasi_exist($judul_informasi, $id_klasifikasi, $tahun_dip)
    {
        $this->db->select('id_sub')
            ->from('ip_sub')
            ->where('judul_informasi', $judul_informasi)
            ->where('id_klasifikasi', $id_klasifikasi)
            ->like('id_sub', '_' . $tahun_dip . '_');
        $result = $this->db->get()->num_rows();
        return $result;
    }

    function count_child_by_idsub($id_sub)
    {
        $this->db->select('COUNT(i.id_dip) AS jmlchild')
            ->from('ip_sub s,ip_dip d')
            ->join('ip_dip i', 'd.id_dip=i.id_parent', 'LEFT')
            ->where('s.id_sub', $id_sub)
            ->where('s.id_sub=d.id_sub', null, false);
        $row = $this->db->get()->row();
        $jmlchild = !empty($row->jmlchild) ? ($row->jmlchild != null ? $row->jmlchild : 0) : 0;
        return $jmlchild;
    }

    function get_parent_child($id_sub)
    {
        $this->db->select('b.id_sub,b.judul_informasi,d.tahun_dip,i.id_dip,s.id_klasifikasi')
            ->from('ip_sub s, ip_dip d,ip_dip i,ip_sub b')
            ->where('s.id_sub=d.id_sub', null, false)
            ->where('d.id_parent=i.id_dip', null, false)
            ->where('i.id_sub=b.id_sub', null, false)
            ->where('s.id_sub', $id_sub);
        $row = $this->db->get()->row();
        return $row;
    }

    function get_list_parent($tahun_dip)
    {
        $this->db->select('d.id_dip,s.id_sub,s.judul_informasi,k.nama_ppid')
            ->from('ip_dip d,ip_sub s,ip_klasifikasi k')
            ->where('d.id_parent', 'N')
            ->where('d.tahun_dip', $tahun_dip)
            ->where('d.id_sub=s.id_sub', null, false)
            ->where('s.id_klasifikasi=k.id_ppid', null, false)
            ->where_in('s.id_klasifikasi', array('1', '3'))
            ->order_by('s.id_klasifikasi', 'ASC')
            ->order_by('s.sorting_informasi', 'ASC');
        $result = $this->db->get()->result();
        return $result;
    }

    function set_idklasifkasi_child_same_parent($id_sub, $id_klasifikasi)
    {
        $sql = 'UPDATE ip_su SET id_klasifikasi = ? '
            . 'WHERE id_sub IN ('
            . 'SELECT i.id_sub '
            . 'FROM ip_sub s,ip_dip d '
            . 'LEFT JOIN ip_dip i ON d.id_dip=i.id_parent '
            . 'WHERE s.id_sub=? '
            . 'AND s.id_sub=d.id_sub'
            . ')';
        $this->db->query($sql, array($id_klasifikasi, $id_sub));
    }

    function get_list_files($id_sub)
    {
        $this->db->select('f.id_file,f.nama_file,f.display_name,f.slug,t.sort_display,t.id_sub')
            ->from('ip_sub_file_trans t, ip_sub_file f')
            ->where('t.id_sub', $id_sub)
            ->where('t.id_file=f.id_file', null, false)
            ->order_by('t.sort_display', 'ASC')
            ->order_by('f.display_name', 'ASC');
        $result = $this->db->get()->result();
        return $result;
    }

    function get_list_filesub($keyword, $id_file_in = array(), $only_fileindex = true)
    {
        $this->db->select('f.id_file,f.display_name,f.nama_file,f.slug')
            ->from('ip_sub_file f')
            ->group_start()
            ->like('f.nama_file', $keyword)
            ->or_like('f.display_name', $keyword)
            ->group_end()
            ->order_by('f.display_name', 'ASC');
        if ($only_fileindex == true) {
            $this->db->where('f.fileindex', 'T');
        }
        if (count($id_file_in) > 0) {
            $this->db->where_not_in('id_file', $id_file_in);
        }
        $result = $this->db->get()->result();
        return $result;
    }

    function get_detail_file_trans($id_sub, $id_file)
    {
        $this->db->select('t.*,f.nama_file,f.display_name')
            ->from('ip_sub_file_trans t, ip_sub_file f')
            ->where('t.id_file=f.id_file', null, false)
            ->where('t.id_sub', $id_sub)
            ->where('t.id_file', $id_file);
        $row = $this->db->get()->row();
        return $row;
    }

    function search_file_kategori($id_tag, $keyword, $typedata)
    {
        $this->db->select('file')
            ->from('ip_tag_content')
            ->where('tipe', 'file')
            ->where('id_tag', $id_tag);
        $file_already_exist = $this->db->get()->result_array();
        if ($typedata == 'file') {
            $this->db->select('c.display_name,c.file as namafile,c.id_tagcontent as idfile');
        } else {
            $this->db->select('c.display_name,c.slug as namafile,c.id_tagcontent as idfile');
        }
        $this->db->from('ip_tag_content c')
            ->where('c.id_tag !=', $id_tag)
            ->where('c.tipe', $typedata)
            ->group_start()
            ->like('c.display_name', $keyword)
            ->or_like('c.file', $keyword)
            ->group_end()
            ->order_by('c.display_name');
        if (count($file_already_exist) > 0) {
            $already_in = array();
            foreach ($file_already_exist as $row) :
                $already_in[] = $row['file'];
            endforeach;
            $this->db->where_not_in('file', $already_in);
        }
        $result = $this->db->get()->result_array();
        return $result;
    }

    function search_file_sub_not_exist_tag($keyword, $file_in_kategori = array())
    {
        $this->db->select('display_name,nama_file as namafile,id_file as idfile')
            ->from('ip_sub_file')
            ->group_start()
            ->like('display_name', $keyword)
            ->or_like('nama_file', $keyword)
            ->group_end()
            ->order_by('display_name');
        if (count($file_in_kategori) > 0) {
            $this->db->where_not_in('nama_file', $file_in_kategori);
        }
        $result = $this->db->get()->result_array();
        return $result;
    }

    function getThreadContent($slug = null, $idContent = null)
    {
        $this->db->select('*')
            ->from('thread_content');
        if ($slug != null) {
            $this->db->where('slug', $slug);
        }
        if ($idContent != null) {
            $this->db->where('idcontent', $idContent);
        }
        $result = $this->db->get()->result_array();
        if ($result) {
            return $result[0];
        }
    }

    function getThreadMedia($idMedia, $idFile = null)
    {
        $this->db->select('m.*,f.slug AS slugFile,t.slug AS slugTag')
            ->from('thread_media m')
            ->join('ip_sub_file f', 'm.id_sub_file=f.id_file', 'LEFT')
            ->join('ip_tag_content t', 'm.id_tagcontent=t.id_tagcontent', 'LEFT')
            ->where('m.idmedia', $idMedia)
            ->order_by('m.urutan', 'ASC');
        if ($idFile != null) {
            $this->db->where('idfile', $idFile);
        }
        $result = $this->db->get()->result_array();
        return $result;
    }

    function getThreadMain($idTopik)
    {
        $this->db->select('*')
            ->from('thread_main')
            ->where('idtopik', $idTopik);
        $result = $this->db->get()->result_array();
        if ($result) {
            return $result[0];
        }
    }

    function getMaxIdMedia()
    {
        $this->db->select('MAX(CAST(SUBSTR(idmedia,13,LENGTH(idmedia)) AS UNSIGNED)) AS maxidmedia')
            ->from('thread_content')
            ->where('idmedia IS NOT NULL', null, false);
        $result = $this->db->get()->row();
        if ($result) {
            $maxId = $result->maxidmedia;
            return ($maxId + 1);
        } else {
            return 0;
        }
    }

    function getMaxIdFileMedia($idMedia)
    {
        $this->db->select('MAX(CAST(SUBSTR(idfile,8,LENGTH(idfile)) AS UNSIGNED)) AS maxidfile')
            ->from('thread_media')
            ->where('idmedia', $idMedia);
        $result = $this->db->get()->row();
        if ($result) {
            $maxId = $result->maxidfile;
            return ($maxId + 1);
        } else {
            return 0;
        }
    }

    function getMaxUrutanMedia($idMedia)
    {
        $this->db->select('MAX(urutan) AS maxurutan')
            ->from('thread_media')
            ->where('idmedia', $idMedia);
        $result = $this->db->get()->row();
        if ($result) {
            $maxId = $result->maxurutan;
            return ($maxId + 1);
        } else {
            return 0;
        }
    }

    function getMaxMinUrutanMedia($idMedia)
    {
        $this->db->select('MIN(urutan) AS minurutan,MAX(urutan) AS maxurutan')
            ->from('thread_media')
            ->where('idmedia', $idMedia);
        $result = $this->db->get()->result_array();
        if ($result) {
            return $result[0];
        }
    }

    function getCurentMediaUrutan($idMedia, $urutan)
    {
        $this->db->select('*')
            ->from('thread_media')
            ->where('idmedia', $idMedia)
            ->where('urutan', $urutan);
        $result = $this->db->get()->result_array();
        if ($result) {
            return $result[0];
        }
    }

    function getListFileTagContent($keyword, $id_file_in = array())
    {
        $this->db->select('id_tagcontent AS id_file,display_name,file AS nama_file,slug')
            ->from('ip_tag_content')
            ->group_start()
            ->like('file', $keyword)
            ->or_like('display_name', $keyword)
            ->group_end()
            ->order_by('display_name', 'ASC');
        if (count($id_file_in) > 0) {
            $this->db->where_not_in('id_tagcontent', $id_file_in);
        }
        $result = $this->db->get()->result();
        return $result;
    }

    function getExistMedia($typeMedia, $namaFile, $idMedia)
    {
        $this->db->select('*')
            ->from('thread_media')
            ->where('typefile', $typeMedia)
            ->where('namafile', $namaFile)
            ->where('idmedia', $idMedia);
        return $this->db->get()->result_array();
    }

    function update_thread_media($idmedia, $idfile, $set)
    {
        $this->db->where('idmedia', $idmedia)
            ->where('idfile', $idfile)
            ->update('thread_media', $set);
    }

    function get_file_sub_dan_tag($keyword, $id_file_in = array(), $only_fileindex = true)
    {
        $this->db->select("id_file AS id,display_name,nama_file,slug,'ip_sub_file' AS file_type")
            ->from('ip_sub_file')
            ->group_start()
            ->like('nama_file', $keyword)
            ->or_like('display_name', $keyword)
            ->group_end();
        if ($only_fileindex == true) {
            $this->db->where('f.fileindex', 'T');
        }
        if (count($id_file_in) > 0) {
            $this->db->where_not_in('id_file', $id_file_in);
        }
        $query1 = $this->db->get_compiled_select();

        $this->db->select("id_tagcontent AS id,display_name,file AS nama_file,slug,'ip_tag_content' AS file_type")
            ->from('ip_tag_content')
            ->group_start()
            ->like('file', $keyword)
            ->or_like('display_name', $keyword)
            ->group_end();
        $query2 = $this->db->get_compiled_select();
        $query = $this->db->query($query1 . " UNION " . $query2 . " ORDER BY nama_file ASC;");
        return $query->result();
    }
}
