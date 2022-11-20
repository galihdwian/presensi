<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>List Data Periode</h2>
                <div class="nav navbar-right panel_toolbox">
                    <div class="dropdown">
                        <a href="<?= site_url('periode_tambah'); ?>" class="btn btn-primary">
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
                            <th>Tahun Periode</th>
                            <th>Semester</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($list_periode as $r) :
                            $status = $r->status != 1 ? "Nonaktif" : "Aktif";
                            echo '<tr>';
                            echo '<td class="fit">' . $no . '</td>';
                            echo '<td>' . $r->tahun_periode . '</td>';
                            echo '<td>' . $r->semester . '</td>';
                            echo '<td>' . $status  . '</td>';
                            echo '<td class="fit">';
                        ?>
                            <button class="btn btn-sm btn-warning" onclick="Edit('<?php echo $r->id_periode; ?>')">Edit</button>
                            <?php
                            if ($r->status != 1) { ?>
                                <button class="btn btn-sm btn-success" onclick="Aktifkan('<?php echo $r->id_periode; ?>')">Aktifkan</button>
                            <?php } else { ?>
                                <button class="btn btn-sm btn-danger" onclick="Nonaktifkan('<?php echo $r->id_periode; ?>')">Nonaktifkan</button>
                            <?php } ?>
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
    function Aktifkan(id_periode) {
        var retVal = confirm('Yakin Diaktifkan?');
        if (retVal == true) {
            let yes = 1;
            window.location.href = "<?php echo site_url('aktivasi_periode'); ?>/" + id_periode + "/" + yes;
        } else {
            return false;
        }
    }

    function Nonaktifkan(id_periode) {
        var retVal = confirm('Yakin Dinonaktifkan?');
        if (retVal == true) {
            let no = 0;
            window.location.href = "<?php echo site_url('aktivasi_periode'); ?>/" + id_periode + "/" + no;
        } else {
            return false;
        }
    }

    function Edit(id_periode) {
        window.location.href = "<?php echo site_url('periode_edit'); ?>/" + id_periode;
    }
</script>