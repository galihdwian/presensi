<section id="portfolio">
    <div class="container">
        <div class="center">
            <h1>
                Permohonan Informasi Secara Online<br>RSUD Prof. Dr. Margono Soekarjo Purwokerto
            </h1>
        </div>
        <div class="portfolio-filter">          
            <?= form_open_multipart('permohonan_informasi_online'); ?>
            <div class="well">
                <p>
                    Form permohonan informasi secara online ini merupakan Hak anda memperoleh Informasi Publik 
                    sesuai UU No 14 Tahun 2008 Tentang Keterbukaan Informasi Publik
                </p>
                <p>
                    Selain dengan permohonan melalui form permohonan informasi secara online, Anda juga dapat melakukan permohonan informasi 
                    secara offline / manual dengan mendownload formulir permohonan informasi di link 
                    <a href="<?= site_url('formpermohonan'); ?>">Form Permohonan Informasi</a>.
                    Isilah form tersebut dan kirimkan via pos atau dapat diantarkan langsung ke pelayanan informasi publik di RSUD Prof. Dr. Margono Soekarjo.
                </p>
                <p>
                    Permohonan informasi yang telah Anda lakukan sebelumnya dapat dilihat pada 
                    <a href="<?= site_url('permohonan_informasi_online/data_permohonan');?>">Data Permohonan Informasi</a>
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
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-6 text-justify">
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
                            <label class="mb-0">Lampiran Foto Tanda Pengenal</label>
                            <p class="small help-block mt-0">(Max : 200Kb, Format File : gif / jpg / png / jpeg)</p>
                            <input type="file" 
                                   name="lampiran" 
                                   id="lampiran" 
                                   required="true">
                        </div>
                        <div class="form-group has-feedback">
                            <label>Rincian informasi yang dibutuhkan</label>
                            <textarea 
                                name="isi_kandungan" 
                                id="txtisi_kandungan" 
                                class="form-control" 
                                spellcheck="false" 
                                autocomplete="off"
                                required="true"><?= set_value('isi_kandungan'); ?></textarea>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Tujuan penggunaan informasi</label>
                            <textarea 
                                name="tujuan" 
                                id="tujuan" 
                                class="form-control" 
                                data-minlength="11" 
                                spellcheck="false" 
                                required="true" 
                                autocomplete="off"
                                required="true"><?= set_value('tujuan'); ?></textarea>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="gender">Bentuk informasi yang diminta</label><br>
                            <?php
                            $options['0'] = 'Melihat / Membaca / Mendengarkan / Mencatat';
                            $options['S'] = 'Mendapatkan Salinan Softcopy';
                            $options['H'] = 'Mendapatkan Salinan Hardcopy';
                            $selected = set_value('bentuk_informasi');
                            $selected = empty($selected) ? '0' : $selected;
                            echo form_dropdown('bentuk_informasi', $options, $selected, 'class="form-control" required="true"');
                            unset($options, $selected);
                            ?>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="gender">Cara mendapatkan salinan informasi</label><br>
                            <?php
                            $options['Mengambil Langsung'] = 'Mengambil Langsung';
                            $options['Email'] = 'Email';
                            $options['Pos / Kurir'] = 'Pos / Kurir';
                            $options['Faximile'] = 'Faximile';
                            $selected = set_value('cara_mendapkan_salinan');
                            $selected = empty($selected) ? '0' : $selected;
                            echo form_dropdown('cara_mendapkan_salinan', $options, $selected, 'class="form-control" required="true"');
                            unset($options, $selected);
                            ?>                            
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <hr>
                <div class="pull-right">
                    <button class="btn btn-success" type="submit" name="submitdata" value="submit"><i class="fa fa-save"></i> Proses Permohonan</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php
            echo form_close();
            ?>
        </div>
    </div>
</section>