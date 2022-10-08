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
                <h2>Media <?= $threadContent['headingcontent']; ?></h2>
                <div class="nav navbar-right panel_toolbox">
                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Tambah Media <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="<?= site_url('adminppid/' . $threadMain['slug'] . '/tambah_media/' . $threadContent['slug'] . '/fileppid') ?>">File PPID DIP</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?= site_url('adminppid/' . $threadMain['slug'] . '/tambah_media/' . $threadContent['slug'] . '/fileppidtag') ?>">File PPID Kategori</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?= site_url('adminppid/' . $threadMain['slug'] . '/tambah_media/' . $threadContent['slug'] . '/youtube') ?>">Youtube</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?= site_url('adminppid/' . $threadMain['slug'] . '/tambah_media/' . $threadContent['slug'] . '/jpg') ?>">JPG</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?= site_url('adminppid/' . $threadMain['slug'] . '/tambah_media/' . $threadContent['slug'] . '/png') ?>">PNG</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php
                if (!empty($threadMedia)) {
                ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="fitcell text-center">Type Media</th>
                                <th class="text-center">Detail Media</th>
                                <th class="text-center">Urutan</th>
                                <th class="text-center">Waktu Upload</th>
                                <th class="fitcell text-center">User Upload</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($threadMedia as $rowMedia) :
                            ?>
                                <tr>
                                    <td class="fitcell text-center"><?= ++$no; ?></td>
                                    <td class="fitcell"><?= $rowMedia['typefile']; ?></td>
                                    <td><?= ($rowMedia['typefile'] == 'youtube' ? $rowMedia['judulmedia'] : $rowMedia['namafile']); ?></td>
                                    <td class="fitcell text-center"><?= $rowMedia['urutan']; ?></td>
                                    <td class="fitcell text-center"><?= $rowMedia['datecreate']; ?></td>
                                    <td class="fitcell text-center"><?= $rowMedia['userupload']; ?></td>
                                    <td class="fitcell text-right">
                                        <?php
                                        if ($rowMedia['typefile'] == 'fileppid') {
                                        ?>
                                            <a href="<?= site_url('informasipublik/file/' . $rowMedia['slugFile']); ?>" target="blank" class="btn btn-sm btn-info">Lihat</a>
                                        <?php
                                        } elseif ($rowMedia['typefile'] == 'fileppidtag') {
                                        ?>
                                            <a href="<?= site_url('informasipublik/showfilekategori/' . $rowMedia['slugTag']); ?>" target="blank" class="btn btn-sm btn-info">Lihat</a>
                                        <?php
                                        } else {
                                        ?>
                                            <button type="button" class="btn btn-sm btn-info" disabled="true">Lihat</button>
                                        <?php
                                        }
                                        ?>
                                        <a href="<?= site_url('adminppid/' . $threadMain['slug'] . '/hapus_media/' . $threadContent['slug'] . '/' . $rowMedia['idmedia'] . '/' . $rowMedia['idfile']); ?>" onClick="return confirm('Anda yakin akan menghapus media???');" class="btn btn-sm btn-danger">Hapus</a>
                                        <a href="<?= site_url('adminppid/' . $threadMain['slug'] . '/edit_media/' . $threadContent['slug'] . '/' . $rowMedia['idmedia'] . '/' . $rowMedia['idfile']); ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <?php
                                        if ($no == 1) {
                                        ?>
                                            <a href="#" class="btn btn-default btn-sm disabled"><i class="fa fa-stop"></i></a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="<?= site_url('adminppid/' . $threadMain['slug'] . '/up/' . $threadContent['slug'] . '/' . $rowMedia['idmedia'] . '/' . $rowMedia['idfile']); ?>" class="btn btn-default btn-sm"><i class="fa fa-caret-up"></i></a>
                                        <?php
                                        }
                                        if ($no < count($threadMedia)) {
                                        ?>
                                            <a href="<?= site_url('adminppid/' . $threadMain['slug'] . '/down/' . $threadContent['slug'] . '/' . $rowMedia['idmedia'] . '/' . $rowMedia['idfile']); ?>" class="btn btn-default btn-sm"><i class="fa fa-caret-down"></i></a>
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
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo '<div class="alert alert-warning"><p>Data media belum tersedia.</p></div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>