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
                <h2>List Master Satuan Donasi</h2>
                <div class="nav navbar-right panel_toolbox">
                    <div class="dropdown">
                        <a href="<?= site_url('adminppid/donasi/master-satuan/tambah'); ?>" class="btn btn-success">
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
                            <th class="text-center">ID</th>
                            <th class="text-center">NAMA</th>
                            <th class="text-center">CREATED AT</th>
                            <th class="text-center">CREATED BY</th>
                            <th class="text-center">UPDATED AT</th>
                            <th class="text-center">UPDATED BY</th>
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
                "url": "<?= site_url('adminppid/donasi/master-satuan/listdata'); ?>",
                "type": "POST"
            },
            //id,nama_satuan,created_at,created_by,updated_at,updated_by
            columns: [{
                    "data": "id",
                    "orderable": false,
                    "searchable": false
                },
                {
                    "data": "id"
                },
                {
                    "data": "nama_satuan"
                },
                {
                    "data": "created_at",
                    render: function(data) {
                        if (moment(data, 'YYYY-MM-DD HH:mm:ss').isValid() == false) {
                            return '-';
                        } else {
                            return moment(data).format('DD-MM-YYYY HH:mm:ss');
                        }
                    }
                },
                {
                    "data": "created_by"
                },
                {
                    "data": "updated_at",
                    render: function(data) {
                        if (moment(data, 'YYYY-MM-DD HH:mm:ss').isValid() == false) {
                            return '-';
                        } else {
                            return moment(data).format('DD-MM-YYYY HH:mm:ss');
                        }
                    }
                },
                {
                    "data": "updated_by"
                },
                {
                    "data": "view",
                    "orderable": false,
                    "searchable": false,
                    "class": "text-center fit"
                }
            ],
            order: [
                [1, 'asc']
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