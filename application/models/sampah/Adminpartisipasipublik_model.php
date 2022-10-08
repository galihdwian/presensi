<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Adminpartisipasipublik_model
 * @author CAHSIM
 */
class Adminpartisipasipublik_model extends CI_Model {

    function get_all_topik() {
        $this->db->order_by("date_topik","DESC");
        return $this->db->get("ip_ruangpublik")->result();
    }
    
    function get_topik($id_topik){
        $this->db->where("id_topik", $id_topik);
        return $this->db->get("ip_ruangpublik")->row();
    }
    
    function get_respons($id_topik){
        $this->db->where("id_topik", $id_topik);
        $this->db->order_by("waktu_respon","DESC");
        return $this->db->get("ip_ruangpublik_respon")->result();
    }
    
    function update_partisipasi_respon($id_respontopik,$update){
        $this->db->where("id_respontopik", $id_respontopik);
        $this->db->update('ip_ruangpublik_respon', $update);
    }

}

?>
