<?php
if (!empty($error)) {
    echo $error;
}
echo $this->session->flashdata('message_status');
$typeFile = $threadMedia['typefile'];
?>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Media : <?= $typeFile == 'youtube' ? $threadMedia['judulmedia'] : $threadMedia['namafile']; ?></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div id="contentnotifikasi" style="display: none;"></div>
                <div id="contentnotifikasiaddfiles" style="display: none;"></div>
                <?php
                echo form_open('adminppid/' . $threadMain['slug'] . '/update_media/' . $threadContent['slug'] . '/' . $threadMedia['idmedia'] . '/' . $threadMedia['idfile']);
                echo form_hidden('idContent', $threadContent['idcontent']);
                echo form_hidden('idTopik', $threadMain['idtopik']);
                echo form_hidden('slugMain', $threadMain['slug']);
                echo form_hidden('idmedia', $threadMedia['idmedia']);
                echo form_hidden('idfile', $threadMedia['idfile']);
                echo form_hidden('typeFile', $typeFile);
                if ($typeFile == 'youtube') {
                ?>
                    <div class="form-group">
                        <label>Url Youtube</label>
                        <?php
                        $url = $threadMedia['namafile'];
                        echo form_input('url', $url, 'class="form-control input-sm"');
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Judul Video</label>
                        <?php
                        echo form_input('judulmedia', $threadMedia['judulmedia'], 'class="form-control input-sm"');
                        ?>
                    </div>
                <?php
                }
                ?>
                <div class="form-group has-feedback">
                    <label>Judul Narasi</label>
                    <textarea class="form-control input-sm" name="judulnarasi" id="txtEditor"><?= $threadMedia['judulnarasi']; ?></textarea>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Narasi</label>
                    <textarea class="form-control input-sm" name="narasi" id="txtnarasi"><?= $threadMedia['narasi']; ?></textarea>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="pull-right">
                    <a href="<?= site_url('adminppid/' . $threadMain['slug'] . '/' . $threadContent['slug']); ?>" class="btn btn-warning">Batal</a>
                    <?= form_submit('simpanMedia', 'Simpan', 'class="btn btn-success"'); ?>
                </div>
                <?php
                echo form_close();
                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    CKEDITOR.replace('txtnarasi', {
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