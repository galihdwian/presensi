<?php
if (!empty($error)) {
    echo $error;
}
echo $this->session->flashdata('message_status');
echo form_open_multipart('adminppid/manajemenfiles_edit/' . $get_file['id'] . '/' . $get_file['type_file']);
echo form_hidden('id_file', $get_file['id']);
echo form_hidden('type_file', $get_file['type_file']);
?>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit File</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="form-group">
                    <label>Nama File yang Ditampilkan</label>
                    <?= form_textarea('display_name', $get_file['display_name'], 'class="form-control input-sm textarea-h100" required="true" autocomplete="off" id="txtdisplay_name"'); ?>
                </div>
                <div class="form-group">
                    <label>Slug File <span id="lengthSlug"></span></label>
                    <?= form_input('slug', $get_file['slug'], 'class="form-control input-sm" required="true" autocomplete="off" id="txtslug" readonly="true"'); ?>
                </div>
                <?php
                if (!empty($get_file['tahun'])) {
                ?>
                    <div class="form-group">
                        <label>Tahun Pembuatan File</label>
                        <?= form_input('tahun_file', $get_file['tahun'], 'class="form-control input-sm" required="true" autocomplete="off"'); ?>
                    </div>
                <?php
                }
                ?>
                <div class="form-group">
                    <label>File <span class="small">(Upload file baru akan mengupdate file lama)</span></label>
                    <?= form_upload('nama_file'); ?>
                </div>
                <?php
                if (!empty($get_file['tipe'])) {
                ?>
                    <div class="form-group">
                        <label>Tipe File</label>
                        <?php
                        $options['File'] = 'File PDF';
                        $options['image'] = 'Image';
                        echo form_dropdown('tipe', $options, $get_file['tipe'], 'class="form-control input-sm"');
                        unset($options);
                        ?>
                    </div>
                <?php
                }
                if (!empty($get_file['keterangan'])) {
                ?>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <?= form_textarea('keterangan', $get_file['keterangan'], 'class="form-control input-sm textarea-h100" autocomplete="off"'); ?>
                    </div>
                <?php
                }
                if (!empty($get_file['fileindex'])) {
                ?>
                    <div class="form-group">
                        <label>Tampilkan di Pencarian</label>
                        <?php
                        $options['T'] = 'Ya';
                        $options['F'] = 'Tidak';
                        echo form_dropdown('fileindex', $options, $get_file['fileindex'], 'class="form-control input-sm"');
                        ?>
                    </div>
                <?php
                }
                ?>
                <div class="ln_solid"></div>
                <div class="pull-right">
                    <a href="<?= site_url('adminppid/manajemenfiles'); ?>" class="btn btn-warning btn-sm">Batal</a>
                    <?php
                    if ($get_file['type_file'] == 'ip_sub_file') {
                    ?>
                        <a href="<?= site_url('informasipublik/file/' . $get_file['slug']); ?>" class="btn btn-info btn-sm" target="blank">Lihat</a>
                    <?php
                    } else {
                    ?>
                        <a href="<?= site_url('informasipublik/showfilekategori/' . $get_file['slug']); ?>" class="btn btn-info btn-sm" target="blank">Lihat</a>
                    <?php
                    }
                    ?>
                    <button type="submit" name="simpan_data" value="prosessimpanfile" id="btnSimpan" class="btn btn-success btn-sm">Simpan</button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<?= form_close(); ?>