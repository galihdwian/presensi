<section id="services" class="service-item">
    <div class="container">
        <div class="center wow slideInDown">
            <h2 class="section-title text-center">Kegiatan Terbaru</h2>
        </div>
        <div class="row">
            <?php
            foreach ($list_kegiatan as $r) :
            ?>
                <div class="col-sm-6 col-md-3 center">
                    <div style="background-color: white;">
                        <div class="media services-wrap wow zoomIn fixed-height" style="height: 260px;">
                            <img class="img-circle profile_img" src="<?php echo base_url($r->foto); ?>" style="height: 100px; width: 100px">
                            <div class="media-body">
                                <h4 class="media-heading"><?= $r->judul ?></h4>
                                <p><?= substr(strip_tags($r->isi), 0, 90) ?> . . .</p>
                            </div>
                        </div>
                        <div class="services-wrap">
                            <a href="<?= site_url('kegiatan/detail_kegiatan/') . $r->id; ?>"><button class="btn btn-danger btn-outline">Selengkapnya</button></a>

                        </div>
                    </div>
                </div>
            <?php
            endforeach
            ?>

        </div>
        <!--/.row-->
    </div>
    <!--/.container-->
</section>
<!--/#services-->