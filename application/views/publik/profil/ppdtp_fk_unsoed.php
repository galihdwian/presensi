<section id="portfolio" style="padding-bottom: 50px;">
    <div class="row">
        <div class="col-md-8">
            <div class="center">

                <h1 id="judul"></h1>

                <div>

                    <iframe src="<?php echo $list_ppdtp_fk_unsoed[0]->dokumen ?>" name="iframe_a" height="550px" width="100%" title="Iframe Example"></iframe>

                </div>


            </div>
        </div>
        <div class="col-md-4">
            <div class="widget categories">
                <h3 class="column-title"><i class="fa fa-list"></i> PPDTP FK UNSOED</h3>

                <ol>
                    <?php
                    foreach ($list_ppdtp_fk_unsoed as $r) :
                    ?>
                        <li><a href="<?php echo $r->dokumen ?>" target="iframe_a"><?= $r->keterangan ?></a></li>
                    <?php
                    endforeach;
                    ?>
                </ol>

            </div>
</section>