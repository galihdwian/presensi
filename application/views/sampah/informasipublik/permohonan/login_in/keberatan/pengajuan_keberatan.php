<div class="center">
    <h2>Pengajuan Keberatan</h2>
    <hr>
</div>
<?php
if (!empty($error)) {
    echo $error;
}
echo $this->session->flashdata('msg');
echo validation_errors('<div class="alert alert-danger"><p>', '</p></div>');
$attributes = $attributes = array('data-toggle' => 'validator', 'role' => 'form');
echo form_open('pengajuan_keberatan', $attributes);
?>
<div class="panel panel-danger">            
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group has-feedback">
                    <label>Keberatan Atas Permohonan Informasi</label>
                    <?php
                    $options[''] = '- Pilih Nomor Permohonan -';
                    foreach ($get_permohonan_ol as $r):
                        $options[$r['id_permohonan']] = $r['informasi_diminta'];
                    endforeach;
                    unset($r);
                    echo form_dropdown('id_permohonan', $options, '', 'class="form-control input-sm" tabindex="2" required  autocomplete="off"');
                    ?>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Alasan Pengajuan Keberatan</label>
                    <div class="checkbox">
                        <label><input type="checkbox" name="ditolak" value="T"> Permohonan informasi ditolak</label>
                        <label><input type="checkbox" name="tdk_disediakan" value="T"> Informasi berkala tidak disediakan</label>
                        <label><input type="checkbox" name="tdk_ditanggapi" value="T"> Permintaan informasi tidak ditanggapi</label>
                        <label><input type="checkbox" name="tdk_sesuaipermintaan" value="T"> Permintaan informasi ditanggapi tidak sebagaimana diminta</label>
                        <label><input type="checkbox" name="tdk_dipenuhi" value="T"> Permintaan informasi tidak dipenuhi</label>
                        <label><input type="checkbox" name="tdk_wajar" value="T"> Biaya yang dikenakan tidak wajar</label>
                        <label><input type="checkbox" name="overtime" value="T"> Informasi disampaikan melebihi jangka waktu yang ditentukan</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group has-feedback">
                    <label>Kasus Posisi</label>
                    <textarea name="kasus" id="tujuan" class="form-control input-sm" data-minlength="11" spellcheck="false" required="true" autocomplete="off" style="height: 250px;resize: none;"><?php echo set_value('kasus'); ?></textarea>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
            </div>

        </div>        
    </div>
</div>
<div class="panel panel-danger">
    <div class="panel-body">
        <p><b>Identitas Kuasa Pemohon</b></p>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group has-feedback">
                    <label>Nama</label>
                    <input type="text" name="kuasa_nama" class="form-control" value="<?php echo set_value('kuasa_nama'); ?>" autocomplete="off"/>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Nomor Telepon</label>
                    <input type="text" name="kuasa_telp" class="form-control" value="<?php echo set_value('kuasa_telp'); ?>" autocomplete="off"/>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group has-feedback">
                    <label>Alamat</label>
                    <textarea name="kuasa_alamat" class="form-control input-sm" spellcheck="false" autocomplete="off" style="resize: none;height: 110px;"><?php echo set_value('kuasa_alamat'); ?></textarea>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pull-right"><button class="btn btn-success" type="submit">Simpan</button></div>
<div class="clearfix"></div>
<?php
echo form_close();
?>