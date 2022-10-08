<section id="blog" class="container" style="padding-bottom: 50px;">
    <div class="row">

        <div class="col-md-12">
            <div class="center">
                <h1>Visi dan Misi Pemerintah Provinsi Jawa Tengah</h1>
                <h2>Visi</h2>
            </div>
            <div class="blog-item">
                <div class="col-xs-12 col-sm-12 col-md-12 blog-content">
                    <p class="center">Jawa Tengah Berdikari dan Semakin Sejahtera. (Tetep) Mboten Korupsi Mboten Ngapusi</p>
                    <hr>
                </div>
            </div>
        </div>
        <div class="center">
            <h2>Misi</h2>
        </div>
        <div class="blog-item">
            <div class="col-xs-12 col-sm-12 col-md-12 blog-content">
                <div class="listshow">
                    <ol>
                        <center>
                            <p>1. Mempercepat reformasi birokrasi yang dinamis serta memperluas sasaran ke pemerintah kabupaten/kota</p>
                            <p>2. Menjadikan rakyat Jawa Tengah lebih sehat, lebih pintar, lebih berbudaya dan mencintai lingkungan</p>
                        </center>
                    </ol>
                    <hr>
                </div>
            </div>
        </div>
        <div class="center">
            <h2>Program Unggulan</h2>
        </div>
        <div class="blog-item">
            <div class="col-xs-12 col-sm-12 col-md-12 blog-content">
                <p class="center">Reformasi birokrasi di kabupaten/kota yang dinamis berbasis teknologi informasi dan sistem layanan terintegrasi</p>
                <p class="center">Reformasi Tanpa Dinding</p>
            </div>
        </div>
    </div>
    <div class="row" style="padding-top: 100px;">
        <div class="col-md-12">
            <div class="center">
                <h1>Visi dan Misi RSUD Prof.Dr. Margono Soekarjo Purwokerto</h1>
                <h2>Visi</h2>
            </div>
            <div class="blog-item">
                <div class="col-xs-12 col-sm-12 col-md-12 blog-content">
                    <?php
                    foreach ($list_visi as $r) :
                    ?>
                        <p class="center"><?= $r->nama_visi ?></p>
                    <?php
                    endforeach;
                    unset($r);
                    ?>
                    <hr>
                </div>
            </div>
            <div class="center">
                <h2>Misi</h2>
            </div>
            <div class="blog-item">
                <div class="col-xs-12 col-sm-12 col-md-12 blog-content">
                    <div class="listshow">
                        <ol>
                            <?php
                            $no = 1;
                            foreach ($list_misi as $r) :
                            ?>
                                <center>
                                    <p><?= $no . '. ' . $r->nama_misi ?></p>
                                </center>
                            <?php
                                $no++;
                            endforeach;

                            unset($r);
                            ?>
                        </ol>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="center">
                <h2>Motto</h2>
            </div>
            <div class="blog-item">
                <div class="col-xs-12 col-sm-12 col-md-12 blog-content">
                    <p class="center">Melayani Dengan Sepenuh Hati</p>
                </div>
            </div>
        </div>
    </div>
</section>