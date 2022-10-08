<?php
if (!empty($error)) {
    echo '<div class="alert alert-danger">' . $error . '</div>';
}
$attributes = array('data-toggle' => 'validator', 'role' => 'form');
echo form_open('matkul_detail_tambah/' . $id_matkul, $attributes);
?>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Tambah Detail Mata Kuliah</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group has-feedback">
                                    <label>Nama Mahasiswa</label>
                                    <?php
                                    $options[''] = '- Pilih Mahasiswa -';
                                    foreach ($get_list_mahasiswa as $r) :
                                        $options[$r->id_mhs] = $r->nama_mhs;
                                    endforeach;
                                    unset($r);
                                    echo form_dropdown('id_mhs', $options, '', 'class="form-control input-sm" tabindex="2" required  autocomplete="off"');
                                    ?>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>

                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="pull-right">
                            <a href="<?= site_url('matkul_detail/' . $id_matkul); ?>" class="btn btn-warning" id="btnBatal">Batal</a>
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