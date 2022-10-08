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
                <h2>List Dokumen Pengadaan</h2> 
                <div class="pull-right">
                    <a href="<?= site_url('adminppid/pengadaan/tambah_dokumen_pengadaan/' . $detail_pengadaan->id_paket); ?>" class="btn btn-default">Tambah Data</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">                
                <?php
                include_once 'pengadaan_display_detail.php';
                if (!empty($list_dokumen)) {
                    echo '<table class="table table-bordered table-centeredhead">';
                    echo '<thead>';
                    echo '<tr class="bg-primary">';
                    echo '<th class="fit text-center">NO.</th>';
                    echo '<th class="text-center">JENIS DOKUMEN</th>';
                    echo '<th class="text-center">FILE</th>';
                    echo '<th class="text-center">AKSI</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    $no = 0;
                    foreach ($list_dokumen as $row):
                        echo '<tr>';
                        echo '<td class="text-center fit">' . ++$no . '</td>';
                        echo '<td>' . $row->namadokumen . '</td>';
                        echo '<td>' . ($row->link_lpse == 1 ? 'Link Ke LPSE' : $row->display_name) . '</td>';
                        echo '<td class="text-center fit">';
                        if ($row->link_lpse == 1) {
                            echo '<a href="http://lpse.jatengprov.go.id/eproc4/' . $row->lpseprefix . '/' . $detail_pengadaan->idtender . '/' . $row->lpsesufix . '" class="btn btn-sm btn-warning" target="blank">Lihat Dokumen</a>';
                        } else {
                            if (empty($row->direct_link)) {
                                echo '<a href="https://rsmargono.jatengprov.go.id/ppid/informasipublik/file/' . $row->slug . '" class="btn btn-sm btn-warning" target="blank">Lihat Dokumen</a>';
                            } else {
                                echo '<a href="' . $row->direct_link . '" class="btn btn-sm btn-warning" target="blank">Lihat Dokumen</a>';
                            }
                        }
                        echo '<a href="' . site_url('adminppid/pengadaan/delete_dokumen_pengadaan/' . rawurlencode($detail_pengadaan->id_paket) . '/' . rawurlencode($row->iddokumen) . '/' . rawurlencode($row->idlistdokumen)) . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Apakah yakin ingin menghapus dokumen pengadaan?\');">Hapus Dokumen</a>';
                        echo '</td>';
                        echo '</tr>';
                    endforeach;
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<div class="alert alert-warning"><p>Dokumen pengadaan belum tersedia.</p></div>';
                }
                ?>
                <div class="ln_solid"></div>
                <div class="pull-right">
                    <a href="<?= site_url('adminppid/pengadaan'); ?>" class="btn btn-warning btn-sm" >Batal</a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>