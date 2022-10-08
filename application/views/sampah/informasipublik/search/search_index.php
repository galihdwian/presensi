<section id="blog" class="container">
    <div class="blog">
        <div class="row">
            <div class="col-sm-8">                
                <div class="center">
                    <h2>Pencarian Informasi Publik</h2>
                </div>
                <div class="blog-item row"> 
                    <div class="col-xs-12 blog-content">                          
                        <div class="widget search">
                            <form method="POST" action="<?php echo site_url('pencarianinformasipublik'); ?>" class="form-inline">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Cari Dokumen" name="keyword" id="searchkey" value="<?php echo $keyword; ?>">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default btn-outline" id="searchbutton"><i class="glyphicon glyphicon-search"></i> Cari</button>                                                    
                                        </div>
                                    </div>
                                </div>                                
                            </form>
                        </div>
                        <?= !empty($message) ? $message : ''; ?>
                        <ul class="nav nav-tabs">
                            <li <?= ($activetab == 'ppid' ? 'class="active"' : '') ?>><a data-toggle="tab" href="#datappid">Data PPID <span class="label label-success"><?php echo $searchppid['jumlah']; ?></span></a></li>
                            <li <?= ($activetab == 'opendata' ? 'class="active"' : '') ?>><a data-toggle="tab" href="#dataopendata">Data Opendata <span class="label label-success"><?php echo $search_opendata['requestopendata']->jumlahdata; ?></span></a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="datappid" class="tab-pane fade <?= ($activetab == 'ppid' ? 'in active' : '') ?>">
                                <?= empty($message) ? '<p class="small mt-10">Hasil pencarian dengan kata kunci : ' . str_replace("%", " ", $keyword) . ', berjumlah ' . $searchppid['jumlah'] . ' Informasi.</p>' : ''; ?>
                                <?php
                                echo '<div class="row"><div class="col-sm-12"><div class="well">';
                                foreach ($searchppid['results'] as $r_res):
                                    echo '<div class="box">';
                                    if ($r_res['typefile'] == 'FILE') {
                                        echo '<h4><span class="label label-warning">FILE</span> <a href="' . site_url('informasipublik/file/' . $r_res['slug']) . '">' . $r_res['display_name'] . '</a></h4>';
                                    } else if ($r_res['typefile'] == 'DIP') {
                                        echo '<h4><span class="label label-info">DIP&nbsp;&nbsp;</span> <a href="' . site_url('informasipublikdetail/' . $r_res['slug']) . '">' . $r_res['display_name'] . '</a></h4>';
                                        echo $r_res['description'];
                                    } else if ($r_res['typefile'] == 'TAG') {
                                        if ($r_res['tipe'] == 'File') {
                                            echo '<h4><span class="label label-warning">FILE</span> <a href="' . site_url('informasipublik/showfilekategori/' . $r_res['slug']) . '">' . $r_res['display_name'] . '</a></h4>';
                                        } else if ($r_res['tipe'] == 'Image') {
                                            echo '<h4><span class="label label-danger">IMG</span> <a href="' . base_url('assets/file/' . $r_res['file']) . '" rel="prettyPhoto">' . $r_res['display_name'] . '</a></h4>';
                                        }
                                    }
                                    echo '</div>';
                                endforeach;
                                unset($r_res);
                                echo $searchppid['links'];
                                echo '</div></div></div>';
                                ?>
                            </div>
                            <div id="dataopendata" class="tab-pane fade <?= ($activetab == 'opendata' ? 'in active' : '') ?>">
                                <p class="small mb-10 mt-10">Hasil pencarian dengan kata kunci : <?php echo str_replace("%", " ", $keyword); ?>, berjumlah <?php echo $search_opendata['requestopendata']->jumlahdata; ?> Dataset.</p>                                
                                <?php
                                echo '<div class="row"><div class="col-sm-12"><div class="well">';
                                foreach ($search_opendata['requestopendata']->data as $row_ds):
                                    echo '<div class="box">';
                                    echo '<h4><a href="' . $row_ds->url . '" target="_blank">' . $row_ds->dataset_name . '</a></h4>';
                                    echo '<p>' . $row_ds->deskripsi . '</p>';
                                    echo '</div>';
                                endforeach;
                                unset($row_ds);
                                echo $search_opendata['linksod'];
                                echo '</div></div></div>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>				
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
    </div>
</section>