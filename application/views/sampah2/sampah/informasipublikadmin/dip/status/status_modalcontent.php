<form id="formdetail">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $md_title; ?></h4>
    </div>
    <div class="modal-body">
        <?php
//    print_r($md_detaipertanyaan);
        foreach ($dipstatusdetail as $rowdet):
            ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tahun DIP</label>
                        <input type="text" class="form-control" id="idpertanyaan" name="tahun_dip" value="<?php echo $rowdet['tahun_dip']; ?>" readonly="true">
                    </div>            
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Status</label><br>
                        <?php if ($rowdet['status_dip'] == 'T') { ?>
                            <label class="radio-inline"><input type="radio" id="idpertanyaan" name="status" value="T" checked>Aktif</label>
                            <label class="radio-inline"><input type="radio" id="idpertanyaan" name="status" value="F">NonAktif</label>
                        <?php } else { ?>
                            <label class="radio-inline"><input type="radio" id="idpertanyaan" name="status" value="T">Aktif</label>
                            <label class="radio-inline"><input type="radio" id="idpertanyaan" name="status" value="F" checked>NonAktif</label>
                        <?php } ?>
                    </div>                     
                </div>
            </div>

            <?php
        endforeach;
        unset($rowdet);
        ?>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" id="asasa" class="btn btn-primary btn-sm">Save changes</button>
    </div>
</form>
<script type="text/javascript">    
        $(document).ready(function() {
            $("#formdetail").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    beforeSend: function() {
                        NProgress.start();
                    },
                    complete: function() {
                        NProgress.done();
                    },
                    type: "POST",
                    url: "<?php echo site_url('adminppid/dipstatusupdate'); ?>",
                    data: $("#formdetail").serialize(),
                    success: function() {
                        alert('Update Sukses');
                        $("#datacontent").html('');
                        $("#datacontent").load("<?php echo site_url('adminppid/dipstatusdata'); ?>");
                        $('#myModal').modal('hide');
                    },
                    error: function(request) {
                        alert(request.responseText);
                    }
                });
            });
        });
</script>