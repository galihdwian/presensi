<section id="portfolio">
    <div class="container">
        <div class="center">
            <h1>
                Form Pengaduan Secara Online<br>RSUD Prof. Dr. Margono Soekarjo Purwokerto
            </h1>
        </div>
        <div class="portfolio-filter">
            <?= form_open('pengaduan'); ?>
            <div class="well">
                <p>
                    Untuk melihat proses pengaduan yang telah Anda lakukan sebelumnya dapat dilihat pada
                    <a href="<?= site_url('pengaduan/riwayat'); ?>">Data Pengaduan</a>
                </p>
                <p>
                    Pengaduan juga dapat dilakukan melalui aplikasi RSMS Online yang dapat didownload di
                    <a href="https://play.google.com/store/apps/details?id=com.margono.sim.rsmsapp">Playstore</a> pada menu Pojok Pengaduan
                </p>
                <hr>
                <?php
                echo $this->session->flashdata('msg');
                if (!empty($error)) {
                    echo '<div class="alert alert-danger">' . $error . '</div>';
                }
                ?>
                <div class="row" id="loginpage">
                    <div class="col-md-6 rightborder">
                        <div class="form-group">
                            <label for="txtfull_name">Nama Lengkap</label>
                            <input type="text" class="form-control" id="txtfull_name" name="full_name" required="true" value="<?= set_value('full_name') ?>" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="txttelp">No Handphone / Whatsapp</label>
                            <input type="text" class="form-control" id="txttelp" name="telp" required="true" value="<?= set_value('telp') ?>" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="txtemail">E-Mail</label>
                            <input type="text" class="form-control" id="txtemail" name="email" value="<?= set_value('email') ?>" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="txtalamat">Alamat Lengkap</label>
                            <textarea name="alamat" id="txtalamat" class="form-control" spellcheck="false" autocomplete="off" required="true" autocomplete="off"><?= set_value('alamat'); ?></textarea>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-6 text-justify">
                        <div class="form-group">
                            <label for="txtisipengaduan">Isi Pengaduan</label>
                            <textarea name="isipengaduan" id="txtisipengaduan" class="form-control" data-minlength="11" spellcheck="false" required="true" autocomplete="off" required="true"><?= set_value('isipengaduan'); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="txtcaptcha">Kode Keamanan</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <?= $captcha['image']; ?>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="txtcaptcha" name="captcha" required="true" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <hr>
                <div class="pull-right">
                    <button class="btn btn-success" type="submit" name="submitdata" value="submit"><i class="fa fa-save"></i> Simpan Pengaduan</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</section>