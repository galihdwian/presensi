<div class="row">
    <div class="col-md-12">
        <?php echo validation_errors(); ?>
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Form Edit Pengguna</h3>
            </div>
            <?php
            $attributes = array('id' => 'form_add_pengguna', 'data-toggle' => 'validator', 'role' => 'form');
            echo form_open('admin/manajemen_pengguna/ubah_password', $attributes);
            ?>
            <div class="box-body">

                <div class="form-group has-feedback">
                    <label>Nama Lengkap</label>
                    <?php
                    $data = array(
                        'name' => 'namauser',
                        'id' => 'txtnamauser',
                        'class' => 'form-control',
                        'required' => TRUE,
                        'value' => $get_user->nama_user,
                        'autocomplete' => 'off',
                    );
                    echo form_input($data);
                    unset($data);
                    ?>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>

                <div class="form-group has-feedback">
                    <label>Username</label>
                    <?php
                    $data = array(
                        'name' => 'username',
                        'id' => 'txtusername',
                        'class' => 'form-control',
                        'readonly' => TRUE,
                        'value' => $get_user->username,
                        'autocomplete' => 'off',
                    );
                    echo form_input($data);
                    unset($data);
                    ?>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>

                <div class="form-group has-feedback">
                    <label>Password</label>
                    <?php
                    $data = array(
                        'name' => 'password',
                        'id' => 'txtpassword',
                        'class' => 'form-control',
                        'required' => TRUE,
                        'data-minlength' => '6',
                        'data-minlength-error' => 'Password minimal 6 karakter.',
                        'value' => set_value('password'),
                        'autocomplete' => 'off',
                    );
                    echo form_password($data);
                    unset($data);
                    ?>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group has-feedback">
                    <label>Konfirmasi Password</label>
                    <?php
                    $data = array(
                        'name' => 'confpassword',
                        'id' => 'txtconfpassword',
                        'class' => 'form-control',
                        'required' => TRUE,
                        'data-minlength' => '6',
                        'data-minlength-error' => 'Password minimal 6 karakter.',
                        'data-match' => '#txtpassword',
                        'data-match-error' => 'Konfirmasi password & password harus sama.',
                        'value' => set_value('confpassword'),
                        'autocomplete' => 'off',
                    );
                    echo form_password($data);
                    unset($data);
                    ?>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>

            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <a href="<?php echo site_url('admin/dashboard'); ?>" class="btn btn-danger">Batal</a>
                    <button type="submit" name="submit" value="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
            <?php
            echo form_close();
            ?>
        </div>
    </div>
</div>