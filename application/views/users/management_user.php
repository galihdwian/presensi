<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>List Data User</h2>
                <div class="nav navbar-right panel_toolbox">
                    <div class="dropdown">
                        <a href="<?= site_url('user_tambah'); ?>" class="btn btn-primary">
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
                            <th>Username</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($list_user as $r) :
                            $status = $r->aktivasi != 1 ? "Nonaktif" : "Aktif";
                            echo '<tr>';
                            echo '<td class="fit">' . $no . '</td>';
                            echo '<td>' . $r->usernm . '</td>';
                            echo '<td>' . $status  . '</td>';
                            echo '<td class="fit">';
                        ?>
                            <?php
                            if ($r->aktivasi != 1) { ?>
                                <button class="btn btn-sm btn-success" onclick="Aktifkan('<?php echo $r->id_admin; ?>')">Aktifkan</button>
                            <?php } else { ?>
                                <button class="btn btn-sm btn-danger" onclick="Nonaktifkan('<?php echo $r->id_admin; ?>')">Nonaktifkan</button>
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
    function Aktifkan(id_admin) {
        let yes = 'Y';
        window.location.href = "<?php echo site_url('aktivasi_user'); ?>/" + id_admin + "/" + yes;
    }

    function Nonaktifkan(id_admin) {
        let no = 'N';
        window.location.href = "<?php echo site_url('aktivasi_user'); ?>/" + id_admin + "/" + no;
    }
</script>