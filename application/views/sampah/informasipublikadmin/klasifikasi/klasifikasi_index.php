<?php echo $this->session->flashdata('message_status'); ?>
<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_content"> 
                <div class="row">
                    <div class="col-md-12 col-sm-12">                        
                        <div id="datacontent"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">            
            <div id="modaldetailcontent"></div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" id="myModalXlg">
    <div class="modal-dialog">
        <div class="modal-content">            
            <div id="modalxlgdetailcontent"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function showdetail(id_ppid) {
        href = "<?php echo site_url('adminppid/klasifikasidetail'); ?>/" + id_ppid;
        $('#myModal').find('#modaldetailcontent').load(href);
        $('#myModal').modal('show');
    }
    $(document).ready(function() {
        $("#datacontent").load("<?php echo site_url('adminppid/klasifikasidata'); ?>");
        $('#myModal').on('hide.bs.modal', function() {
            $('#myModal').find('#modaldetailcontent').html('');
        });
        $('#myModalXlg').on('hide.bs.modal', function() {
            $('#myModalXlg').find('#modalxlgdetailcontent').html('');
        });
    });
</script>

