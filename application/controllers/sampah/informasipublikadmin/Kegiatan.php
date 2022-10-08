<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Galih Dwi A N
 * 
 * @property kegiatan_model $kegiatan_model
 */

class Kegiatan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('kegiatan_model');
        $this->load->library('pagination');
    }

    function index()
    {
        show_404();
    }

    function list_kegiatan($from = null)
    {

        $data['menu'] = 'kegiatan';
        $data['page'] = 'kegiatan';
        $jumlah_data = $this->kegiatan_model->jumlah_data();
        $config['base_url'] = base_url() . 'kegiatan';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 10;

        $this->pagination->initialize($config);
        $data['list_kegiatan'] = $this->kegiatan_model->getListKegiatandata($config['per_page'], $from);


        // $data['list_kegiatan'] = $this->kegiatan_model->getListKegiatan();
        $this->load->view('publik/layout', $data);
    }

    function detail_kegiatan($id)
    {
        $data['menu'] = 'kegiatan';
        $data['page'] = 'detail_kegiatan';
        $data['get_kegiatan'] = $this->kegiatan_model->getKegiatan($id);
        $data['get_kegiatan_lampiran'] = $this->kegiatan_model->getKegiatanLampiranbyidkegiatan($id);
        $this->load->view('publik/layout', $data);
    }
}
