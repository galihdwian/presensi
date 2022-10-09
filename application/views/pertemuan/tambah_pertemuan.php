<?php
if (!empty($error)) {
    echo '<div class="alert alert-danger">' . $error . '</div>';
}
$attributes = array('data-toggle' => 'validator', 'role' => 'form');
echo form_open('pertemuan_tambah', $attributes);
?>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Tambah Data Pertemuan</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-feedback">
                                    <label>Nama Dosen Pengampu</label>
                                    <?php
                                    $options[''] = '- Pilih -';
                                    foreach ($get_list_dosen as $r) :
                                        $options[$r->id_dsn] = $r->nama_dsn;
                                    endforeach;
                                    unset($r);
                                    echo form_dropdown('id_dsn', $options, '', 'class="form-control input-sm" tabindex="2" required  autocomplete="off"');
                                    unset($options);
                                    ?>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Nama Mata Kuliah</label>
                                    <?php
                                    $options[''] = '- Pilih -';
                                    foreach ($get_list_matkul as $r) :
                                        $options[$r->id_matkul] = $r->nm_matkul;
                                    endforeach;
                                    unset($r);
                                    echo form_dropdown('id_matkul', $options, '', 'class="form-control input-sm" tabindex="2" required  autocomplete="off"');
                                    unset($options);
                                    ?>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Ruangan</label>
                                    <?php
                                    $options[''] = '- Pilih -';
                                    foreach ($get_list_ruangan as $r) :
                                        $options[$r->id_ruangan] = $r->nm_ruangan;
                                    endforeach;
                                    unset($r);
                                    echo form_dropdown('id_ruangan', $options, '', 'class="form-control input-sm" tabindex="2" required  autocomplete="off"');
                                    unset($options);
                                    ?>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Pertemuan Ke</label>
                                    <input type="number" class="form-control input-sm" name="pertemuanke" id="pertemuanke" autocomplete="off" autofocus autocapitalize="true" required="true">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Waktu Mulai</label>
                                    <input type="time" class="form-control input-sm" name="waktu_mulai" id="waktu_mulai" autocomplete="off" autofocus autocapitalize="true" required="true">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Waktu Selesai</label>
                                    <input type="time" class="form-control input-sm" name="waktu_selesai" id="waktu_selesai" autocomplete="off" autofocus autocapitalize="true" required="true">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <label>Pokok Bahasan</label>
                                <?php echo form_textarea(array('name' => 'pkok_bahasan', 'id' => 'pkok_bahasan', 'class' => "ckeditor")); ?>
                                <label>Sub Pokok</label>
                                <?php echo form_textarea(array('name' => 'sub_pkokbhasan', 'id' => 'sub_pkokbhasan', 'class' => "ckeditor")); ?>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="pull-right">
                            <a href="<?= site_url('pertemuan'); ?>" class="btn btn-warning" id="btnBatal">Batal</a>
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