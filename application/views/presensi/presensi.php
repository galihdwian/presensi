<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>List Presensi</h2>
                <div class="nav navbar-right panel_toolbox">
                    <div class="dropdown">
                        <a href="<?= site_url('matkul_tambah'); ?>" class="btn btn-primary">
                            Tambah
                        </a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="mytable" class="table table-bordered table-centeredhead">
                    <thead>
                        <tr class="info">
                            <th>No</th>
                            <th>Nama Matkul</th>
                            <th>Dosen Pengampu</th>
                            <th>SKS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($list_presensi as $r) :
                            echo '<tr>';
                            echo '<td class="fit">' . $no . '</td>';
                            echo '<td>' . $r->nm_matkul . '</td>';
                            echo '<td>' . $r->nama_dsn . '</td>';
                            echo '<td>' . $r->sks . '</td>';
                            echo '<td class="fit">';
                        ?>
                            <button class="btn btn-sm btn-success" onclick="Detail('<?php echo $r->id_matkul; ?>')">Detail</button>
                        <?php
                            echo '</td>';
                            echo '</tr>';
                            $no++;
                        endforeach;
                        unset($r);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#mytable').DataTable();
    });
</script>
<script type="text/javascript">
    function Detail(id_matkul) {
        window.location.href = "<?php echo site_url('presensi_detail_pertemuan'); ?>/" + id_matkul;
    }
</script>