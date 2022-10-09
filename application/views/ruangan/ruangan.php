<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>List Data Ruangan</h2>
                <div class="nav navbar-right panel_toolbox">
                    <div class="dropdown">
                        <a href="<?= site_url('ruangan_tambah'); ?>" class="btn btn-primary">
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
                            <th>Nama Ruangan</th>
                            <th>Longitude</th>
                            <th>Latitude</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($list_ruangan as $r) :
                            echo '<tr>';
                            echo '<td class="fit">' . $no . '</td>';
                            echo '<td>' . $r->nm_ruangan . '</td>';
                            echo '<td>' . $r->longitude . '</td>';
                            echo '<td>' . $r->latitude  . '</td>';
                            echo '<td class="fit">';
                        ?>
                            <button class="btn btn-sm btn-warning" onclick="Edit('<?php echo $r->id_ruangan; ?>')">Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="Hapus('<?php echo $r->id_ruangan; ?>')">Hapus</button>

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
    function Hapus(id_ruangan) {
        var retVal = confirm('Yakin Dihapus?');
        if (retVal == true) {
            window.location.href = "<?php echo site_url('ruangan_hapus'); ?>/" + id_ruangan;
        } else {
            return false;
        }
    }

    function Edit(id_ruangan) {
        window.location.href = "<?php echo site_url('ruangan_edit'); ?>/" + id_ruangan;
    }
</script>