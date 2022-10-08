<?php
if (!empty($error)) {
    echo $error;
}
echo $this->session->flashdata('message_status');
echo form_open('adminppid/dipmanajemenfilesedit/' . $file_trans->id_sub . '/' . $file_trans->id_file);
echo form_hidden('id_sub', $file_trans->id_sub);
echo form_hidden('id_file', $file_trans->id_file);
?>
<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_title">
                <h2>Manajemen File <?= $check_sub->judul_informasi; ?></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="form-group">
                    <label>Nama File yang Ditampilkan</label>
                    <?= form_input('display_name', $file_trans->display_name, 'class="form-control input-sm"'); ?>
                    <p class="help-block">*merubah Nama File yang Ditampilkan berarti merubah semua tampilan file ini.</p>
                </div>
                <div class="form-group">
                    <label>Nama File</label>
                    <?= form_input('nama_file', $file_trans->nama_file, 'class="form-control input-sm" readonly="true"'); ?>
                </div>
                <div class="form-group">
                    <label>Urutan</label>
                    <?= form_input('sort_display', $file_trans->sort_display, 'class="form-control input-sm"'); ?>
                </div>
                <div class="ln_solid"></div>
                <div class="pull-right">
                    <a href="<?= site_url('adminppid/dipmanajemenfiles/' . $file_trans->id_sub); ?>" class="btn btn-warning btn-sm">Batal</a>
                    <button type="submit" name="simpan_data" value="prosessimpanfile" id="btnSimpan" class="btn btn-success btn-sm">Simpan</button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<?= form_close(); ?>