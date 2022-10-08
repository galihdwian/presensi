<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_content"> 
                <?php
                if (!empty($get_permohonan_list)) {
                    ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pemohon</th>
                                <th>Informasi yg diminta</th>
                                <th>Tgl Permohonan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($get_permohonan_list as $r_permohonan):
                                if ($r_permohonan['tgl_dikonfirmasi'] == "") {
                                    echo '<tr class="warning">';
                                } elseif ($r_permohonan['keputusan_permohonan'] == "") {
                                    echo '<tr class="success">';
                                } else {
                                    echo '<tr>';
                                }
                                echo '<td class="fit text-center">' . ++$no . '</td>';
                                echo '<td class="fit">' . $r_permohonan['full_name'] . '</td>';
                                echo '<td>' . $r_permohonan['informasi_diminta'] . '</td>';
                                echo '<td class="fit text-center">' . ($r_permohonan['tgl_permohonan'] != "" ? date_indo($r_permohonan['tgl_permohonan']) : "") . '</td>';
                                echo '<td class="fit text-center"><a href="' . site_url('adminpermohonan/permohonan_detail/' . $r_permohonan['id_permohonan']) . '" class="btn btn-primary btn-xs">Detail</a></td>';
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