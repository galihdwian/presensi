<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>List Kegiatan</h2>
                <div class="nav navbar-right panel_toolbox">
                    <div class="dropdown">
                        <a href="<?= site_url('admin/kegiatan/tambah_kegiatan'); ?>" class="btn btn-primary">
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
                            <th>Judul</th>
                            <th>Isi Kegiatan</th>
                            <th>foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($list_kegiatan as $r) :
                            $gambar = base_url($r->foto);
                            echo '<tr>';
                            echo '<td class="fit">' . $no . '</td>';
                            echo '<td>' . $r->judul . '</td>';
                            echo '<td>' . strip_tags($r->isi) . '</td>';
                            echo '<td><img src="' . $gambar . '" alt="Foto kegiatan" width="160px" height="100px"</td>';
                            echo '<td class="fit">';
                        ?>
                            <button class="btn btn-sm btn-warning" onclick="Edit('<?php echo $r->id; ?>')">Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="Delete('<?php echo $r->id; ?>')">Hapus</button>
                            <button class="btn btn-sm btn-success" onclick="Tambahan('<?php echo $r->id; ?>')">Tambahan</button>
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
        window.location.href = "<?php echo site_url('admin/kegiatan/delete_kegiatan'); ?>/" + id;
    }

    function Edit(id) {
        window.location.href = "<?php echo site_url('admin/kegiatan/edit_kegiatan'); ?>/" + id;
    }

    function Tambahan(id) {
        window.location.href = "<?php echo site_url('admin/kegiatan/tambahan'); ?>/" + id;
    }
</script>