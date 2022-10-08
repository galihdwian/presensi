<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">

                <h2>List Detail Mata Kuliah : <b><?= $detail_matkul->nm_matkul ?></b>
                    </br>
                    Dosen : <b><?= $detail_matkul->nama_dsn ?></b>
                    </br>
                    SKS : <b><?= $detail_matkul->sks ?></b>
                </h2>


                <div class="nav navbar-right panel_toolbox">
                    <div class="dropdown">
                        <a href="<?= site_url('matkul_detail_tambah/' . $detail_matkul->id_matkul); ?>" class="btn btn-primary">
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
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($list_detail_matkul as $r) :
                            echo '<tr>';
                            echo '<td class="fit">' . $no . '</td>';
                            echo '<td>' . $r->nim . '</td>';
                            echo '<td>' . $r->nama_mhs . '</td>';
                            echo '<td class="fit">';
                        ?>
                            <button class="btn btn-sm btn-danger" onclick="Hapus('<?php echo $r->id_matkul; ?>','<?php echo $r->id_mhs; ?>')">Hapus</button>
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
    function Hapus(id_matkul, id_mahasiswa) {
        var retVal = confirm('Yakin Dihapus?');
        if (retVal == true) {
            let yes = 1;
            window.location.href = "<?php echo site_url('matkul_hapus_detail'); ?>/" + id_matkul + "/" + id_mahasiswa;
        } else {
            return false;
        }
    }
</script>