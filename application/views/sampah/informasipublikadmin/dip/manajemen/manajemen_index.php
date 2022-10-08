<?php
if (!empty($error)) {
    echo $error;
}
echo validation_errors('<div class="alert alert-danger"><p>', '</p></div>');
echo $this->session->flashdata('message_status');
?>
<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_content"> 
                <div class="row">
                    <div class="col-md-12 col-sm-12">

                        <div class="row">
                            <div class="col-xs-8 col-md-6">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default" disabled="true">Silahkan Pilih Tahun DIP</button>
                                    </span>
                                    <?php
                                    $options = array();
                                    $selected = !empty($selected) ? $selected : '';
                                    foreach ($list_tahun_dip as $row):
                                        $options[$row->tahun_dip] = $row->tahun_dip;
                                        if ($selected == '') {
                                            $selected = ($row->status_dip == 'T' ? $row->tahun_dip : '');
                                        }
                                    endforeach;
                                    echo form_dropdown('tahundip', $options, $selected, 'class="form-control" id="opttahundip"');
                                    ?>
                                </div>
                            </div>
                            <div class="col-xs-4 col-md-6">
                                <div class="pull-right">
                                    <a class="btn btn-default btn-sm" id="linkaddnew" href="<?php echo site_url('adminppid/dipmanajemenadd'); ?>">Tambah Data</a>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div id="datacontent"></div>
                    </div>
                </div>

            </div>
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
    $(function () {
        $('#opttahundip').on('change', function () {
            var tahundip = this.value;
            var hrefRedirect = "<?= site_url('/adminppid/dipmanajemen/') ?>" + tahundip;
            window.location.replace(hrefRedirect);
        });
        var selectedTahunDip = "<?= $selected; ?>";
        var newUrl = "<?php echo site_url('adminppid/dipmanajemenadd'); ?>/" + selectedTahunDip;
        $('#linkaddnew').attr("href", newUrl);
    });
    function getfile(file) {
        var href = "<?php echo site_url('dipviewfile'); ?>/" + file;
        $('#myModalXlg').find('#modalxlgdetailcontent').load(href);
        $('#myModalXlg').modal('show');

    }
    $(document).ready(function () {
        $("#datacontent").load("<?php echo site_url('adminppid/dipmanajemendata/' . $selected); ?>");
    });
</script>

