<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Admin
 * @author Galih Dwi A N <galihdwia007 at gmail.com>
 */
class Admin extends Public_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        redirect('admin/dashboard');
    }

    //END OF class Admin
}
