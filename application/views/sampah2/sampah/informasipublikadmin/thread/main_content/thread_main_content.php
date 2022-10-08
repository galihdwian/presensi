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
                <h2><?= $thread_main->judultopik; ?></h2>
                <div class="nav navbar-right panel_toolbox">
                    <div class="dropdown">
                        <a href="<?= site_url('adminppid/' . $thread_main->slug . '/tambah_content'); ?>" class="btn btn-success dropdown-toggle">Tambah Content</a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php
                if (!empty($list_thread_content)) {
                ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Heading Content / Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($list_thread_content as $row) {
                            ?>
                                <tr>
                                    <td class="fitcell text-center"><?= ++$no; ?></td>
                                    <td><?= (!empty($row->headingcontent) ? "{$row->headingcontent}<br>" : "") . (!empty($row->keterangan) ? "Keterangan : {$row->keterangan}" : ""); ?></td>
                                    <td class="fitcell">
                                        <a href="<?= site_url('adminppid/' . $thread_main->slug . '/hapus_content/' . $row->idcontent); ?>" onClick="return confirm('Anda yakin akan menghapus cohtent???');" class="btn btn-sm btn-danger">Hapus</a>
                                        <a href="<?= site_url('adminppid/' . $thread_main->slug . '/edit_content/' . $row->idcontent); ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="<?= site_url('adminppid/' . $thread_main->slug . '/' . $row->slug); ?>" class="btn btn-sm btn-warning">Media</a>
                                        <?php
                                        if ($no == 1) {
                                        ?>
                                            <a href="#" class="btn btn-default btn-sm disabled"><i class="fa fa-stop"></i></a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="<?= site_url('adminppid/' . $thread_main->slug . '/up/' . $row->idcontent); ?>" class="btn btn-default btn-sm"><i class="fa fa-caret-up"></i></a>
                                        <?php
                                        }
                                        if ($no < count($list_thread_content)) {
                                        ?>
                                            <a href="<?= site_url('adminppid/' . $thread_main->slug . '/down/' . $row->idcontent); ?>" class="btn btn-default btn-sm"><i class="fa fa-caret-down"></i></a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="#" class="btn btn-default btn-sm disabled"><i class="fa fa-stop"></i></a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo '<div class="alert alert-warning"><p>Content belum tersedia.</p></div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>