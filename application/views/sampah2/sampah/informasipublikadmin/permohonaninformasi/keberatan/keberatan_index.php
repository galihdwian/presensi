<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_content"> 
                <?php
                if (!empty($get_keberatan_list)) {
                    ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pemohon</th>
                                <th>Informasi yg diminta</th>
                                <th>Tgl Keberatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($get_keberatan_list as $r_keberatan):
                                if ($r_keberatan['verifikasi'] == "") {
                                    echo '<tr class="warning">';
                                } else {
                                    echo '<tr>';
                                }
                                echo '<td class="fit text-center">' . ++$no . '</td>';
                                echo '<td class="fit">' . $r_keberatan['full_name'] . '</td>';
                                echo '<td>' . $r_keberatan['informasi_diminta'] . '</td>';
                                echo '<td class="fit text-center">' . ($r_keberatan['tanggal'] != "" ? date_indo($r_keberatan['tanggal']) : "") . '</td>';
                                echo '<td class="fit text-center"><a href="' . site_url('adminpermohonan/keberatan_detail/' . $r_keberatan['id_keberatan']) . '" class="btn btn-primary btn-xs">Detail</a></td>';
                                echo '</tr>';
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                    <?php
                } else {
                    echo 'Belum Ada Permohonan';
                }
                ?>
            </div>
        </div>
    </div>
</div>