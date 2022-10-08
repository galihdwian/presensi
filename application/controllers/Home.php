<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Galih Dwi A N
 * 
 * @property home_model $home_model
 * @property kegiatan_model $kegiatan_model
 * @property gallery_model $gallery_model
 */
class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('convert');
        $this->load->helper('xsshandle');
        $this->load->model("home_model");
        $this->load->model('kegiatan_model');
        $this->load->model('gallery_model');
        date_default_timezone_set("Asia/Jakarta");
    }

    function _404()
    {
        $data['menu'] = 'home';
        $data['page'] = '404';
        $this->load->view('publik/layout', $data);
    }

    function index()
    {
        $this->load->helper("form");
        $this->load->helper("convert");
        $data['slide'] = $this->home_model->get_slide();
        $data['list_kegiatan'] = $this->kegiatan_model->getListKegiatan(4);
        $data['list_gallery'] = $this->gallery_model->getListGallery();
        $data['menu'] = 'home';
        $data['page'] = 'index';
        $this->load->view('publik/layout', $data);
    }
}
