<?php
if (!empty($error)) {
    echo $error;
}
echo $this->session->flashdata('message_status');
echo form_open('adminppid/pengadaan/tambah_data/' . rawurlencode($tahun_pengadaan));
?>
<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_title"> 
                <h2>Tambah Data Pengadaan</h2>                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="form-group">
                    <label>Nama Paket Pengadaan</label>
                    <?= form_input('nama_paket', set_value('nama_paket'), 'class="form-control input-sm" autocomplete="off" required="true"'); ?>
                </div>
                <div class="form-group">
                    <label>Tahun Pengadaan</label>
                    <?php
                    $value_tahunpengadaan = set_value('tahunpengadaan');
                    echo form_input('tahunpengadaan', (!empty($value_tahunpengadaan) ? $value_tahunpengadaan : $tahun_pengadaan), 'class="form-control input-sm" autocomplete="off" required="true"');
                    ?>
                </div>
                <div class="form-group">
                    <label>Sumber Anggaran</label>
                    <?= form_input('sumber_anggaran', set_value('sumber_anggaran'), 'class="form-control input-sm" autocomplete="off" required="true"'); ?>
                </div>
                <div class="form-group">
                    <label>Pagu Anggaran</label>
                    <?= form_input('pagu_anggaran', set_value('pagu_anggaran'), 'class="form-control input-sm" autocomplete="off" required="true" id="txtpaguanggaran"'); ?>
                </div>
                <div class="form-group">
                    <label>Nilai Kontrak</label>
                    <?= form_input('nilai_kontrak', set_value('nilai_kontrak'), 'class="form-control input-sm" autocomplete="off" required="true" id="txtnilaikontrak"'); ?>
                </div>
                <div class="form-group">
                    <label>ID Tender LPSE</label>
                    <?= form_input('idtender', set_value('idtender'), 'class="form-control input-sm" autocomplete="off"'); ?>
                </div>
                <div class="form-group">
                    <label>Jenis Pengadaan</label>
                    <?php
                    $options['Lelang'] = 'Lelang';
                    $options['Tender'] = 'Tender';
                    $options['Tender Cepat'] = 'Tender Cepat';
                    $options['Pengadaan Langsung'] = 'Pengadaan Langsung';
                    $options['Penunjukan Langsung'] = 'Penunjukan Langsung';
                    $options['E-Purchasing'] = 'E-Purchasing';
                    echo form_dropdown('jenis_pengadaan', $options, set_value('jenis_pengadaan'), 'class="form-control input-sm" autocomplete="off"');
                    unset($options);
                    ?>
                </div>
                <div class="form-group">
                    <label>Nama Penyedia</label>
                    <?= form_input('penyedia', set_value('penyedia'), 'class="form-control input-sm" autocomplete="off"'); ?>
                </div>
                <div class="form-group" id="elpenyedia">
                    <label>Nomor Kontrak</label>
                    <?= form_input('nomor_kontrak', set_value('nomor_kontrak'), 'class="form-control input-sm" autocomplete="off"'); ?>
                </div>
                <div class="form-group" id="elpenyedia">
                    <label>Tanggal Kontrak</label>
                    <?= form_input('tanggal_kontrak', set_value('tanggal_kontrak'), 'class="form-control input-sm inputdate" autocomplete="off"'); ?>
                </div>
                <div class="ln_solid"></div>
                <div class="pull-right">
                    <a href="<?= site_url('adminppid/pengadaan'); ?>" class="btn btn-warning btn-sm" >Batal</a>
                    <button type="submit" name="simpan_data" value="proses_simpan" class="btn btn-primary btn-sm">Simpan</button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<?= form_close(); ?>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.maskedinput.js'); ?>"></script>
<script type="text/javascript">
    $(function () {
        $(".inputdate").mask("99-99-9999", {placeholder: "dd-mm-yyyy"});
        $('#txtpaguanggaran').change(function () {
            var pagu = $(this).val();
            pagu = pagu.replace(/\./g, "");
            var curencyPagu = currencyFormatID(parseInt(pagu));
            $(this).val(curencyPagu.toString());
        });
        $('#txtnilaikontrak').change(function () {
            var nilaikontrak = $(this).val();
            nilaikontrak = nilaikontrak.replace(/\./g, "");
            var curencynilaikontrak = currencyFormatID(parseInt(nilaikontrak));
            $(this).val(curencynilaikontrak.toString());
        });
    });
</script>
