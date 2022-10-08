<?php
if (!empty($error)) {
    echo $error;
}
echo $this->session->flashdata('message_status');
echo form_open_multipart('adminppid/list_file_categori_upload/' . $detail_kategori->id_tag);
echo form_hidden('id_tag', $detail_kategori->id_tag);
?>
<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_title">
                <h2>Upload File Kategori <?= $detail_kategori->name_tag; ?></h2>                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="form-group">
                    <label>Tipe File</label>
                    <?php
                    $options['file'] = 'File';
                    $options['link'] = 'Link';
                    $selected_tipe = set_value('tipe');
                    echo form_dropdown('tipe', $options, $selected_tipe, 'class="form-control input-sm" id="opttipefile"');
                    ?>
                </div>
                <div class="form-group">
                    <label>Nama File yang Ditampilkan</label>
                    <?= form_textarea('display_name', set_value('display_name'), 'class="form-control input-sm textarea-h100" required="true" autocomplete="off" id="txtdisplay_name"'); ?>
                </div>
                <div id="elementformfile" style="display: block;">
                    <div class="form-group">
                        <label>Slug File <span id="lengthSlug"></span></label>
                        <?= form_input('slug', set_value('slug'), 'class="form-control input-sm" required="true" autocomplete="off" id="txtslug"'); ?>
                    </div>
                    <div class="form-group">
                        <label>File</label>
                        <?= form_upload('nama_file', null, 'required="true" id="fileupload"'); ?>
                    </div>
                </div>
                <div id="elementformlink" style="display: none">
                    <div class="form-group">
                        <label>Link</label>
                        <?= form_input('link', set_value('link'), 'class="form-control input-sm" required="true" autocomplete="off" id="txtlink"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Urutan</label>
                    <?= form_input('sorting_data', $urutan, 'class="form-control input-sm" required="true" autocomplete="off"'); ?>
                </div>
                <div class="ln_solid"></div>
                <div class="pull-right">
                    <a href="<?= site_url('adminppid/list_file_categori/' . $detail_kategori->id_tag); ?>" class="btn btn-warning btn-sm">Batal</a>
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
        var tipefile = $('#opttipefile option:selected').val();
        initshowform(tipefile);
        $('#opttipefile').change(function () {
            tipefile = $('#opttipefile option:selected').val();
            initshowform(tipefile);
        });
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
    function initshowform(tipefile) {
        console.log(tipefile);
        if (tipefile == 'file') {
            $('#elementformlink').hide();
            $('#txtlink').removeAttr('required');
            $('#elementformfile').show();
            $('#txtslug').attr('required', true);
            $('#fileupload').attr('required', true);
        } else {
            $('#elementformlink').show();
            $('#txtlink').attr('required');
            $('#elementformfile').hide();
            $('#txtslug').removeAttr('required', true);
            $('#fileupload').removeAttr('required', true);
        }
    }
    function convertToSlug(Text)
    {
        return Text
                .toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
    }
</script>
