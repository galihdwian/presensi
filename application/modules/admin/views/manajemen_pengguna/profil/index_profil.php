<div class="row">
    <div class="col-md-12">
        <div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-purple">
                <div class="widget-user-image">
                    <img src="<?php echo base_url($this->session->userdata('avatar')); ?>" class="img-circle" alt="User Image">
                </div>
                <h3 class="widget-user-username"><?php echo $get_user->nama_user; ?></h3>
                <h5 class="widget-user-desc"><?php echo $get_user->nama_level; ?></h5>
            </div>
            <div class="box-footer no-padding">
                <table class="table table-striped table-hover col-dashed">
                    <tbody>
                        <tr>
                            <td class="fit">USERNAME</td>
                            <td>: <?php echo $get_user->username; ?></td>
                        </tr>
                        <tr>
                            <td class="fit">NAMA USER</td>
                            <td>: <?php echo $get_user->nama_user; ?></td>
                        </tr>
                        <tr>
                            <td class="fit">HAK AKSES</td>
                            <td>: <?php echo $get_user->nama_level; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>