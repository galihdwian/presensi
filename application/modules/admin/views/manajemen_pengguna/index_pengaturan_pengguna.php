<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Pengaturan Pengguna</h3>
                <div class="pull-right">
                    <a href="<?php echo site_url('admin/manajemen_pengguna/user_add'); ?>" class="btn btn-sm btn-primary btn-flat">Tambah</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-condensed bordered-orange">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA</th>
                            <th>USERNAME</th>
                            <th>HAK AKSES</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($list_user as $row) :
                            $cipher_username = aesencryptstring($row->username);
                            echo '<tr ' . ($row->hakakses == '0' ? 'class="bg-danger"' : '') . '>';
                            echo '<td class="fit text-center">' . ++$no . '</td>';
                            echo '<td>' . $row->namauser . '</td>';
                            echo '<td>' . $row->username . '</td>';
                            echo '<td>' . $row->namahakakses . '</td>';
                            echo '<td  class="fit text-right">';
                            if ($row->hakakses == 'PN' || $row->hakakses == 'PS') {
                                echo '<a href="' . site_url('admin/manajemen_pengguna/user_wawancara/' . $cipher_username) . '" class="btn btn-sm btn-flat btn-info mr-5">AKSES WAWANCARA</a>';
                            }
                            echo '<a href="' . site_url('admin/manajemen_pengguna/user_detail/' . $cipher_username) . '" class="btn btn-sm btn-flat btn-primary mr-5">DETAIL</a>';
                            echo '<a href="' . site_url('admin/manajemen_pengguna/user_edit/' . $cipher_username) . '" class="btn btn-sm btn-flat btn-warning mr-5">EDIT</a>';
                            echo '</td>';
                            echo '</tr>';
                        endforeach;
                        ?>
                    </tbody>
                </table>

                <div class="clearfix"></div>
            </div>
            <div class="box-footer">
                <div class="pull-right">
                </div>
            </div>
        </div>
    </div>
</div>