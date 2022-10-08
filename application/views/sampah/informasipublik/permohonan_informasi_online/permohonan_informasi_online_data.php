<section id="portfolio">
    <div class="container">
        <div class="center">
            <h1>
                Permohonan Informasi Secara Online<br>RSUD Prof. Dr. Margono Soekarjo Purwokerto
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
                        if (empty($kode_akses) || empty($data_permohonan)) {
                            ?>
                            <div class="text-center">
                                <p>
                                    <i class="fa fa-play"></i>
                                    Untuk mengajukan permohonan informasi secara online silahkan klik 
                                    <a href="<?= site_url('permohonan_informasi_online'); ?>">Permohonan Informasi</a>
                                    <i class="fa fa-play fa-rotate-180"></i>
                                </p>
                                <p>
                                    <i class="fa fa-play"></i>
                                    Untuk melihat permohonan informasi yang telah dilakukan sebelumnya silahkan masukan <strong>KODE PERMOHONAN</strong> 
                                    yang telah dimiliki pada kolom dibawah ini
                                    <i class="fa fa-play fa-rotate-180"></i>
                                </p>
                                <?= form_open('permohonan_informasi_online/data_permohonan'); ?>
                                <div class="row">
                                    <div class="col-md-4 col-md-offset-4">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="KODE PERMOHONAN" name="kode_akses" required="true" maxlength="6">
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
                                    <i class="fa fa-play"></i> Informasi Permohonan Informasi Secara Online <i class="fa fa-play fa-rotate-180"></i>
                                </h2> 
                                <p>
                                    <i class="fa fa-play"></i>
                                    Untuk mengajukan permohonan informasi secara online silahkan klik 
                                    <a href="<?= site_url('permohonan_informasi_online'); ?>">Permohonan Informasi</a>
                                    <i class="fa fa-play fa-rotate-180"></i>
                                </p>                               
                            </div>
                            <p class="mb-0">Kode Permohonan Informasi Anda Adalah "<b class="text-red fs-18"><?= $data_permohonan->kode_akses ?></b>".</p>
                            <p class="mb-0">Simpan kode tersebut untuk melihat permohonan informasi yang telah Anda lakukan dikemudian hari.</p>
                            <p><span class="text-red">Jangan berikan kode tersebut kepada orang lain.</span></p>

                            <p class="bordered-top bordered-bottom mb-0 pt-5 pb-5">
                                <b>Kode Permohonan :</b>
                                <br><?= $data_permohonan->kode_akses; ?>
                            </p>
                            <p class="bordered-bottom mb-0 pt-5 pb-5">
                                <b>Nomor Register Permohonan :</b>
                                <br><?= $data_permohonan->nomor_register; ?>
                            </p>
                            <p class="bordered-bottom mb-0 pt-5 pb-5">
                                <b>Nama Pemohon :</b>
                                <br><?= $data_permohonan->full_name; ?>
                            </p>
                            <p class="bordered-bottom mb-0 pt-5 pb-5">
                                <b>Alamat Pemohon :</b>
                                <br><?= $data_permohonan->alamat; ?>
                            </p>
                            <p class="bordered-bottom mb-0 pt-5 pb-5">
                                <b>Waktu Permohonan :</b>
                                <br><?= date('d-m-Y H:i:s', strtotime($data_permohonan->tgl_permohonan)); ?>
                            </p>
                            <p class="bordered-bottom mb-0 pt-5 pb-5">
                                <b>Rincian informasi yang dibutuhkan :</b>
                                <br><?= $data_permohonan->kandungan_isi; ?>
                            </p>
                            <p class="bordered-bottom mb-0 pt-5 pb-5">
                                <b>Tujuan penggunaan informasi :</b>
                                <br><?= $data_permohonan->tujuan_permohoan; ?>
                            </p>
                            <p class="bordered-bottom mb-0 pt-5 pb-5">
                                <b>Bentuk informasi yang diminta :</b>
                                <br><?= $data_permohonan->nama_bentuk_informasi; ?>
                            </p>
                            <p class="bordered-bottom mb-0 pt-5 pb-5">
                                <b>Cara mendapatkan salinan informasi :</b>
                                <br><?= $data_permohonan->cara_mendapkan_salinan; ?>
                            </p>                            
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>