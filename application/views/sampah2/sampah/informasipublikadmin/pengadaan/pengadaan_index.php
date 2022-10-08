<?php
if (!empty($error)) {
    echo $error;
}
echo $this->session->flashdata('message_status');
?>
<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_title"> 
                <div class="row">
                    <div class="col-xs-8 col-md-6">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default" disabled="true">Silahkan Pilih Tahun Pengadaan</button>
                            </span>
                            <?php
                            $options[null] = '-- Silahkan Pilih Tahun Pengadaan --';
                            foreach ($list_tahun_pengadaan as $row):
                                $options[$row->tahunpengadaan] = $row->tahunpengadaan;
                            endforeach;
                            echo form_dropdown('tahunpengadaan', $options, null, 'class="form-control" id="opttahunpengadaan"');
                            ?>
                        </div>
                    </div>
                    <div class="col-xs-4 col-md-6">                       
                        <div class="pull-right">
                            <button class="btn btn-warning btn-sm" id="btnSetDokumenRS">Set Dokumen</button>
                            <button class="btn btn-default btn-sm" id="btnTambahData">Tambah Data Pengadan</button>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div id="datacontent"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        load_content('');
        $('#opttahunpengadaan').change(function () {
            var tahunPengadaan = $('#opttahunpengadaan option:selected').val();
            if (tahunPengadaan.length > 0) {
                load_content(tahunPengadaan);
            }
        });
        $('#btnTambahData').click(function () {
            var tahunPengadaan = $('#opttahunpengadaan option:selected').val();
            var url = "<?php echo site_url('adminppid/pengadaan/tambah_data/'); ?>" + encodeURIComponent(tahunPengadaan);
            window.location.replace(url);
        });
        $('#btnSetDokumenRS').click(function () {
            var tahunPengadaan = $('#opttahunpengadaan option:selected').val();
            var url = "<?php echo site_url('adminppid/pengadaan/dokumen_rs_set/'); ?>" + encodeURIComponent(tahunPengadaan);
            window.location.replace(url);
        });
    });
    function load_content(tahunPengadaan) {
        var url = "<?php echo site_url('adminppid/pengadaan/list_pengadaan/'); ?>" + encodeURIComponent(tahunPengadaan);
        $("#datacontent").load(url);
    }
</script>

