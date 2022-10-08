<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Galih Dwi A N
 * 
 * @property visidanmisi_model $visidanmisi_model
 * @property strukturorganisasi_model $strukturorganisasi_model
 * @property sk_komkordik_model $sk_komkordik_model
 * @property ppdtp_fk_unsoed_model $ppdtp_fk_unsoed_model
 * @property pesertadidik_model $pesertadidik_model
 */

class Profil extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('visidanmisi_model');
        $this->load->model('strukturorganisasi_model');
        $this->load->model('sk_komkordik_model');
        $this->load->model('ppdtp_fk_unsoed_model');
        $this->load->model('pesertadidik_model');
    }

    function index()
    {
        show_404();
    }


    function visimisi()
    {
        $data['menu'] = 'profil';
        $data['page'] = 'visimisi';
        $data['list_visi'] = $this->visidanmisi_model->getListVisi();
        $data['list_misi'] = $this->visidanmisi_model->getListMisi();
        $this->load->view('publik/layout', $data);
    }

    function strukturorganisasi()
    {
        $data['menu'] = 'profil';
        $data['page'] = 'strukturorganisasi';
        $data['getstrukturorganisasi'] = $this->strukturorganisasi_model->getstrukturorganisasi();
        $this->load->view('publik/layout', $data);
    }

    function sk_komkordik()
    {
        $data['menu'] = 'profil';
        $data['page'] = 'sk_komkordik';
        $data['list_sk_komkordik'] = $this->sk_komkordik_model->getListSk();
        $this->load->view('publik/layout', $data);
    }

    function ppdtp_fk_unsoed()
    {
        $data['menu'] = 'profil';
        $data['page'] = 'ppdtp_fk_unsoed';
        $data['list_ppdtp_fk_unsoed'] = $this->ppdtp_fk_unsoed_model->getListPPDTP();
        $this->load->view('publik/layout', $data);
    }

    function daftarpesertadidik()
    {
        $data['menu'] = 'profil';
        $data['page'] = 'daftarpesertadidik';
        $data['list_daftarpesertadidik'] = $this->pesertadidik_model->getListPesertadidik();
        $this->load->view('publik/layout', $data);
    }
}
