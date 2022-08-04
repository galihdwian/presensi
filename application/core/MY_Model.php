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
     * save
     * Method to save data to table
     * @param string $table  name table
     * @param array $set value to set into table ex. $set=array('username'=>'imamz','fullname'=>'Imam Syaifulloh')
     */
    function save($table, $set)
    {
        $this->db->insert($table, $set);
        return $this->db->affected_rows();
    }

    /**
     * save_multiple
     * Method to save multiple data to table
     * @param string $table  name table
     * @param array $data 2 dimension array to set into table
     */
    function save_multiple($table, $data)
    {
        $this->db->insert_batch($table, $data);
    }

    /**
     * get_all
     * Method to get all data from table
     * @param string $table  name table
     * @param array $order_by  order by parameter ex. array('field'=>'direction')
     */
    function get_all($table, $order_by = NULL)
    {
        if ($order_by != NULL) {
            foreach ($order_by as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }
        return $this->db->get($table)->result();
    }

    /**
     * get_where_single
     * Method to get one row from table with condition
     * @param string $table  name table
     * @param array $where  where condition ex. array('id' => $id)
     * @param integer $limit  limit result default null
     * @param integer $offset  ofset of limit result default null
     */
    function get_where_single($table, $where, $order_by = NULL, $limit = NULL, $offset = NULL)
    {
        //$this->db->where($key, $value);
        //return $this->db->get($table)->row();
        if ($order_by != NULL) {
            foreach ($order_by as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }
        return $this->db->get_where($table, $where, $limit, $offset)->row();
    }

    /**
     * get_where
     * Method to get data from table with condition
     * @param string $table  name table
     * @param array $where  where condition ex. array('id' => $id)
     * @param array $order_by  order by parameter ex. array('field'=>'direction')
     * @param integer $limit  limit result default null
     * @param integer $offset  ofset of limit result default null
     */
    function get_where($table, $where, $order_by = NULL, $limit = NULL, $offset = NULL)
    {
        //$this->db->where($key, $value);
        //return $this->db->get($table)->result();
        if ($order_by != NULL) {
            foreach ($order_by as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }
        return $this->db->get_where($table, $where, $limit, $offset)->result();
    }

    /**
     * get_join
     * Method to get one row from table with condition
     * @param string $table  name table     
     * @param array $join  2 dimension array join condition ex. array(array('table1','table1.field1=table2.field1','LEFT'));
     * @param string $select  field select
     * @param array $order_by  order by parameter ex. array('field'=>'direction')
     * @param integer $limit  limit result default null
     * @param integer $offset  offset of limit result default null
     */
    function get_join($table, $join = NULL, $select = NULL, $order_by = NULL, $limit = NULL, $offset = NULL)
    {
        if ($select != NULL)
            $this->db->select($select);
        if ($join != NULL) {
            foreach ($join as $key => $value) {
                $this->db->join($value[0], $value[1], $value[2]);
            }
        }
        if ($order_by != NULL) {
            foreach ($order_by as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }
        return $this->db->get($table, $limit, $offset)->result();
    }

    /**
     * get_where_join
     * Method to get data from table with condition
     * @param string $table  name table
     * @param array $where  where condition ex. array('id' => $id)
     * @param array $join  2 dimension array join condition ex. array(array('table1','table1.field1=table2.field1','LEFT'));
     * @param string $select  field select
     * @param array $order_by  order by parameter ex. array('field'=>'direction')
     * @param integer $limit  limit result default null
     * @param integer $offset  offset of limit result default null
     */
    function get_where_join($table, $where, $join = NULL, $select = NULL, $order_by = NULL, $limit = NULL, $offset = NULL)
    {
        if ($select != NULL)
            $this->db->select($select);
        if ($join != NULL) {
            foreach ($join as $key => $value) {
                $this->db->join($value[0], $value[1], $value[2]);
            }
        }
        if ($order_by != NULL) {
            foreach ($order_by as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }
        return $this->db->get_where($table, $where, $limit, $offset)->result();
    }

    /**
     * get_where_singgle_join
     * Method to get one row from table with condition
     * @param string $table  name table
     * @param array $where  where condition ex. array('id' => $id)
     * @param array $join  2 dimension array join condition ex. array(array('table1','table1.field1=table2.field1','LEFT'));
     * @param string $select  field select
     * @param array $order_by  order by parameter ex. array('field'=>'direction')
     * @param integer $limit  limit result default null
     * @param integer $offset  offset of limit result default null
     */
    function get_where_singgle_join($table, $where, $join = NULL, $select = NULL, $order_by = NULL, $limit = NULL, $offset = NULL)
    {
        if ($select != NULL)
            $this->db->select($select);
        if ($join != NULL) {
            foreach ($join as $key => $value) {
                $this->db->join($value[0], $value[1], $value[2]);
            }
        }
        if ($order_by != NULL) {
            foreach ($order_by as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }
        return $this->db->get_where($table, $where, $limit, $offset)->row();
    }

    /**
     * update
     * Method to table table with condition
     * @param string $table  name table
     * @param array $data value to set on table
     * @param array $where condition ex. array('id' => $id)
     */
    function update($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }

    /**
     * delete
     * Method to table table with condition
     * @param string $table name table
     * @param array $where array condition ex. array('id' => $id)
     */
    function delete($table, $where)
    {
        $this->db->delete($table, $where);
        return $this->db->affected_rows();
    }

    /**
     * count_where
     * Method to count data with condition
     * @param string $table name table
     * @param array $where array condition ex. array('id' => $id)
     */
    function count_where($table, $where)
    {
        $this->db->from($table);
        foreach ($where as $key => $value) {
            if ($value != NULL) {
                $this->db->where($key, $value);
            } else {
                $this->db->where($key, $value, FALSE);
            }
        }
        return $this->db->count_all_results();
    }

    /**
     * execute_query
     * Method to eksekusi query
     * @param string $sql query yang akan diexekusi
     */
    function execute_query($sql)
    {
        $this->db->query($sql);
    }

    /**
     * get_where_in
     * method untuk mendapatkan nilai sesuai array tertentu
     * @param string $table nama table
     * @param array $where array sebagai kunci
     * @param string $select field yang dicari
     * @param array $order_by array yang digunakan untuk menentukan pengurutan data
     */
    function get_where_in($table, $where, $select = NULL, $order_by = NULL)
    {
        if ($select != NULL)
            $this->db->select($select);
        foreach ($where as $key => $value) {
            $this->db->where_in($key, $value);
        }
        if ($order_by != NULL) {
            foreach ($order_by as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }
        return $this->db->get($table)->result();
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

    //END OF class MY_Model
}
