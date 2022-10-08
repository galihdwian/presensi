<?php
if (!empty($error)) {
    echo '<div class="alert alert-danger">' . $error . '</div>';
}
$attributes = array('data-toggle' => 'validator', 'role' => 'form');
echo form_open('user_tambah', $attributes);
?>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Tambah Data User</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-feedback">
                                    <label>Username</label>
                                    <input type="text" class="form-control input-sm" name="username" autocomplete="off" autofocus autocapitalize="true" required="true">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Password</label>
                                    <input type="password" class="form-control input-sm" name="password" id="password" autocomplete="off" autofocus autocapitalize="true" required="true">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Konfirmasi Password</label>
                                    <input type="password" class="form-control input-sm" name="password_confirmation" id="confirm_password" autocomplete="off" autofocus autocapitalize="true" required="true">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors" id='message'></div>
                                </div>

                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="pull-right">
                            <a href="<?= site_url('management_user'); ?>" class="btn btn-warning" id="btnBatal">Batal</a>
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