<section id="portfolio">
    <div class="container">
        <div class="center">
            <h1>
                Pengajuan Keberatan Secara Online<br>RSUD Prof. Dr. Margono Soekarjo Purwokerto
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
                                    Untuk mengajukan keberatan secara online silahkan klik 
                                    <a href="<?= site_url('pengajuan_keberatan_online'); ?>">Pengajuan Keberatan</a>
                                    <i class="fa fa-play fa-rotate-180"></i>
                                </p>
                                <p>
                                    <i class="fa fa-play"></i>
                                    Untuk melihat pengajuan keberatan yang telah dilakukan sebelumnya silahkan masukan <strong>KODE PENGAJUAN KEBERATAN</strong> 
                                    yang telah dimiliki pada kolom dibawah ini
                                    <i class="fa fa-play fa-rotate-180"></i>
                                </p>
                                <?= form_open('pengajuan_keberatan_online/data_keberatan'); ?>
                                <div class="row">
                                    <div class="col-md-4 col-md-offset-4">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="KODE PENGAJUAN KEBERATAN" name="kode_akses" required="true" maxlength="6">
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
                                    <i class="fa fa-play"></i> Informasi Pengajuan Keberatan Secara Online <i class="fa fa-play fa-rotate-180"></i>
                                </h2> 
                                <p>
                                    <i class="fa fa-play"></i>
                                    Untuk mengajukan keberatan secara online silahkan klik 
                                    <a href="<?= site_url('pengajuan_keberatan_online'); ?>">Pengajuan Keberatan</a>
                                    <i class="fa fa-play fa-rotate-180"></i>
                                </p>                               
                            </div>
                            <p class="mb-0">Kode Pengajuan Keberatan Anda Adalah "<b class="text-red fs-18"><?= $data_permohonan->kode_akses ?></b>".</p>
                            <p class="mb-0">Simpan kode tersebut untuk melihat pengajuan keberatan yang telah Anda lakukan dikemudian hari.</p>
                            <p><span class="text-red">Jangan berikan kode tersebut kepada orang lain.</span></p>

                            <p class="bordered-top bordered-bottom mb-0 pt-5 pb-5">
                                <b>Kode Pengajuan Keberatan :</b>
                                <br><?= $data_permohonan->kode_akses; ?>
                            </p>
                            <p class="bordered-bottom mb-0 pt-5 pb-5">
                                <b>Nomor Register Pengajuan Keberatan :</b>
                                <br><?= $data_permohonan->nomor_register; ?>
                            </p>
                            <p class="bordered-bottom mb-0 pt-5 pb-5">
                                <b>Nama Pengaju Keberatan :</b>
                                <br><?= $data_permohonan->full_name; ?>
                            </p>
                            <p class="bordered-bottom mb-0 pt-5 pb-5">
                                <b>Alamat Pengaju Keberatan :</b>
                                <br><?= $data_permohonan->alamat; ?>
                            </p>
                            <?php
                            if (!empty($data_permohonan->kuasa_nama)):
                                ?>
                                <p class="bordered-bottom mb-0 pt-5 pb-5">
                                    <b>Nama Kuasa Pengaju Keberatan :</b>
                                    <br><?= $data_permohonan->kuasa_nama; ?>
                                </p>
                                <p class="bordered-bottom mb-0 pt-5 pb-5">
                                    <b>Alamat Kuasa Pengaju Keberatan :</b>
                                    <br><?= $data_permohonan->kuasa_alamat; ?>
                                </p>
                                <?php
                            endif;
                            ?>
                            <p class="bordered-bottom mb-0 pt-5 pb-5">
                                <b>Waktu Pengajuan Keberatan :</b>
                                <br><?= date('d-m-Y H:i:s', strtotime($data_permohonan->tanggal)); ?>
                            </p>
                            <p class="bordered-bottom mb-0 pt-5 pb-5">
                                <b>Alasan Pengajuan Keberatan :</b>
                                <?php
                                if ($data_permohonan->ditolak == 'T')
                                    echo '<br>- Permohonan informasi ditolak';
                                if ($data_permohonan->tdk_disediakan == 'T')
                                    echo '<br>- Informasi berkala tidak disediakan';
                                if ($data_permohonan->tdk_ditanggapi == 'T')
                                    echo '<br>- Permintaan informasi tidak ditanggapi';
                                if ($data_permohonan->tdk_sesuaipermintaan == 'T')
                                    echo '<br>- Permintaan informasi ditanggapi tidak sebagaimana diminta';
                                if ($data_permohonan->tdk_dipenuhi == 'T')
                                    echo '<br>- Permintaan informasi tidak dipenuhi';
                                if ($data_permohonan->tdk_wajar == 'T')
                                    echo '<br>- Biaya yang dikenakan tidak wajar';
                                if ($data_permohonan->overtime == 'T')
                                    echo '<br>- Informasi disampaikan melebihi jangka waktu yang ditentukan';
                                ?>
                            </p>
                            <p class="bordered-bottom mb-0 pt-5 pb-5">
                                <b>Kasus Posisi :</b>
                                <br><?= $data_permohonan->kasus; ?>
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