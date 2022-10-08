<?php
if (!empty($error)) {
    echo $error;
}
echo $this->session->flashdata('message_status');
?>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Tambah Content <?= $thread_main->judultopik; ?></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div id="contentnotifikasi" style="display: none;"></div>
                <div id="contentnotifikasiaddfiles" style="display: none;"></div>
                <?php
                echo form_open("adminppid/{$thread_main->slug}/tambah_content/");
                echo form_hidden('idtopik', $thread_main->idtopik);
                ?>
                <div class="form-group has-feedback">
                    <label>Judul Content</label>
                    <textarea class="form-control input-sm" name="headingcontent" id="txtheadingcontent"><?= set_value('headingcontent'); ?></textarea>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Keterangan</label>
                    <input type="text" class="form-control input-sm" name="keterangan" value="<?= set_value('keterangan'); ?>" id="txtketerangan">
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Slug Content</label>
                    <input type="text" class="form-control input-sm" name="slug" value="<?= set_value('slug'); ?>" required="true" id="txtslug">
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Isi Content</label>
                    <textarea class="form-control input-sm" name="isicontent" id="txtisicontent"><?= set_value('isicontent'); ?></textarea>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Type Media</label>
                    <?php
                    $options[null] = '-- Pilih Type Media --';
                    $options['image'] = 'Foto';
                    $options['video'] = 'Video';
                    echo form_dropdown('mediatype', $options, set_value('mediatype'), 'class="form-control input-sm"');
                    unset($options);
                    ?>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Posisi Media</label>
                    <?php
                    $options['bottom'] = 'Dibawah Isi Content';
                    $options['top'] = 'Diatas Isi Content';
                    echo form_dropdown('mediaposition', $options, set_value('mediaposition'), 'class="form-control input-sm"');
                    unset($options);
                    ?>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Tampilan Link</label>
                    <input type="text" class="form-control input-sm" name="contentlinkdisplay" value="<?= set_value('contentlinkdisplay'); ?>">
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="pull-right">
                    <a href="<?= site_url("adminppid/{$thread_main->slug}"); ?>" class="btn btn-warning">Batal</a>
                    <?= form_submit('simpan', 'Simpan', 'class="btn btn-success"'); ?>
                </div>
                <?php
                echo form_close();
                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    CKEDITOR.replace('txtisicontent', {
        language: 'id',
        uiColor: '#9AB8F3',
        toolbarGroups: [{
                "name": "basicstyles",
                "groups": ["basicstyles"]
            },
            {
                "name": "links",
                "groups": ["links"]
            },
            {
                "name": "paragraph",
                "groups": ["list", "blocks"]
            },
            {
                "name": "document",
                "groups": ["mode"]
            }
        ],
        removeButtons: 'Anchor,Styles,Blockquote,CreateDiv,Save,NewPage,Preview,Print',
        height: 300,
        allowedContent: true
    });
    CKEDITOR.replace('txtheadingcontent', {
            language: 'id',
            uiColor: '#9AB8F3',
            toolbarGroups: [{
                    "name": "basicstyles",
                    "groups": ["basicstyles"]
                },
                {
                    "name": "links",
                    "groups": ["links"]
                },
                {
                    "name": "paragraph",
                    "groups": ["list", "blocks"]
                },
                {
                    "name": "document",
                    "groups": ["mode"]
                }
            ],
            removeButtons: 'Anchor,Styles,Blockquote,CreateDiv,Save,NewPage,Preview,Print',
            height: 300,
            allowedContent: true
        })
        .on('blur', function(e) {
            let headingcontent = CKEDITOR.instances['txtheadingcontent'].getData();
            let slug = convertToSlug(headingcontent);
            $('#txtslug').val(slug);
        });
    $(function() {
        $('#txtketerangan').keyup(function() {
            let txtketerangan = $(this).val();
            let textslug = $('#txtslug').val();
            if (!textslug.value) {
                let slug = convertToSlug(txtketerangan);
                $('#txtslug').val(slug);
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