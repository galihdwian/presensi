<section id="blog" class="container" style="padding-bottom: 50px;">
    <div class="row">
        <div class="col-md-12">
            <div class="entry clearfix">

                <div class="entry-title">
                    <h2 style="color: red"><?= ($get_kegiatan->judul); ?></h2>
                </div><!-- .entry-title end -->


                <div class="entry-meta">
                    <ul>
                        <li style="color: black"><i class="icon-calendar3"></i> <?= $get_kegiatan->updated_at !== null ?  date('d F Y', strtotime($get_kegiatan->created_at)) :  date('d F Y', strtotime($get_kegiatan->created_at)) ?> <?= $get_kegiatan->updated_at !== null ?  "<i></i>" :  "" ?></li>
                    </ul>
                </div><!-- .entry-meta end -->


                <center>
                    <div class="entry-image bottommargin">
                        <a href="#"><img src="<?= base_url($get_kegiatan->foto); ?>" alt="Blog Single" style="height: 400px; width: 800px"></a>
                    </div>
                </center>

                <div class="entry-content mt-0">

                    <div style="color: black; padding-top:30px;">
                        <p><?= ($get_kegiatan->isi); ?></p>
                    </div>


                    <?php
                    foreach ($get_kegiatan_lampiran as $row) :
                    ?>
                        <div style="padding-top: 35px;">
                            <a href="#"><img src="<?= base_url($row->foto); ?>" alt="Blog Single" style="height: 200px; width: 350px"></a>
                        </div>
                        <div style="color: black; padding-top:30px;">
                            <p><?= ($row->isi); ?></p>
                        </div>
                    <?php
                    endforeach;
                    ?>

                    <div class="clear"></div>


                </div>
            </div>
        </div>
    </div>
</section>