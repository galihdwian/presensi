<section id="portfolio">
    <div id="dip-page">
        <div class="center">
            <h1>Daftar Informasi Publik (DIP) PPID Pelaksana RSUD Prof. Dr. Margono Soekarjo Tahun <?php echo $th_dip; ?></h1>
        </div>
        <div class="portfolio-filter">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <br>
                    <?php
                    $klas = "";
                    $sno = "A";
                    $no = 0;
                    $klasifikasi_heading = "";
                    $kh = 'A';
                    foreach ($dip as $r_dip) :
                        //HEADING TABEL
                        if ($klas != $r_dip['nama_ppid']) {
                            if ($no != 0) {
                                echo '</tbody></table>';
                            }
                            $klas = $r_dip['nama_ppid'];
                            if ($klas == 'Berkala' || $klas == 'Tersedia Setiap Saat' || $klas == 'Serta Merta') {
                                if ($klas == 'Berkala') {
                                    echo '<p class="lead" id="' . $r_dip['urlaliasklasifikasi'] . '">' . $sno . '. Informasi Yang Diumumkan Secara ' . $r_dip['nama_ppid'] . '</p>';
                                } else {
                                    echo '<p class="lead" id="' . $r_dip['urlaliasklasifikasi'] . '">' . $sno . '. Informasi Yang ' . $r_dip['nama_ppid'] . '</p>';
                                }
                                echo '<div class="clearfix"></div>';
                                echo '<table class="table table-bordered table-condensed table-centeredhead tabledip">
                                    <thead>
                                    <tr class="info">
                                    <th>No</th>
                                    <th>Judul<br>Informasi</th>
                                    <th>Ringkasan<br>Isi Informasi</th>
                                    <th>Penanggung Jawab Pembuatan Informasi / Unit yang Menguasai Informasi</th>
                                    <th>Waktu<br>Pembuatan / Penerbitan<br>Informasi</th>
                                    <th>Bentuk Informasi<br>Yang Tersedia</th>
                                    <th>Jangka Waktu Penyimpanan</th>
                                    <th>Jenis Media<br>Yang Memuat<br>Informasi</th>
                                    </tr>
                                    </thead>
                                    <tbody>';
                                echo '<tr class="info"><th>(1)</th><th>(2)</th><th>(3)</th><th>(4)</th><th>(5)</th><th>(6)</th><th>(7)</th><th>(8)</th></tr>';
                            } elseif ($klas == 'Dikecualikan') {
                                echo '<div class="clearfix"></div>';
                                echo '<p class="lead" id="' . $r_dip['urlaliasklasifikasi'] . '">' . $sno . '. Daftar Informasi ' . $r_dip['nama_ppid'] . '</p>';
                                echo '<table class="table table-bordered table-condensed table-centeredhead tabledip">
                                    <thead>
                                    <tr class="info">
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Jenis Informasi</th>
                                    <th rowspan="2">Dasar Hukum</th>
                                    <th colspan="2">Konsekuensi</th>
                                    <th rowspan="2">Batas Waktu Pengecualian</th>
                                    </tr>
                                    <tr class="info">
                                    <th>Akibat Info Dibuka</th>
                                    <th>Akibat Info Ditutup</th>
                                    </tr>
                                    </thead>
                                    <tbody>';
                                echo '<tr class="info"><th>(1)</th><th>(2)</th><th>(3)</th><th>(4)</th><th>(5)</th><th>(6)</th></tr>';
                            }
                            $no = 1;
                            $sno++;
                        }

                        if ($klas == 'Berkala' || $klas == 'Tersedia Setiap Saat' || $klas == 'Serta Merta') {
                            //HEADING DIP
                            if ($r_dip['heading_dip'] == 'T') {
                                echo '<tr id="' . $r_dip['id_sub'] . '">';
                                echo '<td class="centertext"><b>' . $no . '.</b></td>';
                                echo '<td colspan="9"><b>' . $r_dip['judul_informasi'] . '</b></td>';
                                echo '</tr>';
                                if (count($r_dip['dip_child']) == 0) {
                                    $no++;
                                }
                            } else {
                                //PARENT
                                echo '<tr id="' . $r_dip['id_sub'] . '">';
                                echo '<td class="centerhtext"><b>' . $no . '.</b></td>';
                                echo '<td><b>' . $r_dip['judul_informasi'] . '</b></td>';
                                echo '<td><b>' . $r_dip['isi_informasi'] . '</b></td>';
                                echo '<td><b>' . $r_dip['penanggung_jawab'] . '</b></td>';
                                echo '<td><b>' . $r_dip['waktu_pembuatan'] . '</b></td>';
                                echo '<td><b>' . $r_dip['bentuk_informasi'] . '</b></td>';
                                echo '<td><b>' . $r_dip['jangka_waktu'] . '</b></td>';
                                echo '<td>';
                                if ($th_dip < 2017) {
                                    if ($r_dip['tipe_view'] == 'DL') {
                                        echo preg_replace("#http://([\S]+?)#Uis", '<a href="http://\\1" target="blank">\\1</a><br><br>', $r_dip['media']);
                                    } elseif ($r_dip['tipe_view'] == 'FD') {
                                        $url_view = str_replace("index.php", "", "http://$_SERVER[HTTP_HOST]$_SERVER[SCRIPT_NAME]");
                                        echo 'Website : <a href="' . site_url('informasipublikdetail/' . $r_dip['id_sub']) . '">' . $url_view . 'informasipublikdetail/' . $r_dip['id_sub'] . '</a><br><br>' . preg_replace("#http://([\S]+?)#Uis", '<a href="http://\\1" target="blank">\\1</a><br><br>', $r_dip['media']);
                                    }
                                } else {
                                    if ($r_dip['tipe_view'] == 'DL') {
                                        echo auto_link($r_dip['media'], 'both', false);
                                    } elseif ($r_dip['tipe_view'] == 'FD') {
                                        $url_view = str_replace("index.php", "", "http://$_SERVER[HTTP_HOST]$_SERVER[SCRIPT_NAME]");
                                        echo 'Website : <a href="' . site_url('dip/' . $r_dip['id_sub']) . '">' . $url_view . 'dip/' . $r_dip['id_sub'] . '</a><br><br>' . auto_link($r_dip['media'], 'both', false);
                                    } else {
                                        echo $r_dip['media'];
                                    }
                                }
                                echo '</td>';
                                echo '</tr>';
                                $no++;
                            }
                            //CHILD
                            if (count($r_dip['dip_child']) != 0) {
                                $sno_child = 1;
                                foreach ($r_dip['dip_child'] as $r_d_child) :
                                    echo '<tr id="' . $r_dip['id_sub'] . '">';
                                    echo '<td class="centerhtext">' . $no . '.' . $sno_child . '</td>';
                                    echo '<td>' . $r_d_child['judul_informasi'] . '</td>';
                                    echo '<td>' . $r_d_child['isi_informasi'] . '</td>';
                                    echo '<td>' . $r_d_child['penanggung_jawab'] . '</td>';
                                    echo '<td>' . $r_d_child['waktu_pembuatan'] . '</td>';
                                    echo '<td>' . $r_d_child['bentuk_informasi'] . '</td>';
                                    echo '<td>' . $r_d_child['jangka_waktu'] . '</td>';
                                    if ($th_dip < 2017) {
                                        if ($r_d_child['tipe_view'] == 'DL') {
                                            echo '<td>' . preg_replace("#http://([\S]+?)#Uis", '<a href="http://\\1" target="blank">\\1</a><br>', $r_d_child['media']) . '</td>';
                                        } elseif ($r_d_child['tipe_view'] == 'FD') {
                                            $url_view = str_replace("index.php", "", "http://$_SERVER[HTTP_HOST]$_SERVER[SCRIPT_NAME]");
                                            echo '<td>Website : <a href="' . site_url('informasipublikdetail/' . $r_d_child['id_sub']) . '">' . $url_view . 'informasipublikdetail/' . $r_d_child['id_sub'] . '</a><br><br>' . preg_replace("#http://([\S]+?)#Uis", '<a href="http://\\1" target="blank">\\1</a><br><br>', $r_d_child['media']) . '</td>';
                                        }
                                    } else {
                                        if ($r_d_child['tipe_view'] == 'DL') {
                                            echo '<td>' . auto_link($r_d_child['media'], 'both', false) . '</td>';
                                        } elseif ($r_d_child['tipe_view'] == 'FD') {
                                            $url_view = str_replace("index.php", "", "http://$_SERVER[HTTP_HOST]$_SERVER[SCRIPT_NAME]");
                                            echo '<td>Website : <a href="' . site_url('dip/' . $r_d_child['id_sub']) . '">' . $url_view . 'dip/' . $r_d_child['id_sub'] . '</a><br><br>' . auto_link($r_d_child['media'], 'both', false) . '</td>';
                                        }
                                    }
                                    echo '</tr>';
                                    $sno_child++;

                                endforeach;
                                unset($r_d_child);
                                $no++;
                            }
                        }
                        if ($klas == 'Dikecualikan') {
                            echo '<tr id="' . $r_dip['id_sub'] . '">';
                            echo '<td class="centerhtext"><b>' . $no . '.</b></td>';
                            echo '<td>' . $r_dip['isi_informasi'] . '</td>';
                            echo '<td>' . $r_dip['dasar_hukum'] . '</td>';
                            echo '<td>' . $r_dip['akibat_dibuka'] . '</td>';
                            echo '<td>' . $r_dip['akibat_ditutup'] . '</td>';
                            echo '<td>' . $r_dip['batas_waktu'] . '</td>';
                            echo '</tr>';
                            $no++;
                        }
                    endforeach;
                    unset($r_dip);
                    echo '</tbody></table>';
                    ?>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="myModal">
        <div class="modal-dialog modal-xlg">
            <div class="modal-content">
                <div id="modaldetailcontent"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function showmodal(file) {
            var href = "<?php echo site_url('dipviewfile'); ?>/" + file;
            $('#myModal').find('#modaldetailcontent').load(href);
            $('#myModal').modal('show');

        }
    </script>
</section>