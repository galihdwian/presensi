<?php
if (!empty($error)) {
    echo '<div class="alert alert-danger">' . $error . '</div>';
}
$attributes = array('data-toggle' => 'validator', 'role' => 'form');
echo form_open('periode_edit/' . $get_periode->id_periode, $attributes);
?>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Data Periode</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="form-group has-feedback">
                                <label>Tahun Periode</label>
                                <input type="text" class="form-control input-sm" value="<?= $get_periode->tahun_periode ?>" name="tahun_periode" autocomplete="off" autofocus autocapitalize="true" required="true">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <label>Semester</label>
                                <input type="text" class="form-control input-sm" value="<?= $get_periode->semester ?>" name="semester" autocomplete="off" autofocus autocapitalize="true" required="true">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="pull-right">
                        <a href="<?= site_url('periode'); ?>" class="btn btn-warning" id="btnBatal">Batal</a>
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