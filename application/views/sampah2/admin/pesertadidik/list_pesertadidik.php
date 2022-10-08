<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>List Peserta Didik</h2>
                <div class="nav navbar-right panel_toolbox">
                    <div class="dropdown">
                        <a href="<?= site_url('admin/pesertadidik/tambah_pesertadidik'); ?>" class="btn btn-primary">
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
                            <th class="text-center fit">No</th>
                            <th>Keterangan</th>
                            <th>Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($list_pesertadidik as $r) :
                            $dokumen = base_url($r->dokumen);
                            echo '<tr>';
                            echo '<td class="fit">' . $no . '</td>';
                            echo '<td>' . $r->keterangan . '</td>';
                            echo '<td><a href="' . $dokumen . '" target="blank">Dokumen</a></td>';
                            echo '<td class="fit">';
                        ?>
                            <button class="btn btn-sm btn-danger" onclick="Delete('<?php echo $r->id; ?>')">Hapus</button>
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
    function Delete(id) {
        window.location.href = "<?php echo site_url('admin/pesertadidik/delete_pesertadidik'); ?>/" + id;
    }
</script>