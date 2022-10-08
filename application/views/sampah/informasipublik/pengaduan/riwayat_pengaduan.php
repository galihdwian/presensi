<section id="portfolio">
    <div class="container">
        <div class="center">
            <h1>
                Form Pengaduan Secara Online<br>RSUD Prof. Dr. Margono Soekarjo Purwokerto
            </h1>
        </div>
        <div class="portfolio-filter">
            <div class="well">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        echo '<div class="text-center">';
                        echo $this->session->flashdata('msg');
                        if (!empty($error)) {
                            echo '<div class="alert alert-danger">' . $error . '</div><hr>';
                        }
                        echo '</div>';
                        if (empty($kode_akses)) {
                        ?>
                            <div class="text-center">
                                <p>
                                    <i class="fa fa-play"></i>
                                    Untuk melakukan pengaduan secara online silahkan klik
                                    <a href="<?= site_url('pengaduan'); ?>">Pengaduan</a>
                                    <i class="fa fa-play fa-rotate-180"></i>
                                </p>
                                <p>
                                    <i class="fa fa-play"></i>
                                    Untuk melihat informasi pengaduan yang telah dilakukan sebelumnya silahkan masukan <strong>KODE PENGADUAN</strong>
                                    yang telah dimiliki pada kolom dibawah ini
                                    <i class="fa fa-play fa-rotate-180"></i>
                                </p>
                                <?= form_open('pengaduan/riwayat'); ?>
                                <div class="row">
                                    <div class="col-md-4 col-md-offset-4">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="KODE PENGADUAN" name="kode_akses" required="true" maxlength="8">
                                            <span class="input-group-btn">
                                                <button class="btn btn-danger" type="submit" name="submitdata" value="submitdata">Lihat Data</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <?= form_close(); ?>
                                <div class="clearfix"></div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="text-center">
                                <h2>
                                    <i class="fa fa-play"></i> Informasi Pengaduan Secara Online <i class="fa fa-play fa-rotate-180"></i>
                                </h2>
                                <p>
                                    <i class="fa fa-play"></i>
                                    Untuk melakukan pengaduan secara online silahkan klik
                                    <a href="<?= site_url('pengaduan'); ?>">Pengaduan</a>
                                    <i class="fa fa-play fa-rotate-180"></i>
                                </p>
                            </div>
                            <p class="mb-0">Kode Pengaduan Anda Adalah "<b class="text-red fs-18"><?= $kode_akses ?></b>".</p>
                            <p class="mb-0">Simpan kode tersebut untuk melihat pengaduan yang telah Anda lakukan dikemudian hari.</p>
                            <p><span class="text-red">Jangan berikan kode tersebut kepada orang lain.</span></p>

                            <p class="bordered-top bordered-bottom mb-0 pt-5 pb-5">
                                <b>Kode Pengaduan :</b>
                                <br><?= $kode_akses; ?>
                            </p>
                            <p class="bordered-top bordered-bottom mb-0 pt-5 pb-5">
                                <b>Nama :</b>
                                <br><?= $nama_pengadu; ?>
                            </p>
                            <p class="bordered-top bordered-bottom mb-0 pt-5 pb-5">
                                <b>No Hp / Whatsapp :</b>
                                <br><?= $nomor_hp; ?>
                            </p>
                            <?php
                            if (!empty($email)) {
                            ?>
                                <p class="bordered-top bordered-bottom mb-0 pt-5 pb-5">
                                    <b>E-mail :</b>
                                    <br><?= $email; ?>
                                </p>
                            <?php
                            }
                            ?>
                            <p class="bordered-top bordered-bottom mb-0 pt-5 pb-5">
                                <b>Waktu Pengaduan :</b>
                                <br><?= $waktuaduan; ?>
                            </p>
                            <p class="bordered-top bordered-bottom mb-0 pt-5 pb-5">
                                <b>Isi Pengaduan :</b>
                                <br><?= $isiaduan; ?>
                            </p>
                            <p class="bordered-top bordered-bottom mb-0 pt-5 pb-5">
                                <b>Status Pengaduan :</b>
                                <br><?= ($statusaduan == '0' ? '<label class="label label-warning">Dalam Proses</label>' : '<label class="label label-success">Sudah Selesai</label>'); ?>
                            </p>
                            <?php
                            if ($statusaduan == '1') {
                            ?>
                                <p class="bordered-top bordered-bottom mb-0 pt-5 pb-5">
                                    <b>Waktu Penyelesaian :</b>
                                    <br><?= $waktupenyelesaian . ' (' . $respontime . ')'; ?>
                                </p>
                                <p class="bordered-top bordered-bottom mb-0 pt-5 pb-5">
                                    <b>Jawaban Pengaduan :</b>
                                    <br><?= $jawabanaduan; ?>
                                </p>
                            <?php
                            }
                            ?>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>