<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>List Visi</h2>
                <div class="nav navbar-right panel_toolbox">
                    <div class="dropdown">
                        <a href="<?= site_url('admin/visidanmisi/tambah_visi'); ?>" class="btn btn-primary">
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
                            <th>Nama Visi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($list_visi as $r) :
                            echo '<tr>';
                            echo '<td class="fit">' . $no . '</td>';
                            echo '<td>' . $r->nama_visi . '</td>';
                            echo '<td class="fit">';
                        ?>
                            <button class="btn btn-sm btn-warning" onclick="Edit('<?php echo $r->id_visi; ?>')">EDIT</button>
                            <button class="btn btn-sm btn-danger" onclick="Delete('<?php echo $r->id_visi; ?>')">Hapus</button>
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
    function Delete(id_visi) {
        window.location.href = "<?php echo site_url('admin/visidanmisi/delete_visi'); ?>/" + id_visi;
    }

    function Edit(id_visi) {
        window.location.href = "<?php echo site_url('admin/visidanmisi/edit_visi'); ?>/" + id_visi;
    }
</script>