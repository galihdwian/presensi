<?php
if (!empty($error)) {
    echo $error;
}
echo $this->session->flashdata('message_status');
$attributes = array('data-toggle' => 'validator', 'role' => 'form');
echo form_open_multipart('adminppid/dipmanajemenedit/' . $get_sub->id_sub, $attributes);
echo form_hidden('id_sub', $get_sub->id_sub);
echo form_hidden('id_klasifikasi_original', $get_sub->id_klasifikasi);
echo form_hidden('id_parent_dip_original', (!empty($get_parentdata->id_dip) ? $get_parentdata->id_dip : null));
?>
<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_content"> 
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div id="notifikasi"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <label>Klasifikasi</label>
                                    <?php
                                    foreach ($get_klasifikasi as $r_kl):
                                        $options[$r_kl['id_ppid']] = $r_kl['nama_ppid'];
                                    endforeach;
                                    echo form_dropdown('id_klasifikasi', $options, $get_sub->id_klasifikasi, 'class="form-control input-sm" id="optKlasifikasiDip"');
                                    unset($r_kl, $options);
                                    ?>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <?php
                                if (!empty($get_parentdata)) {
                                    echo '<div class="form-group has-feedback">';
                                    echo '<label>Parent Data</label>';
                                    $options = array();
                                    $options['N'] = 'Set Sebagai Parent Data';
                                    foreach ($list_parent as $r_parent):
                                        $options[$r_parent->id_dip] = $r_parent->nama_ppid . ' - ' . $r_parent->judul_informasi;
                                    endforeach;
                                    echo form_dropdown('id_parent', $options, $get_parentdata->id_dip, 'class="form-control input-sm select2" id="optParentData"');
                                    unset($r_parent, $options);
                                    echo '<span class="glyphicon form-control-feedback" aria-hidden="true"></span>';
                                    echo '</div>';
                                }
                                ?>
                                <div class="form-group has-feedback">
                                    <label>Judul Informasi</label>
                                    <?= form_input('judul_informasi', $get_sub->judul_informasi, 'class="form-control input-sm" autocomplete="off" required="true"'); ?>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                
                                <div class="form-group has-feedback">
                                    <label>Heading DIP</label><br>
                                    <div class="radio mt-0 mb-20">
                                        <label class="mr-15">
                                            <input type="radio" name="heading_dip" value="T" <?= ($get_sub->heading_dip == 'T' ? 'checked="true"' : ''); ?> id="radioHeadingDipYa">Ya
                                        </label>
                                        <label>
                                            <input type="radio" name="heading_dip" value="F" <?= ($get_sub->heading_dip == 'F' ? 'checked="true"' : ''); ?> id="radioHeadingDipTidak">Tidak
                                        </label>
                                    </div>
                                </div>

                                <div class="khusus-dikecualikan hide-if-headingdip" style="display: none;">
                                    <div class="form-group has-feedback">
                                        <label>Ringkasan Isi Informasi</label>
                                        <textarea class="form-control input-sm" name="isi_informasi" id="txtEditor"><?= $get_sub->isi_informasi; ?></textarea>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="hide-if-headingdip" style="display: none;">
                                    <div class="form-group has-feedback">
                                        <label>Display Detail (jika dikosongkan otomatis yang ditampilkan adalah Ringkasan Isi Informasi)</label>
                                        <textarea class="form-control input-sm" name="display_detail" id="txtDisplayDetail"><?= $get_sub->display_detail; ?></textarea>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label>Penanggung Jawab</label>
                                        <?= form_input('penanggung_jawab', $get_sub->penanggung_jawab, 'class="form-control input-sm" autocomplete="off"'); ?>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label>Waktu Pembuatan</label>
                                        <?= form_input('waktu_pembuatan', $get_sub->waktu_pembuatan, 'class="form-control input-sm" autocomplete="off"'); ?>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="khusus-dikecualikan" style="display: none;">
                                    <div class="form-group has-feedback">
                                        <label>Dasar Hukum</label>
                                        <textarea class="form-control input-sm" name="dasar_hukum" id="txtEditorDasarHukum"><?= $get_sub->dasar_hukum; ?></textarea>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label>Batas Waktu Pengecualian</label>
                                        <?= form_input('batas_waktu', $get_sub->batas_waktu, 'class="form-control input-sm" autocomplete="off"'); ?>                                        
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="khusus-dikecualikan" style="display: none;">
                                    <div class="form-group has-feedback">
                                        <label>Akibat Dibuka</label>
                                        <textarea class="form-control input-sm" name="akibat_dibuka" id="txtEditorAkibatDibuka"><?= $get_sub->akibat_dibuka; ?></textarea>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label>Akibat Ditutup</label>
                                        <textarea class="form-control input-sm" name="akibat_ditutup" id="txtEditorAkibatDitutup"><?= $get_sub->akibat_ditutup; ?></textarea>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="hide-if-headingdip" style="display: none;">
                                    <div class="form-group has-feedback">
                                        <label>Bentuk Informasi</label>
                                        <?= form_input('bentuk_informasi', $get_sub->bentuk_informasi, 'class="form-control input-sm" autocomplete="off"'); ?>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div> 
                                    <div class="form-group has-feedback">
                                        <label>Jangka Waktu Penyimpanan</label>
                                        <?= form_input('jangka_waktu', $get_sub->jangka_waktu, 'class="form-control input-sm" autocomplete="off"'); ?>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label>Tipe View</label>
                                        <?php
                                        $options = array();
                                        foreach ($get_tipeview as $r_tv):
                                            $options[$r_tv['id_view']] = $r_tv['nama_view'];
                                        endforeach;
                                        echo form_dropdown('tipe_view', $options, $get_sub->tipe_view, 'class="form-control input-sm"');
                                        unset($options, $r_tv);
                                        ?>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>                                         
                                    <div class="form-group has-feedback">
                                        <label>Media Yg Memuat Informasi</label>
                                        <textarea class="form-control input-sm" name="media" id="txtEditorMedia"><?= $get_sub->media; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Aktif DIP</label><br>
                                    <div class="radio mt-0 mb-20">
                                        <label class="mr-15">
                                            <input type="radio" name="aktif_dip" value="T" <?= ($get_dip->aktif_dip == 'T' ? 'checked="true"' : ''); ?>>Ya
                                        </label>
                                        <label>
                                            <input type="radio" name="aktif_dip" value="F" <?= ($get_dip->aktif_dip == 'F' ? 'checked="true"' : ''); ?>>Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Tahun DIP</label>
                                    <?php
                                    echo form_input('tahun_dip', $get_dip->tahun_dip, 'class="form-control input-sm" readonly="true"');
                                    ?>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                
                                <div class="form-group has-feedback">
                                    <label>Sorting Informasi</label>
                                    <?php
                                    echo form_input('sorting_informasi', $get_sub->sorting_informasi, 'class="form-control input-sm"');
                                    ?>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="pull-right">
                            <button type="button" class="btn btn-warning btn-sm" id="btnBatal">Batal</button>
                            <button type="submit" name="simpan_data" value="proses_simpan" class="btn btn-primary btn-sm" id="btnsave">Save changes</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
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
        height: 300
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
        $('.select2').select2();
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
        var countChild = "<?= $count_child ?>";
        console.log(countChild);
        var dataIsHeading = (parseInt(countChild) > 0 ? true : false);
        console.log(dataIsHeading);
        var klasifikasiDip = $('#optKlasifikasiDip :selected').val();
        if (dataIsHeading == false) {
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
        } else {
            if (klasifikasiDip == '4' || klasifikasiDip == '2') {
                $('#notifikasi').html('');
                $('#notifikasi').html('<div class="alert alert-warning"><p>DIP dengan status heading dan masih memiliki sub data tidak dapat diganti klasifikasi selain berkala dan setiap saat.</p></div>');
                $('#btnsave').prop('disabled', true);
            } else {
                $('#notifikasi').html('');
                if ($('#radioHeadingDipTidak').is(':checked')) {
                    $('#notifikasi').html('');
                    $('#notifikasi').html('<div class="alert alert-warning"><p>DIP dengan status heading dan masih memiliki sub data tidak dapat diset menjadi bukan heading.</p></div>');
                    $('#btnsave').prop('disabled', true);
                } else {
                    $('#notifikasi').html('');
                    $('#btnsave').prop('disabled', false);
                }
            }
        }
    }
</script>