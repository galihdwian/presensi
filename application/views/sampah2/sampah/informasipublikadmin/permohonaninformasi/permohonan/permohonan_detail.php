<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_content"> 
                <?php
                echo $this->session->flashdata('message');
                if (!empty($get_permohonan_detail)) {
                    echo '<table class="table"><tbody>';
                    echo '<tr><td class="fit text-left">Nama Pemohon</td><td class="fit text-center">:</td><td class="text-left">';
                    echo '<a href="' . site_url('adminpermohonan/user_detail/' . $get_permohonan_detail->id_pemohon . '/permohonan_detail--' . $get_permohonan_detail->id_permohonan) . '">';
                    echo $get_permohonan_detail->full_name;
                    echo '</a>';
                    echo '</td></tr>';
                    echo '<tr><td class="fit text-left">Informasi Yg Diminta</td><td class="fit text-center">:</td><td class="text-left">' . $get_permohonan_detail->informasi_diminta . '</td></tr>';
                    echo '<tr><td class="fit text-left">Kandungan Isi Informasi</td><td class="fit text-center">:</td><td class="text-left">' . $get_permohonan_detail->kandungan_isi . '</td></tr>';
                    echo '<tr><td class="fit text-left">Tujuan Permohonan</td><td class="fit text-center">:</td><td class="text-left">' . $get_permohonan_detail->tujuan_permohoan . '</td></tr>';
                    echo '<tr><td class="fit text-left">Bentuk informasi yang diminta</td><td class="fit text-center">:</td><td class="text-left">' . ($get_permohonan_detail->bentuk_inf == 'S' ? "Mendapatkan Salinan Informasi Softcopy (Melihat/Mengunduh/email)" : "Mendapatkan Salinan Informasi Hardcopy") . '</td></tr>';
                    echo '<tr><td class="fit text-left">Tanggal Permohonan</td><td class="fit text-center">:</td><td class="text-left">' . ($get_permohonan_detail->tgl_permohonan != "" ? date_indo($get_permohonan_detail->tgl_permohonan) : "") . '</td></tr>';
                    if ($get_permohonan_detail->tgl_dikonfirmasi == "") {
                        echo '<tr><td class="fit">&nbsp;</td><td class="fit">&nbsp;</td><td>';
                        echo '<a href="' . site_url('adminpermohonan/permohonan_konfirmasi/' . $get_permohonan_detail->id_permohonan) . '" class="btn btn-sm btn-warning">Konfirmasi</a>';
                        echo '</td></tr>';
                    } else {
                        echo '<tr><td class="fit text-left">Tanggal Konfirmasi</td><td class="fit text-center">:</td><td class="text-left">' . ($get_permohonan_detail->tgl_dikonfirmasi != "" ? date_indo($get_permohonan_detail->tgl_dikonfirmasi) : "") . ', Oleh : ' . $get_permohonan_detail->user_konfirm . '</td></tr>';
                        if (!empty($get_permohonan_konfirmasi)):
                            echo '<tr><td class="fit text-left">Pesan </td><td class="fit text-center">:</td><td class="text-left">' . $get_permohonan_konfirmasi->pesan_konfirmasi . '</td></tr>';
                            if ($get_permohonan_konfirmasi->send_mail == "T") {
                                echo '<tr><td class="fit text-left">Pesan Email</td><td class="fit text-center">:</td><td class="text-left">' . $get_permohonan_konfirmasi->pesan_konfirmasi . '</td></tr>';
                            }
                        endif;
                        if ($get_permohonan_detail->keputusan_permohonan == "") {
                            echo '<tr><td class="fit">&nbsp;</td><td class="fit">&nbsp;</td><td>';
                            echo '<a href="' . site_url('adminpermohonan/permohonan_keputusan/' . $get_permohonan_detail->id_permohonan) . '" class="btn btn-sm btn-warning">Beri Keputusan</a>';
                            echo '</td></tr>';
                        } else {
                            echo '<tr><td class="fit text-left">Tanggal Keputusan</td><td class="fit text-center">:</td><td class="text-left">' . ($get_permohonan_detail->tgl_keputusan != "" ? date_indo($get_permohonan_detail->tgl_keputusan) : "") . ', Oleh : ' . $get_permohonan_detail->user_keputusan . '</td></tr>';
                            if (!empty($get_permohonan_keputusan)):
                                echo '<tr><td class="fit text-left">Hasil Keputusan</td><td class="fit text-center">:</td><td class="text-left">' . $get_permohonan_keputusan->jenis_keputusan . '</td></tr>';
                                echo '<tr><td class="fit text-left">Pesan</td><td class="fit text-center">:</td><td class="text-left">' . $get_permohonan_keputusan->pesan_keputusan . $get_permohonan_keputusan->alasan_penolakan . '</td></tr>';
                                if ($get_permohonan_keputusan->send_mail == 'T') {
                                    echo '<tr><td class="fit text-left">Pesan Email</td><td class="fit text-center">:</td><td class="text-left">' . $get_permohonan_keputusan->pesan_keputusan . $get_permohonan_keputusan->alasan_penolakan . '</td></tr>';
                                }
                            endif;
                        }
                    }
                    echo '</tbody></table>';
                } else {
                    echo 'Data tidak ditemukan.';
                }
                ?>
                <a href="<?php echo site_url('adminpermohonan/daftarpermohonan'); ?>" class="btn btn-primary">Batal / Kembali</a>
            </div>
        </div>
    </div>
</div>