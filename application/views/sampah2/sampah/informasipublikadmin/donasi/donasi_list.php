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
                <h2>List Donasi</h2>
                <div class="nav navbar-right panel_toolbox">
                    <div class="dropdown">
                        <a href="<?= site_url('adminppid/donasi/tambah'); ?>" class="btn btn-success">
                            Tambah Data
                        </a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-bordered table-striped" id="mytable">
                    <thead>
                        <tr class="bg-primary">
                            <th class="text-center">#</th>
                            <th class="text-center">TANGGAL</th>
                            <th class="text-center">NAMA ITEM</th>
                            <th class="text-center">SATUAN</th>
                            <th class="text-center">QTY</th>
                            <th class="text-center">PENGIRIM</th>
                            <th class="text-center">DISTRIBUSI</th>
                            <th class="text-center">DELETED</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };
        var t = $("#mytable").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                    .off('.DT')
                    .on('keyup.DT', function(e) {
                        if (e.keyCode == 13) {
                            api.search(this.value).draw();
                        }
                    });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            pageLength: 25,
            ajax: {
                "url": "<?= site_url('adminppid/donasi/listdata'); ?>",
                "type": "POST"
            },
            columns: [{
                    "data": "id",
                    "orderable": false,
                    "searchable": false
                },
                {
                    "data": "tanggal_donasi",
                    render: function(data) {
                        if (moment(data, 'YYYY-MM-DD').isValid() == false) {
                            return '-';
                        } else {
                            return moment(data).format('DD-MM-YYYY');
                        }
                    }
                },
                {
                    "data": "nama_item"
                },
                {
                    "data": "nama_satuan"
                },
                {
                    "data": "qty"
                },
                {
                    "data": "pengirim_donasi"
                },
                {
                    "data": "keterangan"
                },
                {
                    "data": "deleted_at",
                    render: function(data) {
                        if (moment(data, 'YYYY-MM-DD HH:mm:ss').isValid() == false) {
                            return '';
                        } else {
                            return 'Ya';
                        }
                    }
                },
                {
                    "data": "view",
                    "orderable": false,
                    "searchable": false,
                    "class": "text-center fit"
                }
            ],
            order: [
                [2, 'asc']
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
    });
</script>