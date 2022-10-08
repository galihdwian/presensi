<?php
if (!empty($error)) {
    echo $error;
}
echo $this->session->flashdata('message_status');
$attributes = array('data-toggle' => 'validator', 'role' => 'form');
echo form_open_multipart('adminppid/donasi/master-satuan/edit/' . $id, $attributes);
echo form_hidden('id', $id);
?>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Master Satuan Donasi</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-feedback">
                                    <label>Nama Satuan</label>
                                    <input type="text" class="form-control input-sm" name="nama_satuan" value="<?= $nama_satuan; ?>" autocomplete="off" autofocus autocapitalize="true" required="true">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="pull-right">
                            <a href="<?= site_url('adminppid/donasi/master-satuan'); ?>" class="btn btn-warning" id="btnBatal">Batal</a>
                            <button type="submit" name="simpan_data" value="proses_simpan" class="btn btn-primary">Simpan</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= form_close(); ?>