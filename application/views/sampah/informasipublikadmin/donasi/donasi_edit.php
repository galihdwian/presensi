<?php
if (!empty($error)) {
    echo $error;
}
echo $this->session->flashdata('message_status');
$attributes = array('data-toggle' => 'validator', 'role' => 'form');
echo form_open_multipart('adminppid/donasi/edit/' . $id, $attributes);
echo form_hidden('id', $id);
?>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Tambah Donasi</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <label>Tanggal</label>
                                    <input type="text" class="form-control input-sm" name="tanggal_donasi" value="<?= $tanggal_donasi; ?>" autocomplete="off" autofocus autocapitalize="true" required="true" id="single_cal2">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Nama Item</label>
                                    <input type="text" class="form-control input-sm" name="nama_item" value="<?= $nama_item; ?>" autocomplete="off" autocapitalize="true" required="true">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Pengirim</label>
                                    <input type="text" class="form-control input-sm" name="pengirim_donasi" value="<?= $pengirim_donasi; ?>" autocomplete="off" autocapitalize="true" required="true">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <label>Satuan</label>
                                    <?php
                                    $options[null] = '-- Pilih Satuan --';
                                    foreach ($list_satuan as $row_satuan) {
                                        $options[$row_satuan->id] = $row_satuan->nama_satuan;
                                    }
                                    echo form_dropdown('id_donasi_mst_satuan', $options, $id_donasi_mst_satuan, 'class="form-control select2" required="true"');
                                    unset($options);
                                    ?>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Qty</label>
                                    <input type="text" class="form-control input-sm" name="qty" value="<?= $qty; ?>" autocomplete="off" autofocus required="true">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Distribusi</label>
                                    <input type="text" class="form-control input-sm" name="keterangan" value="<?= $keterangan; ?>" autocomplete="off" autocapitalize="true" required="true">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="pull-right">
                            <a href="<?= site_url('adminppid/donasi'); ?>" class="btn btn-warning" id="btnBatal">Batal</a>
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
        $('#single_cal2').daterangepicker({
            locale: {
                format: 'DD-MM-YYYY'
            },
            singleDatePicker: true,
            calender_style: "picker_2",
        });
    });
</script>