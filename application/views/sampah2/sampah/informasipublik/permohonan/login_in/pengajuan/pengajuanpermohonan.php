<div class="center">
    <h2>Pengajuan Permohonan</h2>
    <hr>
</div>
<?php
if (!empty($error)) {
    echo $error;
}
echo $this->session->flashdata('msg');
echo validation_errors('<div class="alert alert-danger"><p>', '</p></div>');
$attributes = $attributes = array('data-toggle' => 'validator', 'role' => 'form');
echo form_open('pengajuan_permohonan', $attributes);
?>
<div class="form-group has-feedback">
    <label>Informasi yang dimohon</label>
    <input type="text" name="judul_informasi" id="judul_informasi" class="form-control" tabindex="1" required="true" value="<?php echo set_value('judul_informasi'); ?>" autocomplete="off"/>
    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
</div>
<div class="form-group has-feedback">
    <label>Kandungan isi informasi</label>
    <textarea name="isi_kandungan" id="isi_kandungan" class="form-control input-sm" tabindex="7" data-minlength="11" spellcheck="false" autocomplete="off"><?php echo set_value('isi_kandungan'); ?></textarea>
    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
</div>
<div class="form-group has-feedback">
    <label>Tujuan permohonan informasi</label>
    <textarea name="tujuan" id="tujuan" class="form-control input-sm" tabindex="7" data-minlength="11" spellcheck="false" required="true" autocomplete="off"><?php echo set_value('tujuan'); ?></textarea>
    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
</div>
<div class="form-group has-feedback">
    <label for="gender">Bentuk informasi yang diminta</label><br>
    <div class="radio">
        <label>
            <input type="radio" name="bentuk_informasi" id="inlineRadio1" value="S" required="true" <?php echo set_radio('bentuk_informasi', 'S', TRUE); ?>> Mendapatkan Salinan Informasi Softcopy (Melihat/Mengunduh/email)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="bentuk_informasi" id="inlineRadio2" value="H" required="true" <?php echo set_radio('bentuk_informasi', 'H'); ?>> Mendapatkan Salinan Informasi Hardcopy
        </label>
    </div>
    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
</div>
<div class="pull-right"><button class="btn btn-success" type="submit">Simpan</button></div>
<div class="clearfix"></div>
<?php
echo form_close();
?>
