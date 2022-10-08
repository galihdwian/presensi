<?php
if (!empty($error)) {
    echo $error;
}
echo $this->session->flashdata('message_status');
echo form_open_multipart('adminppid/categori_edit_file/' . $detail_tag_content->id_tagcontent);
echo form_hidden('id_tag', $detail_kategori->id_tag);
echo form_hidden('id_tagcontent', $detail_tag_content->id_tagcontent);
echo form_hidden('tipe', $detail_tag_content->tipe);
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
                    <label>Nama File yang Ditampilkan</label>
                    <?= form_textarea('display_name', $detail_tag_content->display_name, 'class="form-control input-sm textarea-h100" required="true" autocomplete="off" id="txtdisplay_name"'); ?>
                </div>
                <div id="elementformfile" <?= ($detail_tag_content->tipe == 'file' ? '' : 'style="display: none;"'); ?>>
                    <div class="form-group">
                        <label>Slug File <span id="lengthSlug"></span></label>
                        <?= form_input('slug', $detail_tag_content->slug, 'class="form-control input-sm" required="true" autocomplete="off" id="txtslug" readonly="true"'); ?>
                    </div>                    
                </div>
                <div id="elementformlink" <?= ($detail_tag_content->tipe == 'link' ? '' : 'style="display: none;"'); ?>>
                    <div class="form-group">
                        <label><?=$detail_tag_content->tipe == 'link';?></label>
                        <?= form_input('link', $detail_tag_content->slug, 'class="form-control input-sm" required="true" autocomplete="off" id="txtlink"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Urutan</label>
                    <?= form_input('sorting_data', $detail_tag_content->sorting_data, 'class="form-control input-sm" required="true" autocomplete="off"'); ?>
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