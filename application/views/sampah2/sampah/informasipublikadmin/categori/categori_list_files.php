<?php echo $this->session->flashdata('message_status'); ?>
<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_title">
                <h2>List File Kategori <?= $detail_kategori->name_tag; ?></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a href="<?= site_url('adminppid/list_file_categori_upload/' . rawurlencode($detail_kategori->id_tag)); ?>" class="btn btn-sm btn-warning">Upload</a></li>
                    <li><a href="javascript:void(0);" id="btnTambahData" class="btn btn-sm btn-success">Tambah</a></li>
                    <li><a class="collapse-link btn btn-sm btn-default"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div id="contentnotifikasi" style="display: none;"></div>
                <div id="contentnotifikasiaddfiles" style="display: none;"></div>
                <div class="row" id="elementTambah" style="display: none;">
                    <div class="col-md-1">
                        <span class="input-group">
                            <select id="opttypedata"  class="form-control input-sm">
                                <option value="file">File</option>
                                <option value="link">Link</option>
                            </select>
                        </span>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">                                
                            <div class="input-group">                                
                                <input type="text" class="form-control input-sm" id="txtsearchfile" placeholder="Masukan nama file">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-sm" id="btnsearchfile"><i class="fa fa-search"></i> Cari</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row" id="formpecarianpilihfile" style="display: none;">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Pilih File</label>
                                    <?php
                                    $options = array();
                                    echo form_dropdown('filetambah', $options, null, 'class="form-control input-sm" id="opttambahfile"');
                                    ?>
                                </div>                               
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Urutan Tampil File</label>
                                    <?= form_input('urutanfiletambah', null, 'class="form-control input-sm" id="txttambahurutanfile"'); ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Display Name</label>
                                    <?= form_input('urutanfiletambah', null, 'class="form-control input-sm" id="txtdisplayname" readonly="true"'); ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Slug</label>
                                    <?= form_input('urutanfiletambah', null, 'class="form-control input-sm" id="txtslug" readonly="true"'); ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="pull-right">
                                    <button type="button" class="btn btn-primary btn-sm btn-block" id="btnPilihFile">Simpan File</button>                                    
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
                <?php
                if (!empty($list_file)) {
                    echo '<table class="table table-bordered table-centeredhead">';
                    echo '<thead>';
                    echo '<tr class="info">';
                    echo '<th>NO</th>';
                    echo '<td>Display Name</td>';
                    echo '<th>Nama File</th>';
                    echo '<th>Aksi</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody id="tbodylistfiles">';
                    $no = 0;
                    foreach ($list_file as $row):
                        echo '<tr>';
                        echo '<td class="fit">' . ++$no . '</td>';
                        echo '<td>' . $row->display_name . '</td>';
                        echo '<td>' . $row->file . '</td>';
                        echo '<td class="fit">';
                        echo '<a href="' . site_url('informasipublik/showfilekategori/' . rawurlencode($row->slug)) . '" class="btn btn-sm btn-info" target="blank">Lihat</a>';
                        echo '<a href="' . site_url('adminppid/categori_edit_file/' . rawurlencode($row->id_tagcontent)) . '" class="btn btn-sm btn-warning">Edit</a>';
                        echo '<a href="' . site_url('adminppid/categori_delete_file/' . rawurlencode($row->id_tagcontent)) . '" onclick="return confirm(\'Anda yakin..???\');" class="btn btn-sm btn-danger">Hapus</a>';
                        echo '</td>';
                        echo '</tr>';
                    endforeach;
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<div class="alert alert-warning">Belum ada list file yang tersedia</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#btnTambahData').click(function () {
            $('#elementTambah').show();
            $('#txtsearchfile').focus();
        });

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
            if (e.keyCode == 13) {
                initFormTambahData();
            }
        });
        $('#btnPilihFile').click(function () {
            var fileSelected = $('#opttambahfile').val();
            if (fileSelected.length > 0) {
                prosesPilihFile();
            } else {
                generateNotifikasi('warning', 'Pilih file terlebih dahulu', '');
                $('#opttambahfile').focus();
            }

        });
    });
    function generateNotifikasi(type, msg, elementid) {
        if (elementid.length == 0) {
            elementid = 'contentnotifikasi';
        }
        var str = '<div class="alert alert-' + type + '"><p>' + msg + '</p></div>';
        $('#' + elementid).html('');
        $('#' + elementid).html(str);
        $('#' + elementid).show();
    }
    function initFormTambahData() {
        $('#contentnotifikasi').hide();
        $('#contentnotifikasiaddfiles').hide();
        $('#formpecarianpilihfile').hide();
        $("#txtdisplayname").val('');
        $("#txtslug").val('');
        $("#txtdisplayname").prop('readonly', true);
        $("#txtslug").prop('readonly', true);
        var typedata = $('#opttypedata option:selected').val();
        var keyword = $('#txtsearchfile').val();
        var idtag = "<?= $detail_kategori->id_tag; ?>";
        var urlTarget = "<?= site_url('adminppid/categori_cari_file') ?>";
        $.ajax({
            type: "POST",
            url: urlTarget,
            data: {key: keyword, id: idtag, type: typedata},
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
                        $('#opttambahfile').append($('<option>').val(item.idfile).text(item.display_name));
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
    function prosesPilihFile() {
        $('#contentnotifikasi').hide();
        $("#txtdisplayname").prop('readonly', true);
        $("#txtslug").prop('readonly', true);
        var typedata = $('#opttypedata option:selected').val();
        var idfile = $('#opttambahfile option:selected').val();
        var display = $('#txtdisplayname').val();
        if (display.length == 0) {
            display = $('#opttambahfile option:selected').text();
        }
        var textslug = $('#txtslug').val();
        var idtag = "<?= $detail_kategori->id_tag; ?>";
        var urutan = $('#txttambahurutanfile').val();
        var urlTarget = "<?= site_url('adminppid/categori_pilih_file') ?>";
        $.ajax({
            type: "POST",
            url: urlTarget,
            data: {file: idfile, id: idtag, urut: urutan, type: typedata, displayname: display, slug: textslug},
            dataType: "json",
            success: function (data) {
//                initFormTambahData();
                var success = data.success;
                if (success == false) {
                    $('#formpecarianpilihfile').show();
                    var message = ($.isEmptyObject(data.message) ? 'Tidak dapat memproses permintaan' : data.message);
                    generateNotifikasi('warning', message, 'contentnotifikasiaddfiles');
                    $('#txtdisplayname').val(data.data.display_name);
                    $('#txtslug').val(data.data.slug);
                    $("#txtdisplayname").prop('readonly', false);
                    $("#txtslug").prop('readonly', false);
                } else {
                    $('#notifListFile').hide();
                    $("#tbodylistfiles").empty();
                    var listfile = data.listfiles;
                    var no = 0;
                    var newrow = '';
                    var urlLihat = "<?= site_url('informasipublik/showfilekategori/'); ?>";
                    var urlEdit = "<?= site_url('adminppid/categori_edit_file/'); ?>";
                    var urlDelete = "<?= site_url('adminppid/categori_delete_file/'); ?>";
                    $.each(listfile, function (i, item) {
                        newrow = '<tr>';
                        newrow += '<td>' + (++no) + '</td>'
                        newrow += '<td>' + item.display_name + '</td>'
                        newrow += '<td>' + item.file + '</td>'
                        newrow += '<td class="fitcell text-center">';
                        newrow += '<a href="' + urlLihat + encodeURIComponent(item.slug) + '" target="blank" class="btn btn-sm btn-info">Lihat</a>';
                        newrow += '<a href="' + urlEdit + encodeURIComponent(item.id_tagcontent) + '" class="btn btn-sm btn-warning">Edit</a>';
                        newrow += '<a href="' + urlDelete + encodeURIComponent(item.id_tagcontent) + '" onClick="return confirm(\'Anda yakin..???\');" class="btn btn-sm btn-danger">Hapus</a>';
                        newrow += '</td>'
                        newrow += '</tr>';
                        $('#tbodylistfiles').append(newrow);
                    });
                    $('#tableListFile').show();
                    generateNotifikasi('success', display + ' Berhasil ditambahkan', 'contentnotifikasiaddfiles');
                    $('#txtsearchfile').focus();
                }
            },
            failure: function (errMsg) {
                generateNotifikasi('warning', errMsg, 'contentnotifikasiaddfiles');
            }
        });
    }
</script>
