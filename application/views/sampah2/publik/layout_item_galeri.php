<section id="recent-works">
    <div class="container">
        <div class="center wow fadeInDown">
            <h2 class="section-title text-center">GALERI</h2>
            <p class="lead">Foto dokumentasi Komkordik RSUD Prof. Dr. Margono Soekarjo Purwokerto</p>
        </div>

        <div class="row">
            <?php
            foreach ($list_gallery as $r) :
            ?>
                <div class="col-xs-6 col-sm-4 col-md-3">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="<?php echo base_url($r->foto); ?>" style="width: auto; height: 200px">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <a class="preview" href="<?php echo base_url($r->foto); ?>" rel="prettyPhoto[gallery]"><i class="fa fa-arrows"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
            unset($r);
            ?>
        </div>
    </div>
</section>