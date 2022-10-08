<?php
if (!empty($error)) {
    echo '<div class="alert alert-danger">' . $error . '</div>';
}
$attributes = array('data-toggle' => 'validator', 'role' => 'form');
echo form_open_multipart('admin/kegiatan/edit_kegiatan_lampiran/' . $get_kegiatan_lampiran->id . '/' . $id_kegiatan, $attributes);
?>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Data Edit Lampiran Kegiatan</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-feedback">
                                    <label>Foto Lama</label></br>
                                    <img src="<?php echo base_url($get_kegiatan_lampiran->foto); ?>" alt="Gambar" width="280" height="150">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Ganti Foto Tambahan</label></br>
                                    <input type="file" name="foto" id="foto">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <!-- <div class="form-group has-feedback">
                                    <label>Isi Kegiatan</label>
                                    <input type="textarea" class="form-control input-sm" name="isi" autocomplete="off" autofocus autocapitalize="true" required="true">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div> -->
                                <?php echo form_textarea(array('name' => 'isi', 'id' => 'isi', 'class' => "ckeditor", 'value' => " $get_kegiatan_lampiran->isi ")); ?>
                                <br>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="pull-right">
                            <a href="<?= site_url('admin/kegiatan/tambahan/' . $id_kegiatan); ?>" class="btn btn-warning" id="btnBatal">Batal</a>
                            <button type="submit" name="submit" value="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= form_close(); ?>