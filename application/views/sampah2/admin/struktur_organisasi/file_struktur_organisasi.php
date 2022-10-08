<?php
if (!empty($error)) {
    echo '<div class="alert alert-danger">' . $error . '</div>';
}
$attributes = array('data-toggle' => 'validator', 'role' => 'form');
echo form_open_multipart('admin/strukturorganisasi', $attributes);
echo form_hidden('id', $getstrukturorganisasi->id);
echo form_hidden('gambar', $getstrukturorganisasi->gambar);
?>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Data Struktur Organisasi</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-feedback">
                                    <label>Judul</label>
                                    <input type="text" class="form-control input-sm" value="<?= $getstrukturorganisasi->judul ?>" name="judul" autocomplete="off" autofocus autocapitalize="true" required="true">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Foto</label></br>
                                    <img src="<?php echo base_url($getstrukturorganisasi->gambar); ?>" alt="Gambar Struktur Organisasi" width="280" height="150">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>

                                <div class="form-group has-feedback">
                                    <label>Upload Baru</label></br>
                                    <input type="file" name="foto" id="foto" />
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>

                                </div>

                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="pull-right">
                            <a href="<?= site_url('admin/strukturorganisasi'); ?>" class="btn btn-warning" id="btnBatal">Batal</a>
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
<script>
    $('#password, #confirm_password').on('keyup', function() {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else
            $('#message').html('Password Tidak Sama').css('color', 'red');
    });
</script>