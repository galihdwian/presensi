<?php

echo '<h2 class="text-center">' . $title . '</h2>';
$klas = "";
$sno = "A";
$no = 0;
$klasifikasi_heading = "";
$kh = 'A';
foreach ($dip as $r_dip):
    //HEADING TABEL
    if ($klas != $r_dip['nama_ppid']) {
        if ($no != 0) {
            echo '</tbody></table>';
        }
        $klas = $r_dip['nama_ppid'];
        if ($klas == 'Berkala' || $klas == 'Tersedia Setiap Saat' || $klas == 'Serta Merta') {
            if ($klas == 'Berkala') {
                echo '<p class="lead">' . $sno . '. Informasi Yang Diumumkan Secara ' . $r_dip['nama_ppid'] . '</p>';
            } else {
                echo '<p class="lead">' . $sno . '. Informasi Yang ' . $r_dip['nama_ppid'] . '</p>';
            }
            echo '<div class="clearfix"></div>';
            echo '<table class="table table-bordered table-centeredhead tabledip">
                <thead>
                <tr class="info">
                <th>No</th>
                <th>Judul<br>Informasi</th>
                <th>Ringkasan<br>Isi Informasi</th>
                <th>Aksi</th>
                </tr>
                </thead>
                <tbody>';
            echo '<tr class="info"><th>(1)</th><th>(2)</th><th>(3)</th><th>(4)</th></tr>';
        } elseif ($klas == 'Dikecualikan') {
            echo '<div class="clearfix"></div>';
            echo '<p class="lead">' . $sno . '. Daftar Informasi ' . $r_dip['nama_ppid'] . '</p>';
            echo '<table class="table table-bordered table-centeredhead tabledip">
                <thead>
                <tr class="info">
                <th rowspan="2">No</th>
                <th rowspan="2">Jenis Informasi</th>
                <th rowspan="2">Dasar Hukum</th>
                <th colspan="2">Konsekuensi</th>
                <th rowspan="2">Batas Waktu Pengecualian</th>
                <th rowspan="2">Aksi</th>
                </tr>
                <tr class="info">
                <th>Akibat Info Dibuka</th>
                <th>Akibat Info Ditutup</th>
                </tr>
                </thead>
                <tbody>';
            echo '<tr class="info"><th>(1)</th><th>(2)</th><th>(3)</th><th>(4)</th><th>(5)</th><th>(6)</th><th>(7)</th></tr>';
        }
        $no = 1;
        $sno++;
    }

    if ($klas == 'Berkala' || $klas == 'Tersedia Setiap Saat' || $klas == 'Serta Merta') {
        //HEADING DIP
        if ($r_dip['heading_dip'] == 'T') {
            echo '<tr>';
            echo '<td class="centertext"><b>' . $no . '.</b></td>';
            echo '<td colspan="2"><b>' . $r_dip['judul_informasi'] . '</b></td>';
            echo '<td>';
            echo '<a href="' . site_url('adminppid/dipmanajemenaddchild/' . $r_dip['id_sub']) . '" class="btn btn-sm col-xs-12 btn-primary">Tambah Sub</a>';
            echo '<a href="' . site_url('adminppid/dipmanajemenedit/' . $r_dip['id_sub']) . '" class="btn btn-sm col-xs-12 btn-info">Edit</a>';
            echo '<a href="' . site_url('adminppid/dipmanajemendelete/' . $r_dip['id_sub']) . '" onClick="return confirm(\'Anda yakin..???\');" class="btn btn-sm col-xs-12 btn-warning">Hapus</a>';
            echo '</td>';
            echo '</tr>';
            if (count($r_dip['dip_child']) == 0) {
                $no++;
            }
        } else {
            //PARENT
            echo '<tr>';
            echo '<td class="centerhtext"><b>' . $no . '.</b></td>';
            echo '<td><b>' . $r_dip['judul_informasi'] . '</b></td>';
            echo '<td><b>' . $r_dip['isi_informasi'] . '</b></td>';            
            echo '<td>';
            echo '<a href="' . site_url('adminppid/dipmanajemenaddchild/' . $r_dip['id_sub']) . '" class="btn btn-sm col-xs-12 btn-primary">Tambah Sub</a>';
            echo '<a href="' . site_url('adminppid/dipmanajemenedit/' . $r_dip['id_sub']) . '" class="btn btn-sm col-xs-12 btn-info">Edit</a>';
            echo '<a href="' . site_url('adminppid/dipmanajemendelete/' . $r_dip['id_sub']) . '" onClick="return confirm(\'Anda yakin..???\');" class="btn btn-sm col-xs-12 btn-warning">Hapus</a>';
            echo '<a href="' . site_url('adminppid/dipmanajemenfiles/' . $r_dip['id_sub']) . '" class="btn btn-sm col-xs-12 btn-default">File</a>';
            echo '</td>';
            echo '</tr>';
            $no++;
        }
        //CHILD
        if (count($r_dip['dip_child']) != 0) {
            $sno_child = 1;
            foreach ($r_dip['dip_child'] as $r_d_child):
                echo '<tr>';
                echo '<td class="centerhtext">' . $no . '.' . $sno_child . '</td>';
                echo '<td>' . $r_d_child['judul_informasi'] . '</td>';
                echo '<td>' . $r_d_child['isi_informasi'] . '</td>';                
                echo '<td>';
                echo '<a href="' . site_url('adminppid/dipmanajemenedit/' . $r_d_child['id_sub']) . '" class="btn btn-sm col-xs-12 btn-info">Edit</a>';
                echo '<a href="' . site_url('adminppid/dipmanajemendelete/' . $r_d_child['id_sub']) . '" onClick="return confirm(\'Anda yakin..???\');" class="btn btn-sm col-xs-12 btn-warning">Hapus</a>';
                echo '<a href="' . site_url('adminppid/dipmanajemenfiles/' . $r_d_child['id_sub']) . '" class="btn btn-sm col-xs-12 btn-default">File</a>';
                echo '</td>';
                echo '</tr>';
                $sno_child++;

            endforeach;
            unset($r_d_child);
            $no++;
        }
    }
    if ($klas == 'Dikecualikan') {
        echo '<tr>';
        echo '<td class="centerhtext"><b>' . $no . '.</b></td>';
        echo '<td>' . $r_dip['isi_informasi'] . '</td>';
        echo '<td>' . $r_dip['dasar_hukum'] . '</td>';
        echo '<td>' . $r_dip['akibat_dibuka'] . '</td>';
        echo '<td>' . $r_dip['akibat_ditutup'] . '</td>';
        echo '<td>' . $r_dip['batas_waktu'] . '</td>';
        echo '<td>';
        echo '<a href="' . site_url('adminppid/dipmanajemenaddchild/' . $r_dip['id_sub']) . '" class="btn btn-sm col-xs-12 btn-primary">Tambah Sub</a>';
        echo '<a href="' . site_url('adminppid/dipmanajemenedit/' . $r_dip['id_sub']) . '" class="btn btn-sm col-xs-12 btn-info">Edit</a>';
        echo '<a href="' . site_url('adminppid/dipmanajemendelete/' . $r_dip['id_sub']) . '" onClick="return confirm(\'Anda yakin..???\');" class="btn btn-sm col-xs-12 btn-warning">Hapus</a>';
        echo '</td>';
        echo '</tr>';
        $no++;
    }
endforeach;
unset($r_dip);
echo '</tbody></table>';
?>