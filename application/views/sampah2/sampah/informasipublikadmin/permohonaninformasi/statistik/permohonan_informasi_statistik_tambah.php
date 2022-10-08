<?php
if (!empty($error)) {
    echo $error;
}
echo $this->session->flashdata('message_status');
$attributes = array('data-toggle' => 'validator', 'role' => 'form');
echo form_open_multipart('adminpermohonan/statistik/tambah', $attributes);
?>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Tambah Statistik Permohonan Informasi</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <label>Bulan</label>
                                    <?php
                                    $options[null] = '-- Pilih Bulan --';
                                    for ($i = 1; $i < 13; $i++) {
                                        $options[$i] = nama_bulan($i);
                                    }
                                    echo form_dropdown('bulan', $options, set_value('bulan'), 'class="form-control select2" required="true"');
                                    unset($options);
                                    ?>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Tahun</label>
                                    <?php
                                    $options[null] = '-- Pilih Tahun --';
                                    for ($i = 2020; $i < (date('Y') + 1); $i++) {
                                        $options[$i] = $i;
                                    }
                                    echo form_dropdown('tahun', $options, set_value('tahun'), 'class="form-control select2" required="true"');
                                    unset($options);
                                    ?>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <label>Jumlah Permohonan Melalui Medsos yang Diterima</label>
                                    <input type="text" class="form-control input-sm" name="permohonan_medsos_diterima" value="<?= set_value('permohonan_medsos_diterima'); ?>" autocomplete="off" autocapitalize="true" required="true" id="txt-jumlahpermohonan">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Jumlah Permohonan Melalui Medsos yang Disetujui</label>
                                    <input type="text" class="form-control input-sm" name="permohonan_medsos_disetujui" value="<?= set_value('permohonan_medsos_disetujui'); ?>" autocomplete="off" autocapitalize="true" required="true">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <label>Jumlah Permohonan Langsung yang Diterima</label>
                                    <input type="text" class="form-control input-sm" name="permohonan_langsung_diterima" value="<?= set_value('permohonan_langsung_diterima'); ?>" autocomplete="off" autocapitalize="true" required="true" id="txt-jumlahpermohonan">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Jumlah Permohonan Langsung yang Disetujui</label>
                                    <input type="text" class="form-control input-sm" name="permohonan_langsung_disetujui" value="<?= set_value('permohonan_langsung_disetujui'); ?>" autocomplete="off" autocapitalize="true" required="true">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="pull-right">
                            <a href="<?= site_url('adminpermohonan/statistik'); ?>" class="btn btn-warning" id="btnBatal">Batal</a>
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
<script type="text/javascript">
    $(function() {
        $('.select2').select2();
    });
</script>