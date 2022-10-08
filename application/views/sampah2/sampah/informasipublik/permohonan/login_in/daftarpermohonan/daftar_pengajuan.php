<div class="center">
    <h2>List Pengajuan Permohonan</h2>
    <hr>
</div>
<?php
if (!empty($error)) {
    echo $error;
}
echo $this->session->flashdata('msg');
echo validation_errors('<div class="alert alert-danger"><p>', '</p></div>');
//print_r($get_permohonan_ol);
?>
<div class="pull-right">
    <a href="<?php echo site_url('pengajuan_permohonan'); ?>" class="btn btn-default btn-outline btn-sm"><i class="fa fa-plus-circle"></i> Tambah Permohonan</a>
</div>
<div class="clearfix"></div>
<br>
<table class="table table-bordered table-condensed">
    <thead>
        <tr>
            <th class="fit">No</th>
            <th>Informasi yang dimohon</th>
            <th>Tanggal Permohonan</th>
            <th>Status</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($get_permohonan_ol as $r_permohonan):
            $status = 'Dalam Proses Pengkajian';
            if (!empty($r_permohonan['tgl_dikonfirmasi'])) {
                if (!empty($r_permohonan['keputusan_permohonan'])) {
                    if ($r_permohonan['keputusan_permohonan'] == 'T') {
                        $status = 'Permohonan Diterima';
                    } elseif ($r_permohonan['keputusan_permohonan'] == 'F') {
                        $status = 'Permohonan Ditolak';
                    }
                }
            }
            echo '<tr>';
            echo '<td>' . $no . '</td>';
            echo '<td>' . $r_permohonan['informasi_diminta'] . '</td>';
            echo '<td>' . date_indo($r_permohonan['tgl_permohonan']) . '</td>';
            echo '<td>' . $status . '</td>';
            echo '<td class="fit"><a href="javascript:void(0)" onclick="showmodal(this.id)" id="' . $r_permohonan['id_permohonan'] . '" class="btn btn-danger btn-outline btn-xs"><i class="fa fa-eye"></i> Detail</a></td>';
            echo '</tr>';
            $no++;
        endforeach;
        unset($r_permohonan);
        ?>
    </tbody>
</table>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div id="modaldetailcontent"></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#myModal").on("hidden.bs.modal", function() {
            $('#myModal').find('#modaldetailcontent').html("");
        });
    });
    function showmodal(id) {
        //alert(id);
        var href = "<?php echo site_url('detailpermohonan'); ?>/" + id;
        $('#myModal').find('#modaldetailcontent').load(href);
        $('#myModal').modal('show');
    }
</script>