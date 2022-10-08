<?php

if (!empty($list_dokumen_rs)) {
    echo '<h2>List Dokumen Pengadaan RS Tahun ' . $tahun_pengadaan . '</h2>';
    echo '<table class="table table-bordered table-centeredhead">';
    echo '<thead>';
    echo '<tr class="bg-primary">';
    echo '<th class="fit text-center">NO.</th>';
    echo '<th class="text-center">JENIS DOKUMEN</th>';
    echo '<th class="text-center">NAMA FILE DOKUMEN</th>';
    echo '<th class="text-center">AKSI</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    $no = 0;
    foreach ($list_dokumen_rs as $row_dokrs):
        echo '<tr>';
        echo '<td class="text-center fit">' . ++$no . '</td>';
        echo '<td>' . $row_dokrs->namadokumen . '</td>';
        echo '<td>' . $row_dokrs->display_name . '</td>';
        echo '<td class="text-center fit">';
        echo '<a href="' . site_url('adminppid/pengadaan/dokumen_rs_set/' . rawurlencode($row_dokrs->tahunpengadaan) . '/' . rawurlencode($row_dokrs->iddokumen)) . '" class="btn btn-sm btn-warning btn-block">Edit Dokumen</a>';
        echo '<a href="https://rsmargono.jatengprov.go.id/ppid/informasipublik/file/' . $row_dokrs->slug . '" class="btn btn-sm btn-info btn-block" target="_blank">Lihat Dokumen</a>';
        echo '</td>';
        echo '</tr>';
    endforeach;
    echo '</tbody>';
    echo '</table>';
} else {
    echo '<div class="alert alert-warning">Dokumen pengadaan RS Tahun ' . $tahun_pengadaan . ' belum di set.</div>';
}
if (!empty($list_pengadaan)) {
    echo '<h2>List Paket Pengadaan Tahun ' . $tahun_pengadaan . '</h2>';
    echo '<table class="table table-bordered table-centeredhead">';
    echo '<thead>';
    echo '<tr class="bg-primary">';
    echo '<th class="fit text-center">NO.</th>';
    echo '<th class="text-center">NAMA PAKET</th>';
    echo '<th class="text-center">SUMBER ANGGARAN</th>';
    echo '<th class="fit text-center">PAGU</th>';
    echo '<th class="fit text-center">NILAI KONTRAK</th>';
    echo '<th class="fit text-center">ID TENDER LPSE</th>';
    echo '<th class="text-center">AKSI</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    $no = 0;
    foreach ($list_pengadaan as $row):
        echo '<tr>';
        echo '<td class="text-center fit">' . ++$no . '</td>';
        echo '<td>' . $row->nama_paket . '</td>';
        echo '<td>' . $row->sumber_anggaran . '</td>';
        echo '<td>' . $row->pagu_anggaran . '</td>';
        echo '<td>' . $row->nilai_kontrak . '</td>';
        echo '<td class="text-center">' . $row->idtender . '</td>';
        echo '<td class="text-center fit">';
        echo '<a href="' . site_url('adminppid/pengadaan/list_dokumen_pengadaan/' . rawurlencode($row->id_paket)) . '" class="btn btn-sm btn-info btn-block">Dokumen Paket Pengadaan</a>';
        echo '<a href="' . site_url('adminppid/pengadaan/edit_data_pengadaan/' . rawurlencode($row->id_paket)) . '" class="btn btn-sm btn-warning btn-block">Edit Data</a>';
        echo '<a href="' . site_url('adminppid/pengadaan/delete_data_pengadaan/' . rawurlencode($row->id_paket)) . '" class="btn btn-sm btn-danger btn-block" onclick="return confirm(\'Apakah yakin ingin menghapus data pengadaan?\');">Hapus Data</a>';
        echo '</td>';
        echo '</tr>';
    endforeach;
    echo '</tbody>';
    echo '</table>';
} else {
    echo '<div class="alert alert-warning">List pengadaan belum tersedia.</div>';
}
?>