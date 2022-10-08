<?php
if (!empty($error)) {
    echo $error;
}
echo validation_errors('<div class="alert alert-danger"><p>', '</p></div>');
echo $this->session->flashdata('message_status');
?>
<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_content"> 
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="pull-right">
                            <a class="btn btn-default btn-sm" href="<?php echo site_url('adminppid/groupfile/add'); ?>">Tambah Data</a>
                        </div>
                        <div class="clearfix"></div>
                        <div id="datacontent">
                            <?php
                            if (!empty($get_aliasgroupfile)) {
                                ?>
                                <table class="table table-bordered table-condensed table-centeredhead">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Group</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 0;
                                        foreach ($get_aliasgroupfile as $r_group):
                                            $no++;
                                            echo '<tr>';
                                            echo '<td class="fit">' . $no . '</td>';
                                            echo '<td>' . $r_group['alias_group'] . '</td>';
                                            echo '<td class="fit centertext">';
                                            ?>
                                        <a href="<?php echo site_url('adminppid/groupfile/edit/' .$r_group['alias_group']); ?>" class="btn btn-xs btn-primary">Detail & Edit</a>
                                        <a href="<?php echo site_url('adminppid/groupfile/delete/' .$r_group['alias_group']); ?>" onClick="return confirm('Anda yakin..???');" class="btn btn-xs btn-warning">Hapus</a>
                                        <?php
                                        echo '</td>';
                                        echo '</tr>';
                                    endforeach;
                                    unset($no, $r_group);
                                    ?>
                                    </tbody>
                                </table>
                                <?php
                            } else {
                                echo '<div class="alert alert-warning">Maaf, Data belum tersedia</div>';
                            }
                            ?>                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>