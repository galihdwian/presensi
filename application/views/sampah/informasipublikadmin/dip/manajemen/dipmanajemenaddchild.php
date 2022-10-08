<?php
if (!empty($error)) {
    echo $error;
}
echo $this->session->flashdata('message_status');
$attributes = array('data-toggle' => 'validator', 'role' => 'form');
echo form_open_multipart('adminppid/dipmanajemenaddchild/' . $id_sub, $attributes);
?>
<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_content"> 
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Klasifikasi</label>
                                <input type="hidden" name="id_klasifikasi" value="<?= $get_parentdata->id_ppid; ?>">
                                <input type="hidden" name="id_parent" value="<?= $get_parentdata->id_dip; ?>">
                                <input type="text" class="form-control input-sm" name="nama_klasifikasi" value="<?= $get_parentdata->nama_ppid; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Induk Sub</label>
                                <input type="hidden" name="id_sub" value="<?= $get_parentdata->id_sub; ?>">
                                <input type="text" class="form-control input-sm" name="judul_informasi_induk" value="<?= $get_parentdata->judul_informasi; ?>" readonly>
                            </div>
                            <div class="form-group has-feedback">
                                <label>Judul Informasi</label>
                                <input type="text" class="form-control input-sm" name="judul_informasi" value="<?php echo set_value('judul_informasi'); ?>" autocomplete="off">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <label>Ringkasan Isi Informasi</label>
                                <textarea class="form-control input-sm" name="isi_informasi" id="txtEditor"><?php echo set_value('isi_informasi'); ?></textarea>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <label>Display Detail (jika dikosongkan otomatis yang ditampilkan adalah Ringkasan Isi Informasi)</label>
                                <textarea class="form-control input-sm" name="display_detail" id="txtDisplayDetail"><?php echo set_value('display_detail'); ?></textarea>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <label>Penanggung Jawab</label>
                                <input type="text" class="form-control input-sm" name="penanggung_jawab" value="<?php echo set_value('penanggung_jawab'); ?>" autocomplete="off">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>                                           
                        </div>
                        <div class="col-md-6"> 
                            <div class="form-group has-feedback">
                                <label>Waktu Pembuatan</label>
                                <input type="text" class="form-control input-sm" name="waktu_pembuatan" value="<?php echo set_value('waktu_pembuatan'); ?>" autocomplete="off">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>  
                            <div class="form-group has-feedback">
                                <label>Bentuk Informasi</label>
                                <input type="text" class="form-control input-sm" name="bentuk_informasi" value="<?php echo set_value('bentuk_informasi'); ?>" autocomplete="off">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div> 
                            <div class="form-group has-feedback">
                                <label>Jangka Waktu Penyimpanan</label>
                                <input type="text" class="form-control input-sm" name="jangka_waktu" value="<?php echo set_value('jangka_waktu'); ?>" autocomplete="off">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>         
                            <div class="form-group has-feedback">
                                <label>Media Yg Memuat Informasi</label>
                                <textarea class="form-control input-sm" name="media" id="txtEditorMedia"><?php echo set_value('media'); ?></textarea>
                            </div>
                            <div class="form-group has-feedback">
                                <label>Tipe View</label>
                                <?php
                                $options = array();
                                foreach ($get_tipeview as $r_tv):
                                    $options[$r_tv['id_view']] = $r_tv['nama_view'];
                                endforeach;
                                unset($r_tv);
                                $js = 'class="form-control input-sm"';
                                echo form_dropdown('tipe_view', $options, set_value('tipe_view'), $js);
                                ?>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <label>Aktif DIP</label><br>
                                <div class="radio mt-0 mb-20">
                                    <label class="mr-15">
                                        <input type="radio" name="aktif_dip" value="T" <?php echo set_radio('aktif_dip', 'T', TRUE); ?>>Ya
                                    </label>
                                    <label>
                                        <input type="radio" name="aktif_dip" value="F" <?php echo set_radio('aktif_dip', 'F'); ?>>Tidak
                                    </label>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <label>Tahun DIP</label>
                                <?php
                                echo form_input('tahun_dip', $get_parentdata->tahun_dip, 'class="form-control input-sm" readonly="true"');
                                ?>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="pull-right">
                    <button type="button" class="btn btn-warning btn-sm" id="btnBatal">Batal</button>
                    <button type="submit" name="simpan_data" value="proses_simpan" class="btn btn-primary btn-sm">Save changes</button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<?= form_close(); ?>
<script>
    CKEDITOR.replace('txtEditor', {
        language: 'id',
        uiColor: '#9AB8F3',
        toolbarGroups: [{"name": "basicstyles", "groups": ["basicstyles"]},
            {"name": "links", "groups": ["links"]},
            {"name": "paragraph", "groups": ["list", "blocks"]},
            {"name": "document", "groups": ["mode"]}
        ],
        removeButtons: 'Anchor,Styles,Blockquote,CreateDiv,Save,NewPage,Preview,Print',
        height: 100
    });

    CKEDITOR.replace('txtDisplayDetail', {
        language: 'id',
        uiColor: '#9AB8F3',
        toolbarGroups: [{"name": "basicstyles", "groups": ["basicstyles"]},
            {"name": "links", "groups": ["links"]},
            {"name": "paragraph", "groups": ["list", "blocks"]},
            {"name": "document", "groups": ["mode"]}
        ],
        removeButtons: 'Anchor,Styles,Blockquote,CreateDiv,Save,NewPage,Preview,Print',
        height: 100
    });
    CKEDITOR.replace('txtEditorMedia', {
        language: 'id',
        uiColor: '#9AB8F3',
        toolbarGroups: [{"name": "basicstyles", "groups": ["basicstyles"]},
            {"name": "links", "groups": ["links"]},
            {"name": "paragraph", "groups": ["list", "blocks"]},
            {"name": "document", "groups": ["mode"]}
        ],
        removeButtons: 'Anchor,Styles,Blockquote,CreateDiv,Save,NewPage,Preview,Print',
        height: 100
    });
    $(function () {
        $('#btnBatal').click(function () {
            window.history.go(-1);
        });
    });
</script>