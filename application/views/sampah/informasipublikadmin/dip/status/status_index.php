<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_content"> 
                <?php if ($get_maxtahundip < date('Y')): ?>
                    <div class="pull-right"><button class="btn btn-sm btn-default" onClick="showmodalAdd()">Tambah Data</button></div>
                <?php endif; ?>
                <div id="datacontent"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">            
            <div id="modaldetailcontent"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
                    function showmodal(id) {
                        href = "<?php echo site_url('adminppid/dipstatusdetail'); ?>/" + id
                        $('#myModal').find('#modaldetailcontent').load(href);
                        $('#myModal').modal('show');
                    }

                    $(document).ready(function() {
                        $("#datacontent").load("<?php echo site_url('adminppid/dipstatusdata'); ?>");
                        $('#myModal').on('hide.bs.modal', function() {
                            $('#myModal').find('#modaldetailcontent').html('');
                        });
                    });
</script>

