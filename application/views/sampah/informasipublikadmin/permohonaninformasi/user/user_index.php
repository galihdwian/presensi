<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_content"> 
                <?php
                if (!empty($get_user_list)) {
                    ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nomor Identitas</th>
                                <th>Tipe User</th>
                                <th>JK</th>
                                <th>Tempat Lahir</th>
                                <th>Tgl Lahir</th>
                                <th>Aktivasi</th>
                                <th>Waktu Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($get_user_list as $r_user):
                                echo '<tr>';
                                echo '<td class="fit text-center">' . ++$no . '</td>';
                                echo '<td>' . $r_user['full_name'] . '</td>';
                                echo '<td>' . $r_user['nomor_identitas'] . '</td>';
                                echo '<td>' . $r_user['tipe_pemohon'] . '</td>';
                                echo '<td class="fit text-center">' . $r_user['jk']. '</td>';
                                echo '<td>' . $r_user['tempat_lahir'] . '</td>';
                                echo '<td class="fit text-center">' . tgl_indo($r_user['tgl_lahir']) . '</td>';
                                echo '<td class="fit">'.($r_user['active'] == 'T'?'SUDAH':'BELUM').'</td>';
                                echo '<td>' . $r_user['tgl_register'] . '</td>';
                                echo '<td class="fit text-center"><a href="'.  site_url('adminpermohonan/user_detail/'.$r_user['id_pemohon']).'" class="btn btn-primary btn-xs">Detail</a></td>';
                                echo '</tr>';
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                    <?php
                } else {
                    echo 'Belum Ada Pemohon';
                }
                ?>
            </div>
        </div>
    </div>
</div>