<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of MY_Model
 * @author Imam Syaifulloh <imam.syaifulloh12 at gmail.com>
 */
class MY_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     *
     * @param string nama tabel
     * @param array $where kondisi array(field => condition)
     * @param string $type row / result
     * @param int $limit limit result
     * @param int $offset limit ofset
     * @param array $orderby array(field => ASC / DESC)
     * @param string $select select field
     * @param array $groupby group by statement array([0]=>FIELD1,[1]=>FIELD2);
     * @return object row / result
     */
    function get_where($table, $where = null, $type = "result", $limit = null, $offset = null, $orderby = null, $select = null, $groupby = null)
    {
        if ($select != null) {
            $this->db->select($select);
        }
        if ($orderby != null) {
            foreach ($orderby as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }
        if ($groupby != null && count($groupby) > 0) {
            for ($i = 0; $i < count($groupby); $i++) {
                $this->db->group_by($groupby[$i]);
            }
        }
        $result = $this->db->get_where($table, $where, $limit, $offset);
        if ($type == "result") {
            return $result->result();
        } elseif ($type == "row") {
            return $result->row();
        }
    }

    /**
     * get_data_all : mendampatkan nilai semua baris dari suatu table
     * @param string $table nama table
     * @param array $orderby
     * @param int $limit
     * @param int $offset
     * @return object
     */
    function get_data_all($table, $orderby = NULL, $limit = NULL, $offset = NULL)
    {
        if ($orderby) {
            foreach ($orderby as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }
        return $this->db->get($table, $limit, $offset)->result();
    }

    /**
     * update_data : method untuk melakukan update data
     * @param string $table
     * @param array $set
     * @param array $where
     * @param string $field_where field yang dijadikan key untuk kondisi
     * @param array $value_where value yang dijadikan kondisi
     * @return int affected_rows
     */
    function update_data($table, $set, $where, $field_where_in = null, $value_where_in = null)
    {
        if ($field_where_in != null && $value_where_in != null) {
            $this->db->where_in($field_where_in, $value_where_in);
        }
        $this->db->update($table, $set, $where);
        return $this->db->affected_rows();
    }

    /**
     * delete_data : method untuk menlakukan proses delete data
     * @param string $table
     * @param array $where
     * @return int affected_rows
     */
    function delete_data($table, $where)
    {
        $this->db->delete($table, $where);
        return $this->db->affected_rows();
    }

    /**
     * insert_data : method untuk menyimpan data
     * @param string $table
     * @param array $set
     * @param string $type tipe proses simpan data single atau batch
     * @return int affected rows
     */
    function insert_data($table, $set, $type = 'single')
    {
        if ($type == 'single') {
            $this->db->insert($table, $set);
        } elseif ($type == 'batch') {
            $this->db->insert_batch($table, $set);
        }
        return $this->db->affected_rows();
    }

    /**
     * execute_query : menjalankan perintah sql manual
     * @param string $sql perintah sql
     * @param string $type tipe return result atau row
     * @return object
     */
    function execute_query($sql, $type = 'result')
    {
        $result = $this->db->query($sql);
        if ($type == 'result')
            return $result->result();
        elseif ($type == 'row')
            return $result->row();
        elseif ($type == 'ar')
            return $this->db->affected_rows();
    }

    /**
     * count_data : menghitung jumlah data / baris dalam table
     * @param string $table nama tabel
     * @param string $field kolom yang dihitung
     * @return integer
     */
    function count_data($table, $field, $where = null)
    {
        $this->db->select("COUNT($field) AS COUNTDATA");
        return $this->db->get_where($table, $where)->row()->COUNTDATA;
    }

    /**
     * get_max_field mendaptkan nilai maksimal dari suatu kolom dalam table
     * @param string $table nama tabel
     * @param string $field kolom yang dihitung
     * @param int $start
     * @return integer
     */
    function get_max_field($table, $field, $start, $where = null)
    {
        if ($start != 0) {
            $this->db->select("MAX(CAST(SUBSTRING($field, $start, LENGTH($field)) AS UNSIGNED)) AS MAXVALUES");
        } else {
            $this->db->select("MAX($field) AS MAXVALUES");
        }
        if ($where != null) {
            return $this->db->get_where($table, $where)->row()->MAXVALUES;
        } else {
            return $this->db->get($table)->row()->MAXVALUES;
        }
    }

    function get_max_value($table, $field, $where = null)
    {
        $this->db->select('MAX(' . $field . ') AS maxdata');
        if ($where != null) {
            $result = $this->db->get_where($table, $where)->row();
        } else {
            $result = $this->db->get($table)->row();
        }
        $maxdata = ($result->maxdata == null ? 0 : $result->maxdata);
        return $maxdata;
    }

    function get_min_value($table, $field, $where = null)
    {
        $this->db->select('MIN(' . $field . ') AS mindata');
        if ($where != null) {
            $result = $this->db->get_where($table, $where)->row();
        } else {
            $result = $this->db->get($table)->row();
        }
        $mindata = ($result->mindata == null ? 0 : $result->mindata);
        return $mindata;
    }

    function get_listmenu($idparent = null, $idmenu = null)
    {
        $this->db->select('*')
            ->from('m_menu')
            ->where('idparent', $idparent)
            ->order_by('urutan');
        if ($idmenu != null) {
            $this->db->where('idmenu', $idmenu);
        }
        $result = $this->db->get()->result();
        $menu = array();
        foreach ($result as $row) {
            $menu[] = array(
                'idmenu' => $row->idmenu,
                'namamenu' => $row->namamenu,
                'siteurl' => $row->siteurl,
                'faicon' => $row->faicon,
                'idparent' => $row->idparent,
                'urutan' => $row->urutan,
                'childmenu' => $this->get_listmenu($row->idmenu)
            );
        }
        return $menu;
    }

    //END OF class MY_Model
}
