<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions {

    function __construct() {
        parent::CI_Exceptions();
    }

    public function show_404($page = '') {
        $CI = & get_instance();
        $CI->load->view('welcome_message');
        echo 'aaaa';
        exit;
    }

}

?>
