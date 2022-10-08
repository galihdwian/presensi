<section id="portfolio">
    <div class="container">
        <div class="center">
            <h1><?php echo empty($titleform) || $titleform == NULL ? "Permohonan Informasi" : $titleform; ?></h1>
        </div>
        <div class="portfolio-filter">
            <?php
            echo $this->session->flashdata('msg');
            echo validation_errors('<div class="alert alert-danger"><p>', '</p></div>');
            ?>
            <div class="well">
                <div class="row" id="loginpage">
                    <div class="col-md-5 rightborder">
                        <h3>Login</h3>
                        <hr>
                        <br>
                        <?php
                        $attributes = array('data-toggle' => 'validator', 'role' => 'form');
                        echo form_open_multipart('permohonaninformasi', $attributes);
                        ?>
                        <div class="form-group has-feedback">
                            <label>Email</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input type="text" class="form-control" id="email" placeholder="email" name="email" required="true" autocomplete="off" value="<?php echo set_value('email'); ?>">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Password</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password" required="true" autocomplete="off" data-minlength="6">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="pull-right">
                                <button type="submit" name="submit" class="btn btn-danger btn-outline"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Login</button>
                            </div>
                        </div>
                        <?php
                        echo form_close();
                        ?>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-7 text-justify">
                        <h3>Belum menjadi anggota?</h3>
                        <hr>
                        <p>Dengan menjadi member online PPID Pelaksana RSUD Prof. Dr. Margono Soekarjo, anda dapat: Melakukan permohonan informasi dan mengajukan keberatan atas permohonan informasi dengan lebih mudah (dimana saja & kapan saja), serta Anda dapat mengetahui prosesnya sampai dengan selesai.</p>
                        <p>Anda cukup melengkapi formulir pendaftarann member di link <a href="<?php echo site_url("pendaftaranpemohon"); ?>"><button class="btn btn-success btn-outline btn-xs">Pendaftaran Member</button></a> sekali saja dan akan terdaftar menjadi member.</p>
                        <p>Atau anda dapat mendownload <?php echo empty($titleform) || $titleform == NULL ? 'formulir permohonan informasi di link <a href="' . site_url('formpermohonan') . '"><button class="btn btn-info btn-outline btn-xs">Form Permohonan Informasi</button></a>' : 'formulir keberatan atas informasi di link <a href="' . site_url('formkeberatan') . '"><button class="btn btn-info btn-outline btn-xs">Form Keberatan</button></a>'; ?>, isilah form tersebut dan kirimkan via pos tau dapat diantarkan langsung ke pelayanan informasi publik di RSUD Prof. Dr. Margono Soekarjo.</p>
                        <p>Informasi tentang hak dan tata cara memperoleh informasi publik, serta tata cara pengajuan keberatan serta proses penyelesaian sengketa infomasi dapat di lihat <a href="http://rsmargono.jatengprov.go.id/ppid/kategoriinformasipublik/sop-Informasi-publik">disini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>