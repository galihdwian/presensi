<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_content"> 
                <?php
                echo $this->session->flashdata('message');
                if (!empty($get_topik)) {
                    echo '<table class="table"><tbody>';
                    echo '<tr><td class="fit text-left">Topik</td><td class="fit text-center">:</td><td class="text-left">' . $get_topik->topik . '</td></tr>';
                    echo '<tr><td class="fit text-left">User Topik</td><td class="fit text-center">:</td><td class="text-left">' . $get_topik->user_topi . '</td></tr>';
                    if (!empty($get_respons)):
                        echo '<tr><td class="fit text-left">Jumlah Respon</td><td class="fit text-center">:</td><td class="text-left">' . count($get_respons) . '</td></tr>';
                    endif;
                    echo '</tbody></table>';
                    if (!empty($get_respons)):
                        ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Partisipan</th>
                                    <th class="text-center">Masukan</th>
                                    <th class="text-center">Waktu</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                foreach ($get_respons as $r_res):
                                    if ($r_res->tampil == 'T') {
                                        echo '<tr>';
                                    } else {
                                        echo '<tr class="warning">';
                                    }
                                    echo '<td class="fit text-center">' . ++$no . '</td>';
                                    echo '<td class="fit">' . $r_res->nama . '</td>';
                                    echo '<td>' . $r_res->respon . '</td>';
                                    echo '<td class="text-center">' . ($r_res->waktu_respon != "" ? date_indo($r_res->waktu_respon) : "") . '</td>';
                                    if ($r_res->tampil == 'T') {
                                        echo '<td class="fit text-center"><a href="' . site_url('adminpartisipasipublik/topik_respon_aksi/' . $r_res->id_respontopik . '/sembunyikan/' . $get_topik->id_topik) . '" class="btn btn-danger btn-xs">Sembunyikan</a></td>';
                                    } else {
                                        echo '<td class="fit text-center"><a href="' . site_url('adminpartisipasipublik/topik_respon_aksi/' . $r_res->id_respontopik . '/tampilkan/' . $get_topik->id_topik) . '" class="btn btn-success btn-xs">Tampilkan</a></td>';
                                    }
                                    echo '</tr>';
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                        <?php
                    endif;
                } else {
                    echo 'Data tidak ditemukan.';
                }
                ?>
                <div class="clearfix"></div>
                <a href="<?php echo site_url('adminpartisipasipublik/topik'); ?>" class="btn btn-primary">Batal / Kembali</a>
            </div>
        </div>
    </div>
</div>