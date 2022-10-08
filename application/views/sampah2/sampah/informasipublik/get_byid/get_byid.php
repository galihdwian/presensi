<section id="blog" class="container">
    <div class="blog">  
        <div class="row">
            <div class="col-xs-12 col-sm-8">
                <?php
                if (!empty($get_sub_byid)) {
                    foreach ($get_sub_byid as $r_klasifikasi) {
                        $url_alias = strtolower($r_klasifikasi['nama_ppid']);
                        ?>
                        <div class="center">
                            <h2>Informasi Publik <?php echo $r_klasifikasi['nama_ppid']; ?></h2>
                        </div>
                        <div class="blog-item"> 
                            <div class="col-xs-12 col-sm-12 col-md-12 blog-content">
                                <h2>Daftar Informasi Publik <?php echo $r_klasifikasi['nama_ppid']; ?></h2>
                                <hr>
                                <div class="widget search">
                                    <form class="form-inline" method="POST" action="<?php echo site_url('pencarianinformasipublik'); ?>">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Cari Dokumen" name="keyword" id="keyword">
                                                <div class="input-group-btn">
                                                    <button type="submit" class="btn btn-default btn-outline"><i class="glyphicon glyphicon-search"></i> Cari</button>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-info btn-outline" type="button" value="Back" onclick="history.go(-1);"><i class="fa fa-arrow-left"></i> Kembali</button>
                                        </div>
                                    </form>
                                </div>
                                <center id="loading2">
                                    <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
                                    <p>Loading...</p>                            
                                </center>
                                <div id="ajaxdata" class="text-justify">
                                    <?php
                                    echo '<p class="lead" style="margin: 0;">' . $r_klasifikasi['judul_informasi'] . '</p>';
                                    //echo '<p class="small">Dipublikasian ' . date_indo($r_klasifikasi['date_upload']) . '</p>';
									$isi_informasi = $r_klasifikasi['display_detail'] == null ? $r_klasifikasi['isi_informasi'] : $r_klasifikasi['display_detail'];
                                    echo '<p>' . $isi_informasi . '</p>';
                                    echo '<table class="table table-nobordered table-condensed table-v-top">';
                                    echo '<tbody>';
                                    echo '<tr><td class="fit">Penanggungjawab Pembuatan Informasi</td><td>: ' . $r_klasifikasi['penanggung_jawab'] . '</td></tr>';
                                    echo '<tr><td class="fit">Waktu Pembuatan / Penerbitan Informasi</td><td>: ' . $r_klasifikasi['waktu_pembuatan'] . '</td></tr>';
                                    echo '<tr><td class="fit">Bentuk Informasi Yang Tersedia</td><td>: ' . $r_klasifikasi['bentuk_informasi'] . '</td></tr>';
                                    echo '<tr><td class="fit">Jangka Waktu Penyimpanan</td><td>: ' . $r_klasifikasi['jangka_waktu'] . '</td></tr>';
                                    echo '<tr><td class="fit">Jenis Media Yang Memuat Informasi</td><td><div class="link-media">: ' . $r_klasifikasi['media'] . '</div></td></tr>';
                                    echo '</tbody>';
                                    echo '</table>';
                                    if (!empty($get_subfilebyid)) {
                                        /*
                                          if (count($get_subfilebyid) == 1) {
                                          foreach ($get_subfilebyid as $row):
                                          //f.nama_file,f.page,k.nama_ppid
                                          $nama_file = $row['nama_file'];
                                          $page = $row['page'];
                                          $tipe = $row['tipe'];
                                          endforeach;
                                          //echo base_url('assets/file/' . str_replace(" ","",strtolower($r_klasifikasi['nama_ppid'])). '/' . $nama_file . '#page=' . $page);
                                          echo '<object data="' . base_url('assets/file/' . str_replace(" ", "", strtolower($r_klasifikasi['nama_ppid'])) . '/' . $nama_file) . '#page=' . $page . '" type="application/pdf" width="100%" height="700px" style="border: solid 1px #ccc;">';
                                          echo '<p>Tampaknya Anda tidak memiliki plugin PDF untuk browser ini. Tidak masalah, Anda dapat <a href="' . base_url('assets/file/' . str_replace(" ", "", strtolower($r_klasifikasi['nama_ppid'])) . '/' . $nama_file) . '" target="blank">klik disini untuk download pdf file.</a></p>';
                                          echo '</object>';
                                          } else {
                                          echo '<ul class="elements">';
                                          echo '<li>File :</li>';
                                          foreach ($get_subfilebyid as $row_subfile):
                                          ?>
                                          <li><a href="javascript:void(0)" onclick="showfile('<?php echo $row_subfile['id_file']; ?>');">
                                          <?php
                                          if ($row_subfile['tipe'] == 'File') {
                                          echo '<i class="fa fa-file-pdf-o"></i> ' . $row_subfile['display_name'];
                                          } elseif ($row_subfile['tipe'] == 'image') {
                                          echo '<i class="fa fa-image"></i> ' . $row_subfile['display_name'];
                                          }
                                          ?>
                                          </a></li>
                                          <?php
                                          endforeach;
                                          echo '</ul>';
                                          }
                                         */
                                        echo '<ul class="list-unstyled list-fa">';
                                        echo '<li>File :</li>';
                                        foreach ($get_subfilebyid as $row_subfile):
                                            echo '<li><a href="' . site_url('informasipublik/file/' . $row_subfile['slug']) . '">';
                                            if ($row_subfile['tipe'] == 'File') {
                                                echo '<i class="fa fa-file-pdf-o"></i><span> ' . $row_subfile['display_name'] . '</span>';
                                            } elseif ($row_subfile['tipe'] == 'image') {
                                                echo '<i class="fa fa-image"></i><span> ' . $row_subfile['display_name'] . '</span>';
                                            }
                                            ?>
                                            </a></li>
                                            <?php
                                        endforeach;
                                        echo '</ul>';
                                    } else {
                                        echo '<div class="alert alert-warning">Data masih dalam proses.</div>';
                                    }
                                    ?>
                                    <div id="file_object"></div>
                                </div>
                            </div>
                        </div>
                        <?php
                        break;
                    }
                    unset($row);
                }
                ?>
            </div>
            <div class="col-xs-12 col-sm-4">
                <?php
                echo '<div class="widget categories">';
                $this->load->view('informasipublik/v_jenis_informasi');
                echo '</div>';
                $this->load->view('informasipublik/sidebar_galeri');
                ?>               
            </div>  
        </div>
    </div>
</section>
<script type="text/javascript">
    function showfile(id_file) {
        //alert(id_file);
        var href = "<?php echo site_url('informasipublik/get_file'); ?>/" + id_file;
        $('#file_object').load(href);
        //alert(href);
    }
</script>