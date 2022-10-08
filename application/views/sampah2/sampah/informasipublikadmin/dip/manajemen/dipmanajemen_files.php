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
                <h2>List File <?= $get_sub->judul_informasi; ?></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a href="<?= site_url('adminppid/dipmanajemenuploadfiles/' . $get_sub->id_sub); ?>" class="btn btn-sm btn-warning">Upload</a></li>
                    <li><a href="javascript:void(0);" id="btnTambahData" class="btn btn-sm btn-success">Tambah</a></li>
                    <li><a class="collapse-link btn btn-sm btn-default"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div id="contentnotifikasi" style="display: none;"></div>
                <div id="contentnotifikasiaddfiles" style="display: none;"></div>
                <div class="row" id="elementTambah" style="display: none;">
                    <div class="col-md-6">
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
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="button" class="btn btn-primary btn-sm btn-block" id="btnPilihFile">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <?php
                echo '<table class="table table-bordered" id="tableListFile" ' . (!empty($list_files) ? '' : 'style="display:none;"') . '>';
                echo '<thead>';
                echo '<tr>';
                echo '<th class="text-center">#</th>';
                echo '<th class="text-center">ID File</th>';
                echo '<th class="text-center">Nama File</th>';
                echo '<th class="text-center">Urutan</th>';
                echo '<th class="text-center">Aksi</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody id="tbodylistfiles">';
                $no = 0;
                foreach ($list_files as $row_file):
                    echo '<tr>';
                    echo '<td class="fitcell text-center">' . ++$no . '</td>';
                    echo '<td class="fitcell text-center">' . $row_file->id_file . '</td>';
                    echo '<td>' . $row_file->display_name . '</td>';
                    echo '<td class="fitcell text-center">' . $row_file->sort_display . '</td>';
                    echo '<td class="fitcell text-center">';
                    echo '<a href="' . site_url('informasipublik/file/' . $row_file->slug) . '" target="blank" class="btn btn-sm btn-info">Lihat</a>';
                    echo '<a href="' . site_url('adminppid/dipmanajemenfilesedit/' . $row_file->id_sub . '/' . $row_file->id_file) . '" class="btn btn-sm btn-warning">Edit</a>';
                    echo '<a href="' . site_url('adminppid/dipmanajemenfilesdelete/' . $row_file->id_sub . '/' . $row_file->id_file) . '" onClick="return confirm(\'Anda yakin..???\');" class="btn btn-sm btn-danger">Hapus</a>';
                    echo '</td>';
                    echo '</tr>';
                endforeach;
                echo '</tbody>';
                echo '</table>';

                echo '<div class="alert alert-info" id="notifListFile" ' . (empty($list_files) ? '' : 'style="display:none;"') . '>';
                echo '<h4><i class="fa fa-info-circle"></i> Informasi</h4> Belum ada file di informasi publik ini.';
                echo '</div>';
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
                generateNotifikasi('warning', 'Masukan nama file terlebih dahulu untuk melakukan pencarian file.','');
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
                generateNotifikasi('warning', 'Pilih file terlebih dahulu','');
                $('#opttambahfile').focus();
            }

        });
    });
    function generateNotifikasi(type, msg, elementid) {
        if(elementid.length == 0){
            elementid = 'contentnotifikasi';
        }
        var str = '<div class="alert alert-' + type + '"><p>' + msg + '</p></div>';
        $('#' + elementid).html('');
        $('#' + elementid).html(str);
        $('#' + elementid).show();
    }
    function initFormTambahData() {
        $('#formpecarianpilihfile').hide();
        var keyword = $('#txtsearchfile').val();
        var idsub = "<?= $get_sub->id_sub; ?>";
        var urlTarget = "<?= site_url('adminppid/dipmanajemenpencarianfiles') ?>";
        $.ajax({
            type: "POST",
            url: urlTarget,
            data: {key: keyword, id: idsub},
            dataType: "json",
            success: function (data) {
                var success = data.success;
                if (success == false) {
                    var message = ($.isEmptyObject(data.message) ? 'Tidak dapat memproses permintaan' : data.message);
                    generateNotifikasi('warning', message,'');
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
                generateNotifikasi('warning', errMsg,'');
            }
        });
    }
    function prosesPilihFile() {
        $('#formpecarianpilihfile').hide();
        var idfile = $('#opttambahfile option:selected').val();
        var namafile = $('#opttambahfile option:selected').text();
        var idsub = "<?= $get_sub->id_sub; ?>";
        var urutan = $('#txttambahurutanfile').val();
        var urlTarget = "<?= site_url('adminppid/dipmanajemenpilihfiles') ?>";
        $.ajax({
            type: "POST",
            url: urlTarget,
            data: {file: idfile, id: idsub, urut: urutan},
            dataType: "json",
            success: function (data) {
                initFormTambahData();
                console.log(data);
                var success = data.success;
                if (success == false) {
                    var message = ($.isEmptyObject(data.message) ? 'Tidak dapat memproses permintaan' : data.message);
                    generateNotifikasi('warning', message, 'contentnotifikasiaddfiles');
                } else {
                    $('#notifListFile').hide();
                    $("#tbodylistfiles").empty();
                    var listfile = data.listfiles;
                    var no = 0;
                    var newrow = '';
                    var urlLihat = "<?= site_url('informasipublik/file/'); ?>";
                    var urlEdit = "<?= site_url('adminppid/dipmanajemenfilesedit/'); ?>";
                    var urlDelete = "<?= site_url('adminppid/dipmanajemenfilesdelete/'); ?>";
                    $.each(listfile, function (i, item) {
                        newrow = '<tr>';
                        newrow += '<td>' + (++no) + '</td>'
                        newrow += '<td>' + item.id_file + '</td>'
                        newrow += '<td>' + item.display_name + '</td>'
                        newrow += '<td class="fitcell text-center">' + item.sort_display + '</td>'
                        newrow += '<td class="fitcell text-center">';
                        newrow += '<a href="' + urlLihat + item.slug + '" target="blank" class="btn btn-sm btn-info">Lihat</a>';
                        newrow += '<a href="' + urlEdit + item.id_sub + '/' + item.id_file + '" class="btn btn-sm btn-warning">Edit</a>';
                        newrow += '<a href="' + urlDelete + item.id_sub + '/' + item.id_file + '" onClick="return confirm(\'Anda yakin..???\');" class="btn btn-sm btn-danger">Hapus</a>';
                        newrow += '</td>'
                        newrow += '</tr>';
                        $('#tbodylistfiles').append(newrow);
                    });
                    $('#tableListFile').show();
                    generateNotifikasi('success', namafile + ' Berhasil ditambahkan ke daftar informasi publik', 'contentnotifikasiaddfiles');
                }
                $('#txtsearchfile').focus();
            },
            failure: function (errMsg) {
                generateNotifikasi('warning', errMsg, 'contentnotifikasiaddfiles');
            }
        });
    }
</script>