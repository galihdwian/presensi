<div class="modal-header">
    <h4 class="modal-title">Detail Permohonan</h4>
</div>
<div class="modal-body">
    <table class="table-borderedbottom table-condensed">
        <tbody>
            <?php
            //print_r($get_detail_permohonan);
            foreach ($get_detail_permohonan as $r_detail):
                echo '<tr><td class="fit">Nomor registrasi permohonan</td><td class="fit">:</td><td>' . $r_detail['id_permohonan'] . '</td></tr>';
                echo '<tr><td class="fit">Informasi yang dimohon</td><td class="fit">:</td><td>' . $r_detail['informasi_diminta'] . '</td></tr>';
                echo '<tr><td class="fit">Kandungan isi informasi</td><td class="fit">:</td><td>' . $r_detail['kandungan_isi'] . '</td></tr>';
                echo '<tr><td class="fit">Tujuan permohonan infromasi</td><td class="fit">:</td><td>' . $r_detail['tujuan_permohoan'] . '</td></tr>';
                echo '<tr><td class="fit">Bentuk informasi yang diminta</td><td class="fit">:</td><td>' . $r_detail['tujuan_permohoan'] = 'S' ? 'Mendapatkan Salinan Informasi Softcopy (Melihat/Mengunduh/email).' : 'Mendapatkan Salinan Informasi Hardcopy.' . '</td></tr>';
                echo '<tr><td class="fit">Tanggal Permohonan</td><td class="fit">:</td><td>' . date_indo($r_detail['tgl_permohonan']) . '</td></tr>';
                $status = 'Dalam Proses Pengkajian';
                if (!empty($r_detail['tgl_dikonfirmasi'])) {
                    if (!empty($r_detail['keputusan_permohonan'])) {
                        if ($r_detail['keputusan_permohonan'] == 'diterima') {
                            $status = 'Permohonan Diterima';
                        } elseif ($r_detail['keputusan_permohonan'] == 'ditolak') {
                            $status = 'Permohonan Ditolak';
                        }
                    }
                }
                echo '<tr><td class="fit">Status permohonan</td><td class="fit">:</td><td>' . $status . '</td></tr>';
                if (!empty($r_detail['tgl_dikonfirmasi'])) {
                    echo '<tr><td class="fit">Tanggal permohonan diterima</td><td class="fit">:</td><td>' . date_indo($r_detail['tgl_dikonfirmasi']) . '</td></tr>';
                    echo '<tr><td class="fit">Pesan konfirmasi</td><td class="fit">:</td><td>' . $r_detail['pesan_konfirmasi'] . '</td></tr>';
                    if (!empty($r_detail['keputusan_permohonan'])) {
                        if ($r_detail['keputusan_permohonan'] == 'diterima') {
                            echo '<tr><td class="fit">Tanggal penetapan keputusan permohonan</td><td class="fit">:</td><td>' . date_indo($r_detail['tgl_keputusan']) . '</td></tr>';
                            echo '<tr><td class="fit">Hasil keputusan</td><td class="fit">:</td><td>' . $r_detail['pesan_keputusan'] . '</td></tr>';
                        } elseif ($r_detail['keputusan_permohonan'] == 'ditolak') {
                            echo '<tr><td class="fit">Alasan penolakan</td><td class="fit">:</td><td>' . $r_detail['alasan_penolakan'] . '</td></tr>';
                            echo '<tr><td class="fit">Tanggal penetapan keputusan permohonan</td><td class="fit">:</td><td>' . date_indo($r_detail['tgl_keputusan']) . '</td></tr>';
                        }
                    }
                }
            endforeach;
            unset($r_detail);
            ?>    
        </tbody>
    </table>
</div>