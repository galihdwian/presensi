<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Rekap Pertemuan Mahasiswa</h2>
                <div class="nav navbar-right panel_toolbox">
                    <div class="dropdown">
                        <a href="<?= site_url(''); ?>" class="btn btn-primary">
                            Cetak
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
                            <th>Mata Kuliah</th>
                            <th>Jurusan Pertemuan Ke</th>
                            <th>Jumlah Kehadiran</th>
                            <th>Nama Dosen</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

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
    function Detail(id_matkul) {
        window.location.href = "<?php echo site_url('presensi_detail_pertemuan'); ?>/" + id_matkul;
    }
</script>