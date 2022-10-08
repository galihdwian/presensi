<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>List Data Jurusan</h2>
                <div class="nav navbar-right panel_toolbox">
                    <div class="dropdown">
                        <a href="<?= site_url('jurusan_tambah'); ?>" class="btn btn-primary">
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
                            <th>Kode Jurusan</th>
                            <th>Nama Jurusan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($list_jurusan as $r) :
                            echo '<tr>';
                            echo '<td class="fit">' . $no . '</td>';
                            echo '<td>' . $r->kode_jurusan . '</td>';
                            echo '<td>' . $r->nama_jurusan . '</td>';
                            echo '<td class="fit">';
                        ?>
                            <button class="btn btn-sm btn-warning" onclick="Edit('<?php echo $r->id_jurusan; ?>')">Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="Hapus('<?php echo $r->id_jurusan; ?>')">Hapus</button>
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
    function Edit(id_jurusan) {
        window.location.href = "<?php echo site_url('jurusan_edit'); ?>/" + id_jurusan;
    }

    function Hapus(id_jurusan) {
        var retVal = confirm('Yakin Dihapus?');
        if (retVal == true) {
            window.location.href = "<?php echo site_url('jurusan_hapus'); ?>/" + id_jurusan;
        } else {
            return false;
        }
    }
</script>