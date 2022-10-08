<?php
if (!empty($error)) {
    echo $error;
}
echo $this->session->flashdata('message_status');
echo form_open('adminppid/pengadaan/master_dokumen_tambah_data');
?>
<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_title"> 
                <h2>Tambah Data Master Dokumen</h2>                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="form-group">
                    <label>Id Dokumen</label>
                    <?= form_input('iddokumen', set_value('iddokumen'), 'class="form-control input-sm" autocomplete="off" required="true" id="txtiddokumen"'); ?>
                </div>
                <div class="form-group">
                    <label>Nama Dokumen</label>
                    <?= form_input('namadokumen', set_value('namadokumen'), 'class="form-control input-sm" autocomplete="off" required="true" id="txtnamadokumen"'); ?>
                </div>
                <div class="form-group">
                    <label>Urutan Tampil</label>
                    <?php
                    $value_urutan = set_value('urutan');
                    echo form_input('urutan', (!empty($value_urutan) ? $value_urutan : $urutan), 'class="form-control input-sm" autocomplete="off" required="true"');
                    ?>
                </div>
                <div class="form-group">
                    <label>LPSE Prefix</label>
                    <?= form_input('lpseprefix', set_value('lpseprefix'), 'class="form-control input-sm" autocomplete="off"'); ?>
                </div>
                <div class="form-group">
                    <label>LPSE Sufix</label>
                    <?= form_input('lpsesufix', set_value('lpsesufix'), 'class="form-control input-sm" autocomplete="off"'); ?>
                </div>
                <div class="form-group">
                    <label>Tipe Dokumen</label>
                    <?php
                    $options['01'] = 'Dokumen Paket Pengadaan';
                    $options['02'] = 'Dokumen Pengadaan RS';
                    echo form_dropdown('tipedokumen', $options, set_value('tipedokumen'), 'class="form-control input-sm" autocomplete="off" required="true"');
                    ?>
                </div>
                <div class="ln_solid"></div>
                <div class="pull-right">
                    <a href="<?= site_url('adminppid/pengadaan/master_dokumen'); ?>" class="btn btn-warning btn-sm" >Batal</a>
                    <button type="submit" name="simpan_data" value="proses_simpan" class="btn btn-primary btn-sm">Simpan</button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<?= form_close(); ?>
<script type="text/javascript">
    $(function () {
        $('#txtiddokumen').keyup(function () {
            var txtiddokumenval = $(this).val();
            var newtxtiddokumenval = txtiddokumenval.replace(" ", "");
            $(this).val(newtxtiddokumenval.toUpperCase());
        });
    });
</script>
