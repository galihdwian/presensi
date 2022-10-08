<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_content"> 
                <?php
                echo $this->session->flashdata('message');
                if (!empty($get_keberatan_detail)) {
                    echo '<table class="table"><tbody>';
                    echo '<tr><td class="fit text-left">Nama Pemohon</td><td class="fit text-center">:</td><td class="text-left">' . $get_keberatan_detail->full_name . '</td></tr>';
                    echo '<tr><td class="fit text-left">Informasi yg diminta</td><td class="fit text-center">:</td><td class="text-left">' . $get_keberatan_detail->informasi_diminta . '</td></tr>';
                    echo '<tr><td class="fit text-left">Tanggal Keberatan</td><td class="fit text-center">:</td><td class="text-left">' . ($get_keberatan_detail->tanggal != "" ? date_indo($get_keberatan_detail->tanggal) : "") . '</td></tr>';
                    echo '<tr><td class="fit text-left">Alasan Pengajuan Keberatan</td><td class="fit text-center">:</td><td class="text-left">';
                    echo $get_keberatan_detail->ditolak == 'T' ? '- Permohonan informasi ditolak<br>' : '';
                    echo $get_keberatan_detail->tdk_disediakan == 'T' ? '- Informasi berkala tidak disediakan<br>' : '';
                    echo $get_keberatan_detail->tdk_ditanggapi == 'T' ? '- Permintaan informasi tidak ditanggapi<br>' : '';
                    echo $get_keberatan_detail->tdk_sesuaipermintaan == 'T' ? '- Permintaan informasi ditanggapi tidak sebagaimana diminta<br>' : '';
                    echo $get_keberatan_detail->tdk_dipenuhi == 'T' ? '- Permintaan informasi tidak dipenuhi<br>' : '';
                    echo $get_keberatan_detail->tdk_wajar == 'T' ? '- Biaya yang dikenakan tidak wajar<br>' : '';
                    echo $get_keberatan_detail->overtime == 'T' ? '- Informasi disampaikan melebihi jangka waktu yang ditentukan<br>' : '';
                    echo '</td></tr>';
                    echo '<tr><td class="fit text-left">Kasus Posisi</td><td class="fit text-center">:</td><td class="text-left">' . $get_keberatan_detail->kasus . '</td></tr>';
                    echo '<tr><td class="fit text-left"><b>Identitas Kuasa Pemohon</b></td><td class="fit text-center">&nbsp;</td><td class="text-left">&nbsp;</td></tr>';
                    echo '<tr><td class="fit text-left">Nama</td><td class="fit text-center">:</td><td class="text-left">' . $get_keberatan_detail->kuasa_nama . '</td></tr>';
                    echo '<tr><td class="fit text-left">Telp</td><td class="fit text-center">:</td><td class="text-left">' . $get_keberatan_detail->kuasa_telp . '</td></tr>';
                    echo '<tr><td class="fit text-left">Alamat</td><td class="fit text-center">:</td><td class="text-left">' . $get_keberatan_detail->kuasa_alamat . '</td></tr>';
                    if ($get_keberatan_detail->verifikasi == NULL) {
                        echo '<tr><td class="fit text-left">&nbsp;</td><td class="fit text-center">&nbsp;</td><td class="text-left">';
                        echo '<a href="'.  site_url('adminpermohonan/keberatan_verifikasi/'.$get_keberatan_detail->id_keberatan).'" class="btn btn-sm btn-warning">Verifikasi</a>';
                        echo '</td></tr>';
                    } else {
                        if(!empty($get_keberatan_tanggapan)){
                            echo '<tr><td class="fit text-left"><b>Tindak Lanjut</b></td><td class="fit text-center">&nbsp;</td><td class="text-left">&nbsp;</td></tr>';
                            echo '<tr><td class="fit text-left">Di Tanggapi Tanggal</td><td class="fit text-center">:</td><td class="text-left">' . ($get_keberatan_tanggapan->date_tanggapan != ""? date_indo($get_keberatan_tanggapan->date_tanggapan):"") . ', Oleh : '.$get_keberatan_tanggapan->user_keberatan.'</td></tr>';
                            echo '<tr><td class="fit text-left">Isi Tanggapan</td><td class="fit text-center">:</td><td class="text-left">' . $get_keberatan_tanggapan->isi_tanggapan . '</td></tr>';
                        }
                    }
                    echo '</tbody></table>';
                } else {
                    echo 'Data tidak ditemukan.';
                }
                ?>
                <a href="<?php echo site_url('adminpermohonan/keberatan_detail'); ?>" class="btn btn-primary">Batal / Kembali</a>
            </div>
        </div>
    </div>
</div>