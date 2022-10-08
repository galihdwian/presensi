<?php
if (!empty($error)) {
    echo $error;
}
echo $this->session->flashdata('message_status');
echo form_open('adminppid/pengadaan/tambah_dokumen_pengadaan/' . $detail_pengadaan->id_paket);
echo form_hidden('id_paket', $detail_pengadaan->id_paket);
?>
<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_title"> 
                <h2>Tambah Dokumen Pengadaan</h2>                 
                <div class="clearfix"></div>
            </div>
            <div class="x_content">                
                <?php
                include_once 'pengadaan_display_detail.php';
                ?>
                <div class="form-group">
                    <label>Jenis Dokumen</label>
                    <?php
                    $options[null] = '-- Silahkan Pilih Jenis Dokumen --';
                    foreach ($list_jenis_dokumen as $row_jenis_dokumen):
                        $options[$row_jenis_dokumen->iddokumen] = $row_jenis_dokumen->namadokumen;
                    endforeach;
                    echo form_dropdown('iddokumen', $options, set_value('iddokumen'), 'class="form-control input-sm" required="true" id="optjenisdokumen"');
                    unset($options);
                    ?>
                </div>
                <div class="form-group">
                    <label>Link Ke LPSE Jawa Tengah</label>
                    <?php
                    $options[0] = 'Tidak';
                    $options[1] = 'Ya';
                    echo form_dropdown('link_lpse', $options, set_value('link_lpse'), 'class="form-control input-sm" required="true" id="optlinklpse"');
                    unset($options);
                    ?>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <?= form_input('keterangan', set_value('keterangan'), 'class="form-control input-sm" autocomplete="off"'); ?>
                </div>
                <div id="formbukanlinklpse" style="display: none;">
                    <div class="form-group">
                        <label>Link Langsung</label>
                        <input type="url" name="direct_link" class="form-control input-sm" autocomplete="off" id="txt-directlink">
                    </div>
                    <div class="form-group">
                        <label>Cari Dokumen <small>(Pastikan dokumen sudah diupload di DIP)</small></label>
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" id="txtsearchfile" placeholder="Masukan nama file" autocomplete="off">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-sm" id="btnsearchfile"><i class="fa fa-search"></i> Cari</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Pilih File</label>
                        <?php
                        $options[null] = '-- Pilih File --';
                        echo form_dropdown('id_file', $options, null, 'class="form-control input-sm" id="opttambahfile"');
                        ?>
                    </div> 
                </div>                
                <div class="ln_solid"></div>
                <div class="pull-right">
                    <a href="<?= site_url('adminppid/pengadaan/list_dokumen_pengadaan/' . $detail_pengadaan->id_paket); ?>" class="btn btn-warning btn-sm" >Batal</a>
                    <button type="submit" name="simpan_data" value="proses_simpan" class="btn btn-primary btn-sm">Simpan</button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<?= form_close(); ?>
<script type="text/javascript">
    $(function () {
        initFormBukanLinkLpse();
        $('#optlinklpse').change(function () {
            initFormBukanLinkLpse();
        });
        $('#optjenisdokumen').select2({placeholder: "-- Silahkan Pilih Jenis Dokumen --", theme: "bootstrap"});
        $('#btnsearchfile').click(function () {
            var keyword = $('#txtsearchfile').val();
            if (keyword.length > 0) {
                initFormTambahData();
            } else {
                generateNotifikasi('warning', 'Masukan nama file terlebih dahulu untuk melakukan pencarian file.', '');
                $('#txtsearchfile').focus();
            }
        });
        $('#txtsearchfile').keyup(function (e) {
            e.preventDefault();
            if (e.keyCode == 13) {
                initFormTambahData();
            }
        });
        $('#txt-directlink').keyup(function () {
            var directlink = $('#txt-directlink').val();
            if (directlink.length == 0) {
                $('#opttambahfile').prop('required', true);
            } else {
                $('#opttambahfile').removeAttr('required');
                $('#txt-directlink').prop('required', true);
            }
        });
    })
    function initFormTambahData() {
        $('#formpecarianpilihfile').hide();
        var keyword = $('#txtsearchfile').val();
        var urlTarget = "<?= site_url('adminppid/pengadaan/pencarian_file') ?>";
        $.ajax({
            type: "POST",
            url: urlTarget,
            data: {key: keyword},
            dataType: "json",
            success: function (data) {
                var success = data.success;
                if (success == false) {
                    var message = ($.isEmptyObject(data.message) ? 'Tidak dapat memproses permintaan' : data.message);
                    generateNotifikasi('warning', message, '');
                } else {
                    $('#txttambahurutanfile').val(data.urutan);
                    $('#formpecarianpilihfile').show();
                    $('#opttambahfile').empty();
                    var listfile = data.data;
                    $('#opttambahfile').append($('<option>').val(null).text('Pilih Files'));
                    $.each(listfile, function (i, item) {
                        $('#opttambahfile').append($('<option>').val(item.id_file).text(item.display_name));
                    });
                    $('#opttambahfile').select2({placeholder: "Pilih Files"});
                    $('#opttambahfile').focus();
                }
            },
            failure: function (errMsg) {
                generateNotifikasi('warning', errMsg, '');
            }
        });
    }
    function initFormBukanLinkLpse() {
        var linkLpse = $('#optlinklpse option:selected').val();
        console.log(linkLpse);
        if (linkLpse == '1') {
            $('#formbukanlinklpse').hide();
            $('#opttambahfile').removeAttr('required');
        } else {
            $('#formbukanlinklpse').show();
            var directlink = $('#txt-directlink').val();
            if (directlink.length == 0) {
                $('#opttambahfile').prop('required', true);
            } else {
                $('#opttambahfile').removeAttr('required');
                $('#txt-directlink').prop('required', true);
            }
        }
    }
</script>