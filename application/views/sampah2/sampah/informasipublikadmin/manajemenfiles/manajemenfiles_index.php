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
                <h2>Manajemen File</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div id="contentnotifikasi" style="display: none;"></div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm" id="txtsearchfile" placeholder="Masukan nama file">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-sm" id="btnsearchfile"><i class="fa fa-search"></i> Cari</button>
                        </span>
                    </div>
                </div>
                <table class="table table-bordered" id="tableListFile" style="display:none;">
                    <thead>
                        <tr class="bg-primary">
                            <th class="text-center">NO</th>
                            <th class="text-center">ID File</th>
                            <th class="text-center">Display Name</th>
                            <th class="text-center">Nama File</th>
                            <th class="text-center">Type File</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbodylistfiles"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $('#btnsearchfile').click(function() {
            var keyword = $('#txtsearchfile').val();
            if (keyword.length > 0) {
                showListFiles();
            } else {
                generateNotifikasi('warning', 'Masukan nama file terlebih dahulu untuk melakukan pencarian file.');
                $('#txtsearchfile').focus();
            }
        });
        $('#txtsearchfile').keyup(function(e) {
            if (e.keyCode == 13) {
                var keyword = $('#txtsearchfile').val();
                if (keyword.length > 0) {
                    showListFiles();
                } else {
                    generateNotifikasi('warning', 'Masukan nama file terlebih dahulu untuk melakukan pencarian file.');
                    $('#txtsearchfile').focus();
                }
            }
        });
    });

    function generateNotifikasi(type, msg) {
        var str = '<div class="alert alert-' + type + '"><p>' + msg + '</p></div>';
        $('#contentnotifikasi').html('');
        $('#contentnotifikasi').html(str);
        $('#contentnotifikasi').show();
    }

    function showListFiles() {
        $("#tbodylistfiles").empty();
        $('#tableListFile').hide();
        var keyword = $('#txtsearchfile').val();
        var urlTarget = "<?= site_url('adminppid/manajemenfiles/carifiles') ?>";
        $.ajax({
            type: "POST",
            url: urlTarget,
            data: {
                key: keyword
            },
            dataType: "json",
            success: function(data) {
                var success = data.success;
                if (success == false) {
                    var message = ($.isEmptyObject(data.message) ? 'Tidak dapat memproses permintaan' : data.message);
                    generateNotifikasi('warning', message);
                } else {
                    $('#contentnotifikasi').hide();
                    $("#tbodylistfiles").empty();
                    let listfile = data.list_file;
                    let no = 0;
                    let newrow = '';
                    let urlLihat = "<?= site_url('informasipublik/file/'); ?>";
                    let urlLihatKategori = "<?= site_url('informasipublik/showfilekategori/'); ?>";
                    let urlEdit = "<?= site_url('adminppid/manajemenfiles_edit/'); ?>";
                    let tipeFile = "";
                    let namafile = "";
                    $.each(listfile, function(i, item) {
                        tipeFile = item.file_type == 'ip_sub_file' ? 'File DIP' : 'File Kategori';
                        if (namafile != item.nama_file) {
                            namafile = item.nama_file;
                            newrow = '<tr>';
                        } else {
                            newrow = '<tr class="bg-warning">';
                        }
                        newrow += '<td>' + (++no) + '</td>'
                        newrow += '<td>' + item.id + '</td>'
                        newrow += '<td>' + item.display_name + '</td>'
                        newrow += '<td>' + namafile + '</td>'
                        newrow += '<td>' + tipeFile + '</td>'
                        newrow += '<td class="fitcell text-center">';
                        if (item.file_type == 'ip_sub_file') {
                            newrow += '<a href="' + urlLihat + item.slug + '" target="blank" class="btn btn-sm btn-info">Lihat</a>';
                        } else {
                            newrow += '<a href="' + urlLihatKategori + item.slug + '" target="blank" class="btn btn-sm btn-info">Lihat</a>';
                        }
                        newrow += '<a href="' + urlEdit + item.id + '/' + item.file_type + '" class="btn btn-sm btn-warning">Edit</a>';
                        newrow += '</td>'
                        newrow += '</tr>';
                        $('#tbodylistfiles').append(newrow);
                    });
                    $('#tableListFile').show();
                }
                $('#txtsearchfile').focus();
            },
            failure: function(errMsg) {
                generateNotifikasi('warning', errMsg);
            }
        });
    }
</script>