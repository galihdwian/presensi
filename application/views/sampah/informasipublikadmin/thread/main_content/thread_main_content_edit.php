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
                <h2>Edit Content <?= $thread_main->judultopik; ?></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div id="contentnotifikasi" style="display: none;"></div>
                <div id="contentnotifikasiaddfiles" style="display: none;"></div>
                <?php
                echo form_open("adminppid/{$thread_main->slug}/edit_content/{$thread_content->idcontent}");
                echo form_hidden('idtopik', $thread_main->idtopik);
                echo form_hidden('idcontent', $thread_content->idcontent);
                ?>
                <div class="form-group has-feedback">
                    <label>Judul Content</label>
                    <textarea class="form-control input-sm" class="form-control input-sm" name="headingcontent" required="true" id="txtheadingcontent"><?= $thread_content->headingcontent; ?></textarea>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Keterangan</label>
                    <input type="text" class="form-control input-sm" name="keterangan" value="<?= $thread_content->keterangan; ?>" id="txtketerangan">
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Slug Content</label>
                    <input type="text" class="form-control input-sm" name="slug" value="<?= $thread_content->slug; ?>" required="true" id="txtslug">
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Isi Content</label>
                    <textarea class="form-control input-sm" name="isicontent" id="txtisicontent"><?= $thread_content->isicontent; ?></textarea>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Type Media</label>
                    <?php
                    $options[null] = '-- Pilih Type Media --';
                    $options['image'] = 'Foto';
                    $options['video'] = 'Video';
                    echo form_dropdown('mediatype', $options, $thread_content->meditype, 'class="form-control input-sm"');
                    unset($options);
                    ?>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Posisi Media</label>
                    <?php
                    $options['bottom'] = 'Dibawah Isi Content';
                    $options['top'] = 'Diatas Isi Content';
                    echo form_dropdown('mediaposition', $options, $thread_content->mediaposition, 'class="form-control input-sm"');
                    unset($options);
                    ?>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Tampilan Link</label>
                    <input type="text" class="form-control input-sm" name="contentlinkdisplay" value="<?= $thread_content->contentlinkdisplay; ?>">
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
    });
</script>