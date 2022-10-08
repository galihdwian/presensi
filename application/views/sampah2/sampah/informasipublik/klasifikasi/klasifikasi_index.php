<section id="blog" class="container">
    <div class="row">
        <div class="col-sm-8">
            <?php
//                print_r($showklasifikasi);
            if (!empty($showklasifikasi)):
                foreach ($showklasifikasi as $r_klasifikasi):
                    $url_alias = $r_klasifikasi['url_alias'];
                    ?>
                    <div class="center">
                        <h2>Informasi Publik <?php echo $r_klasifikasi['nama_ppid']; ?></h2>
                        <p class="lead justify"><?php echo $r_klasifikasi['penjelasan']; ?></p>
                    </div>
                    <div class="blog-item row"> 
                        <div class="col-xs-12 blog-content">
                            <h2>Daftar Informasi Publik <?php echo $r_klasifikasi['nama_ppid']; ?></h2>
                            <hr>
                            <?php
                            if ($namaklasifikasi != "dikecualikan") {
                                ?>
                                <ul class="list-unstyled list-fa">
                                    <?php
                                    //print_r($results);
                                    foreach ($results as $r_res):
                                        if ($r_res['heading_dip'] != 'T') {
                                            if ($r_res['tipe_view'] == 'DL') {
                                                $url = getUrls($r_res['media']);
                                                if (count($url) > 1) {
                                                    echo '<p>' . $r_res['judul_informasi'] . '</p>';
                                                    for ($i = 0; $i < count($url); $i++) {
                                                        echo '<p><a href="' . $url[$i] . '" target="blank"><i class="fa fa-link"></i> Link 1 : ' . $url[$i] . '</a></p>';
                                                    }
                                                } elseif (count($url) == 1) {
                                                    echo '<p><strong><a href="' . $url[0] . '" target="blank">' . $r_res['judul_informasi'] . '</a></strong></p>';
                                                } elseif (count($url) == 0) {
                                                    echo '<p><strong>' . $r_res['judul_informasi'] . '</strong></p>';
                                                }
                                            } elseif ($r_res['tipe_view'] == 'FD') {
                                                echo '<p><strong><a href="' . site_url('dip/' . $r_res['id_sub']) . '">' . $r_res['judul_informasi'] . '</a></strong></p>';
                                            } elseif ($r_res['tipe_view'] == 'PX') {
                                                echo $r_res['isi_informasi'];
                                                echo $r_res['media'];
                                            }
                                        } else {
                                            echo '<p><strong>' . $r_res['judul_informasi'] . '</strong></p>';
                                        }
                                        foreach ($r_res['sub_file'] as $r_file) {
                                            if ($r_file['tipe'] == 'File') {
                                                echo '<li><a href="' . site_url('file_informasipublik/' . $r_file['id_file']) . '"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <span>' . $r_file['display_name'] . '</span></a></li>';
                                            } elseif ($r_file['tipe'] == 'image') {
                                                echo '<li><a class="preview" href="' . base_url('assets/file/sertamerta/' . $r_file['nama_file']) . '" rel="prettyPhoto"><i class="fa fa-image"></i> <span>' . $r_file['display_name'] . '</span></a></li>';
                                            }
                                        }
                                        foreach ($r_res['dip_child'] as $r_child) {
                                            if ($r_child['tipe_view'] == 'DL') {
                                                $url = getUrls($r_child['media']);
                                                if (count($url) > 1) {
                                                    echo '<i class="fa fa-angle-double-right"></i> ' . $r_child['judul_informasi'];
                                                    for ($i = 0; $i < count($url); $i++) {
                                                        echo '<li><a href="' . $url[$i] . '" target="blank"><i class="fa fa-link"></i> <span>Link 1 : ' . $url[$i] . '</span></a></li>';
                                                    }
                                                } elseif (count($url) == 1) {
                                                    echo '<li><a href="' . $url[0] . '" target="blank"><i class="fa fa-angle-double-right"></i> <span>' . $r_child['judul_informasi'] . '</span></a></li>';
                                                }
                                                //echo '<li><a href="' . $r_child['media'] . '" target="blank"><i class="fa fa-angle-right"></i> ' . $r_child['judul_informasi'] . '</a></li>';
                                            } elseif ($r_child['tipe_view'] == 'FD') {
                                                echo '<li><a href="' . site_url('dip/' . $r_child['id_sub']) . '"><i class="fa fa-angle-double-right"></i> <span>' . $r_child['judul_informasi'] . '</span></a></li>';
                                            }
                                        }
                                        echo '<hr>';
                                    endforeach;
                                    unset($r_res);
                                    ?>
                                </ul>
                                <div class="portfolio-pagination" id="ajax_paging">
                                    <?php echo $links; ?>
                                </div>
                                <?php
                            } else {
                                /*
                                  echo '<table class="table table-bordered table-condensed table-centeredhead tabledip">
                                  <thead>
                                  <tr class="info">
                                  <th rowspan="2">No</th>
                                  <th rowspan="2">Ringkasan<br>Isi Informasi</th>
                                  <th rowspan="2">Dasar Hukum</th>
                                  <th rowspan="2">Batas Waktu<br>Pengecualian</th>
                                  <th colspan="2">Konsekuensi</th>
                                  </tr>
                                  <tr class="info">
                                  <th>Akibat bila Info<br>dibuka</th>
                                  <th>Akibat bila Info<br>ditutup</th>
                                  </tr>
                                  </thead>
                                  <tbody>';
                                  echo '<tr class="info"><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th></tr>';
                                 * 
                                 */
                                /*
                                  echo '<table class="table table-bordered table-condensed table-centeredhead tabledip">
                                  <thead>
                                  <tr class="info">
                                  <th>No</th>
                                  <th>Judul<br>Informasi</th>
                                  <th>Ringkasan<br>Isi Informasi</th>
                                  <th>Penanggungjawab Pembuatan Informasi</th>
                                  <th>Waktu<br>Pembuatan / Penerbitan<br>Informasi</th>
                                  <th>Bentuk Informasi<br>Yang Tersedia</th>
                                  <th>Jangka Waktu Penyimpanan</th>
                                  </tr>
                                  </thead>
                                  <tbody>';
                                  echo '<tr class="info"><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th></tr>';
                                 * 
                                 */
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
                                $no = 1;
                                $klasifikasi_heading = "";
                                $kh = 'A';
                                //print_r($results);
                                foreach ($results as $r_dip) {
                                    /*
                                      if (!empty($r_dip['klasifikasi_heading'])) {
                                      if ($klasifikasi_heading != $r_dip['klasifikasi_heading']) {
                                      $klasifikasi_heading = $r_dip['klasifikasi_heading'];
                                      echo '<tr>';
                                      echo '<td colspan="8"><b style="text-transform: uppercase;">' . $kh . '. ' . $klasifikasi_heading . '</b></td>';
                                      echo '</tr>';
                                      $kh++;
                                      $no = 1;
                                      }
                                      }
                                      if ($r_dip['heading_dip'] == 'T') {
                                      echo '<tr>';
                                      echo '<td class="centertext"><b>' . $no . '.</b></td>';
                                      echo '<td colspan="8"><b>' . $r_dip['isi_informasi'] . '</b></td>';
                                      echo '</tr>';
                                      if (count($r_dip['dip_child']) == 0) {
                                      $no++;
                                      }
                                      } else {
                                      echo '<tr>';
                                      echo '<td>' . $no . '.</td>';
                                      echo '<td>' . $r_dip['isi_informasi'] . '</td>';
                                      echo '<td>' . $r_dip['dasar_hukum'] . '</td>';
                                      echo '<td>' . $r_dip['batas_waktu'] . '</td>';
                                      echo '<td>' . $r_dip['akibat_dibuka'] . '</td>';
                                      echo '<td>' . $r_dip['akibat_ditutup'] . '</td>';
                                      echo '</tr>';
                                      $no++;
                                      }
                                      if (count($r_dip['dip_child']) != 0) {
                                      $sno_child = 'a';
                                      foreach ($r_dip['dip_child'] as $r_d_child):
                                      echo '<tr>';
                                      echo '<td>' . $no . '.' . $sno_child . '</td>';
                                      echo '<td>' . $r_d_child['isi_informasi'] . '</td>';
                                      echo '<td>' . $r_d_child['dasar_hukum'] . '</td>';
                                      echo '<td>' . $r_d_child['batas_waktu'] . '</td>';
                                      echo '<td>' . $r_d_child['akibat_dibuka'] . '</td>';
                                      echo '<td>' . $r_d_child['akibat_ditutup'] . '</td>';
                                      echo '</tr>';
                                      $sno_child++;

                                      endforeach;
                                      unset($r_d_child);
                                      $no++;
                                      }
                                     */
                                    /*
                                      if ($r_dip['heading_dip'] == 'T') {
                                      echo '<tr>';
                                      echo '<td class="centertext"><b>' . $no . '.</b></td>';
                                      echo '<td colspan="9"><b>' . $r_dip['judul_informasi'] . '</b></td>';
                                      echo '</tr>';
                                      if (count($r_dip['dip_child']) == 0) {
                                      $no++;
                                      }
                                      } else {
                                      echo '<tr>';
                                      echo '<td class="centerhtext"><b>' . $no . '.</b></td>';
                                      echo '<td><b>' . $r_dip['judul_informasi'] . '</b></td>';
                                      echo '<td>' . $r_dip['isi_informasi'] . '</td>';
                                      echo '<td>' . $r_dip['penanggung_jawab'] . '</td>';
                                      echo '<td>' . $r_dip['waktu_pembuatan'] . '</td>';
                                      echo '<td>' . $r_dip['bentuk_informasi'] . '</td>';
                                      echo '<td>' . $r_dip['jangka_waktu'] . '</td>';
                                      echo '</tr>';
                                      $no++;
                                      }
                                      if (count($r_dip['dip_child']) != 0) {
                                      $sno_child = 'a';
                                      foreach ($r_dip['dip_child'] as $r_d_child):
                                      echo '<tr>';
                                      echo '<td class="centerhtext"><b>' . $no . '.' . $sno_child . '</b></td>';
                                      echo '<td><b>' . $r_d_child['judul_informasi'] . '</b></td>';
                                      echo '<td>' . $r_d_child['isi_informasi'] . '</td>';
                                      echo '<td>' . $r_d_child['penanggung_jawab'] . '</td>';
                                      echo '<td>' . $r_d_child['waktu_pembuatan'] . '</td>';
                                      echo '<td>' . $r_d_child['bentuk_informasi'] . '</td>';
                                      echo '<td>' . $r_d_child['jangka_waktu'] . '</td>';
                                      echo '</tr>';
                                      $sno_child++;

                                      endforeach;
                                      unset($r_d_child);
                                      $no++;
                                      }
                                     */
                                    echo '<tr>';
                                    echo '<td class="centerhtext"><b>' . $no . '.</b></td>';
                                    echo '<td>' . $r_dip['isi_informasi'] . '</td>';
                                    echo '<td>' . $r_dip['dasar_hukum'] . '</td>';
                                    echo '<td>' . $r_dip['akibat_dibuka'] . '</td>';
                                    echo '<td>' . $r_dip['akibat_ditutup'] . '</td>';
                                    echo '<td>' . $r_dip['batas_waktu'] . '</td>';
                                    echo '</tr>';
                                    $no++;
                                }
                                echo '</tbody></table>';
                            }
                            ?>
                        </div>
                    </div>                                           
                    <?php
                endforeach;
                unset($r_klasifikasi);
            endif;
            ?>
        </div>

        <div class="col-sm-4">            
            <?php
            echo '<div class="widget categories">';
            $this->load->view('informasipublik/v_jenis_informasi');
            echo '</div>';
            $this->load->view('informasipublik/sidebar_galeri');
            ?>        
        </div>  
    </div>        
</section>