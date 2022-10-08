<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_content"> 
                <?php
                if (!empty($get_user_detail)) {
                    echo '<table class="table"><tbody>';
                    foreach ($get_user_detail as $r_detail):
                        echo '<tr><td class="fit text-left">Nama Pemohon</td><td class="fit text-center">:</td><td class="text-left">' . $r_detail['full_name'] . '</td></tr>';
                        echo '<tr><td class="fit text-left">Tipe Pemohon</td><td class="fit text-center">:</td><td class="text-left">' . $r_detail['tipe_pemohon'] . '</td></tr>';
                        echo '<tr><td class="fit text-left">Tanda Pengenal / Nomor Identitas</td><td class="fit text-center">:</td>';
                        echo '<td class="text-left">';
                        if (!empty($r_detail['tanda_pengenal'])) {
                            echo $r_detail['tanda_pengenal'] . ' / ';
                        }
                        echo $r_detail['nomor_identitas'];
                        echo '</td></tr>';
                        if ($r_detail['tipe_pemohon'] == 'MEMBER') {
                            echo '<tr><td class="fit text-left">Jenis Kelamin</td><td class="fit text-center">:</td><td class="text-left">' . ($r_detail['jk'] == 'P' ? 'Perempuan' : 'Laki-Laki') . '</td></tr>';
                            echo '<tr><td class="fit text-left">Tempat, Tanggal Lahir</td><td class="fit text-center">:</td><td class="text-left">' . $r_detail['tempat_lahir'] . ',' . (($r_detail['tgl_lahir']) != "" ? tgl_indo($r_detail['tgl_lahir']) : "") . '</td></tr>';
                            echo '<tr><td class="fit text-left">Pekerjaan</td><td class="fit text-center">:</td><td class="text-left">' . $r_detail['pekerjaan'] . '</td></tr>';
                            echo '<tr><td class="fit text-left">Alamat</td><td class="fit text-center">:</td><td class="text-left">' . $r_detail['alamat'] . '</td></tr>';
                            echo '<tr><td class="fit text-left">&nbsp;</td><td class="fit text-center">&nbsp;</td><td class="text-left">Provinsi ' . $provinsi . ', ' . ucwords(strtolower($kabupaten)) . ', Kode Pos ' . $r_detail['kode_pos'] . '</td></tr>';
                        } else {
                            echo '<tr><td class="fit text-left">Alamat</td><td class="fit text-center">:</td><td class="text-left">';
                            echo $r_detail['alamat'] . '<br>Desa ' . $r_detail['desa_plain'] . '<br>Kecamatan ' . $r_detail['kecamatan_plain'] . '<br>Kabupaten ' . $r_detail['kabupaten_plain'] . '<br>Provinsi ' . $r_detail['provinsi_plain'] . '<br>Kode Pos ' . $r_detail['kode_pos'];
                            echo '</td></tr>';
                        }
                        echo '<tr><td class="fit text-left">E-mail</td><td class="fit text-center">:</td><td class="text-left">' . $r_detail['email'] . '</td></tr>';
                        echo '<tr><td class="fit text-left">Telp</td><td class="fit text-center">:</td><td class="text-left">' . $r_detail['telp'] . '</td></tr>';
                        echo '<tr><td class="fit text-left">Tgl register / Tgl Aktivasi</td><td class="fit text-center">:</td><td class="text-left">' . ($r_detail['tgl_register'] != "" ? date_indo($r_detail['tgl_register']) : "-") . ' / ' . ($r_detail['date_active'] != "" ? date_indo($r_detail['date_active']) : "") . '</td></tr>';
                        echo '<tr><td class="fit text-left">Tanda Pengenal</td><td class="fit text-center">:</td><td class="text-left"><div class="row"><div class="col-md-6"><img src="' . base_url('assets/images/pemohon/indentitas/' . $r_detail['lampiran']) . '" class="img-responsive"></div></div><div class="clearfix"></div></td></tr>';
                    endforeach;
                    echo '</tbody></table>';
                } else {
                    echo 'Pemohon tidak ditemukan';
                }
                ?>
                <a href="<?php echo site_url('adminpermohonan/' . $prev_page); ?>" class="btn btn-primary">Batal / Kembali</a>
            </div>
        </div>
    </div>
</div>