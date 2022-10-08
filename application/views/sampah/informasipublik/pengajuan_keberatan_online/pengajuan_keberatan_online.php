<section id="portfolio">
    <div class="container">
        <div class="center">
            <h1>
                Pengajuan Keberatan Secara Online<br>RSUD Prof. Dr. Margono Soekarjo Purwokerto
            </h1>
        </div>
        <div class="portfolio-filter">          
            <?= form_open_multipart('pengajuan_keberatan_online'); ?>
            <div class="well">
                <p>
                    Selain dengan pengajuan keberatan melalui form pengajukan keberatan online ini, Anda juga dapat melakukan pengajuan keberatan 
                    secara ofline / manual dengan mendownload formulir pengajuan keberatan di link 
                    <a href="<?= site_url('formkeberatan'); ?>">Form Pengajuan Keberatan</a>.
                    Isilah form tersebut dan kirimkan via pos tau dapat diantarkan langsung ke pelayanan informasi publik di RSUD Prof. Dr. Margono Soekarjo.
                </p>
                <p>
                    Pengajuan keberatan yang telah Anda lakukan sebelumnya dapat dilihat pada 
                    <a href="<?= site_url('pengajuan_keberatan_online/data_keberatan'); ?>">Data Pengajuan Keberatan</a>
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
                        <h3>A. Identitas Pengaju Keberatan</h3>
                        <div class="form-group has-feedback">
                            <label>Nama Lengkap</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="txtfull_name" 
                                   name="full_name"
                                   required="true"
                                   value="<?= set_value('full_name') ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label>No Telp / Handphone</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="txttelp" 
                                   name="telp" 
                                   required="true"
                                   value="<?= set_value('telp') ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label>E-Mail</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="txtemail" 
                                   name="email"
                                   value="<?= set_value('email') ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Alamat Lengkap</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="txtprovinsi" 
                                   name="provinsi" 
                                   required="true" 
                                   placeholder="Provinsi"
                                   value="<?= set_value('provinsi') ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" 
                                   class="form-control" 
                                   id="txtkabupaten" 
                                   name="kabupaten" 
                                   required="true" 
                                   placeholder="Kabupaten"
                                   value="<?= set_value('kabupaten') ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" 
                                   class="form-control" 
                                   id="txtkecamatan" 
                                   name="kecamatan" 
                                   required="true" 
                                   placeholder="Kecamatan"
                                   value="<?= set_value('kecamatan') ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" 
                                   class="form-control" 
                                   id="txtdesa" 
                                   name="desa" 
                                   required="true" 
                                   placeholder="Desa"
                                   value="<?= set_value('desa') ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" 
                                   class="form-control" 
                                   id="txtkodepos" 
                                   name="kodepos" 
                                   required="true" 
                                   placeholder="Kode Pos"
                                   value="<?= set_value('kodepos') ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" 
                                   class="form-control" 
                                   id="txtalamat_detail" 
                                   name="alamat_detail" 
                                   required="true" 
                                   placeholder="RT / RW / Nama Jalan / Nomor Rumah"
                                   value="<?= set_value('alamat_detail') ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label>No Identitas (KTP/SIM/KTA/KTM) </label>
                            <input type="text" 
                                   name="nomor_identitas" 
                                   id="nomor_identitas" 
                                   class="form-control" 
                                   required="true"
                                   autocomplete="off"
                                   value="<?= set_value('nomor_identitas') ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Lampiran Foto Tanda Pengenal <span class="small">(Max : 200Kb, Format File : gif / jpg / png / jpeg)</span></label>
                            <input type="file" 
                                   name="lampiran" 
                                   id="lampiran" 
                                   required="true">
                        </div>
                        <hr>
                        <h3>B. Alasan Pengajuan Keberatan</h3>
                        <div class="form-group has-feedback">
                            <div class="checkbox">
                                <label><?=form_checkbox('ditolak', 'T', set_checkbox('ditolak', 'T'));?> Permohonan informasi ditolak</label><br>                               
                                <label><?=form_checkbox('tdk_disediakan', 'T', set_checkbox('tdk_disediakan', 'T'));?> Informasi berkala tidak disediakan</label><br>
                                <label><?=form_checkbox('tdk_ditanggapi', 'T', set_checkbox('tdk_ditanggapi', 'T'));?> Permintaan informasi tidak ditanggapi</label><br>
                                <label><?=form_checkbox('tdk_sesuaipermintaan', 'T', set_checkbox('tdk_sesuaipermintaan', 'T'));?> Permintaan informasi ditanggapi tidak sebagaimana diminta</label><br>
                                <label><?=form_checkbox('tdk_dipenuhi', 'T', set_checkbox('tdk_dipenuhi', 'T'));?> Permintaan informasi tidak dipenuhi</label><br>
                                <label><?=form_checkbox('tdk_wajar', 'T', set_checkbox('tdk_wajar', 'T'));?> Biaya yang dikenakan tidak wajar</label><br>
                                <label><?=form_checkbox('overtime', 'T', set_checkbox('overtime', 'T'));?> Informasi disampaikan melebihi jangka waktu yang ditentukan</label><br>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Kasus Posisi <span class="help-block">(ceritakan kronologis / alasan lengkap pengajuan keberatan)</span></label>
                            <textarea type="text" 
                                      name="kasus" 
                                      id="txtkasus" 
                                      class="form-control" 
                                      required="true"
                                      autocomplete="off"><?= set_value('kasus'); ?></textarea>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-6 text-justify">
                        <div class="hidden-md hidden-lg">
                            <hr>
                        </div>
                        <h3>C. Identitas Kuasa</h3>
                        <p class="help-block">Diisi jika menggunakan kuasa.</p>
                        <div class="form-group has-feedback">
                            <label>Nama Lengkap (Kuasa)</label>
                            <input type="text" 
                                   class="form-control" 
                                   name="full_name_kuasa"
                                   value="<?= set_value('full_name_kuasa') ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label>No Telp / Handphone (Kuasa)</label>
                            <input type="text" 
                                   class="form-control"
                                   name="telp_kuasa" 
                                   value="<?= set_value('telp_kuasa') ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label>E-Mail (Kuasa)</label>
                            <input type="text" 
                                   class="form-control" 
                                   name="email_kuasa"
                                   value="<?= set_value('email_kuasa') ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Alamat Lengkap (Kuasa)</label>
                            <input type="text" 
                                   class="form-control" 
                                   name="provinsi_kuasa" 
                                   placeholder="Provinsi"
                                   value="<?= set_value('provinsi_kuasa') ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" 
                                   class="form-control" 
                                   name="kabupaten_kuasa" 
                                   placeholder="Kabupaten"
                                   value="<?= set_value('kabupaten_kuasa') ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" 
                                   class="form-control" 
                                   name="kecamatan_kuasa" 
                                   placeholder="Kecamatan"
                                   value="<?= set_value('kecamatan_kuasa') ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" 
                                   class="form-control" 
                                   name="desa_kuasa" 
                                   placeholder="Desa"
                                   value="<?= set_value('desa_kuasa') ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" 
                                   class="form-control" 
                                   name="kodepos_kuasa" 
                                   placeholder="Kode Pos"
                                   value="<?= set_value('kodepos_kuasa') ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" 
                                   class="form-control" 
                                   name="alamat_detail_kuasa" 
                                   placeholder="RT / RW / Nama Jalan / Nomor Rumah"
                                   value="<?= set_value('alamat_detail_kuasa') ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label>No Identitas (KTP/SIM/KTA/KTM) (Kuasa) </label>
                            <input type="text" 
                                   name="nomor_identitas_kuasa" 
                                   class="form-control" 
                                   required="true"
                                   autocomplete="off"
                                   value="<?= set_value('nomor_identitas_kuasa') ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <hr>
                <div class="pull-right">
                    <button class="btn btn-success" type="submit" name="submitdata" value="submit"><i class="fa fa-save"></i> Proses Pengajuan Keberatan</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php
            echo form_close();
            ?>
        </div>
    </div>
</section>