<?php
if (!empty($error)) {
    echo $error;
}
echo $this->session->flashdata('message_status');
$attributes = array('data-toggle' => 'validator', 'role' => 'form');
echo form_open_multipart('adminppid/dipmanajemenadd/' . $selected_tahun_dip, $attributes);
?>
<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_content"> 
                <div class="row">
                    <div class="col-md-12 col-sm-12">                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <label>Klasifikasi</label>
                                    <?php
                                    foreach ($get_klasifikasi as $r_kl):
                                        $options[$r_kl['id_ppid']] = $r_kl['nama_ppid'];
                                    endforeach;
                                    echo form_dropdown('id_klasifikasi', $options, set_value('id_klasifikasi'), 'class="form-control input-sm" id="optKlasifikasiDip"');
                                    unset($r_kl, $options);
                                    ?>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Judul Informasi</label>
                                    <input type="text" class="form-control input-sm" name="judul_informasi" value="<?php echo set_value('judul_informasi'); ?>" autocomplete="off">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                
                                <div class="form-group has-feedback">
                                    <label>Heading DIP</label><br>
                                    <div class="radio mt-0 mb-20">
                                        <label class="mr-15">
                                            <input type="radio" name="heading_dip" value="T" <?php echo set_radio('heading_dip', 'T'); ?> id="radioHeadingDipYa">Ya
                                        </label>
                                        <label>
                                            <input type="radio" name="heading_dip" value="F" <?php echo set_radio('heading_dip', 'F', true); ?> id="radioHeadingDipTidak">Tidak
                                        </label>
                                    </div>
                                </div>

                                <div class="khusus-dikecualikan hide-if-headingdip" style="display: none;">
                                    <div class="form-group has-feedback">
                                        <label>Ringkasan Isi Informasi</label>
                                        <textarea class="form-control input-sm" name="isi_informasi" id="txtEditor"><?php echo set_value('isi_informasi'); ?></textarea>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="hide-if-headingdip" style="display: none;">
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
                                    <div class="form-group has-feedback">
                                        <label>Waktu Pembuatan</label>
                                        <input type="text" class="form-control input-sm" name="waktu_pembuatan" value="<?php echo set_value('waktu_pembuatan'); ?>" autocomplete="off">
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="khusus-dikecualikan" style="display: none;">
                                    <div class="form-group has-feedback">
                                        <label>Dasar Hukum</label>
                                        <textarea class="form-control input-sm" name="dasar_hukum" id="txtEditorDasarHukum"><?php echo set_value('dasar_hukum'); ?></textarea>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label>Batas Waktu Pengecualian</label>
                                        <input type="text" class="form-control input-sm" name="batas_waktu" value="<?php echo set_value('batas_waktu'); ?>" autocomplete="off">                                        
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="khusus-dikecualikan" style="display: none;">
                                    <div class="form-group has-feedback">
                                        <label>Akibat Dibuka</label>
                                        <textarea class="form-control input-sm" name="akibat_dibuka" id="txtEditorAkibatDibuka"><?php echo set_value('akibat_dibuka'); ?></textarea>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label>Akibat Ditutup</label>
                                        <textarea class="form-control input-sm" name="akibat_ditutup" id="txtEditorAkibatDitutup"><?php echo set_value('akibat_dibuka'); ?></textarea>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="hide-if-headingdip" style="display: none;">
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
                                        <label>Tipe View</label>
                                        <?php
                                        $options = array();
                                        foreach ($get_tipeview as $r_tv):
                                            $options[$r_tv['id_view']] = $r_tv['nama_view'];
                                        endforeach;
                                        echo form_dropdown('tipe_view', $options, set_value('tipe_view'), 'class="form-control input-sm"');
                                        unset($options, $r_tv);
                                        ?>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>                                         
                                    <div class="form-group has-feedback">
                                        <label>Media Yg Memuat Informasi</label>
                                        <textarea class="form-control input-sm" name="media" id="txtEditorMedia"><?php echo set_value('media'); ?></textarea>
                                    </div>
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
                                    if (empty($selected_tahun_dip)) {
                                        $options = array();
                                        foreach ($get_thdip as $r_th):
                                            $options[$r_th['tahun_dip']] = $r_th['tahun_dip'];
                                        endforeach;
                                        echo form_dropdown('tahun_dip', $options, set_value('tipe_view'), 'class="form-control input-sm"');
                                        unset($r_th, $options);
                                    } else {
                                        echo form_input('tahun_dip', $selected_tahun_dip, 'class="form-control input-sm" readonly="true"');
                                    }
                                    ?>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
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
    CKEDITOR.replace('txtEditorDasarHukum', {
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
    CKEDITOR.replace('txtEditorAkibatDibuka', {
        language: 'id',
        uiColor: '#9AB8F3',
        toolbarGroups: [{"name": "basicstyles", "groups": ["basicstyles"]},
            {"name": "links", "groups": ["links"]},
            {"name": "paragraph", "groups": ["list", "blocks"]},
            {"name": "document", "groups": ["mode"]}
        ],
        removeButtons: 'Anchor,Styles,Blockquote,CreateDiv,Save,NewPage,Preview,Print',
        height: 85
    });
    CKEDITOR.replace('txtEditorAkibatDitutup', {
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
    $(function () {
        initFormOnClickHeadingDipStatus();
        $('#btnBatal').click(function () {
            window.history.go(-1);
        });
        $('#radioHeadingDipYa').click(function () {
            initFormOnClickHeadingDipStatus();
        });
        $('#radioHeadingDipTidak').click(function () {
            initFormOnClickHeadingDipStatus();
        });
        $('#optKlasifikasiDip').change(function () {
            initFormOnClickHeadingDipStatus();
        });
    });
    function initFormOnClickHeadingDipStatus() {
        var klasifikasiDip = $('#optKlasifikasiDip :selected').val();
        if (klasifikasiDip == '4') {
            $('.hide-if-headingdip').hide();
            $('.khusus-dikecualikan').show();
        } else {
            $('.khusus-dikecualikan').hide();
            var isHeadingDip = true;
            if ($('#radioHeadingDipYa').is(':checked')) {
                isHeadingDip = true;
            }
            if ($('#radioHeadingDipTidak').is(':checked')) {
                isHeadingDip = false;
            }
            if (isHeadingDip == true) {
                $('.hide-if-headingdip').hide();
            } else {
                $('.hide-if-headingdip').show();
            }
        }
    }
</script>