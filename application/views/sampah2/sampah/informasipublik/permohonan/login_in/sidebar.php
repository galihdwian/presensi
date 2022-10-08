<div class="widget profile">
    <div class="profile">
        <div class="profile_pic">
            <?php
            if (empty($this->session->userdata['foto']) || $this->session->userdata['foto'] == "") {
                echo '<img src="' . base_url('assets/images/pemohon/foto/default.png') . '" class="img-circle profile_img">';
            } else {
                echo '<img src="' . base_url('assets/images/pemohon/foto/' . $this->session->userdata['foto']) . '" class="img-circle profile_img">';
            }
            ?>
        </div>
        <div class="profile_info">
            <span>Welcome,</span>
            <h2>
                <?php
                if (!empty($this->session->userdata['full_name'])) {
                    echo $this->session->userdata['full_name'];
                }
                ?>
            </h2>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="widget archieve">
    <div class="row">
        <div class="col-sm-12">
            <table class="table-borderedbottom table-condensed">
                <tbody>
                    <tr>
                        <td><a href="<?php echo site_url('pemohon_dashboard'); ?>"><i class="fa fa-home fa-2x"></i></a></td>
                        <td><a href="<?php echo site_url('pemohon_dashboard'); ?>">Permohonan Dashboard</a></td>
                    </tr>
                    <tr>
                        <td><a href="<?php echo site_url('pengajuan_permohonan'); ?>"><i class="fa fa-file-o fa-2x"></i></a></td>
                        <td><a href="<?php echo site_url('pengajuan_permohonan'); ?>">Pengajuan Permohonan</a></td>
                    </tr>
                    <tr>
                        <td><a href="<?php echo site_url('daftar_pengajuan_permohonan'); ?>"><i class="fa fa-list-alt fa-2x"></i></a></td>
                        <td><a href="<?php echo site_url('daftar_pengajuan_permohonan'); ?>"> List Pengajuan Permohonan</a></td>
                    </tr>
                    <tr>
                        <td><a href="<?php echo site_url('pengajuan_keberatan'); ?>"><i class="fa fa-thumbs-down fa-2x"></i></a></td>
                        <td><a href="<?php echo site_url('pengajuan_keberatan'); ?>"> Pengajuan Keberatan</a></td>
                    </tr>
                    <tr>
                        <td><a href="<?php echo site_url('daftar_pengajuan_keberatan'); ?>"><i class="fa fa-list-alt fa-2x"></i></a></td>
                        <td><a href="<?php echo site_url('daftar_pengajuan_keberatan'); ?>"> List Pengajuan Keberatan</a></td>
                    </tr>
<!--                    <tr>
                        <td><a href="<?php // echo site_url('profil_pemohon');  ?>"><i class="fa fa-user fa-2x"></i></a></td>
                        <td><a href="<?php // echo site_url('profil_pemohon');  ?>"> Profil Data</a></td>
                    </tr>
                    <tr>
                        <td><a href="<?php // echo site_url('rubahpassword_pemohon');  ?>"><i class="fa fa-key fa-2x"></i></a></td>
                        <td><a href="<?php // echo site_url('rubahpassword_pemohon');  ?>">Rubah Password</a></td>
                    </tr>-->
                    <tr>
                        <td><a href="<?php echo site_url('pemohon_logout'); ?>"><i class="fa fa-power-off fa-2x"></i></a></td>
                        <td><a href="<?php echo site_url('pemohon_logout'); ?>"> Logout</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>                     
</div>