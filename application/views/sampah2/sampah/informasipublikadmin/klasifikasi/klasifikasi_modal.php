<!--<form id="formdetail" action="<?php // echo site_url('adminppid/dipmanajemensave');        ?>" method="POST">-->
<?php
echo form_open_multipart('adminppid/klasifikasisave');
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><?php echo $md_title; ?></h4>
</div>
<div class="modal-body">
    <?php
//    print_r($get_klasifikasi);
    foreach ($get_klasifikasi as $r_kls):
        ?>
        <div class="row">
            <div class="col-md-6">            
                <div class="form-group">
                    <label>Nama Klaifikasi</label>
                    <input type="text" class="form-control" name="nama_ppid" value="<?php echo $r_kls['nama_ppid']; ?>">
                    <input type="hidden" class="form-control" name="id_ppid" value="<?php echo $r_kls['id_ppid']; ?>">
                </div>                
                <div class="form-group">
                    <label>Tampil di DIP</label><br>
                    <?php
                    if ($r_kls['show_dip'] == 'T') {
                        ?>
                        <input type="radio" name="show_dip" value="T" checked>Ya
                        <input type="radio" name="show_dip" value="F">Tidak
                        <?php
                    } else {
                        ?>
                        <input type="radio" name="show_dip" value="T" checked>Ya
                        <input type="radio" name="show_dip" value="F" checked>Tidak
                        <?php
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label>Ringkasan</label>
                    <textarea name="keterangan" style="width: 100%;height: 100px;resize: none;"><?php echo $r_kls['keterangan']; ?></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Judul DIP</label>
                    <input type="text" class="form-control" name="judul_dip" value="<?php echo $r_kls['judul_dip']; ?>">
                </div>
                <div class="form-group">
                    <label>Penjelasan</label>
                    <textarea name="penjelasan" style="width: 100%;height: 155px;resize: none;"><?php echo $r_kls['penjelasan']; ?></textarea>
                </div>
            </div>
        </div>
        <?php
    endforeach;
    unset($r_kls);
    ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
    <button type="submit" id="asasa" class="btn btn-primary btn-sm">Save changes</button>
</div>
<!--</form>-->
<?php echo form_close(); ?>