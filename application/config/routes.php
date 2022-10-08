<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */


$route['default_controller'] = 'home';
$route['translate_uri_dashes'] = FALSE;
$route['komkordik'] = 'home';
$route['404_override'] = 'home/_404';

$route['login'] = 'admin/login';
$route['logout'] = 'admin/login/logout';

$route['visimisi'] = 'profil/visimisi';
$route['strukturorganisasi'] = 'profil/strukturorganisasi';
$route['sk_komkordik'] = 'profil/sk_komkordik';
$route['ppdtp_fk_unsoed'] = 'profil/ppdtp_fk_unsoed';
$route['daftarpesertadidik'] = 'profil/daftarpesertadidik';
$route['kegiatan'] = 'kegiatan/list_kegiatan';
$route['kegiatan/(:num)'] = 'kegiatan/list_kegiatan/$1';
$route['kegiatan/detail_kegiatan/(:any)'] = 'kegiatan/detail_kegiatan/$1';

$route['pesertadidik'] = 'pesertadidik/list_pesertadidik';
$route['pesertadidik/(:num)'] = 'pesertadidik/list_pesertadidik/$1';
$route['pesertadidik/detail_pesertadidik/(:any)'] = 'kegiatan/detail_pesertadidik/$1';

$route['admin'] = 'admin/dashboard';
$route['admin/management_user'] = 'admin/management_user';
$route['admin/management_user/tambah'] = 'admin/management_user/tambah_user';
$route['admin/status_aktivasi_user/(:any)/(:any)'] = 'admin/management_user/status_aktivasi_user/$1/$2';
$route['admin/visi'] = 'admin/visidanmisi/list_visi';
$route['admin/misi'] = 'admin/visidanmisi/list_misi';
$route['admin/visidanmisi/tambah_visi'] = 'admin/visidanmisi/tambah_visi';
$route['admin/visidanmisi/tambah_misi'] = 'admin/visidanmisi/tambah_misi';
$route['admin/visidanmisi/delete_visi/(:any)'] = 'admin/visidanmisi/delete_visi/$1';
$route['admin/visidanmisi/delete_misi/(:any)'] = 'admin/visidanmisi/delete_misi/$1';
$route['admin/visidanmisi/edit_visi/(:any)'] = 'admin/visidanmisi/edit_visi/$1';
$route['admin/visidanmisi/edit_misi/(:any)'] = 'admin/visidanmisi/edit_misi/$1';
$route['admin/strukturorganisasi'] = 'admin/strukturorganisasi';
$route['admin/kegiatan'] = 'admin/kegiatan';
$route['admin/kegiatan/tambah_kegiatan'] = 'admin/kegiatan/tambah_kegiatan';
$route['admin/kegiatan/delete_kegiatan/(:any)'] = 'admin/kegiatan/delete_kegiatan/$1';
$route['admin/kegiatan/edit_kegiatan/(:any)'] = 'admin/kegiatan/edit_kegiatan/$1';
$route['admin/kegiatan/tambahan/(:any)'] = 'admin/kegiatan/tambahan/$1';
$route['admin/kegiatan/tambah_kegiatan_lampiran/(:any)'] = 'admin/kegiatan/tambah_kegiatan_lampiran/$1';
$route['admin/kegiatan/delete_kegiatan_lampiran/(:any)/(:any)'] = 'admin/kegiatan/delete_kegiatan_lampiran/$1/$2';
$route['admin/kegiatan/edit_kegiatan_lampiran/(:any)/(:any)'] = 'admin/kegiatan/edit_kegiatan_lampiran/$1/$2';


$route['admin/gallery'] = 'admin/gallery';
$route['admin/gallery/tambah_gallery'] = 'admin/gallery/tambah_gallery';
$route['admin/gallery/delete_gallery/(:any)'] = 'admin/gallery/delete_gallery/$1';
$route['admin/sk_komkordik'] = 'admin/sk_komkordik';
$route['admin/sk_komkordik/tambah_sk_komkordik'] = 'admin/sk_komkordik/tambah_sk_komkordik';
$route['admin/sk_komkordik/delete_sk_komkordik/(:any)'] = 'admin/sk_komkordik/delete_sk_komkordik/$1';
$route['admin/ppdtp_fk_unsoed'] = 'admin/ppdtp_fk_unsoed';
$route['admin/ppdtp_fk_unsoed/tambah_ppdtp_fk_unsoed'] = 'admin/ppdtp_fk_unsoed/tambah_ppdtp_fk_unsoed';
$route['admin/ppdtp_fk_unsoed/delete_ppdtp_fk_unsoed/(:any)'] = 'admin/ppdtp_fk_unsoed/delete_ppdtp_fk_unsoed/$1';

$route['admin/pesertadidik'] = 'admin/pesertadidik';
$route['admin/pesertadidik/tambah_pesertadidik'] = 'admin/pesertadidik/tambah_pesertadidik';
