<?php
if (!empty($error)) {
    echo '<div class="alert alert-danger">' . $error . '</div>';
}
$attributes = array('data-toggle' => 'validator', 'role' => 'form');
echo form_open('mahasiswa_edit/' . $get_mahasiswa->id_mhs, $attributes);
?>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Data Mahasiswa</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-feedback">
                                    <label>NIM</label>
                                    <input type="text" class="form-control input-sm" value="<?= $get_mahasiswa->nim ?>" name="nim" autocomplete="off" autofocus autocapitalize="true" required="true">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Nama Mahasiswa</label>
                                    <input type="text" class="form-control input-sm" value="<?= $get_mahasiswa->nama_mhs ?>" name="nama_mhs" autocomplete="off" autofocus autocapitalize="true" required="true">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Jurusan</label>
                                    <?php
                                    $options[''] = '- Pilih Jurusan -';
                                    foreach ($get_list_jurusan as $r) :
                                        $options[$r->kode_jurusan] = $r->nama_jurusan;
                                    endforeach;
                                    unset($r);
                                    echo form_dropdown('kode_jurusan', $options, $get_mahasiswa->kode_jurusan, 'class="form-control input-sm" tabindex="2" required  autocomplete="off"');
                                    ?>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label><br>
                                    <?php
                                    if ($get_mahasiswa->jns_kelamin == 'L') {
                                    ?>
                                        <input type="radio" name="jns_kelamin" value="L" checked>Laki-laki&nbsp;
                                        <input type="radio" name="jns_kelamin" value="P">Perempuan
                                    <?php
                                    } else {
                                    ?>
                                        <input type="radio" name="jns_kelamin" value="L" checked>Laki-laki&nbsp;
                                        <input type="radio" name="jns_kelamin" value="P" checked>Perempuan
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control input-sm" value="<?= $get_mahasiswa->tgl_lahir ?>" name="tgl_lahir" autocomplete="off" autofocus autocapitalize="true" required="true">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control input-sm" value="<?= $get_mahasiswa->alamat ?>" name="alamat" autocomplete="off" autofocus autocapitalize="true" required="true">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="pull-right">
                            <a href="<?= site_url('mahasiswa'); ?>" class="btn btn-warning" id="btnBatal">Batal</a>
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