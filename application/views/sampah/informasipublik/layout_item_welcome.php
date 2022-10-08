<section id="conatcat-info">
    <div class="container">
        <div class="media contact-info wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="media-body center">
                <h2 class="section-title text-center">Pencarian Informasi Publik</h2>
                <p class="lead">Masukan kata kunci pencarian pada kolom isian di bawah ini</p>
                <p>
                    <?php
                    echo form_open('pencarianinformasipublik');
                    ?>
                <div class="form-group">
                    <div class="input-group input-group-lg">
                        <input class="form-control input-lg" id="keyword" name="keyword" type="text" placeholder="Masukan judul / nama informasi yang ingin dicari." autocomplete="off" required="true">
                        <input type="hidden" name="tipe" value="index">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> Cari Data</button>
                        </span>
                    </div>
                </div>
                <?php echo form_close(); ?>
                </p>
            </div>
        </div>
    </div>
</section>