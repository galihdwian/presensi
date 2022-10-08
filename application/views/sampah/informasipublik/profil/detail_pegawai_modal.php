<div class="modal-body">
    <div class="detail-pegawai">
        <?php
        //print_r($detail_pejabat);
        foreach ($detail_pejabat as $row_det) :
        ?>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-nobordered">
                        <tr>
                            <td class="fit">Nama</td>
                            <td class="fit">:</td>
                            <td><?php echo $row_det['nama_pegawai']; ?></td>
                        </tr>
                        <tr>
                            <td class="fit">NIP</td>
                            <td class="fit">:</td>
                            <td><?php echo $row_det['id_pegawai']; ?></td>
                        </tr>
                        <tr>
                            <td class="fit">Tempat/Tgl Lahir</td>
                            <td class="fit">:</td>
                            <td>
                                <?php
                                if (!empty($row_det['tg_lhr'])) {
                                    echo $row_det['tempat_lhr'] . '/' . tgl_indo($row_det['tg_lhr']);
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fit">Jenis Kelamin</td>
                            <td class="fit">:</td>
                            <td><?php echo detail_jk($row_det['jk']); ?></td>
                        </tr>
                        <tr>
                            <td class="fit">Agama</td>
                            <td class="fit">:</td>
                            <td><?php echo detail_agama($row_det['agama']); ?></td>
                        </tr>
                        <tr>
                            <td class="fit">Alamat</td>
                            <td class="fit">:</td>
                            <td><?php echo $row_det['alamat']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>
</div>