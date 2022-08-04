<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Form_validation
 *
 * @author USER
 */
class MY_Form_validation extends CI_Form_validation {

    //put your code here
    public $CI;

    function run($module = '', $group = '') {
        (is_object($module)) AND $this->CI = &$module;
        return parent::run($group);
    }
    
    function is_unique($str, $field) {
        sscanf($field, '%[^.].%[^.]', $table, $field);
        return is_object($this->CI->db) ? ($this->CI->db->limit(1)->get_where($table, array($field => $str))->num_rows() === 0) : FALSE;
    }

}

?>
