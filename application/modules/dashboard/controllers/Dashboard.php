<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Main
 * @author Galih Dwi A N <galihdwia007 at gmail.com>
 * @property main_model $main_model
 */
class Dashboard extends Public_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->helper('form');
        // $this->load->model('main_model');
    }


    public function index()
    {
        $data['str_link'] = $this->_getlink();
        $data['page'] = 'indexpage';
        $this->load->view('dashboard/new_template', $data);
    }
}
