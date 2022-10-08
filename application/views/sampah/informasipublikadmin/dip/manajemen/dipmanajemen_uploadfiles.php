<?php
if (!empty($error)) {
    echo $error;
}
echo $this->session->flashdata('message_status');
echo form_open_multipart('adminppid/dipmanajemenuploadfiles/' . $get_sub->id_sub);
?>
<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_title">
                <h2>Upload File <?= $get_sub->judul_informasi; ?></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="form-group">
                    <label>Nama File yang Ditampilkan</label>
                    <?= form_textarea('display_name', set_value('display_name'), 'class="form-control input-sm textarea-h100" required="true" autocomplete="off" id="txtdisplay_name"'); ?>
                </div>
                <div class="form-group">
                    <label>Slug File <span id="lengthSlug"></span></label>
                    <?= form_input('slug', set_value('slug'), 'class="form-control input-sm" required="true" autocomplete="off" id="txtslug"'); ?>
                </div>
                <div class="form-group">
                    <label>Tahun Pembuatan File</label>
                    <?php
                    $tahun_file = set_value('tahun_file');
                    echo form_input('tahun_file', ($tahun_file == '' ? date('Y') : $tahun_file), 'class="form-control input-sm" required="true" autocomplete="off"');
                    ?>
                </div>
                <div class="form-group">
                    <label>File</label>
                    <?= form_upload('nama_file'); ?>
                </div>
                <div class="form-group">
                    <label>Tipe File</label>
                    <?php
                    $options['File'] = 'File PDF';
                    $options['image'] = 'Image';
                    echo form_dropdown('tipe', $options, 'File', 'class="form-control input-sm"');
                    ?>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <?= form_textarea('keterangan', set_value('keterangan'), 'class="form-control input-sm textarea-h100" autocomplete="off"'); ?>
                </div>
                <div class="ln_solid"></div>
                <div class="pull-right">
                    <a href="<?= site_url('adminppid/dipmanajemenfiles/' . $get_sub->id_sub); ?>" class="btn btn-warning btn-sm">Batal</a>
                    <button type="submit" name="simpan_data" value="prosessimpanfile" id="btnSimpan" class="btn btn-success btn-sm">Simpan</button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<?= form_close(); ?>
<script type="text/javascript">
    $(function () {
        $('#txtdisplay_name').keyup(function () {
            var displayName = $(this).val();
            var slug = convertToSlug(displayName);
            var lengthSlug = slug.length;
            $('#txtslug').val(slug);
            $('#lengthSlug').html('');
            $('#lengthSlug').html('(' + lengthSlug + ')');
            if (lengthSlug > 80) {
                $('#lengthSlug').addClass('bg-red');
                $('#lengthSlug').removeClass('bg-green');
                $('#btnSimpan').prop('disabled', true);
            } else {
                $('#lengthSlug').addClass('bg-green');
                $('#lengthSlug').removeClass('bg-red');
                $('#btnSimpan').prop('disabled', false);
            }
        });
        $('#txtslug').keyup(function () {
            var slug = $('#txtslug').val();
            var lengthSlug = slug.length;
            $('#lengthSlug').html('');
            $('#lengthSlug').html('(' + lengthSlug + ')');
            if (lengthSlug > 80) {
                $('#lengthSlug').addClass('bg-red');
                $('#lengthSlug').removeClass('bg-green');
                $('#btnSimpan').prop('disabled', true);
            } else {
                $('#lengthSlug').addClass('bg-green');
                $('#lengthSlug').removeClass('bg-red');
                $('#btnSimpan').prop('disabled', false);
            }
        });
    });
    function convertToSlug(Text) {
        return Text
                .toLowerCase()
                .replace('rsud prof. dr. margono soekarjo', 'rsud margono')
                .replace('rsud prof dr margono soekarjo', 'rsud margono')
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
    }
</script>