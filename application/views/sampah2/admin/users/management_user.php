<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>List Data User</h2>
                <div class="nav navbar-right panel_toolbox">
                    <div class="dropdown">
                        <a href="<?= site_url('admin/management_user/tambah'); ?>" class="btn btn-primary">
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
                            <th>Nama Lengkap</th>
                            <th>Status</th>
                            <th>Login Terakhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($list_user as $r) :
                            echo '<tr>';
                            echo '<td class="fit">' . $no . '</td>';
                            echo '<td>' . $r->username . '</td>';
                            echo '<td>' . $r->nama_lengkap . '</td>';
                            echo '<td>' . $r->aktivasi . '</td>';
                            echo '<td>' . $r->last_login . '</td>';
                            echo '<td class="fit">';
                        ?>
                            <?php
                            if ($r->aktivasi != 'Y') { ?>
                                <button class="btn btn-sm btn-success" onclick="Aktifkan('<?php echo $r->id_user; ?>')">Aktifkan</button>
                            <?php } else { ?>
                                <button class="btn btn-sm btn-danger" onclick="Nonaktifkan('<?php echo $r->id_user; ?>')">Nonaktifkan</button>
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
    function Aktifkan(id_user) {
        let yes = 'Y';
        window.location.href = "<?php echo site_url('admin/status_aktivasi_user'); ?>/" + id_user + "/" + yes;
    }

    function Nonaktifkan(id_user) {
        let no = 'N';
        window.location.href = "<?php echo site_url('admin/status_aktivasi_user'); ?>/" + id_user + "/" + no;
    }
</script>