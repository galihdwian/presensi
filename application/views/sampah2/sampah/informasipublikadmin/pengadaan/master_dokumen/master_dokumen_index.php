<?php
if (!empty($error)) {
    echo $error;
}
echo $this->session->flashdata('message_status');
?>
<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_title"> 
                <h2>List Master Dokumen</h2>
                <ul class="nav navbar-right panel_toolbox">                    
                    <li><a href="<?= site_url('adminppid/pengadaan/master_dokumen_tambah_data'); ?>" class="btn btn-sm btn-success">Tambah</a></li>
                    <li><a class="collapse-link btn btn-sm btn-default"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php
                if (!empty($list_master_dokumen)) {
                    echo '<table class="table table-bordered table-centeredhead">';
                    echo '<thead>';
                    echo '<tr class="bg-primary">';
                    echo '<th class="fit text-center">NO.</th>';
                    echo '<th class="text-center">ID DOKUMEN</th>';
                    echo '<th class="text-center">NAMA DOKUMEN</th>';
                    echo '<th class="fit text-center">URUTAN DOKUMEN TAMPIL</th>';
                    echo '<th class="fit text-center">LPSE PREFIX</th>';
                    echo '<th class="fit text-center">LPSE SUFIX</th>';
                    echo '<th class="fit text-center">TIPE DOKUMEN</th>';
                    echo '<th class="text-center">AKSI</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    $no = 0;
                    foreach ($list_master_dokumen as $row):
                        echo '<tr>';
                        echo '<td class="text-center fit">' . ++$no . '</td>';
                        echo '<td class="fit">' . $row->iddokumen . '</td>';
                        echo '<td>' . $row->namadokumen . '</td>';
                        echo '<td class="text-center">' . $row->urutan . '</td>';
                        echo '<td class="fit">' . $row->lpseprefix . '</td>';
                        echo '<td class="fit">' . $row->lpsesufix . '</td>';
                        echo '<td class="fit">' . ($row->tipedokumen == '01' ? 'Dokumen Paket Pengadaan' : 'Dokumen Pengadaan RS') . '</td>';
                        echo '<td class="text-center fit">';
                        echo '<a href="' . site_url('adminppid/pengadaan/master_dokumen_edit_data/' . rawurlencode($row->iddokumen)) . '" class="btn btn-sm btn-warning">Edit</a>';
                        echo '</td>';
                        echo '</tr>';
                    endforeach;
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<div class="alert alert-warning">Master dokumen pengadaan belum tersedia.</div>';
                }
                ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
