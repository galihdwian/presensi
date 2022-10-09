<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>List Data absen</h2>
                <div class="nav navbar-right panel_toolbox">
                    <div class="dropdown">

                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="mytable" class="table table-bordered table-centeredhead">
                    <thead>
                        <tr class="info">
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Status Pertemuan</th>
                            <th>Waktu Absen</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($list_detail_absen as $r) :
                            echo '<tr>';
                            echo '<td class="fit">' . $no . '</td>';
                            echo '<td>' . $r->nama_mhs . '</td>';
                            echo '<td>' . $r->stts_pertermuan  . '</td>';
                            echo '<td>' . $r->waktu_absen  . '</td>';
                            echo '<td>' . $r->latitude  . '</td>';
                            echo '<td>' . $r->longitude  . '</td>';
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