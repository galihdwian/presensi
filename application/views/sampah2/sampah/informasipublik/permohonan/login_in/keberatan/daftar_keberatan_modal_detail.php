<div class="modal-header">
    <h4 class="modal-title">Detail Pengajuan Keberatan</h4>
</div>
<div class="modal-body">
    <table class="table-borderedbottom table-condensed">
        <tbody>
            <?php
            //print_r($get_detail);
            foreach ($get_detail as $r):
                ?>
            <table class="table table-nobordered table-condensed">
                <tbody>
                    <tr>
                        <td class="fit"><b>A.</b></td>
                        <td colspan="4"><b>INFORMASI PENGAJU KEBERATAN</b></td>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="3" class="fit"><b>Nomor Registrasi Keberatan</b></td>
                        <td>: <?php echo $r['id_keberatan']; ?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="3" class="fit"><b>Nomor Permohonan Informasi</b></td>
                        <td>: <?php echo $r['id_permohonan']; ?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="3" class="fit"><b>Informasi Yang Diminta</b></td>
                        <td>: <?php echo $r['informasi_diminta']; ?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="3" class="fit"><b>Tujuan Penggunaan Informasi</b></td>
                        <td>: <?php echo $r['tujuan_permohoan']; ?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="4"><b>Identitas Pemohon</b></td>                        
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td colspan="2" class="fit">Nama</td>
                        <td>: <?php echo $r['full_name']; ?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td colspan="2" class="fit">Alamat</td>
                        <td>: <?php echo $r['alamat']; ?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td colspan="2" class="fit">Pekerjaan</td>
                        <td>: <?php echo str_replace("0 : ", "", $r['pekerjaan']); ?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td colspan="2" class="fit">No. Telp / Email</td>
                        <td>: <?php echo $r['telp']; ?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="4"><b>Identitas Kuasa Pemohon</b></td>                        
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td colspan="2" class="fit">Nama</td>
                        <td>: <?php echo $r['kuasa_nama']; ?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td colspan="2" class="fit">Alamat</td>
                        <td>: <?php echo $r['kuasa_alamat']; ?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td colspan="2" class="fit">No. Telp / Email</td>
                        <td>: <?php echo $r['kuasa_telp']; ?></td>
                    </tr>
                    <tr>
                        <td class="fit"><b>B.</b></td>
                        <td colspan="4"><b>ALASAN PENGAJUAN KEBERATAN</b></td>
                    <tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td class="fit"><?php echo '<div class="pull-right"><img src="' . base_url($r['ditolak'] == 'T' ? 'assets/images/pemohon/box-check.png' : 'assets/images/pemohon/box-uncheck.png') . '" class="img-responsive"></div>'; ?></td>
                        <td colspan="3">a. Permohonan informasi ditolak</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td class="fit"><?php echo '<div class="pull-right"><img src="' . base_url($r['tdk_disediakan'] == 'T' ? 'assets/images/pemohon/box-check.png' : 'assets/images/pemohon/box-uncheck.png') . '" class="img-responsive"></div>'; ?></td>
                        <td colspan="3">b. Informasi berkala tidak disediakan</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td class="fit"><?php echo '<div class="pull-right"><img src="' . base_url($r['tdk_ditanggapi'] == 'T' ? 'assets/images/pemohon/box-check.png' : 'assets/images/pemohon/box-uncheck.png') . '" class="img-responsive"></div>'; ?></td>
                        <td colspan="3">c. Permintaan informasi tidak ditanggapi</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td class="fit"><?php echo '<div class="pull-right"><img src="' . base_url($r['tdk_sesuaipermintaan'] == 'T' ? 'assets/images/pemohon/box-check.png' : 'assets/images/pemohon/box-uncheck.png') . '" class="img-responsive"></div>'; ?></td>
                        <td colspan="3">d. Permintaan informasi ditanggapi tidak sebagaimana diminta</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td class="fit"><?php echo '<div class="pull-right"><img src="' . base_url($r['tdk_dipenuhi'] == 'T' ? 'assets/images/pemohon/box-check.png' : 'assets/images/pemohon/box-uncheck.png') . '" class="img-responsive"></div>'; ?></td>
                        <td colspan="3">e. Permintaan informasi tidak dipenuhi</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td class="fit"><?php echo '<div class="pull-right"><img src="' . base_url($r['tdk_wajar'] == 'T' ? 'assets/images/pemohon/box-check.png' : 'assets/images/pemohon/box-uncheck.png') . '" class="img-responsive"></div>'; ?></td>
                        <td colspan="3">f. Biaya yang dikenakan tidak wajar</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td class="fit"><?php echo '<div class="pull-right"><img src="' . base_url($r['overtime'] == 'T' ? 'assets/images/pemohon/box-check.png' : 'assets/images/pemohon/box-uncheck.png') . '" class="img-responsive"></div>'; ?></td>
                        <td colspan="3">g. Informasi disampaikan melebihi jangka waktu yang ditentukan</td>
                    </tr>
                    <tr>
                        <td class="fit"><b>C.</b></td>
                        <td colspan="4"><b>KASUS POSISI</b></td>
                    <tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="4"><?php echo $r['kasus']; ?></td>
                    <tr>
                    <tr>
                        <td class="fit"><b>D.</b></td>
                        <td colspan="4"><b>HARI / TANGGAL TANGGAPAN ATAS KEBERATAN AKAN DIBERIKAN : </b><?php echo $r['verifikasi'] == 'T' ? get_date_from_time($r['tanggal_tanggapan']) : 'Belum diverifikasi'; ?></td>
                    <tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td><div class="text-center"><br>....................., <?php echo get_date_from_time($r['tanggal']) . '<br><br><br><br><br>' . $r['full_name']; ?></div></td>
                    </tr>
                </tbody>
            </table>
            <?php
        endforeach;
        ?>    
        </tbody>
    </table>
</div>