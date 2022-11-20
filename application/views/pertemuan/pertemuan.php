<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>List Data Pertemuan</h2>
                <div class="nav navbar-right panel_toolbox">
                    <div class="dropdown">
                        <a href="<?= site_url('pertemuan_tambah'); ?>" class="btn btn-primary">
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
                            <th>Periode</th>
                            <th>Nama Matkul</th>
                            <th>Nama Dosen Pengampu</th>
                            <th>Pertemuan Ke</th>
                            <th>Waktu mulai</th>
                            <th>Waktu Selesai</th>
                            <th>Ruangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($list_pertemuan as $r) :
                            echo '<tr>';
                            echo '<td class="fit">' . $no . '</td>';
                            echo '<td>' . $r->tahun_periode . ' - ' . $r->semester . '</td>';
                            echo '<td>' . $r->nm_matkul . '</td>';
                            echo '<td>' . $r->nama_dsn . '</td>';
                            echo '<td>' . $r->pertemuanke  . '</td>';
                            echo '<td>' . $r->waktu_mulai  . '</td>';
                            echo '<td>' . $r->waktu_selesai  . '</td>';
                            echo '<td>' . $r->nm_ruangan  . '</td>';
                            echo '<td class="fit">';
                        ?>
                            <button class="btn btn-sm btn-warning" onclick="Edit('<?php echo $r->id_pertemuan; ?>')">Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="Hapus('<?php echo $r->id_pertemuan; ?>')">Hapus</button>

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
    function Hapus(id_pertemuan) {
        var retVal = confirm('Yakin Dihapus?');
        if (retVal == true) {
            window.location.href = "<?php echo site_url('pertemuan_hapus'); ?>/" + id_pertemuan;
        } else {
            return false;
        }
    }

    function Edit(id_pertemuan) {
        window.location.href = "<?php echo site_url('pertemuan_edit'); ?>/" + id_pertemuan;
    }
</script>