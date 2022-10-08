<section id="blog" class="container">
    <div class="blog">
        <div class="row">
            <div class="col-sm-8">
                <div class="center">
                    <h2>Informasi Publik Kategori <?php echo $nama_kategori; ?></h2>
                </div>
                <div class="blog-item row"> 
                    <div class="col-xs-12 blog-content">
                        <hr>
                        <div class="widget search">
                            <div class="form-inline">
                                <form method="POST" action="<?php echo site_url('pencarianinformasipublik'); ?>" class="form-inline">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari Dokumen" name="keyword" id="searchkey">
                                            <div class="input-group-btn">
                                                <button class="btn btn-default btn-outline" id="searchbutton"><i class="glyphicon glyphicon-search"></i> Cari</button>                                                    
                                            </div>
                                        </div>
                                    </div>                                
                                </form>
                            </div>
                        </div>
                        <ul class="list-unstyled list-fa">
                            <?php
                            foreach ($results as $r_res):
                                if ($r_res['tipe'] == 'image') {
                                    echo '<li><a href="' . base_url('assets/file/' . $r_res['file']) . '" rel="prettyPhoto"><i class="fa fa-image"></i><span>&nbsp;&nbsp;' . $r_res['display_name'] . '</span></a></li>';
                                } elseif ($r_res['tipe'] == 'file') {
                                    echo '<li><a href="' . site_url('informasipublik/showfilekategori/' . $r_res['slug']) . '">';
                                    echo '<i class="fa fa-file-pdf-o"></i><span>' . $r_res['display_name'] . '</span>';
                                    echo '</a></li>';
                                } elseif ($r_res['tipe'] == 'link') {
                                    echo '<li><a href="' . $r_res['slug'] . '" target="_blank">';
                                    echo '<i class="fa fa-link"></i><span>' . $r_res['display_name'] . '</span>';
                                    echo '</a></li>';
                                }
                            endforeach;
                            unset($r_res);
                            ?>
                        </ul>
                        <div class="portfolio-pagination" id="ajax_paging">
                            <?php echo $links; ?>
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