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
                <h2>Tambah Media <?= $threadContent['headingcontent']; ?></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div id="contentnotifikasi" style="display: none;"></div>
                <div id="contentnotifikasiaddfiles" style="display: none;"></div>
                <?php
                echo form_open('adminppid/' . $threadMain['slug'] . '/simpan_media/' . $threadContent['slug'] . '/' . $typeFile);
                echo form_hidden('typeFile', $typeFile);
                echo form_hidden('idContent', $threadContent['idcontent']);
                echo form_hidden('idTopik', $threadMain['idtopik']);
                echo form_hidden('slugMain', $threadMain['slug']);
                //start form tambah media file PPID DIP
                if ($typeFile == 'fileppid') {
                ?>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="txtsearchfile" placeholder="Masukan nama file">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary" id="btnsearchfile"><i class="fa fa-search"></i> Cari</button>
                            </span>
                        </div>
                    </div>
                    <div id="formpecarianpilihfile" style="display: none;">
                        <div class="form-group">
                            <label>Pilih File PPID</label>
                            <?php
                            $options = array();
                            echo form_dropdown('idFilePpid', $options, null, 'class="form-control input-sm" id="opttambahfile"');
                            ?>
                        </div>
                    </div>
                <?php
                }
                //end form tambah media file PPID
                //start form tambah media file PPID KATEGORI
                if ($typeFile == 'fileppidtag') {
                ?>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="txtsearchfiletag" placeholder="Masukan nama file">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary" id="btnsearchfiletag"><i class="fa fa-search"></i> Cari</button>
                            </span>
                        </div>
                    </div>
                    <div id="formpecarianpilihfile" style="display: none;">
                        <div class="form-group">
                            <label>Pilih File PPID</label>
                            <?php
                            $options = array();
                            echo form_dropdown('idFilePpid', $options, null, 'class="form-control input-sm" id="opttambahfile"');
                            ?>
                        </div>
                    </div>
                <?php
                }
                //end form tambah media file PPID KATEGORI
                //start from tambah media youtube
                if ($typeFile == 'youtube') {
                ?>
                    <div class="form-group">
                        <label>Url Youtube</label>
                        <?php
                        $url = set_value('url');
                        $url = empty($url) ? 'https://www.youtube.com/embed/' : $url;
                        echo form_input('url', $url, 'class="form-control input-sm"');
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Judul Video</label>
                        <?php
                        echo form_input('judulmedia', set_value('judulmedia'), 'class="form-control input-sm"');
                        ?>
                    </div>
                <?php
                }
                //end from tambah media youtube
                ?>
                <div class="form-group has-feedback">
                    <label>Judul Narasi</label>
                    <textarea class="form-control input-sm" name="judulnarasi" id="txtEditor"><?= set_value('judulnarasi'); ?></textarea>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Narasi</label>
                    <textarea class="form-control input-sm" name="narasi" id="txtnarasi"><?= set_value('narasi'); ?></textarea>
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
    $(function() {
        $('#btnTambahData').click(function() {
            $('#elementTambah').show();
            $('#txtsearchfile').focus();
        });
        //pencarian file ppid dip
        $('#btnsearchfile').click(function() {
            var keyWord = $('#txtsearchfile').val();
            if (keyWord.length > 0) {
                initFormTambahData(keyWord, 'dip');
            } else {
                generateNotifikasi('warning', 'Masukan nama file terlebih dahulu untuk melakukan pencarian file.', '');
                $('#txtsearchfile').focus();
            }
        });
        $('#txtsearchfile').keyup(function(e) {
            e.preventDefault();
            if (e.keyCode == 13) {
                var keyWord = $('#txtsearchfile').val();
                initFormTambahData(keyWord, 'dip');
            }
        });
        //pencarian file ppid kategori
        $('#btnsearchfiletag').click(function() {
            var keyWord = $('#txtsearchfiletag').val();
            if (keyWord.length > 0) {
                initFormTambahData(keyWord, 'tag');
            } else {
                generateNotifikasi('warning', 'Masukan nama file terlebih dahulu untuk melakukan pencarian file.', '');
                $('#txtsearchfile').focus();
            }
        });
        $('#txtsearchfiletag').keyup(function(e) {
            e.preventDefault();
            if (e.keyCode == 13) {
                var keyWord = $('#txtsearchfiletag').val();
                initFormTambahData(keyWord, 'tag');
            }
        });
    });

    function generateNotifikasi(type, msg, elementid) {
        if (elementid.length == 0) {
            elementid = 'contentnotifikasi';
        }
        var str = '<div class="alert alert-' + type + '"><p>' + msg + '</p></div>';
        $('#' + elementid).html('');
        $('#' + elementid).html(str);
        $('#' + elementid).show();
    }

    function initFormTambahData(keyWord, type) {
        $('#formpecarianpilihfile').hide();
        var idContent = "<?= $threadContent['idcontent']; ?>";
        var urlTarget = "<?= site_url('adminppid/' . $threadMain['slug'] . '/pencarian_file_ppid') ?>";
        $.ajax({
            type: "POST",
            url: urlTarget,
            data: {
                key: keyWord,
                id: idContent,
                tipedata: type
            },
            dataType: "json",
            success: function(data) {
                var success = data.success;
                if (success == false) {
                    var message = ($.isEmptyObject(data.message) ? 'Tidak dapat memproses permintaan' : data.message);
                    generateNotifikasi('warning', message, '');
                } else {
                    $('#formpecarianpilihfile').show();
                    $('#opttambahfile').empty();
                    var listfile = data.data;
                    $('#opttambahfile').append($('<option>').val(null).text('Pilih Files'));
                    $.each(listfile, function(i, item) {
                        $('#opttambahfile').append($('<option>').val(item.id_file).text(item.display_name));
                    });
                    $('#opttambahfile').select2({
                        placeholder: "Pilih Files"
                    });
                    $('#opttambahfile').focus();
                }
            },
            failure: function(errMsg) {
                generateNotifikasi('warning', errMsg, '');
            }
        });
    }
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