<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_content"> 
                <div class="pull-right"><button class="btn btn-sm btn-default" onClick="showmodalAdd()">Tambah Data</button></div>
                <div class="clearfix"></div>
                <?php
                if (!empty($get_all_topik)) {
                    ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Topik</th>
                                <th>Tgl Topik</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($get_all_topik as $r_topik):
                                echo '<tr>';
                                echo '<td class="fit text-center">' . ++$no . '</td>';
                                echo '<td class="fit">' . $r_topik->topik . '</td>';
                                echo '<td class="fit text-center">' . ($r_topik->date_topik != "" ? date_indo($r_topik->date_topik) : "") . '</td>';
                                echo '<td class="fit text-center"><a href="' . site_url('adminpartisipasipublik/topik_detail/' . $r_topik->id_topik) . '" class="btn btn-primary btn-xs">Detail</a></td>';
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