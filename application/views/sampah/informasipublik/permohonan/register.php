<style>
    input[type=text] {
        text-transform: uppercase;
    }
</style>
<section id="portfolio">
    <div class="container">
        <div class="center">
            <h1>Pendaftaran Pemohon Informasi Publik</h1>
        </div>
        <div class="portfolio-filter">
            <hr>
            <?php
            if (!empty($error)) {
                echo $error;
            }
            echo $this->session->flashdata('msg');
            echo validation_errors('<div class="alert alert-danger"><p>', '</p></div>');
            $attributes = array('data-toggle' => 'validator', 'role' => 'form');
            echo form_open_multipart('pendaftaranpemohon', $attributes);
            ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label>Nama lengkap</label>
                        <input type="text" name="full_name" id="full_name" class="form-control input-sm" tabindex="1" required value="<?php echo set_value('full_name'); ?>" autocomplete="off" />
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tanda Pengenal</label>
                                <?php
                                $options = array(
                                    'KTP' => 'KTP',
                                    'SIM' => 'SIM',
                                    'Paspor' => 'Paspor',
                                );
                                echo form_dropdown('tanda_pengenal', $options, set_value('tanda_pengenal'), 'class="form-control input-sm" tabindex="2" required  autocomplete="off"');
                                ?>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group has-feedback">
                                <label>Nomor</label>
                                <input type="text" name="nomor_identitas" id="nomor_identitas" class="form-control input-sm" tabindex="2" required value="<?php echo set_value('nomor_identitas'); ?>" autocomplete="off">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="gender">Jenis Kelamin</label><br>
                        <label class="radio-inline">
                            <input type="radio" name="jk" id="inlineRadio1" value="L" required <?php echo set_radio('jk', 'L', TRUE); ?>> Laki-laki
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="jk" id="inlineRadio2" value="P" required <?php echo set_radio('jk', 'P'); ?>> Perempuan
                        </label>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group has-feedback">
                                <label>Tempat,</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control input-sm" tabindex="3" required value="<?php echo set_value('tempat_lahir'); ?>" autocomplete="off">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label>Tgl Lahir</label>
                                <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control input-sm" tabindex="4" required value="<?php echo set_value('tgl_lahir'); ?>" autocomplete="off">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Telepon</label>
                        <input type="text" name="telp" id="telp" class="form-control input-sm" tabindex="5" pattern="^[()+0-9]{1,}$" data-minlength="11" required value="<?php echo set_value('telp'); ?>" autocomplete="off">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group">
                        <label for="Pekerjaan">Pekerjaan</label>
                        <div class="row">
                            <div class="col-md-5">
                                <?php
                                $options = array(
                                    'PNS' => 'Pegawai Negeri Sipil (PNS)',
                                    'Karyawan Swasta' => 'Karyawan Swasta',
                                    'TNI/Polri' => 'TNI/Polri',
                                    'Wiraswasta' => 'Wiraswasta',
                                    'Mahasiswa' => 'Mahasiswa',
                                    'Pelajar' => 'Pelajar',
                                    '0' => 'Lainnya...',
                                );
                                $js = 'id="pekerjaan" onChange="changetextbox();" class="form-control input-sm" required';
                                echo form_dropdown('pekerjaan', $options, set_value('tanda_pengenal'), $js);
                                ?>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group has-feedback">
                                    <input type="text" name="pekerjaan_detail" id="pekerjaan_detail" class="form-control input-sm" tabindex="6" disabled required value="<?php echo set_value('pekerjaan_detail'); ?>" autocomplete="off">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control input-sm" tabindex="7" data-minlength="11" spellcheck="false" required autocomplete="off"><?php echo set_value('alamat'); ?></textarea>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label>Kode Pos</label>
                        <input type="text" name="kode_pos" id="kode_pos" class="form-control input-sm" tabindex="8" pattern="^[0-9]{1,}$" data-minlength="5" required value="<?php echo set_value('kode_pos'); ?>" autocomplete="off">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Provinsi</label>
                        <?php
                        $provinsi[null] = '- Pilih Provinsi -';
                        foreach ($get_provinsi as $r_prov) :
                            $provinsi[$r_prov['lokasi_propinsi']] = ucwords(strtolower($r_prov['lokasi_nama']));
                        endforeach;
                        $style_provinsi = 'class="form-control input-sm" id="provinsi_id"  onChange="tampilKabupaten()" tabindex="8" required';
                        echo form_dropdown('provinsi', $provinsi, "", $style_provinsi);
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Kab/Kota</label>
                        <?php
                        $style_kabupaten = 'class="form-control input-sm" id="kabupaten_id" tabindex="9" required';
                        echo form_dropdown("kabupaten_kota", array('' => '- Pilih Kabupaten -'), "", $style_kabupaten);
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control input-sm" tabindex="11" required value="<?php echo set_value('email'); ?>" autocomplete="off">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control input-sm" tabindex="12" data-minlength="6" required autocomplete="off">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirm" id="password_confirm" class="form-control input-sm" tabindex="13" data-match="#password" data-minlength="6" data-match-error="Whoops, these don't match" required autocomplete="off">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Lampiran Tanda Pengenal (Max : 200Kb, Format File : gif / jpg / png / jpeg)</label>
                        <input type="file" name="lampiran" id="lampiran" required>
                    </div>
                </div>
            </div>
            <div class="pull-right"><button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Daftar Menjadi Member</button></div>
            <div class="clearfix"></div>
            <?php echo form_close(); ?>
            <hr>
        </div>
    </div>
</section>
<script>
    jQuery(function($) {
        $("#tgl_lahir").mask("99-99-9999", {
            placeholder: "dd-mm-yyyy"
        });
    });

    function changetextbox() {
        var val = document.getElementById("pekerjaan").value;
        if (val == 0) {
            document.getElementById("pekerjaan_detail").disabled = false;
            document.getElementById("pekerjaan_detail").focus();
        } else {
            document.getElementById("pekerjaan_detail").disabled = true;
        }
    }

    function tampilKabupaten() {
        var kdprop = document.getElementById("provinsi_id").value;
        $.ajax({
            url: "<?php echo site_url(); ?>getkabupaten/" + kdprop + "",
            success: function(response) {
                $("#kabupaten_id").html(response);
            },
            dataType: "html"
        });
        return false;
    }
</script>