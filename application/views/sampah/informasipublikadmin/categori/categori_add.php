<!--<form id="formdetail" action="<?php // echo site_url('adminppid/dipmanajemensave');                ?>" method="POST">-->
<?php
echo form_open_multipart('adminppid/categorisave');
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><?php echo $md_title; ?></h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-6">            
            <div class="form-group">
                <label>Id Kategori</label>
                <?= form_input('id_tag', set_value('id_tag'), 'class="form-control" '); ?>
            </div> 
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Nama Kategori</label>
                <?= form_input('name_tag', set_value('name_tag'), 'class="form-control" '); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">            
            <div class="form-group">
                <label>Nomor Urut</label>
                <?php
                $ordertag = set_value('ordertag');
                $ordertag = !empty($ordertag) ? $ordertag : $max_oerdertag;
                echo form_input('ordertag', $ordertag, 'class="form-control" autocomplete="off" required="true"');
                ?>
            </div> 
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Status Display</label>
                <?php
                $options[1] = 'Ya';
                $options[0] = 'Tidak';
                echo form_dropdown('displaytag', $options, set_value('displaytag'), 'class="form-control" required="true"');
                ?>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary btn-sm" name="btnsimpan" value="simpandata">Save changes</button>
</div>
<!--</form>-->
<?php echo form_close(); ?>