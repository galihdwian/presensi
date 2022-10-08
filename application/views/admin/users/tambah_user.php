<?php
if (!empty($error)) {
    echo '<div class="alert alert-danger">' . $error . '</div>';
}
$attributes = array('data-toggle' => 'validator', 'role' => 'form');
echo form_open('admin/management_user/tambah', $attributes);
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
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control input-sm" name="nama_lengkap" autocomplete="off" autofocus autocapitalize="true" required="true">
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
                                <div class="form-group has-feedback">
                                    <label>Level</label>
                                    <?php
                                    $options[''] = 'Pilih Level';
                                    foreach ($list_level as $row) :
                                        $options[$row->id_level] = $row->nama_level;
                                    endforeach;
                                    echo form_dropdown('id_level', $options, set_value('id_level'), 'required class="form-control select2" id="txtid_level"');
                                    unset($options);
                                    ?>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Status</label>
                                    <?php
                                    $options[''] = 'Pilih Status';
                                    foreach ($list_status as $row) :
                                        $options[$row->id_status] = $row->nama_status;
                                    endforeach;
                                    echo form_dropdown('id_status', $options, set_value('id_status'), 'required class="form-control select2" id="txtid_status"');
                                    unset($options);
                                    ?>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="pull-right">
                            <a href="<?= site_url('admin/management_user'); ?>" class="btn btn-warning" id="btnBatal">Batal</a>
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