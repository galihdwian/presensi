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
                        <?php
                        $attributes = array('data-toggle' => 'validator', 'role' => 'form');
                        echo form_open_multipart('adminppid/groupfile/add', $attributes);
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <label>Nama Group</label>
                                    <?php
                                    $extra = array(
                                        //'onClick' => 'some_function();',
                                        'class' => 'form-control input-sm',
                                        'autocomplete' => 'off',
                                        'required' => 'true',
                                        'tabindex' => '1',
                                        'autofocus' => 'true'
                                    );
                                    echo form_input('alias_group', set_value('alias_group'), $extra);
                                    ?>
                                    <span class="glyphicon form-control-feedback sm-input" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Tahun File/URL</label>
                                    <?php
                                    $extra = array(
                                        'class' => 'form-control input-sm',
                                        'autocomplete' => 'off',
                                        'required' => 'true',
                                        'tabindex' => '3'
                                    );
                                    echo form_input('tahun_file', set_value('tahun_file'), $extra);
                                    ?>
                                    <span class="glyphicon form-control-feedback sm-input" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>File</label>
                                    <input type="file" name="nama_file" id="nama_file">
                                    <span class="glyphicon form-control-feedback sm-input" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <label>Tipe Data</label> 
                                    <div class="sm-radio">
                                        <label>
                                            <input type="radio" class="tipe-radio" name="tipe" tabindex="2" value="File" <?php echo set_radio('tipe', 'File', TRUE); ?>>File
                                        </label>
                                        <label>
                                            <input type="radio" class="tipe-radio" name="tipe" tabindex="2" value="Url" <?php echo set_radio('tipe', 'Url'); ?>>Url                                        
                                        </label>
                                    </div>
                                    <span class="glyphicon form-control-feedback sm-input" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>URL</label>
                                    <?php
                                    $extra = array(
                                        'class' => 'form-control input-sm',
                                        'autocomplete' => 'off',
                                        'tabindex' => '4',
                                        'disabled' => 'true',
                                        'id' => 'txt_url'
                                    );
                                    echo form_input('nama_file', set_value('nama_file'), $extra);
                                    ?>
                                    <span class="glyphicon form-control-feedback sm-input" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Sorting Data</label> 
                                    <?php
                                    $extra = array(
                                        'class' => 'form-control input-sm',
                                        'autocomplete' => 'off',
                                        'required' => 'true',
                                        'tabindex' => '6'
                                    );
                                    echo form_input('sorting_data', set_value('sorting_data'), $extra);
                                    ?>
                                    <span class="glyphicon form-control-feedback sm-input" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="pull-right">
                            <a href="<?php echo site_url('adminppid/groupfile'); ?>" class="btn btn-outline btn-default  btn-sm">Batal</a>
                            <button type="submit" name="submit" class="btn btn-outline btn-success btn-sm">Simpan</button>
                        </div>
                        <?php
                        echo form_close();
                        ?>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>
<script>
    $(".tipe-radio").click(function() {
        $("#txt_url").attr("disabled", true);
        if ($("input[name=tipe]:checked").val() == "Url") {
            $("#txt_url").attr("disabled", false);
            $("#txt_url").attr("required", true);
            $("#nama_file").attr("disabled", true);
            $("#nama_file").attr("required", false);
        } else if ($("input[name=tipe]:checked").val() == "File") {
            $("#txt_url").attr("disabled", true);
            $("#txt_url").attr("required", false);
            $("#nama_file").attr("disabled", false);
            $("#nama_file").attr("required", true);
        }
    });
</script>