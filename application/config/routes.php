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


$route['default_controller'] = 'login';
$route['translate_uri_dashes'] = FALSE;

$route['logout'] = 'login/logout';

$route['dashboard'] = 'dashboard';

$route['management_user'] = 'menu/management_user';
$route['user_tambah'] = 'menu/management_user/tambah_user';
$route['aktivasi_user/(:any)/(:any)'] = 'menu/management_user/status_aktivasi_user/$1/$2';

$route['periode'] = 'menu/periode';
$route['periode_tambah'] = 'menu/periode/tambah_periode';
$route['aktivasi_periode/(:any)/(:any)'] = 'menu/periode/status_aktivasi_periode/$1/$2';
$route['periode_edit/(:any)'] = 'menu/periode/edit_periode/$1';

$route['jurusan'] = 'menu/jurusan';
$route['jurusan_tambah'] = 'menu/jurusan/tambah_jurusan';
$route['jurusan_edit/(:any)'] = 'menu/jurusan/edit_jurusan/$1';
$route['jurusan_hapus/(:any)'] = 'menu/jurusan/hapus_jurusan/$1';

$route['dosen'] = 'menu/dosen';
$route['dosen_tambah'] = 'menu/dosen/tambah_dosen';
$route['aktivasi_dosen/(:any)/(:any)'] = 'menu/dosen/status_aktivasi_dosen/$1/$2';
$route['dosen_edit/(:any)'] = 'menu/dosen/edit_dosen/$1';

$route['mahasiswa'] = 'menu/mahasiswa';
$route['mahasiswa_tambah'] = 'menu/mahasiswa/tambah_mahasiswa';
$route['aktivasi_mahasiswa/(:any)/(:any)'] = 'menu/mahasiswa/status_aktivasi_mahasiswa/$1/$2';
$route['mahasiswa_edit/(:any)'] = 'menu/mahasiswa/edit_mahasiswa/$1';

$route['matkul'] = 'menu/matkul';
$route['matkul_tambah'] = 'menu/matkul/tambah_matkul';
$route['matkul_edit/(:any)'] = 'menu/matkul/edit_matkul/$1';
$route['matkul_hapus/(:any)'] = 'menu/matkul/hapus_matkul/$1';
$route['matkul_detail/(:any)'] = 'menu/matkul/detail_matkul/$1';
$route['matkul_hapus_detail/(:any)/(:any)'] = 'menu/matkul/detail_matkul_hapus/$1/$2';
$route['matkul_detail_tambah/(:any)'] = 'menu/matkul/detail_matkul_tambah/$1';

$route['ruangan'] = 'menu/ruangan';
$route['ruangan_tambah'] = 'menu/ruangan/tambah_ruangan';
$route['ruangan_edit/(:any)'] = 'menu/ruangan/edit_ruangan/$1';
$route['ruangan_hapus/(:any)'] = 'menu/ruangan/hapus_ruangan/$1';

$route['pertemuan'] = 'menu/pertemuan';
$route['pertemuan_tambah'] = 'menu/pertemuan/tambah_pertemuan';
$route['pertemuan_edit/(:any)'] = 'menu/pertemuan/edit_pertemuan/$1';
$route['pertemuan_hapus/(:any)'] = 'menu/pertemuan/hapus_pertemuan/$1';

$route['presensi'] = 'menu/presensi';
$route['presensi_detail_pertemuan/(:any)'] = 'menu/presensi/pertemuan_detail/$1';
$route['detail_absen/(:any)'] = 'menu/presensi/absen_detail/$1';



$route['r_pertemuan_mahasiswa'] = 'menu/rekap/r_pertemuan_mahasiswa';
$route['r_presensi_mahasiswa'] = 'menu/rekap/r_presensi_mahasiswa';
$route['r_dosen'] = 'menu/rekap/r_dosen';
